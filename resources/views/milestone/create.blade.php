@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Issues</h1>
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"></h5>
                        <div class="card-tools">
                            <a href="{{ route('manage-project.detail', $milestone->project_id) }}" class="btn btn-tool"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('milestone.store') }}" method="POST" id="issueForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Milestone:</label>
                                <p>{{ $milestone->nama_milestone }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nama_issue">Nama Issues</label>
                                <input type="text" class="form-control" id="nama_issue" name="nama_issue" required>
                            </div>
                            <div class="form-group">
                                <label for="start_issue">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_issue" name="start_issue" required>
                            </div>
                            <div class="form-group">
                                <label for="deadline_issue">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="deadline_issue" name="deadline_issue" required>
                            </div>
                            <input type="hidden" name="milestone_id" value="{{ $milestone_id }}">
                            <input type="hidden" id="start" value="{{ $milestone->start }}">
                            <input type="hidden" id="deadline" value="{{ $milestone->deadline }}">
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
