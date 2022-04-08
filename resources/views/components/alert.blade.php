@if ($message = Session::get('success'))
    <div class="alert alert-success dark col-12" role="alert">
        <p><i class="fa fa-check"></i> {{ $message }}</p>
    </div>
@elseif ($message = Session::get('error'))
    <div class="alert alert-danger dark col-12" role="alert">
        <p><i class="fa fa-ban"></i> {{ $message }}</p>
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger dark col-12" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="fa fa-ban"></i>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
