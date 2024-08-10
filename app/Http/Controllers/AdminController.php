<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Projects;
use App\Models\Mahasiswa;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\FaseProject;
use App\Models\Dosen;
use App\Models\Waktu;

class AdminController extends Controller
{
    // public function show() {
    //     return view('admin.plotting');
    // }
    public function index()
    {
        $projects = Projects::all();
        $project = Projects::select('projects.*')
            ->join('kelompok', 'projects.project_id', '=', 'kelompok.project_id')
            ->join('mahasiswa', 'kelompok.nim', '=', 'mahasiswa.nim')
            ->get();
        
            foreach ($projects as $project) {
                $totalIssues = $project->milestones->flatMap->issues->count();
                $completedIssues = $project->milestones->flatMap->issues->where('status', true)->count();
                $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
            }
            
        return view('admin.index', compact('projects','project'));
    }

    public function create()
    {
        $projects = Projects::all();
        return view('admin.create', compact('projects'));
    }

    public function search(Request $request) {
        $searchTerm = $request->input('term');
    
        $dosen = Dosen::where('nama_dosen', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('nip', 'LIKE', "%{$searchTerm}%")
                    ->get(['nip', 'nama_dosen']);
    
        return response()->json($dosen);
    }

    public function search_Mahasiswa(Request $request) {
        $searchTerm = $request->input('term');
    
        $mahasiswa = Mahasiswa::where('nama_lengkap', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('nim', 'LIKE', "%{$searchTerm}%")
                    ->get(['nama_lengkap','nim']);
    
        return response()->json($mahasiswa);
    }

    public function autocomplete(Request $request)
    {
        $search = $request->input('term');
    
        $fases = FaseProject::where('nama_fase', 'LIKE', "%{$search}%")
                ->orWhere('fase_id', 'LIKE', "%{$search}%")
                ->get(['nama_fase', 'fase_id']);
    
        return response()->json($fases);
    }    

    public function dosen_pengampu(Request $request)
    {
        $search = $request->get('term');

    $result = MataKuliah::with('dosen')
        ->where('nama_matakuliah', 'LIKE', '%'. $search. '%')
        ->orWhereHas('dosen', function($query) use ($search) {
            $query->where('nama_dosen', 'LIKE', '%'. $search. '%');
        })
        ->get();

    $data = [];
    foreach ($result as $item) {
        $data[] = [
            'label' => $item->dosen->nama_dosen . ' - ' . $item->nama_matakuliah,
            'value' => $item->dosen->nama_dosen,
            'kode_mata_kuliah' => $item->kode_mata_kuliah,
            'nip' => $item->dosen->nip
        ];
    }

    return response()->json($data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode_pbl' => 'required|string',
                'nip' => 'required|string',
                'waktu_pengerjaan' => 'required|string',
                'semester' => 'required|integer',
                'jenis_usulan' => 'required|integer',
                'tahun_akademik' => 'required|string',
                'tipe_pendanaan' => 'required|integer',
                'judul_project' => 'required|string',
                'desain_umum' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date',
                'kode_mata_kuliah' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->error('Judul project gagal ditambah </br> Periksa kembali data anda');
                $errors = $validator->errors()->all();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $project = Projects::create([
                'desain_umum' => $request->desain_umum,
                'nip' => $request->nip,
                'judul_project' => $request->judul_project,
                'tipe_pendanaan' => $request->tipe_pendanaan,
                'kode_pbl' => $request->kode_pbl,
                'waktu_pengerjaan' => $request->waktu_pengerjaan ?: null,
                'semester' => $request->semester,
                'jenis_usulan' => $request->jenis_usulan,
                'tahun_akademik' => $request->tahun_akademik,
            ]);

            $project->waktu()->create([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            foreach (array_filter($request->input('nip1')) as $index => $nip) {
                $kode_mata_kuliah = $request->input('kode_mata_kuliah')[$index]; // Ambil nilai kode_mata_kuliah dari permintaan
                $project->dosenPengampu()->create([
                    'nip' => $nip,
                    'kode_mata_kuliah' => $kode_mata_kuliah,
                ]);
            }            

            toastr()->success('Judul project berhasil disimpan');
            return redirect()->route('manage-admin.index');
        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah di server: ' . $e->getMessage());
            return redirect()->route('manage-admin.index');
        }
    }

    public function edit($project_id)
    {
        $projects = Projects::all();
        $project = Projects::findorfail($project_id);
        $waktu = Waktu::where('project_id', $project_id)->first();

        $waktu_mulai_formatted = $waktu ? \Carbon\Carbon::parse($waktu->tanggal_mulai)->format('Y-m-d') : null;
        $waktu_selesai_formatted = $waktu ? \Carbon\Carbon::parse($waktu->tanggal_selesai)->format('Y-m-d') : null;

        $dosen_pengampu = $project->dosenPengampu()->get(['nip', 'kode_mata_kuliah','id_dosen_pengampu']);
        // dd($dosen_pengampu);

        return view('admin.edit', compact('project', 'projects', 'waktu', 'waktu_mulai_formatted', 'waktu_selesai_formatted','dosen_pengampu'));
    }

    public function update(Request $request, $project_id)
    {
        try {
            $project = Projects::findorfail($project_id);
            $project->kode_pbl = $request->post('kode_pbl');
            $project->desain_umum = $request->post('desain_umum');
            $project->judul_project = $request->post('judul_project');
            $project->tipe_pendanaan = $request->post('tipe_pendanaan');
            $project->jenis_usulan = $request->post('jenis_usulan');
            $project->semester = $request->post('semester');
            $project->tahun_akademik = $request->post('tahun_akademik');
            $project->waktu_pengerjaan = $request->post('waktu_pengerjaan');
            $project->update();
    
            // $project->dosenPengampu()->delete();
            // dd($request->input('nip1')); 
            // dd($request->input('kode_mata_kuliah'));
            $failed_NIP = []; 

            foreach (array_filter($request->input('nip1')) as $index => $nip) {
                $kode_mata_kuliah = $request->input('kode_mata_kuliah')[$index]; 
            
                $existingEntry = $project->dosenPengampu()->where('nip', $nip)->first();
            
                if (!$existingEntry) {

                    $project->dosenPengampu()->create([
                        'nip' => $nip,
                        'kode_mata_kuliah' => $kode_mata_kuliah,
                    ]);
                } else {

                    $failed_NIP[] = $nip;
                }
            }
            
            if (!empty($failed_NIP)) {

                $Nips = implode(', ', $failed_NIP);
                throw new \Exception(" NIP berikut sudah ada dalam project ini: $Nips");
            }            
    
            toastr()->success('Menu berhasil disimpan');
            return redirect()->route('manage-admin.index');
        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah diserver' . $e->getMessage());
            return redirect()->route('manage-admin.index');
        }
    }    
    
    public function destroy($project_id)
    {
        try {
            $project = Projects::findOrFail($project_id);
            $project->delete();
            
            // $dosen_pengampu = Projects::findOrFail($project_id);
            // $dosen_pengampu->delete();

            $waktu = Waktu::where('project_id', $project_id)->first();
            if ($waktu) {
                $waktu->delete();
            }

        toastr()->success('Proyek berhasil dihapus');
            return redirect()->route('manage-admin.index');
        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah di server: ' . $e->getMessage());
            return redirect()->route('manage-admin.index');
        }
    }
    public function hapus($id_dosen_pengampu) {
        $dosenPengampu = DosenPengampu::find($id_dosen_pengampu);
        if ($dosenPengampu) {
            $dosenPengampu->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
    
}
