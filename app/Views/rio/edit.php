<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page"><?= $tittle ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tittle ?></h5>
                        <form action="<?= base_url('') ?>/rio/updaterio/<?= $rio->rid ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-7">
                                    <select class="js-states form-control" name="project" tabindex="-1" style="display: none; width: 100%">
                                        <option value="<?= $rio->project ?>" hidden><?= $rio->project_name ?></option>
                                        <?php foreach ($project as $prj) : ?>
                                            <option value="<?= $prj->id ?>"><?= $prj->project_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-7">
                                    <select class="js-states form-control" name="type" tabindex="-1" style="display: none; width: 100%">
                                        <option hidden><?= $rio->type ?></option>
                                        <option value="Risk">Risk</option>
                                        <option value="Issue">Issue</option>
                                        <option value="Oportunity">Oportunity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RIO Tittle</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="rio" type="text" value="<?= $rio->rio ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PIC</label>
                                <div class="col-sm-7">
                                    <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                        <option value="<?= $rio->pic ?>" hidden><?= $rio->fullname ?></option>
                                        <?php foreach ($users as $us) : ?>
                                            <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Approval RIO</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="uar" type="text" value="<?= user()->fullname ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Due Date</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="due_date" type="date" value="<?= $rio->due_date ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="exampleFormControlTextarea1">Description</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="notes" rows="3"><?= $rio->notes ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Required Attachment File</label>
                                <div class="col-sm-7">
                                    <select class="js-states form-control" name="required_file" tabindex="-1" style="display: none; width: 100%;" aria-placeholder="Choose">
                                        <option hidden><?= $rio->file ?></option>
                                        <option value="" hidden>-- Choose --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 text-center">
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->endSection(); ?>