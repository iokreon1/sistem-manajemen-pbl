@extends('layouts.app')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="mingguan">Pilih Penilaian :</label>
                    <div class="d-flex justify-content-between align-items-center">
                        <form method="get" action="" class="mr-5 flex-grow-1">
                        <select name="minggu" id="minggu" class="form-control" onchange="this.form.submit()">
                            <?php
                            $selectedMinggu = request()->get('minggu', 2);
                            
                            for ($i = 2; $i <= 16; $i += 2) {
                                $selected = $i == $selectedMinggu ? 'selected' : '';
                                echo "<option value=\"$i\" $selected>Minggu Ke $i</option>";
                            }
                            ?>

                            <option value="UTS" {{ $selectedMinggu == 'UTS' ? 'selected' : '' }}>UTS</option>
                            <option value="UAS" {{ $selectedMinggu == 'UAS' ? 'selected' : '' }}>UAS</option>
                        </select>

                    </form>
                    <a href="{{ route('nilai-mingguan.rekap', ['project_id' => $project->project_id, 'kode_matakuliah' => $project->dosenPengampu[0]->kode_mata_kuliah]) }}"
                            class="btn btn-sm btn-outline-info ml-auto mr-0">Rekap Nilai</a>
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
                                <a href="{{ route('nilai-mingguan.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('nilai-mingguan.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="penilaian" value="{{ request()->input('minggu') }}">
                            <input type="hidden" name="nip" value="{{ $dosen['nip'] }}">
                            <input type="hidden" name="project_id" value="{{ $project['project_id'] }}">
                            <input type="hidden" name="kode_mata_kuliah" value="{{ $kode_mata_kuliah }}">
                            <div class="card-body">
                                <h5 class="card-title m-0">Judul Project : {{ $project->judul_project }} </h5><br>
                                <h5 class="card-title m-0">Kode Project : {{ $project->kode_pbl }} </h5><br>
                                <h5 class="card-title m-0">Mata Kuliah :
                                    @foreach ($project->dosenPengampu as $dosenPengampu)
                                        {{ $dosenPengampu->mataKuliah->nama_matakuliah }}
                                    @endforeach
                                </h5>
                            </div>
                            <div class="card-body">
                                <table id="datatable-main" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            @foreach ($aspek as $row)
                                                <th>{{ $row->nama_aspek }}
                                                    <input type="hidden" name="aspek_id[]" value="{{ $row->aspek_id }}">
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->mahasiswa as $mahasiswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $mahasiswa->nim }}
                                                    <input type="hidden" name="nim[]" value="{{ $mahasiswa->nim }}">
                                                </td>
                                                <td>{{ $mahasiswa->nama_lengkap }}</td>
                                                @foreach ($aspek as $row)
                                                    <td>
                                                        @php
                                                            $nilai_aspek = '';

                                                            if (
                                                                request()->input('minggu') == 'UTS' ||
                                                                request()->input('minggu') == 'UAS'
                                                            ) {
                                                                $nilai = $nilaiUjian->has($mahasiswa->nim)
                                                                    ? $nilaiUjian[$mahasiswa->nim]
                                                                        ->where('aspek_id', $row->aspek_id)
                                                                        ->first()
                                                                    : null;
                                                            } else {
                                                                $nilai = $nilaiMingguan->has($mahasiswa->nim)
                                                                    ? $nilaiMingguan[$mahasiswa->nim]
                                                                        ->where('aspek_id', $row->aspek_id)
                                                                        ->first()
                                                                    : null;
                                                            }

                                                            $nilai_aspek = $nilai ? $nilai->nilai_aspek : '';

                                                        @endphp

                                                        <input type="number"
                                                            name="nilai_aspek[{{ $mahasiswa->nim }}][{{ $row->aspek_id }}]"
                                                            value="{{ $nilai_aspek }}" class="form-control rounded-md"
                                                            style="width: 70px;" required>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="card-footer">

                                    <button type="submit" class="btn btn-info btn-block btn-flat"><i
                                            class="fa fa-save"></i> Simpan</button>

                                </div>
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
