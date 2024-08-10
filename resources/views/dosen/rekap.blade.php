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
                        <label for="fase_id">Rekapitulasi</label>
                        <div class="card-tools">
                            <a href="{{ route('manage-dosen.index') }}" class="btn btn-tool"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('manage-dosen.store') }}" method="post">
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
                                        @foreach ($fase_project as $row)
                                        <th>{{ $row->nama_fase }}
                                            <input type="hidden" name="fase_id[]" value="{{ $row->fase_id }}">
                                        </th>
                                        @endforeach
                                        <th>Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($project->mahasiswa as $mahasiswa)
                                @php
                                    $nilai_aspek_mahasiswa = $nilai_aspek_grouped->get($mahasiswa->nim, collect());
                                    $nilai_fase = [];
                                    foreach ($fase_project as $fase) {
                                        $nilai_fase[$fase->fase_id] = [];
                                    }
                                @endphp
                    

                                @if ($nilai_aspek_mahasiswa)
                                    @foreach ($nilai_aspek_mahasiswa as $fase_id => $nilai)
                                        @foreach ($nilai as $aspek_nilai)
                                            @php
                                                $nilai_fase[$fase_id][] = $aspek_nilai->nilai_aspek;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                @endif    

                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $mahasiswa->nim }}
                                        <input type="hidden" name="nim[]" value="{{ $mahasiswa->nim }}">
                                    </td>
                                    <td>{{ $mahasiswa->nama_lengkap }}</td>
                                    @php
                                        $total_avg = 0;
                                        $total_phases = count($fase_project);
                                    @endphp
                                    @foreach ($fase_project as $fase)
                                    <td>
                                        @php
                                            $nilai = $nilai_fase[$fase->fase_id];
                                            $avg = !empty($nilai) ? array_sum($nilai) / count($nilai) : 0;
                                            $total_avg += $avg;
                                        @endphp
                                        {{ number_format($avg, 2) }}
                                    </td>
                                    @endforeach

                                    <td>
                                    @php
                                        $final_avg = $total_avg / $total_phases;
                                    @endphp
                                    {{ number_format($final_avg, 2) }}
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
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fase_id').select2({
            placeholder: 'Pilih Fase'
        });

        $('#fase_id').change(function() {
            var fase_id = $(this).val();
            $.ajax({
                url: '{{ route("get.aspek.by.fase") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'fase_id': fase_id
                },
                success: function(response) {
                    // Memperbarui nama aspek untuk setiap baris dalam tabel
                    $.each(response, function(nim, nama_aspek) {
                        $('.nama_aspek_' + nim).text(nama_aspek);
                    });
                }
            });
        });
    });
</script>
@endpush