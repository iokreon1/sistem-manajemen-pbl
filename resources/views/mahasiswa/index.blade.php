@extends('layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">List Judul PBL</h4>
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
                            <h3 class="card-title">Data PBL</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Tahun Akademik</th>
                                    <th>Judul Proyek</th>
                                    <th>Progres</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $project->waktu_pengerjaan }}</td>
                                            <td>{{ $project->tahun_akademik }}</td>
                                            <td>{{ $project->judul_project }}</td>
                                            <td>
                                                @php
                                                    $overallProgress = number_format($project->overallProgress, 2);
                                                @endphp
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $project->overallProgress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $overallProgress }}%"></div>
                                                </div>
                                                <small>{{ $overallProgress }}% Selesai</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('manage-project.show', ['project_id' => $project->project_id, 'nip' => $project->nip]) }}" class="btn btn-block btn-sm btn-outline-info"> Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
