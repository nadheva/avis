<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/mguideline">Area</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $areaRow->area ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/mguideline" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">Process List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->department_id == "1") :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newProcess"
                                        class="btn btn-primary">Add Process</button>
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
                                    <th scope="col" style="width: 20%">Process</th>
                                    <th scope="col" style="width: 17%">Best Practice</th>
                                    <th scope="col" style="width: 20%">Equip Spec</th>
                                    <th scope="col" style="width: 16%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($process as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->process_name ?> <br>
                                    <img src="<?= base_url('') ?>/public/theme/assets/manufacturing_guidline/<?= $areaRow->area ?>/<?= $row->process_name ?>/<?= $row->photo ?>" width="100" alt=""></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="Download" type="button" href="<?= base_url('') ?>/mguideline/download/<?= $areaRow->area ?>/<?= $row->process_name ?>/<?= $row->mfg_spec ?>"><span class="bcstm bcstm-secondary"><span class="material-icons">download</span> Guidelines</span></a>
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="Download" type="button" href="<?= base_url('') ?>/mguideline/download/<?= $areaRow->area ?>/<?= $row->process_name ?>/<?= $row->equip_spec ?>"><span class="bcstm bcstm-secondary"><span class="material-icons">download</span> Equipment AVL</span></a></td>
                                    <td>
                                        <?php if(user()->department_id == "1") { ?>
                                        <span data-toggle="modal" data-target="#editMachine<?= $row->id ?>">
                                            <a data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="badge badge-primary"><span class="material-icons" style="color: white;">edit</span></a>
                                        </span>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="badge badge-danger" onclick="del(<?= $row->id; ?>, <?= $areaRow->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
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
        <div class="row" style="display: none;">
            <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-primary alert-dismissible fade show">
                <?= session('pesan') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif ?>
            <div class="col-12">
                <div class="card card-transparent file-list">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Directory</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->level_id == '3') :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newProcess"
                                        class="btn btn-primary">Add Machine</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <?php foreach ($process as $row) : ?>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= base_url('') ?>/mguideline/machine/<?= $areaRow->id ?>/<?= $row->id ?>">View Details</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="folder-icon">
                                            <i class="material-icons">folder_open</i>
                                        </div>
                                        <div class="folder-info">
                                            <a href="<?= base_url('') ?>/mguideline/machine/<?= $areaRow->id ?>/<?= $row->id ?>"><?= $row->process_name ?></a>
                                            <span>87 files, 417mb</span>
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
        <div class="modal fade" id="newProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Process</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/mguideline/addprocess" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <input type="hidden" name="area_id" value="<?= $areaRow->id ?>">
                            <input type="hidden" name="area" value="<?= $areaRow->area ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Process</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Process Name" name="machine">
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
                                    <input type="file" name="mfgspec" class="filestyle">
                                    <small class="form-text text-muted">*max size 10Mb</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Equip Spec</label>
                                <div class="col-sm-9">
                                    <input type="file" name="equipspec" class="filestyle">
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
        <?php foreach($process as $row) : ?>
        <div class="modal fade" id="editMachine<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Process</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/mguideline/updateprocess/<?= $row->id ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Process</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $row->process_name ?>" name="newmachine">
                                    <input type="hidden" value="<?= $row->process_name ?>"  name="oldmachine">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="newphoto" class="filestyle">
                                    <small class="form-text text-muted t">*max size 5Mb</small>
                                    <input type="hidden" value="<?= $row->photo ?>" name="oldphoto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Best Practice</label>
                                <div class="col-sm-9">
                                    <input type="file" name="newmfgspec" class="filestyle">
                                    <small class="form-text text-muted">*max size 10Mb</small>
                                    <input type="hidden" value="<?= $row->mfg_spec ?>" name="oldmfgspec">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Equip Spec</label>
                                <div class="col-sm-9">
                                    <input type="file" name="newequipspec" class="filestyle">
                                    <small class="form-text text-muted">*max size 10Mb</small>
                                    <input type="hidden" value="<?= $row->equip_spec ?>" name="oldequipspec">
                                </div>
                            </div>
                            <input type="hidden" name="area_id" value="<?= $areaRow->id ?>">
                            <input type="hidden" name="area" value="<?= $areaRow->area ?>">
                            <input type="hidden" name="process" value="<?= $row->process_name ?>">
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
                        text: "Once deleted, you will not be able to recover this process!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/mguideline/delmachine') ?>/${id}/${a_id}`)
                        } else {
                            swal("This process is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>