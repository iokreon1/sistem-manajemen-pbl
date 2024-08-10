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
                    <h4 class="m-0">Penilaian Dosen</h4>
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
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Penilaian Dosen</h3>
                            <div class="card-tools">
                                <a href="{{ route('nilai-mingguan.index') }}" class="btn btn-tool">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail Project</th>
                                        <th>Anggota Kelompok</th>
                                        <th>Progres</th>
                                        <th>Mata Kuliah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        @php
                                            $courseCount = count($project->dosenPengampu);
                                            $firstCourse = true;
                                        @endphp
                                        @foreach ($project->dosenPengampu as $dosenPengampu)
                                            @if ($dosenPengampu->dosen->id_user == Auth::user()->id)
                                                <tr>
                                                    @if ($firstCourse)
                                                        <td rowspan="{{ $courseCount }}">{{ $loop->parent->iteration }}.
                                                        </td>
                                                        <td rowspan="{{ $courseCount }}">
                                                            <h5><a href="{{ route('manage-penilaianmingguan.detail', ['project_id' => $project->project_id]) }}"
                                                                    class="text-body">{{ $project->judul_project }}</a>
                                                            </h5>
                                                            <ul style="list-style-type:disc; padding-left: 10;">
                                                                <li>Dosen PM: {{ $project->dosen->nama_dosen }}</li>
                                                                <li>Tahun Akademik: {{ $project->tahun_akademik }}</li>
                                                                <a href="{{ route('manage-penilaianmingguan.detail', ['project_id' => $project->project_id]) }}"
                                                                    class="btn btn-link">Selengkapnya</a>
                                                            </ul>
                                                        </td>
                                                        <td rowspan="{{ $courseCount }}">
                                                            @foreach ($project->mahasiswa as $index => $mahasiswa)
                                                                <p>{{ $loop->iteration }}. {{ $mahasiswa->nama_lengkap }}
                                                                    - {{ $mahasiswa->nim }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td rowspan="{{ $courseCount }}">
                                                            @php
                                                                $overallProgress = number_format(
                                                                    $project->overallProgress,
                                                                    2,
                                                                );
                                                            @endphp
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar bg-success" role="progressbar"
                                                                    aria-valuenow="{{ $project->overallProgress }}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{ $overallProgress }}%"></div>
                                                            </div>
                                                            <small>{{ $overallProgress }}% Complete</small>
                                                        </td>
                                                        @php
                                                            $firstCourse = false;
                                                        @endphp
                                                    @endif
                                                    <td>{{ $dosenPengampu->mataKuliah->nama_matakuliah }}</td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-block btn-sm btn-outline-info">
                                                            <a
                                                                href="{{ route('nilai-mingguan.custom_edit', ['project_id' => $project->project_id, 'kode_matakuliah' => $dosenPengampu->kode_mata_kuliah]) }}">Masukkan
                                                                Nilai</a>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
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
