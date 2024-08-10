<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Projects;
use App\Models\Mahasiswa;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\FaseProject;
use App\Models\Milestone;
use App\Models\Issues;
use App\Models\Dosen;
use App\Models\Waktu;

class IssuesController extends Controller
{
    public function show($milestone_id)
    {
        $milestones = Milestone::findOrFail($milestone_id);
        $issues = Issues::where('milestone_id', $milestone_id)->get();
        $project = $milestones->project;
        return view('mahasiswa.issues', compact('milestones', 'issues', 'project'));
    }

    public function create($milestone_id)
    {
        $issues = Issues::where('milestone_id', $milestone_id)->get();
        $milestone = Milestone::findOrFail($milestone_id);
        $project = $milestone->project_id;
        return view('milestone.create', compact('issues', 'milestone_id', 'milestone', 'project'));
    }

    public function store(Request $request)
{
    try {
        $milestone = Milestone::where('milestone_id', $request->input('milestone_id'))->firstOrFail();

        $request->validate([
            'nama_issue' => 'required|string|max:255',
            'start_issue' => 'required|date|after_or_equal:' . $milestone->start,
            'deadline_issue' => 'required|date|before_or_equal:' . $milestone->deadline,
            'milestone_id' => 'required|exists:milestones,milestone_id',
        ]);

        $issue = new Issues();
        $issue->nama_issue = $request->input('nama_issue');
        $issue->start_issue = $request->input('start_issue');
        $issue->deadline_issue = $request->input('deadline_issue');
        $issue->milestone_id = $request->input('milestone_id');
        $issue->status = '0'; 
        $issue->save();

        $project = $milestone->project;

        session()->flash('success', 'Issue berhasil ditambahkan.');
        return redirect()->route('manage-project.show', ['project_id' => $project->project_id, 'nip' => $project->nip]);
    } catch (\Exception $e) {
        Log::error('Error saving issue: ' . $e->getMessage());

        session()->flash('error', 'Terdapat masalah saat menyimpan issue: ' . $e->getMessage());
        return redirect()->back()->withInput();
    }
}


    public function update(Request $request, $milestone_id)
{
    $statuses = $request->input('status');

    foreach ($statuses as $id => $status) {
        $issue = Issues::find($id);
        if ($issue) {
            $issue->status = $status;
            $issue->save();
        }
    }

    return redirect()->route('manage-issues.show', $milestone_id)->with('success', 'Status berhasil diperbarui.');
}

}
