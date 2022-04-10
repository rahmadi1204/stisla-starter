<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ ucwords(str_replace('_', ' ', config('app.name'))) ?? 'App' }} | {{ $title ?? 'Login' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/storage/images/logo.png') }}" class="appLogo"
        type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/stisla') }}/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/stisla') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/stisla') }}/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="{{ asset('/storage/images/logo.png') }}" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Welcome to <span
                                class="font-weight-bold">{{ str_replace('_', ' ', config('app.name')) }}</span></h4>
                        <form method="POST" action="{{ url('/login') }}" class="needs-validation" novalidate="">
                            @csrf
                            @include('components.alert')
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Forgot Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                        {{-- <div class="text-center mt-5 text-small">
                            Copyright &copy; {{ config('app.name') }}. Made with 💙 by Stisla
                            <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="{{ asset('/stisla') }}/images/login-bg.jpg">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                @if (now()->format('His') < '120000')
                                    <h1 class="mb-2 display-4 font-weight-bold">Selamat Pagi</h1>
                                @elseif (now()->format('His') < '150000')
                                    <h1 class="mb-2 display-4 font-weight-bold">Selamat Siang</h1>
                                @elseif (now()->format('His') < '180000')
                                    <h1 class="mb-2 display-4 font-weight-bold">Selamat Sore</h1>
                                @elseif (now()->format('His') > '180000')
                                    <h1 class="mb-2 display-4 font-weight-bold">Selamat Malam</h1>
                                @endif
                                <h5 class="font-weight-normal text-muted-transparent">Sarangan, Magetan Jawa Timur
                                    Indonesia</h5>
                            </div>
                            Photo by <a
                                href="https://unsplash.com/@ilhamabitama?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Ilham
                                Abitama</a> on <a
                                href="https://unsplash.com/photos/SXSU5nW8hz0?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>


                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    <script src="{{ asset('/stisla') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('/stisla') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('/stisla') }}/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
