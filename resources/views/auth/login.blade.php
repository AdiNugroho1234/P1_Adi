<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | Adixiiweb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Page">
    <meta name="author" content="Themesbrand">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">

                            <!-- Logo -->
                            <h3 class="text-center mt-5 mb-4">
                                <a href="#" class="d-block auth-logo">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}"
                                        height="30"
                                        class="auth-logo-dark"
                                        alt="Logo Dark">

                                    <img src="{{ asset('assets/images/logo-light.png') }}"
                                        height="30"
                                        class="auth-logo-light"
                                        alt="Logo Light">
                                </a>
                            </h3>

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mb-1 text-center">
                                    Welcome Back!
                                </h4>
                                <p class="text-muted text-center">
                                    Sign in to continue to Adixiiweb.
                                </p>

                                <!-- FORM FRONTEND ONLY -->
                                <form class="form-horizontal mt-4" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email"
                                            value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" required>
                                        @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    id="remember">
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 text-end">
                                            <button type="submit"
                                                class="btn btn-primary w-md waves-effect waves-light">
                                                Log In
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="#" class="text-muted">
                                            <i class="mdi mdi-lock"></i> Forgot your password?
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-5 text-center">
                        <p>
                            Don't have an account?
                            <a href="register" class="text-primary">Signup Now</a>
                        </p>

                        <p class="mb-0">
                            © 2026 Adixiiweb
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>