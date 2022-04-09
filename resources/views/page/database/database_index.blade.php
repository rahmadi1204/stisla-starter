@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @include('components.alert')
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                        <div class="card-header-action">
                            {{-- <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item has-icon" id="btn-add" data-toggle="modal"
                                    data-target="#modal-edit"><i class="fas fa-plus"></i>
                                    Add</a>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row my-1 mb-3">
                            <div class="col-8">
                                <div class="btn btn-danger" id="delete-checked" title="Delete checked"><i
                                        class="fas fa-trash-alt"></i></div>
                                <div class="btn btn-success" id="btn-import" title="Import Sql"><i
                                        class="fas fa-file-import"></i></div>
                                <div class="btn btn-primary" id="btn-backup" title="Backup Database"><i
                                        class="fas fa-sync-alt"></i></div>
                                <div class="btn btn-dark disabled" id="btn-print" title="Print"><i
                                        class="fas fa-ban"></i>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="#" class="btn btn-primary float-right disabled" id="btn-add" title="Tambah Data">
                                    <i class="fas fa-ban"></i></a>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="input-group">
                                    <select name="status" id="statusFilter" class="form-control" style="max-width: 300px"
                                        disabled>
                                        <option value="null">Semua Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group float-right">
                                    <div class="input-group">
                                        <input type="text" name="fromDate" class="form-control datepicker"
                                            value="2022-01-01" title="Tanggal Awal" id="from">
                                        <input type="text" name="toDate" class="form-control datepicker"
                                            title="Tanggal Akhir" id="to">
                                        <button type="submit" class="form-control" id="btn-search" title="Cari Tanggal"><i
                                                class="fa fa-ban"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <form action="#" id="form-multiple">
                                <table class="table table-striped" id="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                            <th>No</th>
                                            <th>Avatar</th>
                                            <th>File Name</th>
                                            <th>File Size</th>
                                            <th>Created Date</th>
                                            <th>Created Age</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $fileSizes = 0;
                                        @endphp
                                        @foreach ($databases as $database)
                                            <tr>
                                                <td>
                                                    @if ($no < 6)
                                                        <input type="checkbox" value="{{ $database['file_name'] }}"
                                                            disabled>
                                                    @else
                                                        <input type="checkbox" name="checkbox[]"
                                                            value="{{ $database['file_name'] }}">
                                                    @endif
                                                </td>
                                                <td>{{ $no++ }}</td>
                                                <td></td>
                                                <td>{{ $database['file_name'] }}</td>
                                                <td>{{ \App\Http\Controllers\Page\DatabaseController::humanFilesize($database['file_size']) }}
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d, g:ia (T)', $database['last_modified']) }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($database['last_modified'])->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('database.download', $database['file_name']) }}"
                                                            id="btn-download" class="btn mx-1 btn-success"><i
                                                                class="fa fa-download"></i></a>
                                                        @if ($no < 7)
                                                            <div class="btn btn-danger mx-1 disabled">
                                                                <i class="fa fa-ban"></i>
                                                            </div>
                                                        @else
                                                            <a href="#" class="btn mx-1 btn-danger"
                                                                onclick="deleteConfirm('{{ $database['file_name'] }}','{{ $database['file_name'] }}')">
                                                                <i class="fa fa-trash-alt"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $fileSizes += $database['file_size'];
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" disabled></th>
                                            <th colspan="3" class="text-center">Database</th>
                                            <th>{{ \App\Http\Controllers\Page\DatabaseController::humanFilesize($fileSizes) }}
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@section('scripts')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#btn-backup").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
        });
        $("#btn-import").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
        });
    </script>
@endsection
