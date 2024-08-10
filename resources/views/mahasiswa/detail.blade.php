@extends('layouts.app')


@push('css')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0">Detail</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mt-3">
                    <a href="{{ route('manage-project.index') }}" class="btn btn-tool"><i class="fas fa-arrow-alt-circle-left"></i></a>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Project Details -->
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Detail Project {{ $project->judul_project }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode PBL:</label>
                            <p>{{ $project->kode_pbl }}</p>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pengampu:</label>
                            @foreach($dosen_pengampu as $item)
                            <p>{{ $item->dosen->nama_dosen }}</p>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Proyek Manajer:</label>
                            <p>{{ $project->dosen->nama_dosen }}</p>
                        </div>
                        <div class="form-group">
                            <label>Judul PBL:</label>
                            <p>{{ $project->judul_project }}</p>
                        </div>
                        <div class="form-group">
                            <label>Tahun Akademik:</label>
                            <p>{{ $project->tahun_akademik }}</p>
                        </div>
                        <div class="form-group">
                            <label>Jenis Usulan:</label>
                            <p>{{ $project->jenis_usulan == 1 ? 'Software' : 'Hardware' }}</p>
                        </div>
                        <div class="form-group">
                            <label>Semester:</label>
                            <p>{{ $project->semester }}</p>
                        </div>
                        <div class="form-group">
                            <label>Tipe Pendanaan:</label>
                            <p>{{ $project->tipe_pendanaan == 1 ? 'Berbayar' : 'Non Berbayar' }}</p>
                        </div>
                        <div class="form-group">
                            <label>Waktu Pengerjaan:</label>
                            <p>{{ $project->waktu_pengerjaan }}</p>
                        </div>
                        <div class="form-group">
                            <label>Gambaran Proyek:</label>
                            <p>{{ $project->desain_umum }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Group Data -->
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Data Kelompok</h5>
                    </div>
                    <div class="card-body">
                        @if($kelompok)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php 
                                $sort_status_mahasiswa = $mahasiswas->sortByDesc(function($mahasiswa) {
                                return $mahasiswa->pivot->ketua_kelompok;
                                });
                            @endphp
                                @foreach($sort_status_mahasiswa as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->nama_lengkap }}</td>
                                    <td>{{ $mahasiswa->pivot->ketua_kelompok == 1 ? 'Ketua' : 'Anggota' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Tidak ada data kelompok yang terkait dengan proyek ini.</p>
                        @endif
                    </div>
                </div>
                <!-- Proggress -->
                <div class="card card-primary card-outline mt-3">
                    <div class="card-header">
                    <h5 class="card-title m-0">Progres</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $overallProgress = number_format($project->overallProgress, 2);
                        @endphp
                        <canvas id="progressDonutChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
            <!-- Milestones -->
            <div class="col-md-12 mt-3">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Milestone</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-block btn-sm btn-outline-info" onclick="window.location.href='{{ route('manage-project.create', $project->project_id ) }}'">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Milestone</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Progres</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($milestones as $milestone)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $milestone->nama_milestone }} 
                                        <br>
                                        <small>({{ $milestone->deskripsi }})</small>
                                    </td>
                                    <td>{{ Carbon::parse($milestone->start)->format('d-m-y')}}</td>
                                    <td>{{ Carbon::parse($milestone->deadline)->format('d-m-y') }}</td>
                                    <td>
                                    @php
                                        $progress = number_format($milestone->progress, 2);
                                    @endphp
                                        <div class="progress progress-sm milestone-progress" data-milestone-id="{{ $milestone->milestone_id }}">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $milestone->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $milestone->progress }}%"></div>
                                        </div>
                                        <small>{{ $milestone->progress }}% Selesai</small>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-sm btn-outline-info" data-toggle="dropdown">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="{{ route('manage-issue.create', $milestone->milestone_id) }}">Tambah Issue</a>
                                            <a class="dropdown-item" href="{{ route('manage-issues.show', $milestone->milestone_id) }}">Issue</a>
                                            <a class="dropdown-item" href="{{ route('manage-project.edit', $milestone->milestone_id) }}">Edit</a>
                                            <form method="POST" action="{{ route('manage-project.destroy', ['project_id' => $project->project_id, 'milestone_id' => $milestone->milestone_id]) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item confirm-button">Hapus</button>
                                            </form>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>

        document.querySelectorAll('.milestone-progress').forEach(progress => {
            progress.addEventListener('click', function () {
                const milestoneId = this.getAttribute('data-milestone-id');
                window.location.href = '{{ url('manage-project/issues') }}/' + milestoneId;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('progressDonutChart').getContext('2d');
    var overallProgress = {{ $overallProgress }};
    const xValues = ["Selesai", "Belum Selesai"];

    Chart.pluginService.register({
        beforeDraw: function(chart) {
            if (chart.config.type === 'doughnut') {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;

                ctx.restore();
                var fontSize = (height / 130).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                var text = overallProgress + "%",
                    textX = Math.round((width - ctx.measureText(text).width) / 1.9),
                    textY = height / 1.8;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }
    });

    var progressDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: xValues,
            datasets: [{
                data: [overallProgress, 100 - overallProgress],
                backgroundColor: ['#5AB2FF', '#C7C8CC'],
            }],
        },
        options: {
            cutoutPercentage: 70,
            rotation: -0.49 * Math.PI,
            circumference: 2 * Math.PI,
            tooltips: { enabled: false },
            hover: { mode: null },
        }
    });
});
</script>
@endpush
