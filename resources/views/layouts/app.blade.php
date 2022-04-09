<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ ucwords(str_replace('_', ' ', config('app.name'))) }} | {{ $title ?? 'Page' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/prismjs/themes/prism.css">
    <link rel="stylesheet"
        href="{{ asset('/stisla') }}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('/stisla') }}/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/chocolat/dist/css/chocolat.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet"
        href="{{ asset('/stisla') }}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('/stisla') }}/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('/stisla') }}/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/stisla') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/assets/css/components.css">
    <link rel="shortcut icon" href="{{ asset('/storage/images/logo.png') }}" class="appLogo"
        type="image/x-icon">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.navigation')
            @include('layouts.sidebar')


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{ $title ?? 'Page' }}</h1>
                    </div>
                    @yield('content')
                </section>
                @yield('modal')
                @include('components.modal_image')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2020 <b class="appName"></b>
                    <div class="bullet"></div>
                </div>
                <div class="footer-right">
                    0.9.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    {{-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('/stisla') }}/assets/js/stisla.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('/stisla') }}/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/prismjs/prism.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js">
    </script>
    <script src="{{ asset('/stisla') }}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
    </script>
    <script src="{{ asset('/stisla') }}/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('/stisla') }}/node_modules/select2/dist/js/select2.full.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('/stisla') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('/stisla') }}/assets/js/custom.js"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('/stisla') }}/assets/js/page/modules-datatables.js"></script>
    <script src="{{ asset('/stisla') }}/assets/js/page/bootstrap-modal.js"></script>
    {{-- <script src="{{ asset('/stisla') }}/assets/js/page/features-post-create.js"></script> --}}
    @include('scripts.show_image')
    @include('scripts.img_validation')
    @include('scripts.form')
    @yield('scripts')
    <script>
        $.ajax({
            type: "get",
            url: "{{ url('/apps-show') }}",
            success: function(response) {
                console.log(response);
                $(".appName").val(response['name']);
                $(".appName").text(response['name'].toUpperCase());
                $(".appLogo").attr('src', response['img']);
                $(".appLogo").attr('href', response['img']);
            }
        });
    </script>
    <script>
        $("#btn-logout").click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Logout!',
                        'You have been logged out.',
                        'success'
                    )
                    $("#logout").click();
                }
            })
        });
    </script>
</body>

</html>
