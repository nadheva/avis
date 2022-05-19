<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Drawing</li>
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
                                <h5 class="card-title">Model List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->section == 'RnD') :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newTask"
                                        class="btn btn-primary">Add Model</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <?php if (session()->has('pesanmodel')) : ?>
                        <div class="alert alert-primary alert-dismissible fade show">
                            <?= session('pesanmodel') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif ?>
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 56.66%">Model</th>
                                    <th scope="col" style="width: 36.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dwg_model as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $m->model ?></td>
                                    <td>
                                        <a type="button" style="color: white;" href="<?= base_url('') ?>/drawing/model/<?= $m->id ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        <?php if(user()->section == "RnD") : ?>
                                        <a href="<?= base_url('') ?>/drawing/editmodel/<?= $m->id; ?>" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                        <a type="button" class="badge badge-danger" onclick="del(<?= $m->id; ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if(user()->section == 'RnD') :  ?>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Drawing Download Report</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <!-- <button type="button" data-toggle="modal" data-target="#newTask"
                                        class="btn btn-primary">Add Model</button> -->
                                </div>
                            </div>
                        </div>
                        <br>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <?php if (session()->has('pesanlog')) : ?>
                        <div class="alert alert-primary alert-dismissible fade show">
                            <?= session('pesanlog') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif ?>
                        <table class="table table-responsive" id="zero-conf2">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 9.66%">Date</th>
                                    <th scope="col" style="width: 12.66%">Name</th>
                                    <th scope="col" style="width: 12.66%">Section</th>
                                    <th scope="col" style="width: 9.66%">Model</th>
                                    <th scope="col" style="width: 19.66%">File</th>
                                    <th scope="col" style="width: 5.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($log as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->date ?></td>
                                    <td><?= $row->fullname ?></td>
                                    <td><?= $row->section ?></td>
                                    <td><?= $row->model ?></td>
                                    <td><?= $row->file ?></td>
                                    <td>
                                        <?php if(user()->role == "pm" || user()->role == "admin" || user()->role == "ame"|| user()->section == "RnD") : ?>
                                        <a type="button" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Delete"
                                            onclick="delog(<?= $row->id; ?>)"><span class="material-icons"
                                                style="color: white;">delete</span></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
        <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Model</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/drawing/addmodel" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Model Name" name="model">
                            </div>
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
            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this model!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/drawing/delmodel') ?>/${id}`)
                        } else {
                            swal("This model is safe!");
                        }
                    });
            }
        </script>
        <script>
            function delog(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this log!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/drawing/delog') ?>/${id}`)
                        } else {
                            swal("This log is safe!");
                        }
                    });
            }
        </script>
    <?= $this->endSection(); ?>