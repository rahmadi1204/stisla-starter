@extends('layouts.app')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $title }}</h2>
        <p class="section-lead">
            Halaman pengaturan {{ $title }}
        </p>

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="card-body">
                        <h4>Whatsapp</h4>
                        <p>Pengaturan nomor whatsapp, pesan notifikasi whatsapp dan lainnya</p>
                        <a href="{{ route('whatsapp.index') }}" class="card-cta">Ubah Pengaturan <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-body">
                        <h4>Email</h4>
                        <p>Pengaturan alamat email, pesan notifikasi email dan lainnya</p>
                        <a href="features-setting-detail.html" class="card-cta">Ubah Pengaturan <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@section('scripts')
@endsection
