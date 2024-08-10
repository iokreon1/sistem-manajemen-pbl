@extends('layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0">Daftar Judul PBL</h4>
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
                        <div class="card-tools">
                            <a href="{{ route('manage-admin.create') }}" class="btn btn-tool"><i
                                    class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-main" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Proyek & Anggota Kelompok</th>
                                <th>Tahun Akademik & Semester</th>
                                <th>Waktu</th>
                                <th>Progres</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p>{{ $project->judul_project }}</p>
                                            @foreach ($project->mahasiswa as $mahasiswa)
                                                <p>{{ $loop->iteration }}. {{ $mahasiswa->nama_lengkap }} -
                                                    {{ $mahasiswa->nim }}</p>
                                            @endforeach
                                        </td>
                                        <td>{{ $project->tahun_akademik }} - {{ $project->semester }}</td>
                                        <td>{{ $project->waktu_pengerjaan }}</td>
                                        <td>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $project->overallProgress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $project->overallProgress }}%"></div>
                                            </div>
                                            <small>{{ $project->overallProgress }}% Selesai</small>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-sm btn-outline-info"
                                                data-toggle="dropdown">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('manage-admin.edit', $project->project_id) }}">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('manage-admin.destroy', $project->project_id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="dropdown-item confirm-button" href="#">Hapus</a>
                                                </form>
                                                <a class="dropdown-item"
                                                    href="{{ route('manage-plotting.edit', $project->project_id, $project->nip) }}">Plotting</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('manage-plotting.show', $project->project_id, $project->nip) }}">Detail</a>
                                            </div>
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