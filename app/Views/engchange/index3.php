<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
if($atasan == NULL) {
    $newatasan = [
        'id' => 0,
        'fullname' => 'Not Found'
    ];
    $atasan = (object) $newatasan;
    // dd($atasan);
}
?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item" aria-current="page">Engineering Change</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
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
                                <h5 class="card-title">4M Change Request List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#newRequest" class="btn btn-primary">Add Request</button>
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
                                    <th scope="col" style="width: 10%">Project</th>
                                    <th scope="col" style="width: 10%">Change</th>
                                    <th scope="col" style="width: 10%">Line</th>
                                    <th scope="col" style="width: 10%">Description</th>
                                    <th scope="col" style="width: 15%">Issuer</th>
                                    <th scope="col" style="width: 15%">Status</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($request as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->project_name ?></td>
                                        <td><?= $r->fourm ?></td>
                                        <td><?= $r->line ?></td>
                                        <td><?= $r->description ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= ($r->status == 'Waiting Approve') ? 'warning' : (($r->status == 'Revise') ? 'danger' : 'primary') ?>">
                                            <?= $r->status ?></span>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#viewLesson<?= $r->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Add Request 4M -->
        <div class="modal fade" id="newRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add 4M Change Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/engchange/addrequest" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <select class="js-states form-control" name="project_id" tabindex="-1" style="display: none; width: 100%">
                                            <?php foreach($project as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->project_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">4M</label>
                                        <select class="js-states form-control" name="fourm_id" tabindex="-1" style="display: none; width: 100%">
                                            <option value="1">Man</option>
                                            <option value="2">Method</option>
                                            <option value="3">Material</option>
                                            <option value="4">Machine</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Line</label>
                                <select class="js-states form-control" name="line" tabindex="-1" style="display: none; width: 100%">
                                    <option value="SMT-1">SMT-1</option>
                                    <option value="SMT-2">SMT-2</option>
                                    <option value="FA-1">FA-1</option>
                                    <option value="FA-2">FA-2</option>
                                    <option value="FA-3">FA-3</option>
                                    <option value="FA-4">FA-4</option>
                                    <option value="FA-5">FA-5</option>
                                    <option value="FA-6">FA-6</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" required name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <textarea class="form-control" required name="reason" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">File</label>
                                <input type="file" class="filestyle" name="file">
                                <div class="text-right">
                                    <small>*Optional</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Route</label>
                                        <?php for ($x = 1; $x < 6; $x++) : ?>
                                            <div class="form-group">
                                                <select disabled class="js-states form-control" tabindex="-1" style="display: none; width: 100%">
                                                    <option readonly value="<?= $x ?>"><?= $x ?></option>
                                                </select>
                                            </div><br>
                                            <input type="hidden" name="route_num[]" value="<?= $x ?>">
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>User Approval</label>
                                        <div class="form-group">
                                            <select disabled class="js-states form-control"" tabindex="-1" style="display: none; width: 100%">
                                                <option readonly value="<?= $atasan->id ?>"><?= $atasan->fullname ?></option>
                                            </select>
                                            <input type="hidden" name="lau[]" value="<?= $atasan->id ?>">
                                            <div class="text-right">
                                                <small>*Department head</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="js-states form-control" name="lau[]" tabindex="-1" style="display: none; width: 100%">
                                                <option value="--Choose--">--Choose--</option>
                                                <?php foreach ($usersectheadeng as $us) : ?>
                                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-right">
                                                <small>*Engineering section head</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select disabled class="js-states form-control" tabindex="-1" style="display: none; width: 100%">
                                                <option readonly value="67">Veronica Verawaty Manurung</option>
                                            </select>
                                            <input type="hidden" name="lau[]" value="67">
                                            <div class="text-right">
                                                <small>*EHS Section head</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="js-states form-control" name="lau[]" tabindex="-1" style="display: none; width: 100%">
                                                <option value="--Choose--">--Choose--</option>
                                                <?php foreach ($userdeptquality as $us) : ?>
                                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-right">
                                                <small>*Quality section head</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select disabled class="js-states form-control" tabindex="-1" style="display: none; width: 100%">
                                                <option readonly value="<?= $deptheadquality->id ?>"><?= $deptheadquality->fullname ?></option>
                                            </select>
                                            <input type="hidden" name="lau[]" value="<?= $deptheadquality->id ?>">
                                            <div class="text-right">
                                                <small>*Quality department head</small>
                                            </div>
                                        </div>
                                    </div>
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
        <!-- Modal Detail Request -->
        <?php $o = 1; ?>
        <?php foreach($request as $row) : ?>
        <div class="modal fade" id="viewLesson<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details 4M Request Change</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/request/" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <input type="text" name="project" readonly value="<?= $row->project_name ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">4M</label>
                                        <input type="text" value="<?= $row->fourm ?>" class="form-control" readonly>
                                    </div>
                                </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Issuer</label>
                                    <input type="text" value="<?= $row->fullname ?>" class="form-control" readonly>
                                </div>
                            </div>
                            </div>
                            <input type="hidden" name="project_id" value="<?= $row->project_id ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" readonly name="description" rows="3"><?= $row->description ?></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <textarea class="form-control" readonly required name="reason" rows="3"><?= $row->reason ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                    <label>User Approval 4M</label>
                                        <ul class="list-group">
                                                <?php foreach ($UserApprovalEngchange as $uae) : ?>
                                                    <?php if ($uae->req_id == $row->id) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?= $uae->routes ?>. <?= $uae->fullname ?>
                                                        <?php $userapprove[] = $uae->fullname  ?>
                                                        <?php if ($uae->approve == 202) : ?>
                                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                        <?php endif ?>
                                                        <?php if ($uae->approve == 0) : ?>
                                                            <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                        <?php endif ?>
                                                    </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php if (isset($row->file)) { ?>
                                <div class="col-lg-4">
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
                                                            href="<?= base_url('public') ?>/theme/assets/4m change request/<?= $row->project_name ?>/<?=  $row->fourm  ?>/<?= $row->file ?>">View</a>
                                                        <a class="dropdown-item" href="#">Download</a>
                                                    </div>
                                                </div>
                                                <div class="card-header file-icon">
                                                    <i class="material-icons">description</i>
                                                </div>
                                                <div class="card-body file-info">
                                                    <p><?= $row->file ?></p>
                                                    <span class="file-size">
                                                        <?php
                                                        $filesize = filesize('public/theme/assets/4m change request/' . $row->project_name . '/' . $row->fourm. '/'. $row->file);
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
                                                        <?= date('d M Y', strtotime($row->created_at)) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-lg-4">
                                    <label for="">File</label>
                                    <input type="text" class="form-control" readonly value="No Attachment File" name="" id="">
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if (isset($row->notesmgr)) { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notes Manager</label>
                                        <textarea class="form-control" readonly name="notesmgr"
                                            rows="3"><?= $row->notesmgr ?></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if (isset($row->testresult_eng)) { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tested Result by Engineering</label>
                                        <textarea class="form-control" readonly name="testresult_eng"
                                            rows="3"><?= $row->testresult_eng ?></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if (isset($row->acknowledge_ehs)) { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Acknowledge by EHS</label>
                                        <textarea class="form-control" readonly name="acknowledge_ehs"
                                            rows="3"><?= $row->acknowledge_ehs ?></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if (isset($row->confirm_quality)) { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Verification Result by Quality</label>
                                        <textarea class="form-control" readonly name="confirm_quality"
                                            rows="3"><?= $row->confirm_quality ?></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if ($row->to_customer == 'No' && $row->notes_dhqa != NULL) : ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Notes Dept Head Quality</label>
                                        <textarea class="form-control" readonly name="notes_dhqa"
                                            rows="3"><?= $row->notes_dhqa ?></textarea>
                                    </div>
                                </div>
                                <?php endif ?>
                                <?php if ($row->to_customer == 'Yes' && $row->notes_dhqa != NULL) : ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notes Dept Head Quality</label>
                                        <textarea class="form-control" readonly name="notes_dhqa"
                                            rows="3"><?= $row->notes_dhqa ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label >Apply to Customer</label>
                                        <input type="text" readonly value="Yes" class="form-control" name="" id="">
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                            <?php if (isset($row->notes_mkt)) { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Notes Marketing</label>
                                        <textarea class="form-control" readonly name="notes_mkt"
                                            rows="3"><?= $row->notes_mkt ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <?php if($row->issuer == user()->id) : ?>
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a type="submit" href="<?= base_url('') ?>/user/dashboard/#fourm" class="btn btn-danger">Delete Request</a> -->
                        <?php endif ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <?= $this->endSection(); ?>