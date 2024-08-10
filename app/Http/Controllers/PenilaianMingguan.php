<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\FaseProject;
use App\Models\MataKuliah;
use App\Models\AspekPenilaianPengampu;
use App\Models\DosenPengampu;
use App\Models\NilaiMingguan;
use App\Models\NilaiUjian;
use App\Models\AspekPenilaianPM;
use App\Models\NilaiPM;
use App\Models\Waktu;
use App\Models\Milestone;
use App\Models\Issues;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class PenilaianMingguan extends Controller
{
    public function index()
    {
        $tahun = request()->get('tahun');
        $dosenId = Auth::user()->id;

        $dosen = Dosen::where('id_user', $dosenId)->first();
        if (!$dosen) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan');
        }
        $nip = $dosen->nip;

        $projects = Projects::with(['dosenPengampu', 'dosenPengampu.mataKuliah'])
            ->select('projects.*')
            ->join('dosen_pengampu', 'projects.project_id', '=', 'dosen_pengampu.project_id')
            ->where('dosen_pengampu.nip', $nip)
            ->when($tahun, function ($query, $tahun) {
                return $query->where('projects.tahun_akademik', 'LIKE', "%$tahun%");
            })
            ->with([
                'milestones.issues' => function ($query) {
                    $query->select('milestone_id', 'status');
                }])
            ->groupBy('projects.project_id', 'projects.judul_project', 'projects.nip', 'projects.tahun_akademik', 'projects.semester', 'projects.jenis_usulan', 'projects.tipe_pendanaan', 'projects.desain_umum', 'projects.waktu_pengerjaan', 'projects.kode_pbl')
            ->get();
        // dd($projects);
        foreach ($projects as $project) {
            $totalIssues = $project->milestones->flatMap->issues->count();
            $completedIssues = $project->milestones->flatMap->issues->where('status', true)->count();
            $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
        }
        $mahasiswa = Mahasiswa::all();
        $years = Projects::distinct()->pluck('tahun_akademik')->toArray();
        return view('penilaianmingguan.index', compact('projects', 'years', 'tahun'));
    }

    public function edit($project_id, $kode_mata_kuliah)
    {
        $week = request()->get('minggu', 2);
        $project = Projects::with([
            'dosenPengampu' => function ($query) use ($kode_mata_kuliah) {
                $query->where('kode_mata_kuliah', $kode_mata_kuliah);
            }
        ])->findOrFail($project_id);

        
        $fase_project = FaseProject::all();
        $aspek = AspekPenilaianPengampu::get();
        $dosen = Dosen::where('id_user', Auth::user()->id)->first();

        $nilaiMingguan = NilaiMingguan::where('project_id', $project_id)
            ->where('kode_mata_kuliah', $kode_mata_kuliah)
            ->where('minggu', $week)
            ->get()
            ->groupBy('nim');

        $nilaiUjian = NilaiUjian::where('project_id', $project_id)
            ->where('kode_mata_kuliah', $kode_mata_kuliah)
            ->where('tipe_ujian', $week)
            ->get()
            ->groupBy('nim');

        return view('penilaianmingguan.edit', compact('project', 'fase_project', 'aspek', 'dosen', 'kode_mata_kuliah', 'nilaiMingguan', 'nilaiUjian', 'week'));
    }


    public function store(Request $request)
    {
        $post_data = $request->all();
        // dd($post_data);
        try {
            DB::beginTransaction();
            $project = Projects::findOrFail($post_data['project_id']);
            $kode_mata_kuliah = $post_data['kode_mata_kuliah'];

            

            if ($post_data['penilaian'] == 'UAS' || $post_data['penilaian'] == 'UTS') {
                foreach ($post_data['nim'] as $nim) {
                    foreach ($post_data['aspek_id'] as $aspek) {
                        try {
                            DB::table('nilai_ujian')->upsert([
                                'nim' => $nim,
                                'kode_mata_kuliah' => $kode_mata_kuliah,
                                'project_id' => $post_data['project_id'],
                                'tipe_ujian' => $post_data['penilaian'],
                                'aspek_id' => $aspek,
                                'nilai_aspek' => $post_data['nilai_aspek'][$nim][$aspek]
                            ], ['nim', 'kode_mata_kuliah', 'project_id', 'tipe_ujian', 'aspek_id'], ['nilai_aspek']);
                            echo "Data inserted successfully!";
                        } catch (QueryException $e) {
                            $errorCode = $e->getCode();
                            $errorMessage = $e->getMessage();
                            echo "Error Code: " . $errorCode . " - " . $errorMessage;
                            die;
                        }
                    }
                }
                // return redirect()->back();
            } else {
                $project = Projects::findorfail($post_data['project_id']);
                $kode_mata_kuliah = $post_data['kode_mata_kuliah'];
                // dd($kode_mata_kuliah);

                $i = 1;
                foreach ($post_data['nim'] as $nim) {
                    foreach ($post_data['aspek_id'] as $aspek) {
                        echo $i++ . "<br>";
                        DB::table('nilai_harian_pengampu')->upsert([
                            'minggu' => $post_data['penilaian'],
                            'nim' => $nim,
                            'kode_mata_kuliah' => $kode_mata_kuliah,
                            'project_id' => $post_data['project_id'],
                            'aspek_id' => $aspek,
                            'nilai_aspek' => $post_data['nilai_aspek'][$nim][$aspek]
                        ], ['minggu', 'nim', 'kode_mata_kuliah', 'project_id', 'aspek_id'], ['nilai_aspek']);
                    }
                }
                // return redirect()->back();
            }
            if ($request->penilaian == 'UTS' or $request->penilaian == 'UAS') {
                toastr()->success('Berhasil Menambahkan Penilaian Ujian');
            } else {
                toastr()->success('Berhasil Menambahkan Penilaian Mingguan');
            }

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('Terjadi kesalahan saat menyimpan data.');
            return redirect()->back()->withInput();
        }
    }

    public function rekap($project_id, $kode_mata_kuliah)
    {
        $project = Projects::with([
            'dosenPengampu' => function ($query) use ($kode_mata_kuliah) {
                $query->where('kode_mata_kuliah', $kode_mata_kuliah);
            }
        ])->findOrFail($project_id);

        $nilaiPengampu = NilaiMingguan::all();
        $nilaiUji = NilaiUjian::all();
        $dosen = Dosen::where('id_user', Auth::user()->id)->first();

        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.nim', '=', 'kelompok.nim')
            ->where('kelompok.project_id', $project_id)
            ->get();

        $nilaiMingguan = DB::table('nilai_harian_pengampu')
            ->select('nim', 'minggu', DB::raw('AVG(nilai_aspek) as rata_rata'))
            ->where('project_id', $project_id)
            ->where('kode_mata_kuliah', $kode_mata_kuliah)
            ->groupBy('nim', 'minggu')
            ->get()
            ->groupBy('nim');

        $nilaiUjian = DB::table('nilai_ujian')
            ->select('nim', 'tipe_ujian', DB::raw('AVG(nilai_aspek) as rata_rata'))
            ->where('project_id', $project_id)
            ->where('kode_mata_kuliah', $kode_mata_kuliah)
            ->groupBy('nim', 'tipe_ujian')
            ->get()
            ->groupBy('nim');

        return view(
            'penilaianmingguan.rekap',
            compact(
                'project',
                'dosen',
                'kode_mata_kuliah',
                'nilaiMingguan',
                'nilaiUjian',
                'nilaiUji',
                'nilaiPengampu',
                'mahasiswa'
            )
        );
    }

    public function detail($project_id) 
    {
        $project = Projects::findOrFail($project_id);
        $milestones = Milestone::where('project_id', $project_id)->get();

        $totalIssues = $milestones->flatMap->issues->count();
        $completedIssues = $milestones->flatMap->issues->where('status', true)->count();
        $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
        
        $kelompok = $project->kelompok()->exists() ? $project->kelompok()->get() : null;
        $mahasiswas = $kelompok ? $kelompok->flatMap(fn($k) => $k->mahasiswas) : collect();

        $dosen_pengampu = $project->dosenPengampu()->get(['nip', 'kode_mata_kuliah']);

        return view('penilaianmingguan.detail', compact('project', 'kelompok', 'mahasiswas', 'dosen_pengampu', 'milestones'));
    }
}
