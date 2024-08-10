@extends('layouts.app')

@push('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"></ol>
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
                        <label for="aspek_id">Rekapitulasi</label>
                        <div class="card-tools">
                            <a href="{{ route('nilai-mingguan.index') }}" class="btn btn-tool"><i
                                    class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('nilai-mingguan.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="nip" value="{{ $dosen['nip'] }}">
                        <input type="hidden" name="project_id" value="{{ $project['project_id'] }}">
                        <div class="card-body">
                            <h5 class="card-title m-0">Judul Project: {{ $project->judul_project }}</h5><br>
                            <h5 class="card-title m-0">Kode Project: {{ $project->kode_pbl }}</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        @foreach (range(2, 16, 2) as $minggu)
                                            <th>Minggu {{ $minggu }}</th>
                                        @endforeach
                                        <th>Rata-rata</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiMingguan as $nim => $nilaiPerMinggu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nim }}</td>
                                                                            <td>{{ $mahasiswa->where('nim', $nim)->first()->nama_lengkap ?? 'Nama tidak ditemukan' }}
                                                                            </td>
                                                                            @php
                                                                                $totalNilai = 0;
                                                                                $weeksDisplayed = range(2, 16, 2);
                                                                                $totalWeeks = count($weeksDisplayed);
                                                                            @endphp
                                                                            @foreach ($weeksDisplayed as $minggu)
                                                                                                            <td>
                                                                                                                @if (isset($nilaiPerMinggu->where('minggu', $minggu)->first()->rata_rata))
                                                                                                                                                    @php
                                                                                                                                                        $nilaiMinggu = $nilaiPerMinggu->where('minggu', $minggu)->first()->rata_rata;
                                                                                                                                                        $totalNilai += $nilaiMinggu;
                                                                                                                                                    @endphp
                                                                                                                                                    {{ number_format($nilaiMinggu, 2) }}
                                                                                                                @else
                                                                                                                    -
                                                                                                                @endif
                                                                                                            </td>
                                                                            @endforeach
                                                                            <td>
                                                                                @php
                                                                                    $rataRata = $totalNilai / $totalWeeks;
                                                                                @endphp
                                                                                {{ number_format($rataRata, 2) }}
                                                                            </td>
                                                                            <td>
                                                                                @if (isset($nilaiUjian[$nim]) && isset($nilaiUjian[$nim]->where('tipe_ujian', 'UTS')->first()->rata_rata))
                                                                                    {{ number_format($nilaiUjian[$nim]->where('tipe_ujian', 'UTS')->first()->rata_rata, 2) }}
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (isset($nilaiUjian[$nim]) && isset($nilaiUjian[$nim]->where('tipe_ujian', 'UAS')->first()->rata_rata))
                                                                                    {{ number_format($nilaiUjian[$nim]->where('tipe_ujian', 'UAS')->first()->rata_rata, 2) }}
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .table {
            font-size: 12px;
            /* Adjust the font size as needed /
        }
        .card-body h5 {
        font-size: 14px; / Adjust the font size of titles if needed */
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#fase_id').select2({
                placeholder: 'Pilih Fase'
            });

            $('#fase_id').change(function () {
                var fase_id = $(this).val();
                $.ajax({
                    url: '{{ route("get.aspek.by.fase") }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'fase_id': fase_id
                    },
                    success: function (response) {
                        $.each(response, function (nim, nama_aspek) {
                            $('.nama_aspek_' + nim).text(nama_aspek);
                        });
                    }
                });
            });
        });
    </script>
@endpush