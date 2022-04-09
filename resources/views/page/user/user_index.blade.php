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
                                <div class="btn btn-success" id="btn-import" title="Import Excel"><i
                                        class="fas fa-file-import"></i></div>
                                <div class="btn btn-primary" id="btn-export" title="Export Excel"><i
                                        class="fas fa-file-export"></i></div>
                                <div class="btn btn-dark" id="btn-print" title="Print"><i class="fas fa-print"></i>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="#" class="btn btn-primary float-right" data-toggle="modal" id="btn-add"
                                    data-target="#modal-edit" title="Tambah Data">
                                    <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="input-group">
                                    <select name="status" id="statusFilter" class="form-control" style="max-width: 300px">
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
                                                class="fa fa-search"></i></button>
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
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" disabled></th>
                                            <th colspan="9" class="text-center">Data Pengguna</th>
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
    <form action="{{ url('users-update') }}" method="post" id="form-modal" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Foto</label>
                            <div class="input-group mb-2">
                                <img alt="image" src="{{ asset('stisla') }}/assets/img/avatar/avatar-1.png"
                                    class="rounded-circle profile-widget-picture zoomImage" style="max-height: 100px"
                                    id="img">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="customFile" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <label for="name">Nama</label>
                            <input type="hidden" name="id" class="form-control" id="id">
                            <input type="text" name="name" class="form-control" id="name">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username">
                            <label for="username">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">--Belum Ada--</option>
                                @foreach ($role as $key => $value)
                                    <option value="{{ $value }}">{{ ucwords($value) }}</option>
                                @endforeach
                            </select>
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary rounded" id="btn-save" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#btn-save").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
            let form_data = $("#form-modal").serialize();
            console.log(form_data)
        });
        $("#customFile").change(function(e) {
            e.preventDefault();
            console.log('upload');
        });
        $("#btn-add").click(function(e) {
            $("#modal-title").text('Tambah Data Baru');
            $("#id").val(null);
            $("#img").attr('src', '{{ asset('stisla') }}/assets/img/avatar/avatar-1.png');
            $("#image-upload").val(null);
            $("#name").val(null);
            $("#username").val(null);
            $("#role").val(null);
            $("#email").val(null);
            $("#password").val(null);
            $("#form-modal").attr('action', '{{ url('users-store') }}')
        });
    </script>
    <script>
        let status = $("#statusFilter").val();
        let from = $("#from").val();
        let to = $("#to").val();

        function tabledata(status, from, to) {
            return $('#datatable').DataTable({
                "scrollX": true,
                "scrollY": 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                        d.status = status,
                            d.from = from,
                            d.to = to
                    }
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false
                    }, {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'img',
                        name: 'img'
                    },
                    {
                        data: 'uid',
                        name: 'uid'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        }
        tabledata(status, from, to);
        setInterval(function() {
            $('#datatable').DataTable().destroy();
            tabledata(status, from, to);
        }, 100000);
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#statusFilter").change(function(e) {
            e.preventDefault();
            let status = $("#statusFilter").val();
            $("#from").val('2022-01-01');
            $("#to").val('{{ date('Y-m-d') }}');
            console.log(status);
            $.ajax({
                type: "get",
                url: "{{ url()->current() }}",
                data: {
                    status: status,
                    from: from,
                    to: to
                },
                success: function(response) {
                    console.log(response);
                    $('#datatable').DataTable().destroy();
                    tabledata(status, from, to);
                }
            });
        });
        $("#btn-search").click(function(e) {
            e.preventDefault();
            let status = $("#statusFilter").val();
            let from = $("#from").val();
            let to = $("#to").val();
            console.log(from);
            console.log(to);
            $.ajax({
                type: "get",
                url: "{{ url()->current() }}",
                data: {
                    status: status,
                    from: from,
                    to: to
                },
                success: function(response) {
                    console.log(response);
                    $('#datatable').DataTable().destroy();
                    tabledata(status, from, to);
                }
            });
        });

        function edit(id) {
            $.ajax({
                type: "get",
                url: "{{ url('users-show') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    $("#modal-title").text(response['name']);
                    $("#id").val(response['id']);
                    $("#img").attr('src', '{{ asset('storage/images') }}/' + response['img']);
                    $("#name").val(response['name']);
                    $("#username").val(response['username']);
                    $("#role").val(response['role']);
                    $("#email").val(response['email']);
                    $("#password").val(null);
                    $("#form-modal").attr('action', '{{ url('users-update') }}')
                }
            });
        }
    </script>
    @can('user delete')
        <script>
            function deleteConfirm(id, name) {
                $(this).addClass("clicked");
                console.log(id);
                $(".clicked").removeClass("clicked");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Data " + name + " Akan Dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oke, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('user.destroy') }}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                if (data != 'success') {
                                    Swal.fire(
                                        'Failed!',
                                        data,
                                        'error'
                                    )
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    $('#datatable').DataTable().destroy();
                                    tabledata(status, from, to);
                                }
                            }
                        })
                    }

                })
            }
            $("#delete-checked").click(function() {
                val = [];
                var checkbox = $("input[name^='checkbox']:checked:enabled", '#form-multiple').each(
                    function(i) {
                        val[i] = $(this).val();
                    });
                console.log(val);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Data Checklist Akan Dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oke, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".btn").addClass('disabled');
                        $(this).html('<i class="fas fa-sync-alt fa-spin"></i>');
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('user.destroy.multi') }}",
                            data: {
                                id: val
                            },
                            success: function(data) {
                                console.log(data);
                                if (data != 'success') {
                                    Swal.fire(
                                        'Failed!',
                                        data,
                                        'error'
                                    )
                                } else {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener(
                                                'mouseenter', Swal
                                                .stopTimer)
                                            toast.addEventListener(
                                                'mouseleave', Swal
                                                .resumeTimer)
                                        }
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Data ' + name +
                                            ' Berhasil Dihapus'
                                    })

                                    $('#datatable').DataTable().destroy();
                                    tabledata(status, from, to);
                                }
                                $(".btn").removeClass('disabled');
                                $("#delete-checked").html(
                                    '<i class="fa fa-trash-alt"></i>');
                            }

                        });
                    }
                })
            });
        </script>
    @elsecannot('user delete')
        <script>
            function deleteConfirm(id, name) {
                Swal.fire(
                    'Waduh!',
                    'Anda Tidak Memiliki Akses',
                    'error'
                )
            }
            $("#delete-checked").click(function() {
                Swal.fire(
                    'Waduh!',
                    'Anda Tidak Memiliki Akses',
                    'error'
                )
            });
        </script>
    @endcan
@endsection