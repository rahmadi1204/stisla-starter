@extends('layouts.app')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $title }}</h2>
        <p class="section-lead">
            Halaman pengaturan {{ $title }}
        </p>

        <div id="output-status"></div>
        <div class="row">
            <div class="col-12">
                @include('components.alert')
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Logo</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('/storage/images/' . $data->img) }}" alt="logo" width="300px" id="img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form id="setting-form" action="{{ route('app.update', $data->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card" id="settings-card">
                        <div class="card-header">
                            <h4>Settings</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Data aplikasi secara umum</p> <code>Note : bila nama diubah, aplikasi
                                akan
                                dimuat ulang dan anda otomatis logout</code>
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Nama Aplikasi</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ ucwords($data->name) }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="desc" class="form-control-label col-sm-3 text-md-right">Deskripsi</label>
                                <div class="col-sm-6 col-md-9">
                                    <textarea class="form-control" name="desc" id="desc">{{ ucwords($data->desc) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="email" class="form-control-label col-sm-3 text-md-right">Email</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ strtolower($data->email) }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="phone" class="form-control-label col-sm-3 text-md-right">Telepon</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" name="phone" class="form-control phone-number" id="phone"
                                        value="{{ ucwords($data->phone) }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="address" class="form-control-label col-sm-3 text-md-right">Alamat</label>
                                <div class="col-sm-6 col-md-9">
                                    <textarea class="form-control" name="address" id="address">{{ ucwords($data->address) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-control-label col-sm-3 text-md-right">Logo</label>
                                <div class="col-sm-6 col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="img" class="custom-file-input" id="customFile"
                                            accept="image/*">
                                        <label class="custom-file-label">Choose File</label>
                                    </div>
                                    <div class="form-text text-muted">The image must have a maximum size of 5MB</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save Changes</button>
                            <button class="btn btn-secondary" type="button" id="btn-reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@section('scripts')
    <script>
        $("#btn-reset").click(function(e) {
            location.reload();
        });
        $("#btn-save").click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $('.btn').addClass('disabled');
            let form_data = $("#setting-form").serialize();
            console.log(form_data)
        });
    </script>
@endsection
