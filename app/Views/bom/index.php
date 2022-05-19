<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
// dd($myapprove);
foreach($myapprove as $val){
    $uap[] = $val->user_approval;
    $uap_approve[] = $val->approve;
    $bom_app = $val->bom_app;
    $ap = $val->ap;
}
foreach($myapprovebaan as $val){
    $uapbaan[] = $val->user_approval;
}
foreach($changestatus as $val){
    $uap_cs[] = $val->user_approval;
    $uap_cs_approve[] = $val->approve;
}
if(!isset($uap)){
    $uap[] = $myapprove;
    $uap_approve[] = $myapprove;
}
if(!isset($uapbaan)){
    $uapbaan[] = $myapprovebaan;
}
if(!isset($uap_cs)){
    $uap_cs[] = $changestatus;
    $uap_cs_approve[] = $changestatus;
}
// dd($uap_cs);
?>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const show = urlParams.get('show')
    // console.log(show);
    if (show === 'baan') {
        jQuery(function(){
        jQuery('#baan-tab').click();
        });
    }
</script>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">BOM</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <?= view('Myth\Auth\Views\_message_block') ?>
        <?php if (session()->has('pesanapprove')) : ?>
        <div class="alert alert-primary alert-dismissible fade show">
            <?= session('pesanapprove') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        <?php if(in_array(user()->id,$uap) || in_array(user()->id,$uap_cs) || in_array(user()->id,$uapbaan)) : ?>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="bom-tab" data-toggle="tab" href="#bom" role="tab" aria-controls="bom" aria-selected="true">BOM - Request Approve</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="baan-tab" data-toggle="tab" href="#baan" role="tab" aria-controls="baan" aria-selected="false">BAAN - Request Approve</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="bom" role="tabpanel" aria-labelledby="bom-tab">
                            <br>
                            <br>
                                <table class="table table-responsive" id="zero-conf3">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 5%">#</th>
                                            <th scope="col">Model</th>
                                            <th scope="col" style="width: 37%">File</th>
                                            <th scope="col">Info</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($myapprove as $row) : ?>
                                        <?php if($row->status != 'inactive' && $row->status != 'active' && $row->status != 'Rejected') : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $row->model ?></td>
                                            <td><?= $row->nama_file ?></td>
                                            <td>
                                                <span class="badge badge-success"> New File
                                            </td>
                                            <td>
                                                <span
                                                    class="bcstm bcstm-<?= ($row->status == 'inactive') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                    <?= $row->status ?>
                                            </td>
                                            <td>
                                                <?php if($row->bom_app == $row->ap) { ?>
                                                    <?php if ($row->status != 'Rejected') : ?>
                                                    <span data-toggle="modal" data-target="#accBom<?= $row->id ?>">
                                                        <a data-toggle="tooltip" data-placement="top" title="View" type="button" class="badge badge-primary"><span class="material-icons"style="color: white;">check</span></a>
                                                    </span>
                                                    <?php endif ?>
                                                <?php } else { ?>
                                                    <span data-toggle="modal" data-target="#viewBom<?= $row->id ?>">
                                                        <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                        <?php foreach ($changestatus as $row) : ?>
                                        <?php if($row->bom_app == $row->ap) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $row->model ?></td>
                                            <td><?= $row->nama_file ?></td>
                                            <td>
                                                <span class="badge badge-info">Change Status
                                            </td>
                                            <td>
                                                <span class="bcstm bcstm-<?= ($row->status == 'inactive') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                    <?= $row->status ?>
                                            </td>
                                            <td>
                                                <?php if ($row->status != 'Rejected') : ?>
                                                <span data-toggle="modal" data-target="#accReqStat<?= $row->id ?>">
                                                    <a type="button" class="badge badge-primary"  data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">check</span></a>
                                                </span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="baan" role="tabpanel" aria-labelledby="baan-tab">
                            <br>
                            <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf4">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%">#</th>
                                                <th scope="col">Model</th>
                                                <th scope="col" style="width: 37%">File</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($myapprovebaan as $row) : ?>
                                            <?php if($row->status != 'active') : ?>
                                            <tr>
                                                <th scope="row"><?= $i++ ?></th>
                                                <td><?= $row->model ?></td>
                                                <td><?= $row->filename ?></td>
                                                <td><?= $row->type ?></td>
                                                <td>
                                                    <span class="bcstm bcstm-<?= ($row->status == 'Revise') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>"><?= $row->status ?>
                                                </td>
                                                <td>
                                                    <?php if($row->bom_app == $row->ap) { ?>
                                                        <span data-toggle="modal" data-target="#accBaan<?= $row->id ?>">
                                                            <a data-toggle="tooltip" data-placement="top" title="View" type="button" class="badge badge-primary"><span class="material-icons"style="color: white;">check</span></a>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span data-toggle="modal" data-target="#viewBaan<?= $row->id ?>">
                                                            <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                                        </span>
                                                    <?php } ?>
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
                </div>
            </div>
        </div>
        <?php endif ?>
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
                                    <?php if(user()->department_id == 2) :  ?>
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
                                    <th scope="col" style="width: 66.66%">Model</th>
                                    <th scope="col" style="width: 36.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($model as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $m->model ?></td>
                                    <td>
                                        <a type="button" style="color: white;"
                                            href="<?= base_url('') ?>/bom/model/<?= $m->id ?>"
                                            class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        <?php if(user()->section == "RnD") : ?>
                                        <a href="<?= base_url('') ?>/bom/editmodel/<?= $m->id; ?>"
                                            class="badge badge-primary"  data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                        <a type="button" class="badge badge-danger" onclick="del(<?= $m->id; ?>)"  data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
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
        <?php if(user()->department_id == 2) :  ?>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">BOM Download Report</h5>
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
                                    <td><?= $row->model ?></td>
                                    <td><?= $row->file ?></td>
                                    <td>
                                        <?php if(user()->role == "pm" || user()->role == "admin" || user()->role == "ame"|| user()->section == "RnD") : ?>
                                        <a type="button" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Delete"
                                            onclick="delog(<?= $row->id; ?>)"  data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons"
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
                        <form action="<?= base_url('') ?>/bom/addmodel" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
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
        <!-- Modal view approve -->
        <?php foreach ($myapprove as $row) : ?>
        <div class="modal fade" id="accBom<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Approve New BOM</h5>
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
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approve as $prove) : ?>
                                        <?php if($prove->id_bom == $row->id_bom) : ?>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if (isset($row->nama_file)) : ?>
                                        <div class="card card-transparent file-list recent-files">
                                            <div class="card-body">
                                                <label for="">File</label>
                                                <div class="card file">
                                                    <div class="file-options dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="<?= base_url('public') ?>/theme/assets/bom/<?= $row->model ?>/<?= $row->nama_file ?>">View</a>
                                                            <a class="dropdown-item" href="<?= base_url('') ?>/bom/download/<?= $row->id; ?>/<?= $row->id_model; ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-header file-icon">
                                                        <i class="material-icons">description</i>
                                                    </div>
                                                    <div class="card-body file-info">
                                                        <p><?= $row->nama_file ?></p>
                                                        <span class="file-size">
                                                            <?php
                                                                            $filesize = filesize('public/theme/assets/bom/' . $row->model . '/' . $row->nama_file);
                                                                            if ($filesize >= 1048576) {
                                                                                echo number_format($filesize / 1048576, 2) . ' MB';
                                                                            } elseif ($filesize >= 1024) {
                                                                                echo number_format($filesize / 1024, 2) . ' KB';
                                                                            } elseif ($filesize > 1) {
                                                                                echo ' Bytes';
                                                                            }
                                                                            ?>
                                                        </span><br>
                                                        <span class="file-date">Upload at:
                                                            <?= date('d M Y', strtotime($row->upload_date)) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="desc" id="" class="form-control" cols="30" rows="3" readonly><?= $row->banotes ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="">Upload File Approve</label>
                                    <input type="file" class="filestyle" name="new_file">
                                    <div class="text-right mr-4"><small>*Required</small></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Notes</label>
                                        <textarea name="notes" id="" required cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="old_file" value="<?= $row->nama_file ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id_bom ?>">
                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="submit" name="reject" value="1"
                                            class="btn btn-danger">Reject</button>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary mr-2"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="approve" value="1"
                                        class="btn btn-primary">Approve</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view bom -->
        <?php foreach ($myapprove as $row) : ?>
        <div class="modal fade" id="viewBom<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Approve BOM</h5>
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
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approve as $prove) : ?>
                                        <?php if($prove->id_bom == $row->id_bom) : ?>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if (isset($row->nama_file)) : ?>
                                        <div class="card card-transparent file-list recent-files">
                                            <div class="card-body">
                                                <label for="">File</label>
                                                <div class="card file">
                                                    <div class="file-options dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="<?= base_url('public') ?>/theme/assets/bom/<?= $row->model ?>/<?= $row->nama_file ?>">View</a>
                                                            <a class="dropdown-item" href="<?= base_url('') ?>/bom/download/<?= $row->id; ?>/<?= $row->id_model; ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-header file-icon">
                                                        <i class="material-icons">description</i>
                                                    </div>
                                                    <div class="card-body file-info">
                                                        <p><?= $row->nama_file ?></p>
                                                        <span class="file-size">
                                                            <?php
                                                                            $filesize = filesize('public/theme/assets/bom/' . $row->model . '/' . $row->nama_file);
                                                                            if ($filesize >= 1048576) {
                                                                                echo number_format($filesize / 1048576, 2) . ' MB';
                                                                            } elseif ($filesize >= 1024) {
                                                                                echo number_format($filesize / 1024, 2) . ' KB';
                                                                            } elseif ($filesize > 1) {
                                                                                echo ' Bytes';
                                                                            }
                                                                            ?>
                                                        </span><br>
                                                        <span class="file-date">Upload at:
                                                            <?= date('d M Y', strtotime($row->upload_date)) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="desc" id="" class="form-control" cols="30" rows="3" readonly><?= $row->banotes ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id_bom ?>">
                            <div class="modal-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view approve baan -->
        <?php foreach ($myapprovebaan as $row) : ?>
        <div class="modal fade" id="accBaan<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Approve New BAAN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/bom/accbaan/<?= $row->id ?>" method="POST"
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
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approvebaan as $prove) : ?>
                                        <?php if($prove->id_baan == $row->id_baan) : ?>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if (isset($row->filename)) : ?>
                                        <div class="card card-transparent file-list recent-files">
                                            <div class="card-body">
                                                <label for="">File</label>
                                                <div class="card file">
                                                    <div class="file-options dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="<?= base_url('public') ?>/theme/assets/baan/<?= $row->model ?>/<?= $row->filename ?>">View</a>
                                                            <a class="dropdown-item" href="<?= base_url('') ?>/bom/baandownload/<?= $row->model; ?>/<?= $row->filename; ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-header file-icon">
                                                        <i class="material-icons">description</i>
                                                    </div>
                                                    <div class="card-body file-info">
                                                        <p><?= $row->filename ?></p>
                                                        <span class="file-size">
                                                            <?php
                                                                            $filesize = filesize('public/theme/assets/baan/' . $row->model . '/' . $row->filename);
                                                                            if ($filesize >= 1048576) {
                                                                                echo number_format($filesize / 1048576, 2) . ' MB';
                                                                            } elseif ($filesize >= 1024) {
                                                                                echo number_format($filesize / 1024, 2) . ' KB';
                                                                            } elseif ($filesize > 1) {
                                                                                echo ' Bytes';
                                                                            }
                                                                            ?>
                                                        </span><br>
                                                        <span class="file-date">Upload at:
                                                            <?= date('d M Y', strtotime($row->upload_date)) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="desc" id="" class="form-control" cols="30" rows="3" readonly><?= $row->banotes ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="">Upload File Approve</label>
                                    <input type="file" class="filestyle" name="new_file">
                                    <div class="text-right mr-4"><small>*Required</small></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Notes</label>
                                        <textarea name="notes" id="" required cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="old_file" value="<?= $row->filename ?>">
                            <input type="hidden" name="idbaan" value="<?= $row->id_baan ?>">
                            <input type="hidden" name="approve_number" value="<?= $row->approve ?>">
                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="submit" name="reject" value="1"
                                            class="btn btn-danger">Revise</button>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary mr-2"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="approve" value="1"
                                        class="btn btn-primary">Approve</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view baan -->
        <?php foreach ($myapprovebaan as $row) : ?>
        <div class="modal fade" id="viewBaan<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Approve BAAN</h5>
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
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1">User Approval Request</label>
                                    <ul class="list-group">
                                        <?php foreach($approvebaan as $prove) : ?>
                                        <?php if($prove->id_baan == $row->id_baan) : ?>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if (isset($row->filename)) : ?>
                                        <div class="card card-transparent file-list recent-files">
                                            <div class="card-body">
                                                <label for="">File</label>
                                                <div class="card file">
                                                    <div class="file-options dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="<?= base_url('public') ?>/theme/assets/baan/<?= $row->model ?>/<?= $row->filename ?>">View</a>
                                                            <a class="dropdown-item" href="<?= base_url('') ?>/bom/baandownload/<?= $row->model; ?>/<?= $row->filename; ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-header file-icon">
                                                        <i class="material-icons">description</i>
                                                    </div>
                                                    <div class="card-body file-info">
                                                        <p><?= $row->filename ?></p>
                                                        <span class="file-size">
                                                            <?php
                                                                            $filesize = filesize('public/theme/assets/baan/' . $row->model . '/' . $row->filename);
                                                                            if ($filesize >= 1048576) {
                                                                                echo number_format($filesize / 1048576, 2) . ' MB';
                                                                            } elseif ($filesize >= 1024) {
                                                                                echo number_format($filesize / 1024, 2) . ' KB';
                                                                            } elseif ($filesize > 1) {
                                                                                echo ' Bytes';
                                                                            }
                                                                            ?>
                                                        </span><br>
                                                        <span class="file-date">Upload at:
                                                            <?= date('d M Y', strtotime($row->upload_date)) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php if($row->fullname != NULL) : ?>
                                    <div class="form-group">
                                        <label for="">Uploader</label>
                                        <input name="fullname" type="text" value="<?= $row->fullname ?>" readonly class="form-control"></input>
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="desc" id="" class="form-control" cols="30" rows="3" readonly><?= $row->banotes ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id_baan ?>">
                            <div class="modal-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <!-- Modal view approve change status -->
        <?php foreach ($myapprovestat as $row) : ?>
        <div class="modal fade" id="accReqStat<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Approve Change Status BOM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/bom/accreqstatus/<?= $row->id ?>" method="POST"
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
                                    <label>File Name</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control"
                                        value="<?= $row->nama_file ?>" name="nama_file" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Last Status</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control"
                                            value="<?= $row->request_status == 'inactive' ? 'active' : 'inactive' ?>" name="last_status" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Request Status</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control"
                                            value="<?= $row->request_status ?>" name="req_status" readonly>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Reason</label>
                                <textarea name="" rows="2" class="form-control" readonly><?= $row->reason ?></textarea>
                            </div>
                            <input type="hidden" name="status" value="<?= $row->status ?>">
                            <input type="hidden" name="idbom" value="<?= $row->id_bom ?>">
                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="submit" name="reject" value="1"
                                            class="btn btn-danger">Reject</button>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary mr-2"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="approve" value="1"
                                        class="btn btn-primary">Approve</button>
                                </div>
                            </div>
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
                        text: "Once deleted, you will not be able to recover this model!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/bom/delmodel') ?>/${id}`)
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
                            location.replace(`<?= base_url('/bom/delbomlog') ?>/${id}`)
                        } else {
                            swal("This log is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>