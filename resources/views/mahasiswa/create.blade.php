@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Milestone</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"></h5>
                        <div class="card-tools">
                            <a href="{{ route('manage-project.detail', $project->project_id) }}" class="btn btn-tool"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('manage-project.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                                <label>Nama Proyek:</label>
                                <p>{{ $project->judul_project }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nama_milestone">Nama Milestone</label>
                                <input type="text" class="form-control" id="nama_milestone" name="nama_milestone" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                            </div>
                            <div class="form-group">
                                <label for="start">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start" name="start" required>
                            </div>
                            <div class="form-group">
                                <label for="deadline">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
