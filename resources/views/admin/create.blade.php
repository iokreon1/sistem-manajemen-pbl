@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Proyek</h4>
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
                        <form action="{{ route('manage-admin.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode PBL</label>
                                    <input type="text" name="kode_pbl"
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
                                    <input type="text" name="dosen_pengampu" id="dosen_pengampu" class="form-control" placeholder="Dosen Pengampu">
                                    <input type="hidden" name="nip1" id="nip1">
                                    <input type="hidden" name="kode_mata_kuliah" id="kode_mata_kuliah">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Proyek Manajer</label>
                                    <input type="text" name="nip" id="nip" class="form-control" placeholder="Project Manager">
                                </div>
                                <input type="hidden" id="hidden_nip_dosen" name="nip">
                                <div class="form-group">
                                    <label>Judul PBL</label>
                                    <input type="text" name="judul_project" class="form-control" placeholder="judul PBL">
                                </div>
                                <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tahun_akademik">Tahun Akademik</label>
                                        <select name="tahun_akademik" class="form-control" id="tahun_akademik">
                                            <?php
                                            
                                            $tahun_sekarang = date("Y");
                                            
                                            for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 1; $i--) {
                                                $tahun_sebelumnya = $i - 1;
                                                echo "<option value='$tahun_sebelumnya/$i'>$tahun_sebelumnya/$i</option>";
                                                }
                                            ?>
                                        </select>
                                </div>
                                    <div class="col-md-6">
                                        <label for="jenis_usulan">Jenis Usulan</label>
                                        <select name="jenis_usulan" id="jenis_usulan" class="form-control">
                                            <option value="1">Software</option>
                                            <option value="2">Hardware</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="semester">Semester</label>
                                        <input type="number" name="semester" class="form-control" id="semester" placeholder="semester">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tipe_pendanaan">Tipe Pendanaan</label>
                                        <select name="tipe_pendanaan" id="tipe_pendanaan" class="form-control">
                                            <option value="1">Berbayar</option>
                                            <option value="2">Non Berbayar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_akhir">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_akhir" class="form-control" id="tanggal_akhir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Pengerjaan</label>
                                    <input type="text" name="waktu_pengerjaan" class="form-control" placeholder="waktu pengerjaan" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Gambaran Proyek</label>
                                    <input type="text" name="desain_umum" class="form-control" placeholder="desain umum">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalMulaiInput = document.getElementById('tanggal_mulai');
        const tanggalSelesaiInput = document.getElementById('tanggal_akhir');
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
                            value: item.nama_dosen,
                            nip: item.nip 
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
        },
        select: function(event, ui) {
            $(this).val(ui.item.value);
            $('#hidden_nip_dosen').val(ui.item.nip); 
            return false; 
        }
    });
});

$(document).ready(function() {
    $('#dosen_pengampu').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/Dosen_Pengampu', // Sesuaikan dengan URL endpoint Anda
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
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
            // Menambahkan input baru setiap kali dosen pengampu dipilih
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

    // Function to add new dosen pengampu input dynamically
    function addDosenInput(label, nip, value, kodeMataKuliah) {
        if (nip) { // Memastikan NIP tidak kosong sebelum menambahkan input
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
        $('#selectedValue2').text('');
        $('#clearValue2').hide();
    }

    // Dynamic event delegation for clearing dosen pengampu input
    $(document).on('click', '.clearValue2', function() {
        $(this).closest('.form-group').remove();
    });
});


</script>
@endpush
