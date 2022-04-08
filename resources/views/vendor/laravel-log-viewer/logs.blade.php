@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title ?? 'Page' }}</h4>
                    </div>
                    <div class="card-body">
                        <iframe src="{{ route('log') }}" frameborder="0" style="width: 100%;height:1000px"></iframe>
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
