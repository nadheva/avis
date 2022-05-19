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
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/bom">Model</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $model->model ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/bom" class="badge badge-secondary">⬅ Back</a>
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
                                <a class="nav-link active" id="bom-tab" data-toggle="tab" href="#bom" role="tab" aria-controls="bom" aria-selected="true">BOM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="baan-tab" data-toggle="tab" href="#baan" role="tab" aria-controls="baan" aria-selected="false">BAAN</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="bom" role="tabpanel" aria-labelledby="bom-tab">
                        <br><br>
                        <div class="row">
                            <?php if(user()->department_id == 2) : ?>
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#newFile"
                                        class="btn btn-primary">Add File</button>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <br>
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 3%;">#</th>
                                    <th scope="col" style="width: 15%;">File</th>
                                    <th scope="col" style="width: 10%;">Status</th>
                                    <th scope="col" style="width: 5%;">Download</th>
                                    <th scope="col" style="width: 7%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if(isset($bom)) : ?>
                                <?php foreach ($bom as $row) : ?>
                                <?php if($row->status == 'active' && user()->department_id != 2) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->nama_file ?></td>
                                    <td>
                                        <span class="bcstm bcstm-<?= ($row->status == 'inactive' || $row->status == 'Rejected') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                        <?= $row->status ?>
                                    </td>
                                    <td>
                                    <a href="<?= base_url('') ?>/bom/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                    </td>
                                    <td>-</td>
                                </tr>
                                <?php endif; ?>
                                <?php if(user()->department_id == 2) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->nama_file ?></td>
                                    <td>
                                        <span class="bcstm bcstm-<?= ($row->status == 'inactive' || $row->status == 'Rejected') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                        <?= $row->status ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('') ?>/bom/download/<?= $row->id; ?>/<?= $model->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span class="material-icons">file_download</span></a>
                                    </td>
                                    <td>
                                        <span data-toggle="modal" data-target="#viewFile<?= $row->id ?>">
                                            <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        </span>
                                        <?php if($row->status == 'inactive' || $row->status == 'active' ) : ?>
                                        <a type="button" class="badge badge-primary" href="<?= base_url('') ?>/bom/editfile/<?= $row->id ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                        <?php endif; ?>
                                        <a type="button" class="badge badge-danger" onclick="del(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="tab-pane fade" id="baan" role="tabpanel" aria-labelledby="baan-tab">
                        <br><br>
                        <div class="row">
                            <?php if(user()->department_id == 2) : ?>
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#newFileBaan"
                                        class="btn btn-primary">Add File</button>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                        <table class="table" id="zero-conf3">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 3%;">#</th>
                                    <th scope="col" style="width: 20%;">Type</th>
                                    <th scope="col" style="width: 15%;">File</th>
                                    <th scope="col" style="width: 10%;">Status</th>
                                    <th scope="col" style="width: 5%;">Download</th>
                                    <th scope="col" style="width: 7%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if(isset($baan)) : ?>
                                <?php foreach ($baan as $row) : ?>
                                <?php if($row->status == 'active' && user()->department_id != 2) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->type ?></td>
                                    <td><?= $row->filename ?></td>
                                    <td>
                                        <span class="bcstm bcstm-<?= ($row->status == 'inactive' || $row->status == 'Revise') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                        <?= $row->status ?>
                                    </td>
                                    <td>
                                    <a href="<?= base_url('') ?>/bom/baandownload/<?= $model->model; ?>/<?= $row->filename; ?>" class="badge badge-info"><span class="material-icons">file_download</span></a>
                                    </td>
                                    <td>-</td>
                                </tr>
                                <?php endif; ?>
                                <?php if(user()->department_id == 2) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row->type ?></td>
                                    <td><?= $row->filename ?></td>
                                    <td>
                                        <span class="bcstm bcstm-<?= ($row->status == 'inactive' || $row->status == 'Revise') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                        <?= $row->status ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('') ?>/bom/baandownload/<?= $model->model; ?>/<?= $row->filename; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Download"><span class="material-icons">file_download</span></a>
                                    </td>
                                    <td>
                                        <span data-toggle="modal" data-target="#viewFileBaan<?= $row->id ?>">
                                            <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        </span>
                                        <?php if($row->status == 'Revise' && $row->approve == 1 && $row->uploader == user()->id) : ?>
                                        <span data-toggle="modal" data-target="#EditFileBaan<?= $row->id ?>">
                                            <a type="button" style="color: white;" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                        </span>
                                        <?php endif; ?>
                                        <a type="button" class="badge badge-danger" onclick="delbaan(<?= $row->id ?>, <?= $model->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                    </td>
                                </tr>
                                <?php endif; ?>
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
                        <form action="<?= base_url('') ?>/bom/addbomfile" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" placeholder="Model Name" name="model" value="<?= $model->model ?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Route</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Model Name" name="route[]" value="1" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Model Name" name="route[]" value="2" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <label>Approval</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Model Name" name="app[]" value="1. M. Sallim Syahied Fauzy" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Model Name" name="app[]" value="2. Ian Aliansyah" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="uap[]" value="38">
                            <input type="hidden" name="uap[]" value="36">
                            <div class="form-group">
                                <label>File</label>
                                <div>
                                    <div class="input-group">
                                        <input type="file" name="fileapp" class="filestyle">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea required name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="id_model" value="<?= $model->id ?>" id="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newFileBaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form action="<?= base_url('') ?>/bom/addbaanfile" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" placeholder="Model Name" name="model" value="<?= $model->model ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="js-states form-control typebaan" name="type" tabindex="-1" style="display: none; width: 100%">
                                    <option disabled selected>--Choose--</option>
                                    <?php foreach($type as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->type ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group routesbaan">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group approvalbaan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <div>
                                    <div class="input-group">
                                        <input type="file" name="fileapp" class="filestyle">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea required name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="id_model" value="<?= $model->id ?>" id="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal view bom -->
        <?php foreach ($bom as $row) : ?>
        <div class="modal fade" id="viewFile<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail BOM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/bom/accbom/<?= $row->id ?>" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Model</label>
                                        <input type="text" class="form-control" readonly value="<?= $row->model ?>"
                                            name="model">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Request Date</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control"
                                            placeholder="dd/mm/yyyy" name="due_date"
                                            value="<?= date('Y-m-d', strtotime($row->upload_date)) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <?php if($row->notes != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="notes" readonly id="" cols="30" rows="2" class="form-control"><?= $row->notes ?></textarea>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-6">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approve as $prove) : ?>
                                        <?php if($prove->id_bom == $row->id) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $prove->routes ?> . <?= $prove->fullname ?> : <?= $prove->notes ?>
                                            <?php if ($prove->ap == 202) : ?>
                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                            <?php endif ?>
                                        </li>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id ?>">
                            <div class="modal-footer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view baan file -->
        <?php foreach ($baan as $row) : ?>
        <div class="modal fade" id="viewFileBaan<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Baan File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/bom/accbom/<?= $row->id ?>" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Model</label>
                                        <input type="text" class="form-control" readonly value="<?= $row->model ?>"
                                            name="model">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Request Date</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control"
                                            placeholder="dd/mm/yyyy" name="due_date"
                                            value="<?= date('Y-m-d', strtotime($row->upload_date)) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <?php if($row->description != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" readonly id="" cols="30" rows="2" class="form-control"><?= $row->description ?></textarea>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-6">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approvebaan as $prove) : ?>
                                        <?php if($prove->id_baan == $row->id) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $prove->routes ?> . <?= $prove->fullname ?> : <?= $prove->notes ?>
                                            <?php if ($prove->appstat == 202) : ?>
                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                            <?php endif ?>
                                            <?php if ($prove->appstat == 404) : ?>
                                            <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                            <?php endif ?>
                                        </li>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id ?>">
                            <div class="modal-footer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view baan file -->
        <?php foreach ($baan as $row) : ?>
            <?php if($row->status == 'Revise' && $row->approve == 1 && $row->uploader == user()->id) : ?>
            <div class="modal fade" id="EditFileBaan<?= $row->id ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Revise Baan File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('') ?>/bom/revisebaan/<?= $row->id ?>" method="POST"
                                enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Model</label>
                                            <input type="text" class="form-control" readonly value="<?= $row->model ?>" name="model">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Request Date</label>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($row->upload_date)) ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <?php if($row->fullname != NULL) : ?>
                                        <div class="form-group">
                                            <label for="">Uploader</label>
                                            <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if($row->description != NULL) : ?>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea name="description" id="" cols="30" rows="2" class="form-control"><?= $row->description ?></textarea>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1">User Approval Request</label>
                                        <ul class="list-group">
                                            <?php foreach($approvebaan as $prove) : ?>
                                            <?php if($prove->id_baan == $row->id) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $prove->routes ?> . <?= $prove->fullname ?> : <?= $prove->notes ?>
                                                <?php if ($prove->appstat == 202) : ?>
                                                <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                <?php endif ?>
                                                <?php if ($prove->appstat == 404) : ?>
                                                <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                <?php endif ?>
                                            </li>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Upload File</label>
                                            <input type="file" class="filestyle" name="new_file" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                                <input type="hidden" name="old_file" value="<?= $row->filename ?>">
                                <input type="hidden" name="id_model" value="<?= $row->id_model ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif ?>
        <?php endforeach ?>
        <script>
            var nameAfin = '<?= $finance->fullname ?>';
            var idAfin = '<?= $finance->id ?>';
            var nameAppic = '<?= $ppic->fullname ?>';
            var idAppic = '<?= $ppic->id ?>';
            var nameArnd = '<?= $rnd->fullname ?>';
            var idArnd = '<?= $rnd->id ?>';
            var nameAeng = '<?= $eng->fullname ?>';
            var idAeng = '<?= $eng->id ?>';
            var nameApurchasing = '<?= $purchasing->fullname ?>';
            var idApurchasing = '<?= $purchasing->id ?>';
            var nameAmarketing = '<?= $marketing->fullname ?>';
            var idAmarketing = '<?= $marketing->id ?>';
            var nameAreq = '<?= $req->fullname ?>';
            var idAreq = '<?= $req->id ?>';
            var nameAsmt = '<?= $sectHeadEngSmt->fullname ?>';
            var idAsmt= '<?= $sectHeadEngSmt->id ?>';
            var nameAat = '<?= $sectHeadEngAt->fullname ?>';
            var idAat= '<?= $sectHeadEngAt->id ?>';
            var nameAfa = '<?= $sectHeadEngFa->fullname ?>';
            var idAfa= '<?= $sectHeadEngFa->id ?>';
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
                            location.replace(`<?= base_url('/bom/delbomfile') ?>/${id}/${idm}`)
                        } else {
                            swal("This file is safe!");
                        }
                    });
            }
            function delbaan(id, idm) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/bom/delbaanfile') ?>/${id}/${idm}`)
                        } else {
                            swal("This file is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>