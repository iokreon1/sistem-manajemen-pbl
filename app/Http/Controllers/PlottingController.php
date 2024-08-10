<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use App\Models\NilaiPM;
use App\Models\Kelompok;
use App\Models\Projects;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use App\Models\NilaiMingguan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exports\ScoresExport;
use Maatwebsite\Excel\Facades\Excel;

class PlottingController extends Controller
{
    public function edit($project_id)
    {
        $projects = Projects::all();
        $project = Projects::findorfail($project_id);
        return view('admin.plotting', compact('projects', 'project'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nim_ketua' => 'required|string',
                'nim_anggota.*' => 'nullable|string',
            ]);

            $project_id = $request->input('project_id');
            $nim_ketua = $request->input('nim_ketua');
            $nim_anggota = $request->input('nim_anggota');

            $this->simpanAnggotaKelompok($project_id, $nim_ketua, true);

            if (is_array($nim_anggota)) {
                foreach ($nim_anggota as $nim) {
                    if (!empty($nim)) {
                        $result_anggota = $this->simpanAnggotaKelompok($project_id, $nim, false);
                        if (!$result_anggota) {
                            return redirect()->back();
                        }
                    }
                }
            }

            return redirect()->route('manage-admin.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    protected function simpanAnggotaKelompok($project_id, $nim, $isKetua)
    {
        try {
            // Ambil semester dari project yang sedang diproses
            $currentProjectSemester = Projects::where('project_id', $project_id)->pluck('semester')->first();

            // Periksa apakah NIM sudah ada di kelompok dari project yang sama
            $existingKelompokCurrentProject = Kelompok::where('nim', $nim)
                ->where('project_id', $project_id)
                ->first();

            if ($existingKelompokCurrentProject) {
                toastr()->warning("Gagal menyimpan data anggota kelompok dengan NIM: $nim. NIM tersebut sudah terdaftar dalam kelompok yang sama");
                return false;
            }

            // Periksa apakah NIM sudah ada di kelompok di semester yang sama tetapi project yang berbeda
            $existingKelompokSameSemester = Kelompok::where('nim', $nim)
                ->whereHas('projects', function ($query) use ($currentProjectSemester, $project_id) {
                    $query->where('semester', $currentProjectSemester)
                        ->where('project_id', '!=', $project_id);
                })
                ->first();

            if ($existingKelompokSameSemester) {
                toastr()->warning("Gagal menyimpan data anggota kelompok dengan NIM: $nim. NIM tersebut sudah terdaftar dalam kelompok lain pada semester yang sama.");
                return false;
            }

            // Periksa apakah sudah ada ketua dalam project yang sama
            if ($isKetua) {
                $existingKetuaInProject = Kelompok::where('project_id', $project_id)
                    ->where('ketua_kelompok', 1)
                    ->first();
                if ($existingKetuaInProject) {
                    toastr()->warning("Gagal menyimpan data anggota kelompok dengan NIM: $nim. Project ini sudah memiliki ketua.");
                    return false;
                }
            }

            // Simpan anggota kelompok baru
            $kelompok = new Kelompok();
            $kelompok->project_id = $project_id;
            $kelompok->nim = $nim;
            $kelompok->ketua_kelompok = $isKetua ? 1 : 0;
            $kelompok->save();

            return true;

        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah di server: ' . $e->getMessage());
            return false;
        }
    }

    public function show($project_id)
    {
        $project = Projects::findOrFail($project_id);
        $milestones = $project->milestones;
        if ($project->kelompok()->exists()) {

            $kelompok = $project->kelompok()->get();
            $mahasiswas = collect();

            foreach ($kelompok as $data_kelompok) {

                $mahasiswas = $mahasiswas->merge($data_kelompok->mahasiswas);
            }
        } else {

            $kelompok = null;
            $mahasiswas = collect();
        }
        $dosen_pengampu = $project->dosenPengampu()->get(['nip', 'kode_mata_kuliah']);

        $nilaiPengampu = NilaiMingguan::where('project_id', $project_id)->get();
        $nilaiPM = NilaiPM::where('project_id', $project_id)->get();
        $nilaiUjian = NilaiUjian::where('project_id', $project_id)->get();

        $nilaiMingguanRekap = DB::table('nilai_harian_pengampu')
            ->select('nim', DB::raw('AVG(nilai_aspek) as rata_rata'))
            ->where('project_id', $project_id)
            ->groupBy('nim')
            ->get();

        
        $nilaiFase = DB::table('nilai_pm')
        
        ->join('aspek_penilaian_pm', 'nilai_pm.aspek_id', '=', 'aspek_penilaian_pm.aspek_id')
        ->join('fase_project', 'aspek_penilaian_pm.fase_id', '=', 'fase_project.fase_id')
        ->select('nilai_pm.nim', 'fase_project.fase_id', DB::raw('AVG(nilai_pm.nilai_aspek) as rata_rata'))
        ->where('nilai_pm.project_id', $project_id)
        ->groupBy('nilai_pm.nim', 'fase_project.fase_id')
        ->get();

        $rekapNilai = [];
        foreach ($mahasiswas as $mhs) {
            $nilaiMingguanPengampu = $nilaiMingguanRekap->where('nim', $mhs->nim)->first()->rata_rata ?? 0;
            // $nilaiMingguanPengampu /= 8;
            
        $faseNilai = $nilaiFase->where('nim', $mhs->nim);
        $totalNilaiFase = $faseNilai->sum('rata_rata');
        $jumlahFase = 4;
        $nilaiFasePM = $jumlahFase > 0 ? $totalNilaiFase / $jumlahFase : 0;
            
        $nilaiUTSCollection = $nilaiUjian->where('nim', $mhs->nim)->where('tipe_ujian', 'UTS');
        $nilaiUTS = $nilaiUTSCollection->avg('nilai_aspek') ?? 0;

        $nilaiUASCollection = $nilaiUjian->where('nim', $mhs->nim)->where('tipe_ujian', 'UAS');
        $nilaiUAS = $nilaiUASCollection->avg('nilai_aspek') ?? 0;

            $nilaiMingguan = ($nilaiMingguanPengampu * 0.5) + ($nilaiFasePM * 0.5);
            $nilaiUjianTotal = ($nilaiUTS * 0.5) + ($nilaiUAS * 0.5);
            $nilaiAkhir = ($nilaiMingguan * 0.6) + ($nilaiUjianTotal * 0.4);

            $rekapNilai[] = [
                'nim' => $mhs->nim,
                'nama' => $mhs->nama_lengkap,
                'nilai_harian_pengampu' => number_format($nilaiMingguanPengampu, 2),
                'nilai_harian_pm' => number_format($nilaiFasePM, 2),
                'nilai_uts' => number_format($nilaiUTS, 2),
                'nilai_uas' => number_format($nilaiUAS, 2),
                'nilai_akhir' => number_format($nilaiAkhir, 2),
            ];
        }

        return view('admin.detail', compact('project', 'kelompok', 'mahasiswas', 'dosen_pengampu', 'milestones', 'nilaiPengampu', 'nilaiPM', 'nilaiUjian', 'nilaiMingguanRekap', 'rekapNilai'));
    }

    

}

