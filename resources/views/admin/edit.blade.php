@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Judul Project</h4>
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
                                <a href="{{ route('manage-admin.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('manage-admin.update', $project->project_id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode PBL</label>
                                    <input value="{{ $project->kode_pbl}}" type="text" name="kode_pbl"
                                        class="form-control @error('kode_pbl')is-invalid @enderror"
                                        placeholder="kode PBL">
                                    @error('kode_pbl')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nip">Dosen Pengampu</label>
                                    <input type="text" name="dosen_pengampu" id="dosen_pengampu" class="form-control mb-3" placeholder="Dosen Pengampu">
                                    @foreach ($dosen_pengampu as $item)
                                    <div class="form-group d-flex align-items-center">
                                        <div>
                                            <span class="clear mr-3" style="cursor: pointer;">
                                            <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control dosen_pengampu flex-grow-1" value="{{ $item->dosen->nama_dosen }}" readonly>
                                        <input type="hidden" name="nip1[]" id="nip1" value="{{ $item->nip }}">
                                        <input type="hidden" name="kode_mata_kuliah[]" id="kode_mata_kuliah" value="{{ $item->kode_mata_kuliah }}">
                                        <input type="hidden" name="id_dosen_pengampu[]" id="id_dosen_pengampu" value="{{ $item->id_dosen_pengampu }}">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label>Proyek Manajer</label>
                                    <input value="{{ $project->dosen->nama_dosen}}" type="text" name="nip" id="nip" class="form-control" placeholder="Dosen Pengampu">
                                </div>
                                <div class="form-group">
                                    <label>Judul PBL</label>
                                    <input value="{{ $project->judul_project}}" type="text" name="judul_project" class="form-control" placeholder="judul PBL">
                                </div>
                                <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tahun_akademik">Tahun Akademik</label>
                                    <select name="tahun_akademik" class="form-control" id="tahun_akademik">
                                        <?php
                                        $tahun_sekarang = date("Y");
                                        for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 1; $i--) {
                                            $tahun_sebelumnya = $i - 1;
                                            $selected = $project->tahun_akademik == "$tahun_sebelumnya/$i" ? 'selected' : '';
                                            echo "<option value='$tahun_sebelumnya/$i' $selected>$tahun_sebelumnya/$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                    <div class="col-md-6">
                                        <label for="jenis_usulan">Jenis Usulan</label>
                                            <select name="jenis_usulan" id="jenis_usulan" class="form-control">
                                                <option value="1" {{ $project->jenis_usulan == 1 ? 'selected' : '' }}>Software</option>
                                                <option value="2" {{ $project->jenis_usulan == 2 ? 'selected' : '' }}>Hardware</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="semester">Semester</label>
                                        <input value="{{ $project->semester}}" type="number" name="semester" class="form-control" id="semester" placeholder="semester">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tipe_pendanaan">Tipe Pendanaan</label>
                                        <select name="tipe_pendanaan" id="tipe_pendanaan" class="form-control">
                                                <option value="1" {{ $project->tipe_pendanaan == 1 ? 'selected' : '' }}>Berbayar</option>
                                                <option value="2" {{ $project->tipe_pendanaan == 2 ? 'selected' : '' }}>Non Berbayar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" value="{{ $waktu_mulai_formatted }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_selesai">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai" value="{{ $waktu_selesai_formatted }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Pengerjaan</label>
                                    <input value="{{ $project->waktu_pengerjaan}}" type="text" name="waktu_pengerjaan" class="form-control" placeholder="waktu pengerjaan" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Gambaran Proyek</label>
                                    <input value="{{ $project->desain_umum}}" type="text" name="desain_umum" class="form-control" placeholder="desain umum">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalMulaiInput = document.getElementById('tanggal_mulai');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
        const waktuPengerjaanInput = document.getElementsByName('waktu_pengerjaan')[0];

        function formatDate(date) {
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            return new Date(date).toLocaleDateString('id-ID', options);
        }

        function updateWaktuPengerjaan() {
            const tanggalMulai = tanggalMulaiInput.value;
            const tanggalSelesai = tanggalSelesaiInput.value;
            if (tanggalMulai && tanggalSelesai) {
                const waktuMulaiFormatted = formatDate(tanggalMulai);
                const waktuSelesaiFormatted = formatDate(tanggalSelesai);
                waktuPengerjaanInput.value = `${waktuMulaiFormatted} - ${waktuSelesaiFormatted}`;
            }
        }

        updateWaktuPengerjaan();

        tanggalMulaiInput.addEventListener('change', updateWaktuPengerjaan);
        tanggalSelesaiInput.addEventListener('change', updateWaktuPengerjaan);
    });

    $(document).ready(function() {
    $('#nip').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/Search',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var labelHtml = item.nama_dosen + ' - ' + item.nip; 
                        return {
                            label: labelHtml, 
                            value: item.nip 
                        };
                    }));
                }
            });
        },
        minLength: 2,
        open: function(event, ui) {
            $(this).autocomplete("widget").css({
                "width": "auto",
                "padding": "10px",
                "border": "1px solid #ccc",
                "list-style": "none",
                "border-radius": "5px",
                "box-shadow": "0 4px 8px 0 rgba(0,0,0,0.2)",
                "background-color": "#fff",
                "position": "absolute",
                "z-index": "1000"
            });
        }
    });
});

$(document).ready(function() {
    $('#dosen_pengampu').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/Dosen_Pengampu', 
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    console.log(data);
                    response($.map(data, function(item) {
                        var labelHtml = item.label;
                        return {
                            label: labelHtml,
                            value: item.value,
                            kode_mata_kuliah: item.kode_mata_kuliah,
                            nip: item.nip
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#kode_mata_kuliah').val(ui.item.kode_mata_kuliah);
            $('#nip1').val(ui.item.nip);
            addDosenInput(ui.item.label, ui.item.nip, ui.item.value, ui.item.kode_mata_kuliah);
            return false;
        },
        minLength: 2,
        open: function(event, ui) {
            $(this).autocomplete("widget").css({
                "width": "auto",
                "padding": "10px",
                "border": "1px solid #ccc",
                "list-style": "none",
                "border-radius": "5px",
                "box-shadow": "0 4px 8px 0 rgba(0,0,0,0.2)",
                "background-color": "#fff",
                "position": "absolute",
                "z-index": "1000"
            });
        }
    });

    $('#clearValue2').click(function() {
        $('#dosen_pengampu').val('');
        $('#selectedValue2').text('');
        $(this).hide();
    });

    function addDosenInput(label, nip, value, kodeMataKuliah) {
        if (nip) { 
            var dosenHtml = `
            <div class="form-group d-flex align-items-center">
                <div>
                    <span class="clearValue2 mr-3" style="cursor: pointer;">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
                <input type="text" class="form-control dosen_pengampu flex-grow-1" value="${value}" readonly>
                <input type="hidden" class="hidden_nip" name="nip1[]" value="${nip}">
                <input type="hidden" class="hidden_kode_mata_kuliah" name="kode_mata_kuliah[]" value="${kodeMataKuliah}">
            </div>`;
            $('#dosen_pengampu').closest('.form-group').after(dosenHtml);
        }

        $('#dosen_pengampu').val('');
        $('#nip1').val('');
        $('#kode_mata_kuliah').val('');
        $('#clearValue2').hide();
    }

    function deleteData(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapus-dosen-pengampu/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_dosen_pengampu": id
                    },
                    success: function(result) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    }

    $('.clear').click(function() {
        var id_dosen_pengampu = $(this).closest('.form-group').find('#id_dosen_pengampu').val();
        deleteData(id_dosen_pengampu);
    });

    $(document).on('click', '.clearValue2', function() {
        $(this).closest('.form-group').remove();
    });
});

</script>
@endpush
