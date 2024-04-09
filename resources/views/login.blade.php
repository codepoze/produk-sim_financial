<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="CodePoze">
    <meta name="keywords" content="CodePoze">
    <meta name="author" content="CodePoze">
    <title>CodePoze | {{ $title }}</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.png') }}" sizes="180x180" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: css global -->
    <link href="{{ asset_admin('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('my_assets/my_css.css') }}" rel="stylesheet" type="text/css" />
    <!-- end:: css global -->

    <script type="text/javascript" src="{{ asset_admin('libs/jquery/jquery.min.js') }}"></script>
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-success bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-success p-4">
                                        <h5 class="text-success">Welcome Back !</h5>
                                        <p>Sign in to continue to Skote.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset_admin('images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="{{ route('home') }}" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset_admin('images/codepoze-light.png') }}" alt="" class="rounded-circle" height="70">
                                        </span>
                                    </div>
                                </a>
                                <a href="{{ route('home') }}" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset_admin('images/codepoze-dark.png') }}" alt="" class="rounded-circle" height="70">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <div id="alert"></div>

                                <form id="form-login" class="form-horizontal" action="{{ route('auth.check') }}" method="post">
                                    <div class="field-input mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="field-input mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                            <button class="btn btn-light " type="button"><i class="mdi mdi-eye-outline"></i></button>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember_me" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-success waves-effect waves-light" type="submit" id="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <div>
                            <p class="copyright my-auto"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: jd global -->
    <script type="text/javascript" src="{{ asset_admin('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/metismenu/metisMenu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/simplebar/simplebar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/node-waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>
    <!-- end:: jd global -->

    <script>
        let untukLogin = function() {
            $('#form-login').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-login').find('input, textarea, select').removeClass('is-valid');
                        $('#form-login').find('input, textarea, select').removeClass('is-invalid');

                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').html('Menunggu...');
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location = response.url;
                        } else if (response.status === 'warning') {
                            $('#alert').html(
                                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <i data-feather="info" class="me-50"></i>
                                        <span>${response.message}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>`
                            );
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });
                        }

                        $('#submit').removeAttr('disabled');
                        $('#submit').html('Masuk');
                    }
                })
            });

            $(document).on('keyup', '#form-login input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.field-input').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.field-input').find('.error').html('');
                }
            });
        }();
    </script>
</body>

</html>