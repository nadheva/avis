<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/repository">Library</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $projectrow['project_name'] ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/repository" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">List Document</h5>
                            </div>
                        </div>
                        <br>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <?php if (session()->has('pesan')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show">
                                <?= session('pesan') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif ?>
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 10%">Source</th>
                                    <th scope="col" style="width: 20%">Item</th>
                                    <th scope="col" style="width: 15%">PIC</th>
                                    <th scope="col" style="width: 15%">File Name</th>
                                    <th scope="col" style="width: 15%">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($task as $row) : ?>
                                    <?php if($row->namafile != null) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>Task</td>
                                        <td><?= $row->concern ?></td>
                                        <td><?= $row->fullname ?></td>
                                        <td><?= $row->namafile ?></td>
                                        <td>
                                            <a href="<?= base_url('') ?>/repository/downloadtask/<?= $projectrow['project_name'] ?>/<?= $row->namafile; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($child_task as $row) : ?>
                                    <?php if($row->namafile != null) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>Child Task</td>
                                        <td><?= $row->concern ?></td>
                                        <td><?= $row->fullname ?></td>
                                        <td><?= $row->namafile ?></td>
                                        <td>
                                            <a href="<?= base_url('') ?>/repository/downloadtask/<?= $projectrow['project_name'] ?>/<?= $row->namafile; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($rio as $row) : ?>
                                    <?php if($row->filename != null) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>RIO</td>
                                        <td><?= $row->rio ?></td>
                                        <td><?= $row->fullname ?></td>
                                        <td><?= $row->filename ?></td>
                                        <td>
                                            <a href="<?= base_url('') ?>/repository/downloadrio/<?= $projectrow['project_name'] ?>/<?= $row->filename; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($child_rio as $row) : ?>
                                    <?php if($row->filename != null) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>Child RIO</td>
                                        <td><?= $row->rio ?></td>
                                        <td><?= $row->fullname ?></td>
                                        <td><?= $row->filename ?></td>
                                        <td>
                                            <a href="<?= base_url('') ?>/repository/downloadrio/<?= $projectrow['project_name'] ?>/<?= $row->filename; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>