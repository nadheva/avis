<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php $area_id == 1 ? $designname = 'Mechanical' : $designname = 'Electrical' ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/designstandard">Design</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $designname ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/designstandard" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">Design List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->department_id == "2") :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newDesign"
                                        class="btn btn-primary">Add Design</button>
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
                                    <th scope="col" style="width: 20%">Item</th>
                                    <th scope="col" style="width: 17%">Best Practice</th>
                                    <th scope="col" style="width: 16%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($design as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row['item'] ?> <br>
                                    <img src="<?= base_url('') ?>/public/theme/assets/design standard/<?= $designname ?>/<?= $row['item'] ?>/<?= $row['photo'] ?>" width="100" alt=""></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="Download" type="button" href="<?= base_url('') ?>/designstandard/download/<?= $designname ?>/<?= $row['best_practice'] ?>"><span class="bcstm bcstm-secondary"><span class="material-icons">download</span> Guidelines</span></a>
                                    </td>
                                    <td>
                                        <?php if(user()->department_id == "2") { ?>
                                        <span data-toggle="modal" data-target="#editDesign<?= $row['id'] ?>">
                                            <a data-toggle="tooltip" data-placement="top" title="Edit"  type="button" class="badge badge-primary"><span class="material-icons" style="color: white;">edit</span></a>
                                        </span>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="badge badge-danger" onclick="del(<?= $row['id']; ?>, <?= $area_id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newDesign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Design</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/designstandard/adddesign" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <input type="hidden" name="area_id" value="<?= $area_id ?>">
                            <input type="hidden" name="area" value="<?= $designname ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Item Name" name="item">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="photo" class="filestyle">
                                    <small class="form-text text-muted t">*max size 5Mb</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Best Practice</label>
                                <div class="col-sm-9">
                                    <input type="file" name="best_practice" class="filestyle">
                                    <small class="form-text text-muted">*max size 10Mb</small>
                                </div>
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
        <?php foreach($design as $row) : ?>
        <div class="modal fade" id="editDesign<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Design</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/designstandard/updatedesign/<?= $row['id'] ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $row['item']?>" name="item">
                                    <input type="hidden" value="<?= $row['item']?>" name="olditem">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="newphoto" class="filestyle">
                                    <small class="form-text text-muted t">*max size 5Mb</small>
                                    <input type="hidden" value="<?= $row['photo'] ?>" name="oldphoto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Best Practice</label>
                                <div class="col-sm-9">
                                    <input type="file" name="newbestpractice" class="filestyle">
                                    <small class="form-text text-muted">*max size 10Mb</small>
                                    <input type="hidden" value="<?= $row['best_practice'] ?>" name="oldbestpractice">
                                </div>
                            </div>
                            <input type="hidden" name="area_id" value="<?= $area_id ?>">
                            <input type="hidden" name="area" value="<?= $designname ?>">
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
            function del(id,a_id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this design!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/designstandard/deldesign') ?>/${id}/${a_id}`)
                        } else {
                            swal("This design is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>