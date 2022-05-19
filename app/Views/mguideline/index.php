<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Area</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-transparent file-list">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Directory</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a href="http://vistway.visteon.com/" target="_blank"><span class="bcstm bcstm-warning" style="background-color: #2ec4db; color: white">Link to Vistway</span></a>
                            </div>
                        </div>
                        <br>
                        <div class="container text-center">
                        <div class="row">
                            <div class="col-12">
                                <a class="btn" style="background-color: #5e5d5a; color: white">Manufacturing Guideline</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 right-line"></div>
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-3 p-0">
                            <div class="halved right-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved"></div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        </div>
                        <div class="row">
                            <?php foreach($area as $row) : ?>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= base_url('') ?>/mguideline/area/<?= $row['id'] ?>">View Details</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="folder-icon">
                                                    <i class="material-icons" style="color:orange">folder</i>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="folder-info">
                                                    <a href="<?= base_url('') ?>/mguideline/area/<?= $row['id'] ?>"><?= $row['area'] ?></a>
                                                    <span><?= $row['countdir'] ?> process</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/mguideline/addarea" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Area Name" name="area">
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
        <?php foreach($area as $row) : ?>
        <div class="modal fade" id="editArea<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/mguideline/updatearea/<?= $row['id'] ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Area Name" name="area" value="<?= $row['area'] ?>">
                            </div>
                            <input type="hidden" name="old_area" value="<?= $row['area'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <script>
            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this area!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/mguideline/delarea') ?>/${id}`)
                        } else {
                            swal("This area is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>