<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<style>
    #view_pass {
        float: right;
        margin-right: 25px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }
</style>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <div class="col-11">
                            <form action="<?= base_url('') ?>/user/resetpass" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-7">
                                        <input type="password"
                                            class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                            required name="new_pass" id="myInput">
                                        <span class="fa fa-eye-slash" onclick="myFunction()" id="view_pass"></span>
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Repeat New Password</label>
                                    <div class="col-sm-7">
                                        <input type="password"
                                            class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                            required name="pass_confirm" id="myInput2">
                                        <span class="fa fa-eye-slash" onclick="myFunction2()" id="view_pass"></span>
                                        <div class="invalid-feedback">
                                            <?= session('errors.pass_confirm') ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Tanggal</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" id="datepicker" name="tanggal"
                                                value="<?= date('d/m/Y', time()) ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><span class="material-icons">calendar_today</span></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" id="e" name="tanggal"
                                                value="<?= date('d/m/Y', time()) ?>">
                                        </div>
                                    </div>
                                </div> -->
                                <br>
                                <button type="submit" class="btn btn-primary"><?= lang('Auth.resetPassword') ?></button>
                                <input type="hidden" name="email" value="<?= user()->email ?>" id="">
                                <input type="hidden" name="pass_lama" value="<?= user()->password_hash ?>" id="">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div><!-- container -->
</div>
<?= $this->endSection(); ?>