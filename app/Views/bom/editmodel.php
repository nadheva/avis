<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit Bom Model</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/bom" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Bom Model</h5>
                        <form action="<?= base_url('') ?>/bom/updatemodel/<?= $model->id ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model Name</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="model" type="text"
                                        value="<?= $model->model; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 text-left">
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>