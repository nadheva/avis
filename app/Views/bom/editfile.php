<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit Bom File</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/bom/model/<?= $file->id_model ?>" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Bom File</h5>
                        <form action="<?= base_url('') ?>/bom/updatefile/<?= $file->id ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model Name</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="model" type="text" readonly
                                        value="<?= $file->model; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="file" type="text" readonly
                                        value="<?= $file->nama_file; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="id_model" value="<?= $file->id_model ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-7">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="status" id="exampleRadios1" value="active" <?= ($file->status == 'active') ? 'checked' : '' ?> >
                                            <label class="custom-control-label" for="exampleRadios1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="status" id="exampleRadios2" value="inactive" <?= ($file->status == 'inactive') ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="exampleRadios2">
                                                Inactive
                                            </label>
                                        </div>
                                </div>
                            </div>
                            <input type="hidden" name="status_lama" value="<?= $file->status ?>">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Reason</label>
                                <div class="col-sm-7">
                                    <textarea name="reason" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Approval</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="file" type="text" readonly
                                        value="1. M. Sallim Syahied Fauzy">
                                </div>
                            </div>
                            <input type="hidden" name="uap" value="38">
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