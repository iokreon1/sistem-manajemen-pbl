@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Ketua dan Anggota</h4>
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
                        <form action="{{ route('manage-plotting.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Project Manager</label>
                                    <input value="{{ $project->dosen->nama_dosen }}" type="text" name="project manager" class="form-control" placeholder="project manager" readonly>
                                </div>
                                <input type="hidden" name="project_id" value="{{ $project->project_id }}">
                                <div class="form-group ">
                                    <label for="nim_ketua">Ketua Mahasiswa</label>
                                    <input type="text" name="nim_ketua" id="nim_ketua" class="form-control" placeholder="Nama Ketua">
                                    <div class="form-group d-flex align-items-center">
                                        <span id="clearValue" class="mr-3" style="display: none; cursor: pointer;">
                                        <i class="fas fa-times"></i>
                                        </span>
                                        <div id="selectedValue" class="selected-value-container flex-grow-1"></div>
                                    </div>
                                </div>
                                <input type="hidden" id="hidden_nim_ketua" name="nim_ketua">
                                <div class="form-group">
                                    <label for="nim_anggota">Anggota</label>
                                    <input type="text" name="nim_anggota" id="nim_anggota" class="form-control" placeholder="Anggota">
                                    <div class="d-flex align-items-center">
                                        <span id="clearValue2" class="ml-2" style="display: none; cursor: pointer;">
                                        <i class="fas fa-times"></i> <!-- Ganti dengan ikon hapus yang sesuai -->
                                        </span>
                                        <div id="selectedValue2" class="selected-value-container flex-grow-1"></div>
                                    </div>
                                </div>
                                <!-- Input tersembunyi untuk menyimpan nim anggota -->
                                <input type="hidden" id="hidden_nim_anggota" name="nim_anggota[]">
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
    $(document).ready(function() {
    $('#nim_ketua, #nim_anggota').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/Search_Mahasiswa',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var labelHtml = item.nama_lengkap + ' - ' + item.nim ;
                        return {
                            label: labelHtml,
                            value: item.nama_lengkap,
                            nim: item.nim,
                            is_ketua: $('#nim_ketua').is(':focus')
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $(this).val(ui.item.value);
            if ($(this).attr('id') === 'nim_anggota') {
                // Menambahkan input baru ketika anggota dipilih
                addAnggotaInput(ui.item.label, ui.item.nim, ui.item.value);
            } else if ($(this).attr('id') === 'nim_ketua') {
                $('#hidden_nim_ketua').val(ui.item.nim);
                $('#selectedValue').html(`<div class="d-flex align-items-center mt-2">
                                            <input type="text" class="form-control nim_anggota flex-grow-1" value=" ${ui.item.value} " readonly>
                                        </div>`);
                $('#clearValue').show();
            }
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

    $('#clearValue').click(function() {
        $('#nim_ketua').val('');
        $('#selectedValue').text('');
        $(this).hide();
    });

    $('#clearValue2').click(function() {
        $('#nim_anggota').val('');
        $('#selectedValue2').text('');
        $(this).hide();
    });

    // Function to add new anggota input dynamically
    // Function to add new anggota input dynamically
// Function to add new anggota input dynamically
function addAnggotaInput(label, nim, value) {
    if (nim) { // Memastikan nim tidak kosong sebelum menambahkan input
        var anggotaHtml = `
        <div class="form-group d-flex align-items-center">
            <div>
                <span class="clearValue2 mr-3" style="cursor: pointer;">
                <i class="fas fa-times"></i>
                </span>
            </div>
            <input type="text" class="form-control nim_anggota flex-grow-1" value="${value}" readonly>
            <input type="hidden" class="hidden_nim_anggota" name="nim_anggota[]" value="${nim}">
        </div>`;
        $('#nim_anggota').closest('.form-group').after(anggotaHtml);
    }

    // Clear the input value and hide clear button after adding new anggota
    $('#nim_anggota').val('');
    $('#selectedValue2').text('');
    $('#clearValue2').hide();
}

    // Dynamic event delegation for clearing anggota input
    $(document).on('click', '.clearValue2', function() {
        $(this).closest('.form-group').remove();
    });
});

</script>
@endpush
