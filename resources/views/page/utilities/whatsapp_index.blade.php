@extends('layouts.app')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $title }}</h2>
        <p class="section-lead">
            Halaman pengaturan {{ $title }}
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-data" data-toggle="tab" href="#home5" role="tab"
                                    aria-controls="home" aria-selected="true">
                                    <i class="fas fa-qrcode"></i>Qrcode</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent5">
                            <div class="tab-pane fade show active" id="home5" role="tabpanel" aria-labelledby="tab-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/images/qrcode.png') }}" alt="Whatsapp"
                                                style="max-width: 300px" id="qrcode" class="img-fluid">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <b id="text">Scan Qrcode</b><b id="demo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">

                                    <div class="col-md-6">
                                        <h4 class="ml-2">
                                            Cara menghubungkan Whatsapp ke aplikasi
                                        </h4>
                                        <ol>
                                            <li>Buka Whatsapp di handphone</li>
                                            <li>Klik menu di pojok kanan atas</li>
                                            <li>Pilih Linked Devices</li>
                                            <li>Pilih Link a Device</li>
                                            <li>Pastikan nomor yang anda gukanan sama dengan nomor yang terdaftar pada
                                                aplikasi</li>
                                        </ol>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="#" id="form-whatsapp" class="px-2">
                                            <div class="alert alert-success alert-dismissible show fade d-none"
                                                id="alert-success">
                                                <div class="alert-body">
                                                    <button class="close" data-dismiss="alert">
                                                        <span>&times;</span>
                                                    </button>
                                                    <p><i class="fa fa-check"></i> Data Berhasil Diupdate</p>
                                                </div>
                                            </div>

                                            <div class="alert alert-danger alert-dismissible show fade d-none"
                                                id="alert-danger">
                                                <div class="alert-body">
                                                    <button class="close" data-dismiss="alert">
                                                        <span>&times;</span>
                                                    </button>
                                                    <p><i class="fa fa-window-close"></i> Data Gagal Diupdate</p>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row align-items-center">
                                                <label for="phone" class="form-control-label col-sm-3 text-md-right">
                                                    Server</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <div class="input-group">
                                                        <input type="password" name="server" class="form-control"
                                                            id="server" value="{{ $data->server }}">
                                                        <div class="input-group-text" id="btn-spill">
                                                            <i class="fas fa-eye"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="form-group row align-items-center">
                                                <label for="whatsapp" class="form-control-label col-sm-3 text-md-right">
                                                    Whatsapp</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="whatsapp" class="form-control phone-number"
                                                        id="whatsapp" value="{{ ucwords($data->phone ?? '0') }}">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <div class="btn btn-primary" id="btn-update">Update</div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Pesan</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="#chat-card" class="nav-link list-pesan active"
                                id="chat-list-button">Kirim
                                Pesan</a></li>
                        <li class="nav-item"><a href="#group-card" class="nav-link list-pesan"
                                id="group-list-button">Daftar Group</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 pesan" id="chat-card">

            <div class="alert alert-success alert-dismissible show fade d-none" id="alert-success">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <p><i class="fa fa-check"></i> Pesan Terkirim</p>
                </div>
            </div>

            <div class="alert alert-danger alert-dismissible show fade d-none" id="alert-danger">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <p><i class="fa fa-window-close"></i> Pesan Gagal Terkirim</p>
                </div>
            </div>

            <form method="post" class="needs-validation" novalidate="">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Kirim Pesan</h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label>Nomor Tujuan</label>
                            <input type="text" name="receiver" class="form-control phone-number" id="receiver"
                                value="081217739049" required>
                            <div class="invalid-feedback">
                                Masukan Nomor Tujuan
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pesan</label>
                            <textarea class="form-control" name="message" id="message"></textarea>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary" id="btn-send">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 pesan d-none" id="group-card">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Grup Whatsapp</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border" id="group-list">

                    </ul>
                    <div class="text-center pt-1 pb-1">
                        <a href="#" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 pesan d-none" id="chat-group-card">

            <div class="alert alert-success alert-dismissible show fade d-none" id="alert-success">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <p><i class="fa fa-check"></i> Pesan Terkirim</p>
                </div>
            </div>

            <div class="alert alert-danger alert-dismissible show fade d-none" id="alert-danger">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <p><i class="fa fa-window-close"></i> Pesan Gagal Terkirim</p>
                </div>
            </div>

            <form method="post" class="needs-validation" novalidate="">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Kirim Pesan Group</h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label>Nama Group</label>
                            <input type="text" name="group_name" class="form-control " id="group-name" required>
                            <input type="hidden" name="group_id" class="form-control " id="group-id" required>
                        </div>
                        <div class="form-group">
                            <label>Pesan</label>
                            <textarea class="form-control" name="message" id="message-group"></textarea>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary" id="btn-send">Kirim</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('modal')
@endsection
@section('scripts')
    <script>
        $("#chat-list-button").click(function(e) {
            e.preventDefault();
            $(".list-pesan").removeClass('active');
            $(".pesan").addClass('d-none');
            $("#chat-list-button").addClass('active');
            $("#chat-card").removeClass('d-none');
        });
        $("#group-list-button").click(function(e) {
            e.preventDefault();
            $(".list-pesan").removeClass('active');
            $(".pesan").addClass('d-none');
            $("#group-list-button").addClass('active');
            $("#group-card").removeClass('d-none');
        });
        $("#group-send-button").click(function(e) {
            e.preventDefault();
            $(this).addClass('clicked');
            let idGroup = $(".clicked").data('id');
            let nameGroup = $(".clicked").data('name');
            $(".clicked").removeClass('clicked');
            $("#group-name").val(nameGroup);
            $("#group-id").val(idGroup);
            $(".list-pesan").removeClass('active');
            $(".pesan").addClass('d-none');
            $("#group-list-button").addClass('active');
            $("#chat-group-card").removeClass('d-none');
        });
    </script>
    <script>
        $("#btn-spill").hover(function(e) {
            $("#server").attr('type', 'text');
        }, function(e) {
            $("#server").attr('type', 'password');
        });
    </script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "get",
            url: "{{ url('/whatsapps-qrcode') }}",
            success: function(response) {
                console.log(response);
                $('#qrcode').attr('src', response.data);
                $('#text').text(response.connected);
            }
        });
        $.ajax({
            type: "get",
            url: "{{ url('/whatsapps-group') }}",
            success: function(response) {
                $.each(response, function(indexInArray, data) {
                    console.log(data.name);
                    $("#group-list").append(
                        `
                    <li class="media">
                                <img class="mr-3 rounded-circle" width="50"
                                    src="{{ asset('/stisla') }}/assets/img/avatar/avatar-1.png" alt="avatar">
                                <div class="media-body">
                                    <div class="float-right btn btn-success" title="Kirim Pesan" onclick="groupChat('${data.id}', '${data.name}')">
                                        <i class="fa fa-comment"></i>
                                    </div>
                                    <div class="media-title">` + data.name + `</div>
                                    <span class="text-small text-muted">` + data.id + `</span>
                                </div>
                            </li>
                    `);
                });
            }
        });
    </script>
    <script>
        $("#btn-send").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
            let phone = $('#receiver').val();
            let message = $('#message').val();
            console.log(phone);
            console.log(message);
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('/whatsapps-send') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    phone: phone,
                    message: message
                },
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        $('#alert-success').removeClass('d-none');
                        $('#alert-danger').addClass('d-none');
                    } else {
                        $('#alert-success').addClass('d-none');
                        $('#alert-danger').removeClass('d-none');
                    }
                    $("#btn-send").html('Kirim');
                    $('.btn').removeClass('disabled');
                }
            });
        });
        $("#btn-update").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
            let server = $('#server').val();
            let whatsapp = $('#whatsapp').val();
            console.log(server);
            console.log(whatsapp);
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('/whatsapps-update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    server: server,
                    whatsapp: whatsapp
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        $('#form-whatsapp #alert-success').removeClass('d-none');
                        $('#form-whatsapp #alert-danger').addClass('d-none');
                    } else {
                        $('#form-whatsapp #alert-success').addClass('d-none');
                        $('#form-whatsapp #alert-danger').removeClass('d-none');
                    }
                    $("#btn-update").html('update');
                    $('.btn').removeClass('disabled');
                    $.ajax({
                        type: "get",
                        url: "{{ url('/whatsapps-qrcode') }}",
                        success: function(response) {
                            console.log(response);
                            $('#qrcode').attr('src', response.data);
                            $('#text').text(response.connected);
                        }
                    });
                }
            });
        });

        function groupChat(id, name) {
            $("#group-name").val(name);
            $("#group-id").val(id);
            $(".list-pesan").removeClass('active');
            $(".pesan").addClass('d-none');
            $("#group-list-button").addClass('active');
            $("#chat-group-card").removeClass('d-none');
        };
    </script>
@endsection
