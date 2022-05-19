<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Profile</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit My Profile</h5>
                        <form action="<?= base_url('') ?>/user/update/<?= user()->id ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fullname</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="fullname" type="text"
                                        value="<?= user()->fullname; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="email" type="text" value="<?= user()->email; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">
                                    <img width="200" src="<?= base_url('/public') ?>/theme/assets/images/avatars/<?= user()->user_image; ?>">
                                </label>
                                <div class="col-sm-5">
                                    <div class="mt-2">
                                        <input type="file" name="user_image" class="filestyle" id="inputGroupFile01">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_image_lama" value="<?= user()->user_image; ?>">
                            <input type="hidden" name="id" value="<?= user()->id; ?>">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <button type="submit" class="btn btn-primary mt-2">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>