@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <i class="fa fa-check"></i> {{ $message }}
        </div>
    </div>
@elseif ($message = Session::get('error'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <i class="fa fa-window-close"></i> {{ $message }}
        </div>
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-window-close"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
