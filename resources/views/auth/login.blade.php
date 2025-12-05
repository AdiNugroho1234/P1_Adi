<style>


    .btn-outline-blue {
    color: white; /* teks putih */
    border: 1px solid #0d47a1;
    background-color: transparent;
}

.btn-outline-blue:hover {
    background-color: #0d47a1;
    color: white;
}

</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - ShopGrids</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    <!-- Login Section -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo"
                                    style="max-width: 150px;" />
                            </div>
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>

                            @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                            @endif
                            <div class="row mb-4">
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <a class="btn facebook-btn w-100 btn-outline-blue btn-block" href="#">
                                        <i class="lni lni-facebook-filled"></i> Facebook
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <a class="btn twitter-btn w-100 btn-outline-primary btn-block" href="#">
                                        <i class="lni lni-twitter-original"></i> Twitter
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12"><a href="{{ route('google.redirect') }}" class="btn google-btn btn btn-outline-danger btn-block"
                                        href="javascript:void(0)"><i class="lni lni-google"></i> Google login</a>
                                </div>
                            </div>

                            <div class="alt-option text-center">
                                <span>Or</span>
                            </div>


                            <div class="form-group input-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group input-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="lost-pass" href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>

                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>

                            <p class="outer-link">
                                Don't have an account?
                                <a href="{{ route('register') }}">Register here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>