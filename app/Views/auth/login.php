<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Login</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="<?= base_url('/public') ?>/theme/assets/images/icon.png" type="image/png" sizes="16x16">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

    <!-- Theme Styles -->
    <link href="<?= base_url('/public') ?>/theme/assets/css/connect.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/css/dark_theme.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/css/custom.css" rel="stylesheet">
    <link rel="manifest" href="<?= base_url('') ?>/public/assets/js/web.webmanifest">
</head>
<style>
    #view_pass {
        float: right;
        margin-right: 25px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }
</style>
<body class="auth-page sign-in">
    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="auth-form">
                        <div class="row">
                            <div class="col">
                                <div class="logo-box"><a href="<?= base_url() ?>">
                                        <img src="<?= base_url('/public') ?>/theme/assets/images/avi.png" width="280px" style="padding-right: 20px;" class="img-fluid"
                                            alt="">
                                    </a></div>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <?php if (session()->has('pesan')) : ?>
                                <div class="alert alert-primary alert-dismissible fade show">
                                    <?= session('pesan') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php endif ?>
                                <form action="<?= base_url('/public') ?><?= route_to('login') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <?php if ($config->validFields === ['email']): ?>
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                            name="login" placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                            name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control active"
                                            placeholder="<?=lang('Auth.password')?>" id="myInput">
                                        <span class="fa fa-eye-slash" onclick="myFunction()" id="view_pass"></span>
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Login</button>
                                    <div class="auth-options">
                                        <div class="custom-control custom-checkbox form-group">
                                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                            <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                                        </div>
                                        <a href="#" class="forgot-link">Forgot Password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url('') ?>/public/assets/js/register.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/js/connect.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>