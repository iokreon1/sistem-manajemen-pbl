<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\FaseProject;
use App\Models\AspekPenilaianPM;
use App\Models\NilaiPM;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\Waktu;
use App\Models\Milestone;
use App\Models\Issues;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiFaseController extends Controller
{
    public function index()
    {
        $tahun = request()->get('tahun');
        $id_users = auth()->id();

        $projects = projects::select('projects.*')
            ->join('dosen', 'projects.nip', '=', 'dosen.nip')
            ->where('dosen.id_user', '=', $id_users)
            ->when($tahun, function ($query, $tahun) {
                return $query->where('projects.tahun_akademik', 'LIKE', "%$tahun%");
            })
            ->with([
                'milestones.issues' => function ($query) {
                    $query->select('milestone_id', 'status');
                }])
            ->get();

            foreach ($projects as $project) {
                $totalIssues = $project->milestones->flatMap->issues->count();
                $completedIssues = $project->milestones->flatMap->issues->where('status', true)->count();
                $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
            }
        $nilai_pm = NilaiPM::all();
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        $years = Projects::distinct()->pluck('tahun_akademik')->toArray();

        $mergedProjects = $projects->merge($nilai_pm)->merge($dosen);
        return view('dosen.index', compact('projects', 'years', 'tahun'));
    }

    public function edit($project_id)
    {
        $project = Projects::findorfail($project_id);
        $fase_project = FaseProject::all();
        $fase_id = request()->get('fase_id') != "" ? request()->get('fase_id') : 1;
        $aspek = AspekPenilaianPM::where('fase_id', $fase_id)->get();
        $dosen = Dosen::where('id_user', Auth::user()->id)->get();
        $dosen = Dosen::where('id_user', 3)->first();
        $nilai_aspek = NilaiPM::where('project_id', $project_id)->get();

        
        return view('dosen.edit', compact('project', 'fase_project', 'fase_id', 'aspek', 'dosen', 'nilai_aspek'));
    }

    public function store()
    {
        $post_data = request()->all();
        // dd($post_data);
        $i = 1;
        foreach ($post_data['nim'] as $nim) {
            foreach ($post_data['aspek_id'] as $aspek) {
                echo $i++ . "<br>";
                DB::table('nilai_pm')->upsert([
                    'nim' => $nim,
                    'nip' => $post_data['nip'],
                    'project_id' => $post_data['project_id'],
                    'aspek_id' => $aspek,
                    'nilai_aspek' => $post_data['nilai_aspek'][$nim][$aspek]
                ], ['nim', 'nip', 'project_id', 'aspek_id'], ['nilai_aspek']);
            }
        }
        return redirect()->route('manage-dosen.edit', ['manage_dosen' => $post_data['project_id']]);
    }


    public function filter()
    {
        $projects = Projects::all();
        $titles = Projects::distinct()->pluck('judul_project')->toArray();
        $years = Projects::distinct()->pluck('tahun_akademik')->toArray();


        return view('dosen.index', compact('projects', 'titles', 'years'));
    }

    

    public function rekap($project_id)
    {
            
        $project = Projects::findOrFail($project_id);
        $fase_project = FaseProject::all();
        $fase_id = request()->get('fase_id') != "" ? request()->get('fase_id') : 1;
        $aspek = AspekPenilaianPM::where('fase_id', $fase_id)->get();
        $dosen = Dosen::where('id_user', Auth::user()->id)->first();
        $nilai_aspek = NilaiPM::where('project_id', $project_id)->get();

        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.nim', '=', 'kelompok.nim')
            ->where('kelompok.project_id', $project_id)
            ->get();

        $nilai_aspek_grouped = NilaiPM::select('nilai_pm.nim', 'aspek_penilaian_pm.fase_id', 'nilai_pm.nilai_aspek')
            ->join('aspek_penilaian_pm', 'nilai_pm.aspek_id', '=', 'aspek_penilaian_pm.aspek_id')
            ->join('fase_project', 'aspek_penilaian_pm.fase_id', '=', 'fase_project.fase_id')
            ->where('nilai_pm.project_id', $project_id)
            ->get()
            ->groupBy('nim')
            ->map(function ($item) {
                return $item->groupBy('fase_id');
            });

        return view('dosen.rekap', compact('project', 'fase_project', 'fase_id', 'aspek', 'dosen', 'nilai_aspek', 'nilai_aspek_grouped', 'mahasiswa'));
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

        return view('dosen.detail', compact('project', 'kelompok', 'mahasiswas', 'dosen_pengampu', 'milestones'));
    }


}