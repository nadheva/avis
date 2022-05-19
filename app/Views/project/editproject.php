<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/project/<?= $customer->id; ?>">Project</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit Project</li>
                        <li class="breadcrumb-item" aria-current="page"><?= $project['project_name'] ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/project/<?= $customer->id; ?>" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Project</h5>
                        <form action="<?= base_url('') ?>/project/updateproject/<?= $project['id'] ?>" method="POST"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-form-label">Project Name</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" name="new_prn" type="text"
                                                value="<?= $project['project_name']; ?>" autocomplete="off">
                                        </div>
                                        <input type="hidden" value="<?= $project['project_name'] ?>" name="old_prn" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-form-label">Start</label>
                                        <div class="col-sm-12">
                                            <input readonly type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="start"
                                                value="<?= date('Y-m-d', strtotime($project['start'])) ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-form-label" for="end">End Product</label>
                                        <div class="col-sm-12">
                                        <select class="js-states form-control" tabindex="-1"
                                            style="display: none; width: 100%" id="editenpro" name="end_product">
                                            <option value="<?= $project['end_product'] ?>"><?= $project['end_product'] ?></option>
                                            <option id="valendpro"></option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $project['id']; ?>">
                            <input type="hidden" name="c_id" value="<?= $customer->id; ?>">
                            <input type="hidden" name="status" value="<?= $project['status']; ?>">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>