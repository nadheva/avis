<?php
foreach ($project as $prj) {
    $pic = $prj->pic;
    $viewFields[] = $prj->task_id;
}
foreach ($approve as $appro) {
    $apro[] = $appro->approve_user;
    $updated[] = $appro->updated;
}
foreach ($child_task as $ct) {
    $ctaskid[] = $ct->ctask_id;
}
foreach ($approvect as $ct) {
    $act[] = $ct->approve_user;
    $updated[] = $ct->updated;
}
foreach ($task as $t) {
    $id[] = $t->t_id;
}
if(!isset($act)){
    $act[] = $approvect;
}
if(!isset($apro)){
    $apro[] = $approve;
}
if(!isset($ctaskid)){
    $ctaskid[] = $child_task;
}
foreach ($apu as $prove) {
    if ($prove->ap >= $prove->t_app) {
    }
    if ($prove->t_task_id == $prove->a_task_id) {
        // dd();
    }
}
$i = 1;
$z = 1;
$a = 1;
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item" aria-current="page">Task</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <?php if (isset($apro) || isset($act)) : ?>
            <?php if (in_array(user()->id, $apro) || in_array(user()->id, $act)) : ?>
                <!-- Approval Request -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">Task Approval Request </h5>
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
                                            <th scope="col">#</th>
                                            <th scope="col">Project</th>
                                            <th scope="col" style="width: 26.66%">Task</th>
                                            <th scope="col" style="width: 16.66%">PIC</th>
                                            <th scope="col" style="width: 16.66%">Event</th>
                                            <th scope="col" style="width: 16.66%">Status</th>
                                            <th scope="col" style="width: 22%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>

                                        <?php foreach ($child_task as $t) : ?>
                                            <?php if ($t->approve_user == user()->id  && $t->updated == 1) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++ ?></th>
                                                    <td><?= $t->project_name ?></td>
                                                    <td><?= $t->concern ?></td>
                                                    <td><?= $t->fullname ?></td>
                                                    <td><?= $t->event_name ?></td>
                                                    <td>
                                                        <?php if ($t->cstat == 'Revise') : ?>
                                                            <span class="badge badge-danger">
                                                                <?= $t->cstat ?></span>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($t->cstat != 'Revise') : ?>
                                                    <span class="badge badge-<?= ($t->cstat == 'In Progress') ? 'info' : (($t->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                        <?= $t->cstat ?></span></td>
                                                <?php endif ?>
                                                <td>
                                                    <?php if ($t->capp == $t->ctapp && $t->cstat != 'Revise') : ?>
                                                        <span data-toggle="modal" data-target="#accChildTask<?= $t->cid ?>">
                                                            <a type="button" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if ($t->capp != $t->ctapp || $t->cstat == 'Revise') : ?>
                                                        <span data-toggle="modal" data-target="#viewChildTask<?= $t->cid ?>">                                                    
                                                            <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                                        </span>
                                                    <?php endif ?>
                                                    <!-- <a type="button" class="badge badge-danger" onclick="del(<?= $t->cid; ?>)"><span class="material-icons" style="color: white;">delete</span></a> -->
                                                </td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <?php foreach ($approve as $t) : ?>
                                            <?php if ($t->approve_user == user()->id  && $t->updated == 1) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++ ?></th>
                                                    <td><?= $t->project_name ?></td>
                                                    <td><?= $t->concern ?></td>
                                                    <td><?= $t->fullname ?></td>
                                                    <td><?= $t->event_name ?></td>
                                                    <td>
                                                        <?php if ($t->status == 'Revise') : ?>
                                                            <span class="badge badge-danger">
                                                                <?= $t->status ?></span>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($t->status != 'Revise') : ?>
                                                    <span class="badge badge-<?= ($t->status == 'In Progress') ? 'info' : (($t->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                        <?= $t->status ?></span></td>
                                                <?php endif ?>
                                                <td>
                                                    <?php if ($t->t_app == $t->ap && $t->status != 'Revise') : ?>
                                                        <span data-toggle="modal" data-target="#accTask<?= $t->task_id ?>" >                                                    
                                                            <a type="button" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>    
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if ($t->t_app != $t->ap || $t->status == 'Revise') : ?>
                                                        <span data-toggle="modal" data-target="#viewTask<?= $t->task_id ?>">
                                                            <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                                        </span>
                                                    <?php endif ?>
                                                    <!-- <a type="button" class="badge badge-danger" onclick="del(<?= $t->a_id; ?>)"><span class="material-icons" style="color: white;">delete</span></a> -->
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
            <?php endif; ?>
        <?php endif; ?>
        <!-- My Task -->
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">My Task</h5>
                            </div>
                        </div>
                        <br>
                        <?= view('message\mytask') ?>
                        <table class="table table-responsive" id="zero-conf2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 10.66%">Project</th>
                                    <th scope="col" style="width: 16.66%">Task</th>
                                    <th scope="col" style="width: 16.66%">Parent</th>
                                    <th scope="col" style="width: 16.66%">Due Date</th>
                                    <th scope="col" style="width: 16.66%">PIC</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 16.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($child_task as $ct) : ?>
                                    <?php if ($ct->pic == user()->id) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $ct->project_name ?></td>
                                            <td><?= $ct->concern ?></td>
                                            <td><?= $ct->parent ?></td>
                                            <td><?= date("d M Y", strtotime($ct->due_date)) ?></td>
                                            <td><?= $ct->fullname ?></td>
                                            <td>
                                                <?php if ($ct->cstat == 'Revise') : ?>
                                                    <span class="badge badge-danger">
                                                        <?= $ct->cstat ?></span>
                                            </td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->cstat == 'In Progress') : ?>
                                            <span class="badge badge-danger">Over Due</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->cstat == 'Done') : ?>
                                            <span class="badge badge-primary">Done</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($ct->due_date)) >= date("Y-m-d", time())) : ?>
                                            <?php if ($ct->cstat != 'Revise') : ?>
                                                <span class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                    <?= $ct->cstat ?></span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time())) : ?>
                                            <?php if ($ct->cstat != 'Done' && $ct->cstat != 'Revise') : ?>
                                                <span class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                    <?= $ct->cstat ?></span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($ct->cstat == 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#updateChildTask<?= $ct->cid ?>">
                                                    <a type="button" class="badge badge-primary"><span class="material-icons" data-toggle="tooltip" data-placement="top" title="Detail Approve" style="color: white;">check</span></a>
                                                </span>
                                                <?php if ($ct->parent == '-') : ?>
                                                    <span data-toggle="modal" data-target="#listChildTask<?= $ct->ctask_id ?>">
                                                        <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View Child Task"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                                    </span>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <?php if ($ct->cstat != 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#viewChildTaskUser<?= $ct->cid ?>">
                                                    <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                                </span>
                                            <?php endif ?>
                                        </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($project as $t) : ?>
                                    <?php if ($t->pic == user()->id) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $t->project_name ?></td>
                                            <td><?= $t->concern ?></td>
                                            <td><?= '-' ?></td>
                                            <td><?= date("d M Y", strtotime($t->due_date)) ?></td>
                                            <td><?= $t->fullname ?></td>
                                            <td>
                                                <?php if ($t->status == 'Revise') : ?>
                                                <span class="badge badge-danger">
                                                    <?= $t->status ?></span>
                                            </td>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time()) && $t->status == 'In Progress') : ?>
                                            <span class="badge badge-danger">Over Due</span></td>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time()) && $t->status == 'Done') : ?>
                                            <span class="badge badge-primary">Done</span></td>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) >= date("Y-m-d", time())) : ?>
                                            <?php if ($t->status != 'Revise') : ?>
                                            <span
                                                class="badge badge-<?= ($t->status == 'In Progress') ? 'info' : (($t->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                <?= $t->status ?></span></td>
                                            <?php endif ?>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time())) : ?>
                                            <?php if ($t->status != 'Done' && $t->status != 'Revise' && $t->status != 'In Progress') : ?>
                                            <span
                                                class="badge badge-<?= ($t->status == 'In Progress') ? 'info' : (($t->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                <?= $t->status ?></span></td>
                                            <?php endif ?>
                                            <?php endif ?>
                                        <td>
                                            <?php if ($t->status == 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#updateTask<?= $t->task_id ?>">
                                                    <a type="button" data-toggle="tooltip" data-placement="top" title="Detail Approve" class="listct badge badge-primary"><span class="material-icons" style="color: white;">check</span></a>
                                                </span>
                                                <?php if (in_array($t->task_id, $ctaskid)) : ?>
                                                    <?php $taskct = $t->task_id ?>
                                                    <span data-toggle="modal" data-id="<?= $t->task_id ?>" data-target="#listChildTask<?= $t->task_id ?>">
                                                        <a type="button" data-toggle="tooltip" data-placement="top" title="View Child Task" class="badge badge-info"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                                    </span>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time()) && $t->status != 'Done') : ?>
                                                <!-- <a type="button" data-toggle="modal" data-target="#updateTask<?= $t->task_id ?>" class="badge badge-primary"><span class="material-icons" style="color: white;">check</span></a> -->
                                            <?php endif ?>
                                            <?php if ($t->status != 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#viewTaskUser<?= $t->task_id ?>">
                                                    <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                                </span>
                                                <?php if (in_array($t->task_id, $ctaskid)) : ?>
                                                    <?php $taskct = $t->task_id ?>
                                                    <span data-toggle="modal" data-id="<?= $t->task_id ?>" data-target="#listChildTask<?= $t->task_id ?>">
                                                        <a type="button" data-toggle="tooltip" data-placement="top" title="View Child Task" class="badge badge-info"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                                    </span>
                                                <?php endif ?>
                                            <?php endif ?>
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
        <!-- Modal Request Approval Task -->
        <?php foreach ($approve as $prj) : ?>
            <div class="modal fade bd-example-modal-lg" id="updateTask<?= $prj->task_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request Approval Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('') ?>/task/updatetask/<?= $prj->task_id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label>Task</label>
                                    <input type="text" class="form-control" value="<?= $prj->concern ?>" name="concern" required readonly>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>PIC</label>
                                            <input type="text" class="form-control" value="<?= $prj->fullname ?>" name="pic" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Event</label>
                                            <input type="text" class="form-control" value="<?= $prj->event_name ?>" name="event" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Request Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', time()) ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($prj->due_date)) ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="required_file" value="<?= $prj->t_file ?>">
                                <input type="hidden" name="project_name" value="<?= $prj->project_name ?>">
                                <?php if ($prj->t_file == 'No') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($prj->t_file == 'Yes') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                            <small style="padding-left: 15px; color:orange" class="form-text text-muted-warning">Your task is required upload file.</small>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1">User Approval Request</label>
                                        <ul class="list-group">
                                            <?php foreach ($apu as $prove) : ?>
                                                <?php if ($prj->task_id == $prove->a_task_id) : ?>
                                                    <?php $count[] = $prove->fullname  ?>
                                                    <div style="display: none;">
                                                        <select name="lau[]">
                                                            <option value="<?= $prove->approve_user ?>"></option>
                                                        </select>
                                                    </div>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?= $prove->routes ?> . <?= $prove->fullname ?>
                                                        <?php if ($prove->ap == 202) : ?>
                                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                        <?php endif ?>
                                                    </li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <?php if (isset($prj->a_file)) : ?>
                                        <div class="col-lg-4">
                                            <div class="card card-transparent file-list recent-files">
                                                <div class="card-body">
                                                    <label for="">File</label>
                                                    <div class="card file">
                                                        <div class="file-options dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $prj->project_name ?>/<?= $prj->a_file ?>">View</a>
                                                                <a class="dropdown-item" href="#">Download</a>
                                                            </div>
                                                        </div>
                                                        <div class="card-header file-icon">
                                                            <i class="material-icons">description</i>
                                                        </div>
                                                        <div class="card-body file-info">
                                                            <p><?= $prj->a_file ?></p>
                                                            <span class="file-size"></span><br>
                                                            <span class="file-date">Upload at:
                                                                <?= date('d M Y', strtotime($prj->update_date)) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-6">
                                        <div class="text-left">
                                            <button type="button" data-toggle="modal" data-target="#addChildTask<?= $prj->task_id ?>" data-dismiss="modal" class="btn btn-primary">Add Child Task</button>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                        <?php if ($prj->pic == user()->id || user()->role == 'admin' || user()->role == 'ame') : ?>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                        </div>
                        <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <?php if ($prj->pic == user()->id || user()->role == 'admin' || user()->role == 'ame') : ?>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?php endif ?>
                    </div> -->
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Modal Request Approval Child Task -->
        <?php foreach ($child_task as $ct) : ?>
            <div class="modal fade bd-example-modal-lg" id="updateChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request Approval Child Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('') ?>/task/updatechildtask/<?= $ct->cid ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label>Task</label>
                                    <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required readonly>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Parent</label>
                                            <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>User Parent</label>
                                            <input type="text" class="form-control" value="<?php foreach ($user as $us) { if ($us->id == $ct->tpic) { $cta = $us->fullname; } } echo $cta; ?>" name="tpic" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>PIC</label>
                                            <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Event</label>
                                            <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Request Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', time()) ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($ct->due_date)) ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="required_file" value="<?= $ct->c_file ?>">
                                <input type="hidden" name="project_name" value="<?= $ct->project_name ?>">
                                <?php if ($ct->c_file == 'No') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($ct->c_file == 'Yes') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                            <small style="padding-left: 15px; color:orange" class="form-text text-muted-warning">Your task is required upload file.</small>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1">User Approval Request</label>
                                        <ul class="list-group">
                                            <?php foreach ($approvect as $act) : ?>
                                                <?php if ($ct->cid == $act->child_task_id) : ?>
                                                    <div style="display: none;">
                                                        <select name="lau[]">
                                                            <option value="<?= $act->approve_user ?>"></option>
                                                        </select>
                                                    </div>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?= $act->routes ?> . <?= $act->fullname ?>
                                                        <?php if ($act->ctapp == 202) : ?>
                                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                        <?php endif ?>
                                                    </li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <?php if (isset($ct->file)) : ?>
                                        <div class="col-lg-4">
                                            <div class="card card-transparent file-list recent-files">
                                                <div class="card-body">
                                                    <label for="">File</label>
                                                    <div class="card file">
                                                        <div class="file-options dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->a_file ?>">View</a>
                                                                <a class="dropdown-item" href="#">Download</a>
                                                            </div>
                                                        </div>
                                                        <div class="card-header file-icon">
                                                            <i class="material-icons">description</i>
                                                        </div>
                                                        <div class="card-body file-info">
                                                            <p><?= $ct->a_file ?></p>
                                                            <span class="file-size"></span><br>
                                                            <span class="file-date">Upload at:
                                                                <?= date('d M Y', strtotime($ct->update_date)) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" name="desc" rows="3"></textarea>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                        <?php if ($ct->pic == user()->id || user()->role == 'admin' || user()->role == 'ame') : ?>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Modal Approve Task -->
        <?php foreach ($approve as $appro) : ?>
            <?php if ($appro->approve_user == user()->id && $appro->t_app == $appro->ap) : ?>
                <div class="modal fade bd-example-modal-lg" id="accTask<?= $appro->task_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Approve Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <form action="<?= base_url('') ?>/task/approvetask/<?= $appro->task_id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $appro->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $appro->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" rows="3" value=""><?= $appro->desc ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1">Notes from approval</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                        <?php if ($appro->status == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->t_app >= $prove->ap) : ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($appro->status != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 202) { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; <?= $prove->notes ?>
                                                                <?php } else { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; -
                                                                <?php } ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                        <?php if ($appro->status == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->t_app >= $prove->ap) : ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($appro->status != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($appro->namafile)) : ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $appro->project_name ?>/<?= $appro->namafile ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $appro->namafile ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $appro->project_name . '/' . $appro->namafile);
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
                                                                    <?= date('d M Y', strtotime($appro->request_at)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3" value=""></textarea>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $appro->t_app ?>">
                                    <input type="hidden" name="status_task" value="<?= $appro->status ?>">
                                    <div class="row mt-4 mb-4">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <button type="submit" name="reject" value="1" class="btn btn-danger">Revise</button>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal Approve Child Task -->
        <?php foreach ($child_task as $ct) : ?>
            <?php if ($ct->approve_user == user()->id && $ct->capp == $ct->ctapp) : ?>
                <div class="modal fade bd-example-modal-lg" id="accChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Approve Child Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <form action="<?= base_url('') ?>/task/approvechildtask/<?= $ct->cid ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <input type="hidden" name="approval_id" value="<?= $ct->cta_id ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Parent</label>
                                                <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Parent</label>
                                                <input type="text" class="form-control" value="<?php
                                                                                                foreach ($user as $us) {
                                                                                                    if ($us->id == $ct->tpic) {
                                                                                                        $cta = $us->fullname;
                                                                                                    }
                                                                                                }
                                                                                                echo $cta;
                                                                                                ?>" name="tpic" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $ct->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" name="desc" rows="3" value=""><?= $ct->desc ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($approvect as $act) : ?>
                                                    <?php if ($ct->cid == $act->child_task_id) : ?>
                                                        <div style="display: none;">
                                                            <select name="lau[]">
                                                                <option value="<?= $act->approve_user ?>"></option>
                                                            </select>
                                                        </div>
                                                        <?php if ($ct->cstat == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($ct->cstat != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $act->routes ?> . <?= $act->fullname ?>
                                                                <?php if ($act->ctapp == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($ct->ct_file)) : ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $ct->ct_file ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $ct->project_name . '/' . $ct->ct_file);
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
                                                                    <?= date('d M Y', strtotime($ct->update_date)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="exampleFormControlTextarea1">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3" value=""></textarea>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $ct->capp ?>">
                                    <input type="hidden" name="status_task" value="<?= $ct->cstat ?>">
                                    <div class="row mt-4 mb-4">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <button type="submit" name="reject" value="1" class="btn btn-danger">Revise</button>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal View Approval Task -->
        <?php foreach ($approve as $appro) : ?>
            <?php if ($appro->at_id == $appro->task_id && $appro->approve_user == user()->id) : ?>
                <div class="modal fade bd-example-modal-lg" id="viewTask<?= $appro->task_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('') ?>/task/canceltask/<?= $appro->task_id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $appro->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $appro->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" name="notes" rows="3" value=""><?= $appro->desc ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1">Notes from approval</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->notes != NULL) { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; <?= $prove->notes ?>
                                                                <?php } else { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; -
                                                                <?php } ?>
                                                            </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                        <?php if ($appro->status == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 404) : ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                                <?php endif ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($appro->status != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($appro->namafile)) { ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $appro->project_name ?>/<?= $appro->namafile ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $appro->namafile ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $appro->project_name . '/' . $appro->namafile);
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
                                                                    <?= date('d M Y', strtotime($appro->request_at)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-lg-4">
                                                <label for="">File</label>
                                                <input type="text" class="form-control" value="No Attachment File" readonly name="" id="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $appro->t_app ?>">
                                    <input type="hidden" name="status_task" value="<?= $appro->status ?>">
                                    <div class="modal-footer">
                                        <?php if ($appro->ap == 202) : ?>
                                            <button value="ca" name="cancel_approve" type="submit" class="btn btn-primary">Cancel
                                                Approve</button>
                                        <?php endif ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal View Task -->
        <?php foreach ($approve as $appro) : ?>
            <?php if ($appro->pic == user()->id) : ?>
                <div class="modal fade bd-example-modal-lg" id="viewTaskUser<?= $appro->task_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('') ?>/task/canceltask/<?= $appro->task_id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $appro->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $appro->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" name="notes" rows="3" value=""><?= $appro->desc ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1">Notes from approval</label>
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                            <li class="list-group-item">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->notes != NULL) { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; <?= $prove->notes ?>
                                                                <?php } else { ?>
                                                                    &emsp;&emsp;&emsp;&emsp; : &emsp; -
                                                                <?php } ?>
                                                            </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($appro->task_id == $prove->a_task_id) : ?>
                                                        <input type="hidden" name="routes[]" value="<?= $prove->routes ?>">
                                                        <input type="hidden" name="idapp[]" value="<?= $prove->a_id ?>">
                                                        <?php if ($appro->status == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 404) : ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                                <?php endif ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($appro->status != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($appro->namafile)) { ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('/public') ?>/theme/assets/document/<?= $prj->fullname ?>/<?= $prj->namafile ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $appro->namafile ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $appro->project_name . '/' . $appro->namafile);
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
                                                                    <?= date('d M Y', strtotime($appro->request_at)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } elseif ($appro->status != 'In Progress' && $appro->namafile == NULL) { ?>
                                            <div class="col-lg-4">
                                                <label for="">File</label>
                                                <input type="text" class="form-control" value="No Attachment File" readonly name="" id="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $appro->t_app ?>">
                                    <input type="hidden" name="status_task" value="<?= $appro->status ?>">
                                    <div class="row mt-3 mb-4">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <?php if ($appro->status == 'Revise') : ?>
                                                    <p style="color: #f54242;">* Please withdraw request to send approval again.</p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <?php if ($appro->status != 'Done' && $appro->pic == user()->id) : ?>
                                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw Request</button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal View Approval Child Task -->
        <?php foreach ($child_task as $ct) : ?>
            <?php if ($ct->child_task_id == $ct->cid && $ct->approve_user == user()->id) : ?>
                <?php
                ?>
                <div class="modal fade bd-example-modal-lg" id="viewChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Child Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('') ?>/task/cancelchildtask/<?= $ct->cid ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Parent</label>
                                                <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Parent</label>
                                                <input type="text" class="form-control" value="<?php
                                                                                                foreach ($user as $us) {
                                                                                                    if ($us->id == $ct->tpic) {
                                                                                                        $cta = $us->fullname;
                                                                                                    }
                                                                                                }
                                                                                                echo $cta;
                                                                                                ?>" name="tpic" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $ct->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" name="notes" rows="3" value=""><?= $ct->notes ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($approvect as $act) : ?>
                                                    <?php if ($ct->cid == $act->child_task_id) : ?>
                                                        <?php if ($ct->cstat == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; : &emsp;&emsp;<?= $act->notes ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($ct->cstat != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; : &emsp;&emsp;<?= $act->notes ?>
                                                                <?php if ($act->ctapp == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($ct->ct_file)) : ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $ct->ct_file ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $ct->project_name . '/' . $ct->ct_file);
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
                                                                    <?= date('d M Y', strtotime($ct->update_date)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $ct->capp ?>">
                                    <input type="hidden" name="status_task" value="<?= $ct->cstat ?>">
                                    <div class="row mt-3 mb-4">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <?php if ($ct->cstat == 'Revise') : ?>
                                                    <p style="color: #f54242;">* Please withdraw request to send approval again.</p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <?php if ($ct->cstat != 'Done' && $ct->pic == user()->id) : ?>
                                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw Request</button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal View Child Task -->
        <?php foreach ($child_task as $ct) : ?>
            <?php if ($ct->pic == user()->id) : ?>
                <div class="modal fade bd-example-modal-lg" id="viewChildTaskUser<?= $ct->cid ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Child Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('') ?>/task/cancelchildtask/<?= $ct->cid ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Parent</label>
                                                <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Parent</label>
                                                <input type="text" class="form-control" value="<?php
                                                                                                foreach ($user as $us) {
                                                                                                    if ($us->id == $ct->tpic) {
                                                                                                        $cta = $us->fullname;
                                                                                                    }
                                                                                                }
                                                                                                echo $cta;
                                                                                                ?>" name="tpic" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Project</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="project_name" readonly value="<?= $ct->project_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Request Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea readonly class="form-control" name="notes" rows="3" value=""><?= $ct->desc ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($approvect as $act) : ?>
                                                    <?php if ($ct->cid == $act->child_task_id) : ?>
                                                        <?php if ($ct->cstat == 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; : &emsp;&emsp;<?= $act->notes ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                            </li>
                                                        <?php endif ?>
                                                        <?php if ($ct->cstat != 'Revise') : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; : &emsp;&emsp;<?= $act->notes ?>
                                                                <?php if ($act->ctapp == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($ct->ct_file)) : ?>
                                            <div class="col-lg-4">
                                                <div class="card card-transparent file-list recent-files">
                                                    <div class="card-body">
                                                        <label for="">File</label>
                                                        <div class="card file">
                                                            <div class="file-options dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" target="_blank" href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
                                                                    <a class="dropdown-item" href="#">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-header file-icon">
                                                                <i class="material-icons">description</i>
                                                            </div>
                                                            <div class="card-body file-info">
                                                                <p><?= $ct->ct_file ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $ct->project_name . '/' . $ct->ct_file);
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
                                                                    <?= date('d M Y', strtotime($ct->update_date)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <input type="hidden" name="approve_number" value="<?= $ct->capp ?>">
                                    <input type="hidden" name="status" value="<?= $ct->cstat ?>">
                                    <div class="row mt-3 mb-4">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <?php if ($ct->cstat == 'Revise') : ?>
                                                    <p style="color: #f54242;">* Please withdraw request to send approval again.</p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <?php if ($ct->cstat != 'Done' && $ct->pic == user()->id) : ?>
                                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw Request</button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal Add Child Task -->
        <?php foreach ($approve as $appro) : ?>
            <?php if ($appro->pic == user()->id) : ?>
                <div class="modal fade bd-example-modal-lg" id="addChildTask<?= $appro->task_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Child Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('') ?>/task/addChildTask/<?= $appro->task_id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input type="text" class="form-control" placeholder="<?= $appro->event_name ?>" name="event" readonly value="<?= $appro->event_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Parent Task</label>
                                                <input type="text" class="form-control" value="<?= $appro->concern ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Child Task</label>
                                        <input type="text" class="form-control" id="new-task-name" placeholder="Task" name="concern" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                                    <?php foreach ($user as $us) : ?>
                                                        <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Due Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" id="e" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Approval</label>
                                                <input type="text" class="form-control" readonly value="<?= $appro->fullname ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Required Attachment File</label>
                                                <select class="js-states form-control" name="required_file" tabindex="-1" style="display: none; width: 100%;" aria-placeholder="Choose">
                                                    <option value="" hidden>-- Choose --</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <input type="hidden" class="form-control" name="user_app" readonly value="<?= $appro->pic ?>">
                            <input type="hidden" name="ftask" value="1">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <!-- Modal List Child Task -->
        <?php foreach ($child_task as $ct) : ?>
            <div class="modal fade bd-example-modal-lg" id="listChildTask<?= $ct->ctask_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">List Child Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">PIC</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($child_task as $ct) : ?>
                                        <?php if (isset($taskct)) : ?>
                                            <?php if ($ct->ctask_id == $taskct) : ?>
                                                <tr>
                                                    <th scope="row"><?= $no++ ?></th>
                                                    <td><?= $ct->parent ?></td>
                                                    <td><?= $ct->concern ?></td>
                                                    <td><?= date("d M Y", strtotime($ct->due_date)) ?></td>
                                                    <td><?= $ct->fullname ?></td>
                                                    <td>
                                                        <?php if ($ct->cstat == 'Revise') : ?>
                                                            <span class="badge badge-danger">
                                                                <?= $ct->cstat ?></span>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($ct->cstat != 'Revise') : ?>
                                                    <span class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                        <?= $ct->cstat ?></span></td>
                                                <?php endif ?>
                                                </td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function del(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this project!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.replace(`<?= base_url('/task/delapprequest') ?>/${id}`)
                    } else {
                        swal("This Request is safe!");
                    }
                });
        }
    </script>
    <?= $this->endSection(); ?>