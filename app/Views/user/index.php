<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-6">
                <div class="text-center">
                    <?= view('Myth\Auth\Views\_message_block') ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <?php if (session()->has('pesan')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show">
                                <?= session('pesan') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif ?>
                            <img src="<?= base_url('/public') ?>/theme/assets/images/avatars/<?= $user->user_image ?>" width="150px"
                                class="rounded" alt="...">
                            <br><br>
                            <h5 class="card-title"><?= $user->fullname ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $user->level_name ?> <?= $user->section_name == '-' ? '' : 'of '.$user->section_name ?></h6>
                            <p class="card-text"><?= $user->email ?></p>
                            <small class="form-text text-muted">member since <?= date('d M Y', strtotime($user->created_at)); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>