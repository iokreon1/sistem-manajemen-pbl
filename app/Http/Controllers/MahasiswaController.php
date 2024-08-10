<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Mahasiswa;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\FaseProject;
use App\Models\Dosen;
use App\Models\Waktu;
use App\Models\Milestone;
use App\Models\Issues;

class MahasiswaController extends Controller
{
    public function index()
    {
        $id_users = auth()->id();

        $projects = Projects::select('projects.*')
            ->join('kelompok', 'projects.project_id', '=', 'kelompok.project_id')
            ->join('mahasiswa', 'kelompok.nim', '=', 'mahasiswa.nim')
            ->where('mahasiswa.id_users', '=', $id_users)
            ->with([
                'milestones.issues' => function ($query) {
                    $query->select('milestone_id', 'status');
                }
            ])
            ->get();
        foreach ($projects as $project) {
            $totalIssues = $project->milestones->flatMap->issues->count();
            $completedIssues = $project->milestones->flatMap->issues->where('status', true)->count();
            $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
        }
        

        return view('mahasiswa.index', compact('projects'));
    }

    public function show($project_id)
    {
        $project = Projects::findOrFail($project_id);
        $milestones = Milestone::where('project_id', $project_id)->get();

        $totalIssues = $milestones->flatMap->issues->count();
        $completedIssues = $milestones->flatMap->issues->where('status', true)->count();
        $project->overallProgress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
        
        $kelompok = $project->kelompok()->exists() ? $project->kelompok()->get() : null;
        $mahasiswas = $kelompok ? $kelompok->flatMap(fn($k) => $k->mahasiswas) : collect();

        $dosen_pengampu = $project->dosenPengampu()->get(['nip', 'kode_mata_kuliah']);

        return view('mahasiswa.detail', compact('project', 'kelompok', 'mahasiswas', 'dosen_pengampu', 'milestones'));
    }

    public function create($project_id)
    {
        $project = Projects::findOrFail($project_id);
        $milestones = Milestone::where('project_id', $project_id)->get();
        return view('mahasiswa.create', compact('milestones', 'project_id', 'project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_milestone' => 'required|string',
            'deskripsi' => 'required|string',
            'start' => 'required|date',
            'deadline' => 'required|date|after:start',
            'project_id' => 'required|exists:projects,project_id',
        ]);

        try {
            $milestone = new Milestone();
            $milestone->nama_milestone = $request->input('nama_milestone');
            $milestone->deskripsi = $request->input('deskripsi');
            $milestone->start = $request->input('start');
            $milestone->deadline = $request->input('deadline');
            $milestone->project_id = $request->input('project_id');
            $milestone->save();
            $project = Projects::find($request->input('project_id'));
            session()->flash('sukses', 'Milestone berhasil ditambahkan.');
            return redirect()->route('manage-project.show', ['project_id' => $milestone->project_id, 'nip' => $project->nip]);
        } catch (\Exception $e) {
            toastr()->error('Terdapat masalah saat menyimpan milestone: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($milestone_id)
    {
        $milestone = Milestone::findOrFail($milestone_id);
        $project = $milestone->project_id;
        return view('mahasiswa.edit', compact('milestone', 'project'));
    }

    public function update(Request $request, $milestone_id)
    {
        try {
            $milestone = Milestone::findOrFail($milestone_id);
            $milestone->nama_milestone = $request->post('nama_milestone');
            $milestone->deskripsi = $request->post('deskripsi');
            $milestone->start = $request->post('start');
            $milestone->deadline = $request->post('deadline');
            $milestone->update();

            $project = $milestone->project;

            toastr()->success('Milestone berhasil diupdate');
            return redirect()->route('manage-project.show', ['project_id' => $milestone->project_id, 'nip' => $project->nip]);
        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah di server: ' . $e->getMessage());
            return redirect()->route('manage-project.show', ['project_id' => $milestone->project_id, 'nip' => $project->nip]);
        }
    }

    public function destroy($project_id, $milestone_id)
    {
        try {
            $milestone = Milestone::where('project_id', $project_id)->where('milestone_id', $milestone_id)->firstOrFail();
            Issues::where('milestone_id', $milestone_id)->delete();
            $milestone->delete();

            toastr()->success('Milestone berhasil dihapus');
            return redirect()->route('manage-project.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            toastr()->warning('Milestone atau Project tidak ditemukan');
            return redirect()->route('manage-project.index');
        } catch (\Exception $e) {
            toastr()->warning('Terdapat masalah di server: ' . $e->getMessage());
            return redirect()->route('manage-project.index');
        }
    }
}
