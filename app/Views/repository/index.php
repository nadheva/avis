<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Library</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Project List</h5>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <br>
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 20%">Project</th>
                                    <th scope="col" style="width: 20%">Leader</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($project as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->project_name ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <a type="button" href="<?= base_url('') ?>/repository/list/<?= $r->id ?>" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>