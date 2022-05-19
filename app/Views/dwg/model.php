<?php
// dd($bom);
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/drawing">Model</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $model->model ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/drawing" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <?= view('Myth\Auth\Views\_message_block') ?>
        <?php if (session()->has('pesan')) : ?>
        <div class="alert alert-primary alert-dismissible fade show">
            <?= session('pesan') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true">Customer Drawing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="internal-tab" data-toggle="tab" href="#internal" role="tab" aria-controls="internal" aria-selected="false">Internal Drawing</a>
                            </li>
                        </ul>
                            <?php if(user()->department_id == 2) { ?>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#newFile"
                                            class="btn btn-primary">Add File</button>
                                    </div>
                                </div>
                            </div>  
                                <br>
                            <?php } else { ?>
                                <br>
                                <br>
                            <?php } ?>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                            <div class="table-responsive">
                            <table class="table table-responsive" id="zero-conf3">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%;">#</th>
                                        <th scope="col" style="width: 15%;">File</th>
                                        <th scope="col" style="width: 9%;">Upload For</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php if(isset($dwg)) : ?>
                                    <?php foreach ($dwg as $row) : ?>
                                    <?php if($row->status == 'active' && user()->department_id != 2 && $row->upload_for_dept == user()->department_id && $row->type == 'customer') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php if(user()->department_id == 2 && $row->type == 'customer') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span
                                                    class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php if(user()->department_id == 0 && $row->type == 'customer' && $row->status == 'active') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span
                                                    class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="internal" role="tabpanel" aria-labelledby="internal-tab">
                            <table class="table" id="zero-conf4">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%;">#</th>
                                        <th scope="col" style="width: 15%;">File</th>
                                        <th scope="col" style="width: 5%;">Upload For</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php if(isset($dwg)) : ?>
                                    <?php foreach ($dwg as $row) : ?>
                                    <?php if($row->status == 'active' && user()->department_id != 2 && $row->upload_for_dept == user()->department_id && $row->type == 'internal') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php if(user()->department_id == 2 && $row->type == 'internal') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span
                                                    class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php if(user()->department_id == 0 && $row->type == 'internal' && $row->status == 'active') : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama_file ?></td>
                                        <td><?= $row->depart_name ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($row->status == 'active') ? 'primary' : 'danger' ?>">
                                            <?= $row->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('') ?>/drawing/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span
                                                    class="material-icons">file_download</span></a>
                                            <?php if(user()->section == "RnD") : ?>
                                            <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/drawing/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            <a type="button" class="badge badge-danger"
                                                onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span
                                                    class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
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
                        <form action="<?= base_url('') ?>/drawing/addfile" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <!-- <div class="wrapper"> -->
                            <div class="">
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" class="form-control" placeholder="Model Name" name="model" value="<?= $model->model ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="js-states form-control" name="type" tabindex="-1" style="display: none; width: 100%">
                                        <option value="customer">Customer</option>
                                        <option value="internal">Internal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload For</label>
                                    <select class="js-states form-control" name="upload_for[]" tabindex="-1" style="display: none; width: 100%" multiple="multiple">
                                        <?php foreach ($getDepart as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->depart_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="file" name="fileapp" class="filestyle">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_model" value="<?= $model->id ?>" id="">
                            <div class="row my-4">
                                <div class="col-6">
                                    <!-- <button type="button" class="add_fields_more btn btn-primary">More</button> -->
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary ml-2">Add</button>
                                </div>
                            </div>
                    </div>
                    <!-- <div class="modal-footer">
                    </div> -->
                    </form>
                </div>
            </div>
        </div>
        <script>
            function del(id, idm) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/drawing/delfile') ?>/${id}/${idm}`)
                        } else {
                            swal("This file is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>