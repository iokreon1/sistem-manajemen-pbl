@extends('layouts.app')
@push('css')
@endpush
@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0">Daftar Issue</h4>
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
                            <a href="{{ route('manage-project.detail', $project->project_id) }}" class="btn btn-tool"><i
                                    class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('issues.update', $milestones->milestone_id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Status</th>
                                                <th>Nama Issue</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Berakhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($issues as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="hidden" name="status[{{ $item->issue_id }}]" value="0">
                                                            <input type="checkbox" name="status[{{ $item->issue_id }}]"
                                                                class="custom-control-input" id="{{ $item->nama_issue . $item->issue_id }}"
                                                                value="1" {{ $item->status == 1 ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="{{ $item->nama_issue . $item->issue_id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->nama_issue }}</td>
                                                    <td>{{ Carbon::parse($item->start_issue)->format('d-m-y') }}</td>
                                                    <td>{{ Carbon::parse($item->deadline_issue)->format('d-m-y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $(function () {
            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>
@endpush