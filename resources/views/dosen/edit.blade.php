@extends('layouts.app')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="fase_id">Pilih Fase</label>
                    <div class="d-flex justify-content-between align-items-center">
                        <form method="get" action="" class="mr-5 flex-grow-1">
                            <select name="fase_id" id="fase_id" class="form-control" onchange="this.form.submit()">
                                @foreach ($fase_project as $fase)
                                    <option value="{{ $fase->fase_id }}"
                                        {{ request()->get('fase_id') == $fase->fase_id ? 'selected' : '' }}>
                                        {{ $fase->nama_fase }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ route('manage-dosen.rekap', $project->project_id) }}"
                            class="btn btn-sm btn-outline-info ml-auto mr-0">Rekap Nilai</a>
                    </div>
                </div>


            <!-- <div class="col-md-6">
                                        <label for="fase_id">Pilih Fase</label>
                                        <select name="fase_id" id="fase_id" class="form-control">
                                                
                                        </select>
                                    </div> -->
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
                            <a href="{{ route('manage-dosen.index') }}" class="btn btn-tool"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('manage-dosen.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="nip" value="{{$dosen['nip']}}">
                        <input type="hidden" name="project_id" value="{{$project['project_id']}}">
                        <div class="card-body">
                            <h5 class="card-title m-0">Judul Project : {{ $project->judul_project }} </h5><br>
                            <h5 class="card-title m-0">Kode Project : {{ $project->kode_pbl }} </h5>
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
                                            @foreach ($nilai_aspek as $nilai)
                                            @if ($nilai->nim == $mahasiswa->nim && $nilai->aspek_id == $row->aspek_id)
                                            <input type="number" value="{{ $nilai->nilai_aspek }}" name="nilai_aspek[{{ $mahasiswa->nim }}][{{ $row->aspek_id }}]" class="form-control rounded-md" style="width: 70px;" required>
                                            @endif
                                            @endforeach
                                            @if (!$nilai_aspek->contains('nim', $mahasiswa->nim) || !$nilai_aspek->contains('aspek_id', $row->aspek_id))
                                            <input type="number" value="" name="nilai_aspek[{{ $mahasiswa->nim }}][{{ $row->aspek_id }}]" class="form-control rounded-md" style="width: 70px;" required>
                                            @endif
                                        

                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
