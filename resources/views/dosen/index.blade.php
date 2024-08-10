@extends('layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="col-md-2">
                    <form id="filter-form" method="GET" action="">
                        <div class="form-group">
                            <select class="form-control" id="filter-year" name="tahun" onchange="this.form.submit()">
                                <option value="" disabled selected>-- Pilih Tahun --</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </form>

                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data PBL</h3>
                            <div class="card-tools">
                                <a href="{{ route('manage-dosen.index') }}" class="btn btn-tool"><i
                                        class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail Project</th>
                                        <th>Tahun Akademik</th>
                                        <th>Anggota Kelompok</th>
                                        <th>Progress</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>
                                                <h5><a href="{{ route('manage-penilaianmingguan.detail', ['project_id' => $project->project_id]) }}"
                                                        class="text-body">{{ $project->judul_project }}</a>
                                                </h5>
                                                <li>Mata Kuliah : @foreach ($project->dosenPengampu as $dosenPengampu)
                                                        <br>{{ $loop->iteration }}.
                                                        {{ $dosenPengampu->mataKuliah->nama_matakuliah }}
                                                    @endforeach
                                                </li>
                                                <a href="{{ route('manage-dosen.detail', ['project_id' => $project->project_id]) }}"
                                                    class="btn btn-link">Selengkapnya
                                                </a>
                                            </td>
                                            <td>{{ $project->tahun_akademik }}</td>
                                            <td>
                                                @foreach ($project->mahasiswa as $mahasiswa)
                                                    <p>{{ $loop->iteration }}. {{ $mahasiswa->nama_lengkap }} -
                                                        {{ $mahasiswa->nim }}
                                                    </p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @php
                                                    $overallProgress = number_format($project->overallProgress, 2);
                                                @endphp
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        aria-valuenow="{{ $project->overallProgress }}" aria-valuemin="0"
                                                        aria-valuemax="100" style="width: {{ $overallProgress }}%"></div>
                                                </div>
                                                <small>{{ $overallProgress }}% Complete</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('manage-dosen.edit', $project->project_id) }}"
                                                    class="btn btn-block btn-sm btn-outline-info">Masukkan Nilai</a>
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

@push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script>
        $(function() {
            var table = $('#datatable-main').DataTable({
                "destroy": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>tip'
            });
        });
    </script>
@endpush
