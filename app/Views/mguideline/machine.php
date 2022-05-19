<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/mguideline">Area</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= base_url('') ?>/mguideline/area/<?= $areaRow->id ?>"><?= $areaRow->area ?></a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $machineRow->machine_name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/mguideline/area/<?= $areaRow->id ?>" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">File List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->level_id == '3') :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newFile"
                                        class="btn btn-primary">Add File</button>
                                    <?php endif ?>
                                </div>
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
                                    <th scope="col" style="width: 66.66%">File</th>
                                    <th scope="col" style="width: 36.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if(isset($fileData)) : ?>
                                <?php foreach ($fileData as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->filename ?></td>
                                    <td>
                                        <a type="button" style="color: white;"
                                            href="<?= base_url('') ?>/mguideline/download/<?= $areaRow->area ?>/<?= $machineRow->machine_name ?>/<?= $row->filename ?>"
                                            class="badge badge-info"><span class="material-icons">file_download</span></a>
                                        <?php if(user()->level_id == "3") : ?>
                                        <a type="button" class="badge badge-danger" onclick="del(<?= $row->id; ?>, <?= $areaRow->id ?>,<?= $machineRow->id ?>)"><span
                                                class="material-icons" style="color: white;">delete</span></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/mguideline/addfile/<?= $areaRow->id ?>/<?= $machineRow->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control" name="area" value="<?= $areaRow->area ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Machine</label>
                                <input type="text" class="form-control" name="machine" value="<?= $machineRow->machine_name ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <div>
                                    <div class="input-group">
                                        <input type="file" name="file" class="filestyle">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="area_id" value="<?= $areaRow->id ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function del(id,areaid,machineid,area,machine,file) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/mguideline/delfile') ?>/${id}/${areaid}/${machineid}`)
                        } else {
                            swal("This file is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>