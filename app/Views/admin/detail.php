<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail User</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                    <div class="text-center">
                        <img src="<?= base_url('/public') ?>/theme/assets/images/avatars/<?= $user->user_image ?>" width="150px" class="rounded"
                        alt="...">
                        <br><br>
                    <h5 class="card-title"><?= $user->fullname ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $user->level_name ?> <?= $user->section_name == '-' ? '' : 'of '.$user->section_name ?></h6>
                    <p class="card-text"><?= $user->email ?></p>
                    <small class="form-text text-muted">member since <?= date('d M Y', strtotime($user->created_at)); ?></small>
                    <br>
                    <a href="<?= base_url('') ?>/admin"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>