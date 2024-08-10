@extends('layouts.app')
@push('css')
@endpush
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Detail Proyek</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mt-3">
                        <a href="{{ route('manage-admin.index') }}" class="btn btn-tool"><i
                                class="fas fa-arrow-alt-circle-left"></i></a>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Detail Proyek {{ $project->judul_project }} </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode PBL:</label>
                                <p>{{ $project->kode_pbl }}</p>
                            </div>
                            <div class="form-group">
                                <label>Dosen Pengampu :</label>
                                @foreach ($dosen_pengampu as $item)
                                    <p>{{ $item->dosen->nama_dosen }} - {{ $item->matakuliah->nama_matakuliah }}</p>
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
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Data Kelompok</h5>
                        </div>
                        <div class="card-body">
                            @if ($kelompok)
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
                                            $sort_status_mahasiswa = $mahasiswas->sortByDesc(function ($mahasiswa) {
                                                return $mahasiswa->pivot->ketua_kelompok;
                                            });
                                        @endphp
                                        @foreach ($sort_status_mahasiswa as $mahasiswa)
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
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Milestone</h3>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($milestones as $milestone)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $milestone->nama_milestone }} 
                                                <br>
                                                <small>({{ $milestone->deskripsi }})</small>
                                            </td>
                                            <td>{{ Carbon::parse($milestone->start)->format('d-m-Y') }}</td>
                                            <td>{{ Carbon::parse($milestone->deadline)->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $progress = number_format($milestone->progress, 2);
                                                @endphp
                                                <div class="progress progress-sm milestone-progress"
                                                    data-milestone-id="{{ $milestone->milestone_id }}">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        aria-valuenow="{{ $milestone->progress }}" aria-valuemin="0"
                                                        aria-valuemax="100" style="width: {{ $milestone->progress }}%">
                                                    </div>
                                                </div>
                                                <small>{{ $milestone->progress }}% Selesai</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Rekap Nilai</h3>
                            <button id="exportButton" class="btn btn-primary float-right">Export to Excel</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="rekapTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nilai Harian Pengampu</th>
                                        <th>Nilai Harian PM</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekapNilai as $nilai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nilai['nim'] }}</td>
                                            <td>{{ $nilai['nama'] }}</td>
                                            <td>{{ $nilai['nilai_harian_pengampu'] }}</td>
                                            <td>{{ $nilai['nilai_harian_pm'] }}</td>
                                            <td>{{ $nilai['nilai_uts'] }}</td>
                                            <td>{{ $nilai['nilai_uas'] }}</td>
                                            <td>{{ $nilai['nilai_akhir'] }}</td>
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
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#exportButton').click(function() {
        var table = $('#rekapTable');
        var data = [];
        table.find('tbody tr').each(function() {
            var row = [];
            $(this).find('td').each(function() {
                row.push($(this).text());
            });
            data.push(row);
        });

        $.ajax({
            url: '{{ route('export') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                data: JSON.stringify(data)
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(response);
                link.download = 'rekap_nilai.xlsx';
                link.click();
            }
        });
    });
</script>g
@endpush
