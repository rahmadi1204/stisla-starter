@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="checkAll">
                                        </th>
                                        <th>No</th>
                                        <th>Avatar</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type="checkbox" disabled></th>
                                        <th colspan="7" class="text-center">Data Pengguna</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <form action="{{ url('users-update') }}" method="post" id="form-modal">
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
                                <input type="file" class="custom-file-input" id="customFile">
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
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                    $("#image-upload").val(response['img']);
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
    <script>
        function tabledata() {
            return $('#datatable').DataTable({
                "scrollX": true,
                "scrollY": 500,
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        }
    </script>
    <script>
        tabledata();
    </script>
@endsection
