<?php
foreach ($child_task_data as $ct) { $ctaskid[] = $ct->ctask_id; }
foreach ($child_rio as $cr) {$crioid[] = $cr->crioid;}
if(!isset($crioid)){$crioid[]=$child_rio;}
foreach ($task as $t) {
    if ($t->pic == user()->id) {
        if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time()) && $t->status == 'In Progress') {
            $overdue[] = $t->due_date;
        }
        if ($t->status == 'In Progress' && date("Y-m-d", strtotime($t->due_date)) >= date("Y-m-d", time())) {
            $inprogress[] = $t->status;
        }
        if ($t->status == 'Waiting Approve') {
            $waiting[] = $t->status;
        }
    }
}
foreach ($child_task as $ct) {
    if ($ct->pic == user()->id) {
        if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->status == 'In Progress') {
            $c_overdue[] = $ct->due_date;
            // echo $ct->due_date;
        }
        if ($ct->status == 'In Progress' && date("Y-m-d", strtotime($ct->due_date)) >= date("Y-m-d", time())) {
            $c_inprogress[] = $ct->status;
        }
        if ($ct->status == 'Revise') {
            $revise[] = $ct->status;
        }
        if ($ct->status == 'Waiting Approve') {
            $c_waiting[] = $ct->status;
        }
    }
}
foreach ($approval as $prove) {
    if ($prove->approve_user == user()->id) {
        if ($prove->ap == $prove->tap && $prove->updated == 1) {
            $req[] = $prove->status;
        }
    }
}
foreach ($ctapproval as $prove) {
    if ($prove->approve_user == user()->id) {
        if ($prove->ap == $prove->tap && $prove->updated == 1) {
            $c_req[] = $prove->status;
        }
    }
}
foreach ($approve as $appro) {
    $apro[] = $appro->approve_user;
    $updated[] = $appro->updated;
}
foreach ($approvect as $ct) {
    $act[] = $ct->approve_user;
    $updated[] = $ct->updated;
}
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info" id="tabtask">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="page-options">
            <a href="#tabtask" class="bcstm bcstm-secondary">Task</a>
            <a href="#tabrio" class="bcstm bcstm-secondary">Rio</a>
            <a href="#tabfourm" class="bcstm bcstm-secondary">4M</a>
            <!-- <a href="#" class="bcstm bcstm-secondary">Bom</a> -->
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <?php if (session()->has('pesan')) : ?>
                <div class="alert alert-primary alert-dismissible fade show">
                    <?= session('pesan') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>   
                </div>
                <?php endif ?>
            </div>
        </div>

        <!-- Dashboard Personal Task -->
        <div class="row stats-row">
            <div class="col-lg-3 col-md-12">
                <!-- <div class="card">
                    <div class="card-body">
                        <canvas id="myChart" width="400px" height="500px"></canvas>
                    </div>
                </div> -->
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($inprogress) && isset($c_inprogress) && $revise) {
                                    echo count($inprogress) + count($c_inprogress) + count($c_inprogress);
                                } elseif (isset($inprogress) && isset($revise)) {
                                    echo count($inprogress) + count($revise);
                                } elseif (isset($c_inprogress) && isset($revise)) {
                                    echo count($c_inprogress) + count($revise);
                                } elseif (isset($c_inprogress) && isset($inprogress)) {
                                    echo count($c_inprogress) + count($inprogress);
                                } elseif (isset($inprogress)) {
                                    echo count($inprogress);
                                } elseif (isset($c_inprogress)) {
                                    echo count($c_inprogress);
                                } elseif (isset($revise)) {
                                    echo count($revise);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
                            </h5>
                            <p class="stats-text">Open</p>
                        </div>
                        <a type="button" onclick="mt()" class="stats-icon change-danger">
                            <i class="material-icons">cloud_upload</i>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($waiting) && isset($c_waiting)) {
                                    echo count($waiting) + count($c_waiting);
                                } elseif (isset($waiting)) {
                                    echo count($waiting);
                                } elseif (isset($c_waiting)) {
                                    echo count($c_waiting);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
                            </h5>
                            <p class="stats-text">Waiting approve</p>
                        </div>
                        <a type="button" onclick="mt()" class="stats-icon change-warning">
                            <i class="material-icons">hourglass_bottom</i>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($overdue) && isset($c_overdue)) {
                                    echo count($overdue) + count($c_overdue);
                                } elseif (isset($overdue)) {
                                    echo count($overdue);
                                } elseif (isset($c_overdue)) {
                                    echo count($c_overdue);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
                            </h5>
                            <p class="stats-text">Over due</p>
                        </div>
                        <a type="button" onclick="mt()" class="stats-icon change-danger">
                            <i class="material-icons">warning</i>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($req) && isset($c_req)) {
                                    echo count($req) + count($c_req);
                                } elseif (isset($req)) {
                                    echo count($req);
                                } elseif (isset($c_req)) {
                                    echo count($c_req);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
                            </h5>
                            <p class="stats-text">Request approval</p>
                        </div>
                        <!-- <button  class="btn btn-sm pl-4"> -->
                            <a type="button" onclick="rap()" class="stats-icon change-success">
                                <i class="material-icons">add_task</i>
                            </a>
                        <!-- </button> -->
                    </div>
                </div>
            </div>
            <script>
                function rap(){jQuery('#profile-tab').click();}
                function mt(){jQuery('#home-tab').click();}
            </script>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Approval Task</a>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                            <table class="table" id="dashMyTask">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1.00%">#</th>
                                        <th scope="col" style="width: 1.66%">Project</th>
                                        <th scope="col" style="width: 15.66%">Task</th>
                                        <th scope="col" style="width: 16.66%">Parent</th>
                                        <th scope="col" style="width: 16.66%">Due Date</th>
                                        <th scope="col" style="width: 16.66%">PIC</th>
                                        <th scope="col" style="width: 5.00%">Status</th>
                                        <th scope="col" style="width: 15.00%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($child_task_data as $ct) : ?>
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
                                        <span
                                            class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time())) : ?>
                                        <?php if ($ct->cstat != 'Done' && $ct->cstat != 'Revise' && $ct->cstat != 'In Progress') : ?>
                                        <span
                                            class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($ct->cstat == 'In Progress') : ?>
                                            <span data-toggle="modal" data-target="#updateChildTask<?= $ct->cid ?>">
                                                <a type="button" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>
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
                                    <?php foreach ($project_data as $t) : ?>
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
                                            <?php if ($t->status == 'In Progress'): ?>
                                            <span data-toggle="modal" data-target="#updateTask<?= $t->task_id ?>">  
                                                <a type="button" class="listct badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>
                                            </span>
                                            <?php if (isset($ctaskid)) : ?>
                                            <?php if (in_array($t->task_id, $ctaskid)) : ?>
                                            <?php $taskct = $t->task_id ?>
                                            <span data-toggle="modal" data-id="<?= $t->task_id ?>" data-target="#listChildTask<?= $t->task_id ?>">
                                                <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View Child Task"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                            </span>
                                            <?php endif ?>
                                            <?php endif ?>
                                            <?php endif ?>
                                            <?php if (date("Y-m-d", strtotime($t->due_date)) < date("Y-m-d", time()) && $t->status != 'Done') : ?>
                                            <!-- <a type="button" data-toggle="modal"
                                                data-target="#updateTask<?= $t->task_id ?>"
                                                class="badge badge-primary"><span class="material-icons"
                                                    style="color: white;">check</span></a> -->
                                            <?php endif ?>
                                            <?php if ($t->status != 'In Progress') : ?>
                                            <span data-toggle="modal" data-target="#viewTaskUser<?= $t->task_id ?>">
                                                <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                            </span>
                                            <?php if (isset($ctaskid)) : ?>
                                            <?php if (in_array($t->task_id, $ctaskid)) : ?>
                                            <?php $taskct = $t->task_id ?>
                                            <span data-toggle="modal" data-id="<?= $t->task_id ?>" data-target="#listChildTask<?= $t->task_id ?>">
                                                <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View Child Task"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                            </span>
                                            <?php endif ?>
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
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                            <table class="table" id="dashAppTask">
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
                                    <?php foreach ($child_task_data as $t) : ?>
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
                                        <span
                                            class="badge badge-<?= ($t->cstat == 'In Progress') ? 'info' : (($t->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
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
                                        <span
                                            class="badge badge-<?= ($t->status == 'In Progress') ? 'info' : (($t->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $t->status ?></span></td>
                                        <?php endif ?>
                                        <td>
                                            <?php if ($t->t_app == $t->ap && $t->status != 'Revise') : ?>
                                            <span data-toggle="modal" data-target="#accTask<?= $t->task_id ?>">
                                                <a type="button" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>
                                            </span>
                                            <?php endif ?>
                                            <?php if ($t->t_app != $t->ap || $t->status == 'Revise') : ?>
                                            <span data-toggle="modal" data-target="#viewTask<?= $t->task_id ?>">
                                                <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                            </span>
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
                </div>
            </div>
            <div class="divider" id="tabrio"></div>
        </div>
        
        <!-- Dashboard Personal RIO -->
        <div class="row stats-row">
            <div class="col-lg-3">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?= $getCountRioInProgress + $getCountChildRioInProgress?>
                                <span class="stats-change stats-change-basic">RIO</span>
                            </h5>
                            <p class="stats-text">Open</p>
                        </div>
                        <a>
                            <div class="stats-icon change-danger">
                                <i class="material-icons">cloud_upload</i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?= $getCountRioWaiting + $getCountChildRioOverDue?>
                                <span class="stats-change stats-change-basic">RIO</span>
                            </h5>
                            <p class="stats-text">Waiting approve</p>
                        </div>
                        <a>
                            <div class="stats-icon change-warning">
                                <i class="material-icons">hourglass_bottom</i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?= $getCountRioOverDue + $getCountChildRioWaiting ?>
                                <span class="stats-change stats-change-basic">RIO</span>
                            </h5>
                            <p class="stats-text">Over due</p>
                        </div>
                        <a>
                            <div class="stats-icon change-danger">
                                <i class="material-icons">warning</i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?= $countRequestAppRio + $countRequestAppChildRio ?>
                                <span class="stats-change stats-change-basic">RIO</span>
                            </h5>
                            <p class="stats-text">Request approval</p>
                        </div>
                        <a>
                            <div class="stats-icon change-success">
                                <i class="material-icons">add_task</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="rio-tab" data-toggle="tab" href="#rio" role="tab" aria-controls="rio" aria-selected="true">My Rio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="apprio-tab" data-toggle="tab" href="#apprio" role="tab" aria-controls="apprio" aria-selected="false">My Approval Rio</a>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTab2Content">
                        <div class="tab-pane fade show active" id="rio" role="tabpanel" aria-labelledby="rio-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="zero-conf6">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Project</th>
                                            <th scope="col">RIO</th>
                                            <th scope="col">PIC</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($project_rio as $r) : ?>
                                        <?php if ($r->pic == user()->id) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $r->project_name ?></td>
                                            <td><?= $r->rio ?></td>
                                            <td><?= $r->fullname ?></td>
                                            <td><?= date("d M Y", strtotime($r->due_date)) ?></td>
                                            <td>
                                                <?php if(time() <= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                                <span
                                                    class="badge badge-<?= $r->status == 'In Progress' ? 'info' : 'warning' ?>"><?= $r->status ?></span>
                                                <?php } elseif (time() >= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                                <span class="badge badge-danger">Over Due</span>
                                                <?php } ?>
                                                <?php if($r->status == 'Done') { ?>
                                                <span class="badge badge-primary">Done</span>
                                                <?php } ?>
                                            <td>
                                                <?php if ($r->status == 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#updateRio<?= $r->rio_id ?>">
                                                    <a type="button" class="listct badge badge-primary" data-toggle="tooltip" data-placement="top" title="Update"><span class="material-icons" style="color: white;">check</span></a>
                                                </span>
                                                <?php endif ?>
                                                <?php if ($r->status != 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#viewRio<?= $r->rio_id ?>">
                                                    <a type="button" class="badge badge-info"  data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                                </span>
                                                <?php endif ?>
                                                <?php if (in_array($r->rio_id, $crioid)) : ?>
                                                <?php $rioct = $r->rio_id ?>
                                                <span data-toggle="modal" data-id="<?= $r->rio_id ?>"  data-target="#listChildRio<?= $r->rio_id ?>">
                                                    <a type="button" class="badge badge-info"  data-toggle="tooltip" data-placement="top" title="View Child Rio"><span class="material-icons" style="color: white;">escalator_warning</span></a>
                                                </span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                        <?php foreach ($child_rio as $r) : ?>
                                        <?php if ($r->pic == user()->id) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $r->project_name ?></td>
                                            <td><?= $r->rio ?></td>
                                            <td><?= $r->fullname ?></td>
                                            <td><?= date("d M Y", strtotime($r->due_date)) ?></td>
                                            <td>
                                                <?php if(time() <= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                                <span
                                                    class="badge badge-<?= $r->status == 'In Progress' ? 'info' : 'warning' ?>"><?= $r->status ?></span>
                                                <?php } elseif (time() >= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                                <span class="badge badge-danger">Over Due</span>
                                                <?php } ?>
                                                <?php if($r->status == 'Done') { ?>
                                                <span class="badge badge-primary">Done</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r->status == 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#updateChildRio<?= $r->cr_id ?>">
                                                    <a type="button" class="listct badge badge-primary" data-toggle="tooltip" data-placement="top" title="Update"><span class="material-icons" style="color: white;">check</span></a>
                                                </span>
                                                <?php endif ?>
                                                <?php if ($r->status != 'In Progress') : ?>
                                                <span data-toggle="modal" data-target="#viewChildRio<?= $r->cr_id ?>" >
                                                    <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                                </span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="apprio" role="tabpanel" aria-labelledby="apprio-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                            <table class="table" id="zero-conf4">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 5.66%">Project</th>
                                        <th scope="col" style="width: 16.66%">Type</th>
                                        <th scope="col" style="width: 16.66%">RIO</th>
                                        <th scope="col" style="width: 16.66%">PIC</th>
                                        <th scope="col" style="width: 16.66%">Due Date</th>
                                        <th scope="col" style="width: 16.66%">Status</th>
                                        <th scope="col" style="width: 10.66%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($listapprovalrio as $r) : ?>
                                    <?php if ($r->approve_user == user()->id && $r->updated == 1) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->project_name ?></td>
                                        <td><?= $r->type ?></td>
                                        <td><?= $r->rio ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td><?= date("d M Y", strtotime($r->due_date)) ?></td>
                                        <td>
                                            <?php if ($r->status == 'Revise') : ?>
                                            <span class="badge badge-danger">
                                                <?= $r->status ?></span>
                                        </td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) < date("Y-m-d", time()) && $r->status == 'In Progress') : ?>
                                        <span class="badge badge-danger">Over Due</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) < date("Y-m-d", time()) && $r->status == 'Done') : ?>
                                        <span class="badge badge-primary">Done</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) >= date("Y-m-d", time())) : ?>
                                        <?php if ($r->status != 'Revise') : ?>
                                        <span class="badge badge-<?= ($r->status == 'In Progress') ? 'info' : (($r->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $r->status ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <td>
                                            <?php if ($r->status == 'Waiting Approve') : ?>
                                            <span data-toggle="modal" data-target="#accRio<?= $r->r_rio_id ?>">
                                                <a type="button" data-toggle="modal" data-target="#accRio<?= $r->r_rio_id ?>" data-toggle="tooltip" data-placement="top" title="Detail Approve" class="listct badge badge-primary"><span class="material-icons" style="color: white;">check</span></a>
                                            </span>
                                            <?php endif ?>
                                            <?php if ($r->status == 'Done') : ?>
                                            <span data-toggle="modal" data-target="#accRio<?= $r->r_rio_id ?>">
                                                <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="listct badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                            </span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                    <?php $q = 1; ?>
                                    <?php foreach ($listapprovalchildrio as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $q++ ?></th>
                                        <td><?= $r->project_name ?></td>
                                        <td><?= $r->type ?></td>
                                        <td><?= $r->rio ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td><?= date("d M Y", strtotime($r->due_date)) ?></td>
                                        <td>
                                            <?php if ($r->status == 'Revise') : ?>
                                            <span class="badge badge-danger">
                                                <?= $r->status ?></span>
                                        </td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) < date("Y-m-d", time()) && $r->status == 'In Progress') : ?>
                                        <span class="badge badge-danger">Over Due</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) < date("Y-m-d", time()) && $r->status == 'Done') : ?>
                                        <span class="badge badge-primary">Done</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($r->due_date)) >= date("Y-m-d", time())) : ?>
                                        <?php if ($r->status != 'Revise') : ?>
                                        <span
                                            class="badge badge-<?= ($r->status == 'In Progress') ? 'info' : (($r->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $r->status ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <td>
                                            <?php if ($r->status == 'Waiting Approve') : ?>
                                            <span data-toggle="modal" data-target="#accChildRio<?= $r->r_rio_id ?>">
                                                <a type="button" data-toggle="tooltip" data-placement="top" title="Detail Approve" class="listct badge badge-primary"><span class="material-icons" style="color: white;">check</span></a>
                                            </span>
                                            <?php endif ?>
                                            <?php if ($r->status == 'Done') : ?>
                                            <span data-toggle="modal" data-target="#accChildRio<?= $r->r_rio_id ?>" >
                                                <a type="button" data-toggle="tooltip" data-placement="top" title="View" class="listct badge badge-info"><span class="material-icons" style="color: white;">visibility</span></a>
                                            </span>
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
                </div>
            </div>
            <div class="divider" id="tabfourm"></div>
        </div>

        <!-- Dashboard Personal 4M Change Request -->
        <div class="row stats-row">
            <div class="col-lg-3">
                <!-- <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">0
                                <span class="stats-change stats-change-basic">4M Change</span>
                            </h5>
                            <p class="stats-text">Waiting approve</p>
                        </div>
                        <a>
                            <div class="stats-icon change-warning">
                                <i class="material-icons">hourglass_bottom</i>
                            </div>
                        </a>
                    </div>
                </div> -->
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?= $notif->reqapprove_fourm ?>
                                <span class="stats-change stats-change-basic">4M Change</span>
                            </h5>
                            <p class="stats-text">Request approval</p>
                        </div>
                        <a>
                            <div class="stats-icon change-success">
                                <i class="material-icons">add_task</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="fourm-tab" data-toggle="tab" href="#fourm" role="tab" aria-controls="fourm" aria-selected="true">My 4M Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="appfourm-tab" data-toggle="tab" href="#appfourm" role="tab" aria-controls="appfourm" aria-selected="false">My Approval 4M</a>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTab3Content">
                        <div class="tab-pane fade show active" id="fourm" role="tabpanel" aria-labelledby="fourm-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                            <!-- Table my 4m -->
                            <table class="table" id="zero-conf7">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1.00%">#</th>
                                        <th scope="col" style="width: 9.66%">Line</th>
                                        <th scope="col" style="width: 15.66%">Description</th>
                                        <th scope="col" style="width: 16.66%">Issuer</th>
                                        <th scope="col" style="width: 25.66%">Status</th>
                                        <th scope="col" style="width: 10.00%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($myRequest4m as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->line ?></td>
                                        <td><?= $r->description ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($r->status == 'Waiting Approve') ? 'warning' : (($r->status == 'Revise') ? 'danger' : 'primary') ?>">
                                            <?= $r->status ?></span>
                                        </td>
                                        <td>
                                            <span data-toggle="modal" data-target="#view4m<?= $r->id ?>">
                                                <a type="button" style="color: white;" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info"><span class="material-icons">visibility</span></a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="appfourm" role="tabpanel" aria-labelledby="appfourm-tab">
                            <br>
                            <br>
                            <div class="table-responsive">
                            <!-- Table Approval 4m -->
                            <table class="table" id="zero-conf8">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1.00%">#</th>
                                        <th scope="col" style="width: 9.0%">Line</th>
                                        <th scope="col" style="width: 15.0%">Description</th>
                                        <th scope="col" style="width: 16.0%">Issuer</th>
                                        <th scope="col" style="width: 49.0%">Status</th>
                                        <th scope="col" style="width: 10.00%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($myapprovalengchange as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->line ?></td>
                                        <td><?= $r->description ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($r->status == 'Waiting Approve') ? 'warning' : (($r->status == 'Revise') ? 'danger' : 'primary') ?>">
                                            <?= $r->status ?></span>
                                        </td>
                                        <td>
                                            <?php if ($r->ecrapp == $r->eapp && $r->status != 'Revise') : ?>
                                            <span data-toggle="modal" data-target="#acc4m<?= $r->req_id ?>">
                                                <a type="button" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons" style="color: white;">check</span></a>
                                            </span>
                                            <?php endif ?>
                                            <?php if ($r->ecrapp != $r->eapp || $r->status == 'Revise') : ?>
                                            <span data-toggle="modal" data-target="#view4mapp<?= $r->req_id ?>">
                                                <a type="button" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons" style="color: white;">visibility</span></a>
                                            </span>
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
                </div>
            </div>
        </div>

        <!-- Modal Request Approval Rio -->
        <?php foreach ($approve_rio as $ario) : ?>
        <div class="modal fade bd-example-modal-lg" id="updateRio<?= $ario->rio_id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Approval Rio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/rio/requestapprio/<?= $ario->rio_id ?>" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="<?= $ario->type ?>"
                                                    name="pic" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Project</label>
                                        <input type="text" class="form-control" value="<?= $ario->project_name ?>"
                                            name="project_name" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>RIO Tittle</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?= $ario->rio ?>" name="event"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>PIC</label>
                                        <input type="text" class="form-control" value="<?= $ario->fullname ?>"
                                            name="event" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>User Approval RIO</label>
                                        <ul class="list-group">
                                            <?php foreach ($userapproverio as $row) : ?>
                                            <?php if ($ario->rio_id == $row->r_rio_id) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                style="background-color: #E9ECEF; color: #6D7673">
                                                <?= $row->fullname ?>
                                                <?php if ($row->rap == 202) : ?>
                                                <span class="badge bg-primary rounded-pill"
                                                    style="color: white;">✔</span>
                                                <?php endif ?>
                                            </li>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="required_file" value="<?= $ario->r_file ?>">
                            <div class="row">
                                <div class="col-6">
                                    <?php if ($ario->r_file == 'No') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if ($ario->r_file == 'Yes') : ?>
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="fileapp" class="filestyle">
                                            </div>
                                            <small style="padding-left: 15px; color:orange"
                                                class="form-text text-muted-warning">Your task is required upload
                                                file.</small>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-6">
                                    <label>Notes Spesific File</label>
                                    <?php if($ario->notes_file != "") { ?>
                                    <input type="text" class="form-control" value="<?= $ario->notes_file ?>"
                                        name="notes_file" readonly>
                                    <?php } else { ?>
                                    <input type="text" class="form-control" value="-" readonly>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $ario->file ?>" name="rf">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control" readonly name="notes"
                                    rows="3"><?= $ario->description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Closing Statement</label>
                                <textarea class="form-control" name="clostat" rows="3"></textarea>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <button type="button" data-toggle="modal"
                                        data-target="#addChildRio<?= $ario->rio_id ?>" data-dismiss="modal"
                                        class="btn btn-primary">Add Child Rio</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary mr-2"
                                        data-dismiss="modal">Cancel</button>
                                    <?php if ($ario->pic == user()->id || user()->role == 'admin' || user()->role == 'ame') : ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <?php endif ?>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>

    <!-- Modal View Rio -->
    <?php foreach ($approve_rio as $appro) : ?>
    <?php if ($appro->pic == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewRio<?= $appro->rio_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/cancelrio/<?= $appro->rio_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                        <div class="form-group">
                            <label>RIO Tittle</label>
                            <input type="text" class="form-control" value="<?= $appro->rio ?>" name="rio" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <?php foreach ($userapproverio as $row) : ?>
                                    <?php if ($appro->rio_id == $row->r_rio_id) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        style="background-color: #E9ECEF; color: #6D7673">
                                        <?= $row->fullname ?>
                                        <?php if ($row->rap == 202) : ?>
                                        <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                        <?php endif ?>
                                    </li>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $appro->description ?></textarea>
                        </div>
                        <div class="row">
                            <?php if (isset($appro->a_file)) : ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/rio/<?= $appro->project_name ?>/<?= $appro->a_file ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $appro->a_file ?></p>
                                                <span class="file-size">
                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/rio/' . $appro->project_name . '/' . $appro->a_file);
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
                                                    <?= date('d M Y', strtotime($appro->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Closing Statement</label>
                                    <textarea readonly class="form-control" name="notes" rows="3"
                                        value=""><?= $appro->closing_statement ?></textarea>
                                </div>
                            </div>
                        </div>
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
                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw
                                    Request</button>
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

    <!-- Modal Approve Rio -->
    <?php foreach ($approve_rio as $appro) : ?>
    <?php if ($appro->approve_user == user()->id && $appro->updated == 1) : ?>
    <div class="modal fade bd-example-modal-lg" id="accRio<?= $appro->rio_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Approve Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/approverio/<?= $appro->rio_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                        <div class="form-group">
                            <label>RIO Tittle</label>
                            <input type="text" class="form-control" value="<?= $appro->rio ?>" name="rio" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <?php foreach ($userapproverio as $row) : ?>
                                    <?php if ($appro->rio_id == $row->r_rio_id) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        style="background-color: #E9ECEF; color: #6D7673">
                                        <?= $row->fullname ?>
                                        <?php if ($row->rap == 202) : ?>
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
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea readonly class="form-control" rows=""
                                        value=""><?= $appro->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Closing Statement</label>
                                    <textarea readonly class="form-control" rows=""
                                        value=""><?= $appro->closing_statement ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if($appro->notes == NULL) { ?>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" name="notes" rows="" value=""></textarea>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea readonly class="form-control" name="notes" rows=""
                                        value=""><?= $appro->notes ?></textarea>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (isset($appro->a_file)) : ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/rio/<?= $appro->project_name ?>/<?= $appro->a_file ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $appro->a_file ?></p>
                                                <span class="file-size">
                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/rio/' . $appro->project_name . '/' . $appro->a_file);
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
                                                    <?= date('d M Y', strtotime($appro->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="col-6"></div>
                        </div>
                        <div class="row mt-4 mb-4">
                        <?php if($appro->status != 'Done') : ?>
                            <div class="col-6">
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
                            </div>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php endforeach; ?>

    <!-- Modal Approve Child Rio -->
    <?php foreach ($listapprovalchildrio as $appro) : ?>
    <div class="modal fade bd-example-modal-lg" id="accChildRio<?= $appro->r_rio_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Child Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/approvechildrio/<?= $appro->r_rio_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                        <div class="form-group">
                            <label>RIO Tittle</label>
                            <input type="text" class="form-control" value="<?= $appro->rio ?>" name="rio" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <?php foreach ($userapprovechildrio as $row) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        style="background-color: #E9ECEF; color: #6D7673">
                                        <?= $row->fullname ?>
                                        <?php if ($row->rap == 202) : ?>
                                        <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                        <?php endif ?>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea readonly class="form-control" rows=""
                                        value=""><?= $appro->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Closing Statement</label>
                                    <textarea readonly class="form-control" rows=""
                                        value=""><?= $appro->closing_statement ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <?php if($appro->notes == NULL) { ?>
                                    <textarea class="form-control" name="notes" rows="" value=""></textarea>
                                    <?php } else { ?>
                                    <textarea readonly class="form-control" name="notes" rows="" value=""><?= $appro->notes ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if (isset($appro->a_file)) : ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/rio/<?= $appro->project_name ?>/<?= $appro->a_file ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $appro->a_file ?></p>
                                                <span class="file-size">
                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/rio/' . $appro->project_name . '/' . $appro->a_file);
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
                                                    <?= date('d M Y', strtotime($appro->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="col-6"></div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <?php if($appro->status != 'Done') : ?>
                            <div class="col-6">
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
                            </div>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal Request Approval Task -->
    <?php foreach ($approve as $prj) : ?>
    <div class="modal fade bd-example-modal-lg" id="updateTask<?= $prj->task_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Approve Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/updatetask/<?= $prj->task_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $prj->concern ?>" name="concern" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $prj->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $prj->event_name ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Created At</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($prj->created_at)) ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($prj->due_date)) ?>" required
                                                readonly>
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
                                <small style="padding-left: 15px; color:orange"
                                    class="form-text text-muted-warning">Your task is required upload file.</small>
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $prj->project_name ?>/<?= $prj->a_file ?>">View</a>
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
                                    <button type="button" data-toggle="modal"
                                        data-target="#addChildTask<?= $prj->task_id ?>" data-dismiss="modal"
                                        class="btn btn-primary">Add Child Task</button>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
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

    <!-- Modal View Task -->
    <?php foreach ($approve as $appro) : ?>
    <?php if ($appro->pic == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewTaskUser<?= $appro->task_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/canceltask/<?= $appro->task_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern"
                                required readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $appro->event_name ?>"
                                        name="event" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="desc" rows="3"
                                value=""><?= $appro->desc ?></textarea>
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
                                                        <a class="dropdown-item" target="_blank" href="<?= base_url('/public') ?>/theme/assets/document/<?= $appro->fullname ?>/<?= $appro->namafile ?>">View</a>
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
                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw
                                    Request</button>
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

    <!-- Modal View Approval Task -->
    <?php foreach ($approve as $appro) : ?>
    <?php if ($appro->at_id == $appro->task_id && $appro->approve_user == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewTask<?= $appro->task_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/canceltask/<?= $appro->task_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern"
                                required readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $appro->event_name ?>"
                                        name="event" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $appro->desc ?></textarea>
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
                                        <?php if ($prove->t_app >= $prove->ap) : ?>
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
                            <?php if (isset($appro->namafile)) : ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $appro->project_name ?>/<?= $appro->namafile ?>">View</a>
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

    <!-- Modal Approve Task -->
    <?php foreach ($approve as $appro) : ?>
    <?php if ($appro->approve_user == user()->id && $appro->t_app == $appro->ap) : ?>
    <div class="modal fade bd-example-modal-lg" id="accTask<?= $appro->task_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <form action="<?= base_url('') ?>/task/approvetask/<?= $appro->task_id ?>" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field() ?>
                    <input type="hidden" name="approval_id" value="<?= $appro->a_id ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $appro->concern ?>" name="concern"
                                required readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $appro->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $appro->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($appro->request_at)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $appro->event_name ?>"
                                        name="event" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $appro->desc ?></textarea>
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
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" target="_blank"
                                                            href="<?= base_url('public') ?>/theme/assets/document/<?= $appro->project_name ?>/<?= $appro->namafile ?>">View</a>
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
                            <textarea class="form-control" name="notes" rows="3"></textarea>
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
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
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
    <?php foreach ($child_task_data as $ct) : ?>
    <?php if ($ct->approve_user == user()->id && $ct->capp == $ct->ctapp) : ?>
    <div class="modal fade bd-example-modal-lg" id="accChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <form action="<?= base_url('') ?>/task/approvechildtask/<?= $ct->cid ?>" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field() ?>
                    <input type="hidden" name="approval_id" value="<?= $ct->cta_id ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent</label>
                                    <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent"
                                        required readonly>
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
                                                                                                ?>" name="tpic"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $ct->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="desc" rows="3"
                                value=""><?= $ct->desc ?></textarea>
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
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
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
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

    <!-- Modal View Approval Child Task -->
    <?php foreach ($child_task_data as $ct) : ?>
    <?php if ($ct->child_task_id == $ct->cid && $ct->approve_user == user()->id) : ?>
    <?php
                ?>
    <div class="modal fade bd-example-modal-lg" id="viewChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/cancelchildtask/<?= $ct->cid ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent</label>
                                    <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent"
                                        required readonly>
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
                                                                                                ?>" name="tpic"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $ct->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $ct->notes ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <?php foreach ($approvect as $act) : ?>
                                    <?php if ($ct->cid == $act->child_task_id) : ?>
                                    <?php if ($ct->cstat == 'Revise') : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $act->routes ?>. <?= $act->fullname ?>
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
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
                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw
                                    Request</button>
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

    <!-- Modal List Child Task -->
    <?php foreach ($child_task_data as $ct) : ?>
    <div class="modal fade bd-example-modal-lg" id="listChildTask<?= $ct->ctask_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <?php foreach ($child_task_data as $ct) : ?>
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
                                <span
                                    class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
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


    <!-- Modal View Child Task -->
    <?php foreach ($child_task_data as $ct) : ?>
    <?php if ($ct->pic == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewChildTaskUser<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/cancelchildtask/<?= $ct->cid ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent</label>
                                    <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent"
                                        required readonly>
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
                                                                                                ?>" name="tpic"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $ct->project_name ?>">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($ct->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $ct->desc ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <?php foreach ($approvect as $act) : ?>
                                    <?php if ($ct->cid == $act->child_task_id) : ?>
                                    <?php if ($ct->cstat == 'Revise') : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; :
                                        &emsp;&emsp;<?= $act->notes ?>
                                        <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                    </li>
                                    <?php endif ?>
                                    <?php if ($ct->cstat != 'Revise') : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $act->routes ?>. <?= $act->fullname ?>&emsp;&emsp; :
                                        &emsp;&emsp;<?= $act->notes ?>
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->ct_file ?>">View</a>
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
                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw
                                    Request</button>
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
    <div class="modal fade bd-example-modal-lg" id="addChildTask<?= $appro->task_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/addChildTask/<?= $appro->task_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" placeholder="<?= $appro->event_name ?>"
                                        name="event" readonly value="<?= $appro->event_name ?>">
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
                            <input type="text" class="form-control" id="new-task-name" placeholder="Task" name="concern"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <select class="js-states form-control" name="pic" tabindex="-1"
                                        style="display: none; width: 100%">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" id="e" name="due_date"
                                                value="<?= date('d/m/Y', time()) ?>" required>
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
                                    <select class="js-states form-control" name="required_file" tabindex="-1"
                                        style="display: none; width: 100%;" aria-placeholder="Choose">
                                        <option value="" hidden>-- Choose --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" class="form-control" name="user_app" readonly value="<?= $appro->pic ?>">
                <input type="hidden" name="fdash" value="1">
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

    <!-- Modal Request Approval Child Task -->
    <?php foreach ($child_task_data as $ct) : ?>
    <div class="modal fade bd-example-modal-lg" id="updateChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Approval Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/updatechildtask/<?= $ct->cid ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent</label>
                                    <input type="text" class="form-control" value="<?= $ct->parent ?>" name="parent"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>User Parent</label>
                                    <input type="text" class="form-control"
                                        value="<?php foreach ($user as $us) { if ($us->id == $ct->tpic) { $cta = $us->fullname; } } echo $cta; ?>"
                                        name="tpic" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" value="<?= $ct->event_name ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Created At</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($ct->updated_at)) ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($ct->due_date)) ?>" required
                                                readonly>
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
                                <small style="padding-left: 15px; color:orange"
                                    class="form-text text-muted-warning">Your task is required upload file.</small>
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->a_file ?>">View</a>
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
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
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

    <!-- Modal Add Child Rio -->
    <?php foreach ($approve_rio as $appro) : ?>
    <?php if ($appro->pic == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="addChildRio<?= $appro->rio_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Child Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/addChildRio/<?= $appro->rio_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Project</label>
                                    <input type="text" class="form-control" value="<?= $appro->project_name ?>"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent Rio</label>
                                    <input type="text" class="form-control" value="<?= $appro->rio ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Child Rio</label>
                            <input type="text" class="form-control" placeholder="Rio" name="rio" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <select class="js-states form-control" name="pic" tabindex="-1"
                                        style="display: none; width: 100%">
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
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" id="e" name="due_date"
                                                value="<?= date('d/m/Y', time()) ?>" required>
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
                                    <select class="js-states form-control" name="required_file" tabindex="-1"
                                        style="display: none; width: 100%;" aria-placeholder="Choose">
                                        <option value="" hidden>-- Choose --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="desc" rows="1"></textarea>
                        </div>
                </div>
                <input type="hidden" class="form-control" name="user_app" readonly value="<?= $appro->pic ?>">
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

    <!-- Modal List Child Rio -->
    <?php foreach ($child_rio as $crio) : ?>
    <div class="modal fade bd-example-modal-xl" id="listChildRio<?= $crio->crioid ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Child Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Project</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Child Rio</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">PIC</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($child_rio as $cr) : ?>
                            <?php if (isset($rioct)) : ?>
                            <?php if ($cr->crioid == $rioct) : ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $cr->project_name ?></td>
                                <td><?= $cr->parent ?></td>
                                <td><?= $cr->rio ?></td>
                                <td><?= date("d M Y", strtotime($cr->due_date)) ?></td>
                                <td><?= $cr->fullname ?></td>
                                <td>
                                    <?php if ($cr->status == 'Revise') : ?>
                                    <span class="badge badge-danger">
                                        <?= $cr->status ?></span>
                                </td>
                                <?php endif ?>
                                <?php if ($cr->status != 'Revise') : ?>
                                <span
                                    class="badge badge-<?= ($cr->status == 'In Progress') ? 'info' : (($cr->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                    <?= $cr->status ?></span></td>
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

    <!-- Modal Request Approval Child Rio -->
    <?php foreach ($child_rio as $row) : ?>
    <div class="modal fade bd-example-modal-lg" id="updateChildRio<?= $row->cr_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Approval Child Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/requestappchildrio/<?= $row->cr_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Project</label>
                                    <input type="text" class="form-control" value="<?= $row->project_name ?>"
                                        name="project_name" required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent RIO</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="<?= $row->parent ?>"
                                                name="pic" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>RIO Tittle</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?= $row->rio ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $row->fullname ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>User Approval RIO</label>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            style="background-color: #E9ECEF; color: #6D7673">
                                            <?= $childapprio->fullname ?>
                                            <?php if ($row->approve == 202) : ?>
                                            <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                            <?php endif ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="required_file" value="<?= $row->file ?>">
                        <div class="row">
                            <div class="col-6">
                                <?php if ($row->file == 'No') : ?>
                                <div class="form-group">
                                    <label>File</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="file" name="fileapp" class="filestyle">
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <?php if ($row->file == 'Yes') : ?>
                                <div class="form-group">
                                    <label>File</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="file" name="fileapp" class="filestyle">
                                        </div>
                                        <small style="padding-left: 15px; color:orange"
                                            class="form-text text-muted-warning">Your rio is required upload
                                            file.</small>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" readonly class="form-control" value="<?= $row->description ?>">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $row->file ?>" name="rf">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Closing Statement</label>
                            <textarea class="form-control" name="notes" rows="3"></textarea>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-6">
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
                                <?php if ($row->pic == user()->id || user()->role == 'admin' || user()->role == 'ame') : ?>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <?php endif ?>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal View Child Rio -->
    <?php foreach ($child_rio as $row) : ?>
    <?php if ($row->pic == user()->id) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewChildRio<?= $row->cr_id ?>" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Child Rio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/rio/cancelrio/<?= $row->cr_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" value="<?= $row->fullname ?>" name="pic"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Parent RIO</label>
                                    <input type="text" class="form-control" value="<?= $row->parent ?>" name="pic" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Project</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" name="project_name"
                                            readonly value="<?= $row->project_name ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>RIO Tittle</label>
                            <input type="text" class="form-control" value="<?= $row->rio ?>" name="rio" required readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Request Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', strtotime($row->update_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        style="background-color: #E9ECEF; color: #6D7673">
                                        <?= $childapprio->fullname ?>
                                        <?php if ($row->approve == 202) : ?>
                                        <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea readonly class="form-control" name="notes" rows="3"
                                value=""><?= $row->description ?></textarea>
                        </div>
                        <div class="row">
                            <?php if (isset($row->a_file)) : ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/rio/<?= $row->project_name ?>/<?= $row->a_file ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $row->a_file ?></p>
                                                <span class="file-size">
                                                    <?php
                                                                        $filesize = filesize('public/theme/assets/rio/' . $row->project_name . '/' . $row->a_file);
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
                                                    <?= date('d M Y', strtotime($row->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="row mt-3 mb-4">
                            <div class="col-6">
                                <div class="text-left">
                                    <?php if ($row->status == 'Revise') : ?>
                                    <p style="color: #f54242;">* Please withdraw request to send approval again.</p>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <?php if ($row->status != 'Done' && $row->pic == user()->id) : ?>
                                <button type="submit" value="cr" name="cancel_request" class="btn btn-primary">Withdraw
                                    Request</button>
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

    <!-- Modal Detail my 4m Request -->
    <?php foreach($myRequest4m as $row) : ?>
    <div class="modal fade" id="view4m<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details 4M Request Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/engchange/deleterequest/<?= $row->id ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Project</label>
                                    <input type="text" name="project" readonly value="<?= $row->project_name ?>"
                                        class="form-control">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" readonly name="description"
                                        rows="3"><?= $row->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" readonly required name="reason"
                                        rows="3"><?= $row->reason ?></textarea>
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
                                                        <?php $userapprove[] = $uae->fullname ?>
                                                        <input type="hidden" name="routes[]" value="<?= $uae->routes ?>">
                                                        <input type="hidden" name="idapp[]" value="<?= $uae->id ?>">
                                                        <?= $uae->routes ?>. <?= $uae->fullname ?>
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
                                                                            $filesize = filesize('public/theme/assets/4m change request/' . $row->file);
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Request</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <!-- Modal Detail my 4m Approve -->
    <?php foreach($myapprovalengchange as $row) : ?>
    <div class="modal fade" id="view4mapp<?= $row->req_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details 4M Request Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/request/" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Project</label>
                                    <input type="text" name="project" readonly value="<?= $row->project_name ?>"
                                        class="form-control">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" readonly name="description"
                                        rows="3"><?= $row->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" readonly required name="reason"
                                        rows="3"><?= $row->reason ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label>User Approval 4M</label>
                                        <ul class="list-group">
                                                <?php foreach ($UserApprovalEngchange as $uae) : ?>
                                                    <?php if ($uae->req_id == $row->req_id) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php $userapprove[] = $uae->fullname  ?>
                                                        <?= $uae->routes ?>. <?= $uae->fullname ?>
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
                                                                            $filesize = filesize('public/theme/assets/4m change request/' . $row->file);
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
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Withdraw Request</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <!-- Modal Detail 4m App Request -->
    <?php $l1 = 1; $l2 = 1; $l3 = 100; $l4 = 100; ?>
    <?php foreach($myapprovalengchange as $row) : ?>
    <div class="modal fade" id="acc4m<?= $row->req_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve 4M Request Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/engchange/accrequest/<?= $row->req_id ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Project</label>
                                    <input type="text" name="project" readonly value="<?= $row->project_name ?>"
                                        class="form-control">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" readonly name="description"
                                        rows="3"><?= $row->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" readonly required name="reason"
                                        rows="3"><?= $row->reason ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label>User Approval 4M</label>
                                        <ul class="list-group">
                                                <?php foreach ($UserApprovalEngchange as $uae) : ?>
                                                    <?php if ($uae->req_id == $row->req_id) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?= $uae->routes ?>. <?= $uae->fullname ?>
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
                                                    <!-- <a class="dropdown-item" href="#">Download</a> -->
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $row->file ?></p>
                                                <span class="file-size">
                                                    <?php
                                                                            $filesize = filesize('public/theme/assets/4m change request/' . $row->file);
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Notes Manager</label>
                                    <?php if ($row->approve == 1) { ?>
                                    <textarea class="form-control" required name="notesmgr" rows="3"></textarea>
                                    <?php } else { ?>
                                    <textarea class="form-control" name="notesmgr" readonly rows="3"><?= $row->notesmgr ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php if ($row->approve == 2) { ?>
                                    <label>Tested Result by Engineering</label>
                                    <textarea class="form-control" required name="testresult_eng"
                                        rows="3"></textarea>
                                    <?php } elseif ($row->approve > 2) { ?>
                                    <label>Tested Result by Engineering</label>
                                    <textarea class="form-control" name="testresult_eng" readonly
                                        rows="3"><?= $row->testresult_eng ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php if ($row->approve == 3) { ?>
                                    <label>Acknowledge by EHS</label>
                                    <textarea class="form-control" required name="acknowledge_ehs"
                                        rows="3"></textarea>
                                    <?php } elseif ($row->approve > 3) {  ?>
                                    <label>Acknowledge by EHS</label>
                                    <textarea class="form-control" name="acknowledge_ehs" readonly
                                        rows="3"><?= $row->acknowledge_ehs ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php if ($row->approve == 4) { ?>
                                    <label>Verification Result by Quality</label>
                                    <textarea class="form-control" required name="confirm_quality"
                                        rows="3"></textarea>
                                    <?php } elseif ($row->approve > 4) { ?>
                                    <label>Verification Result by Quality</label>
                                    <textarea class="form-control" name="confirm_quality" readonly
                                        rows="3"><?= $row->confirm_quality ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php if ($row->approve == 5) { ?>
                                    <label>Notes Dept Head Quality</label>
                                    <textarea class="form-control" required name="notes_dhqa"
                                        rows="3"></textarea>
                                    <?php } elseif ($row->approve > 5) { ?>
                                    <label>Notes Dept Head Quality</label>
                                    <textarea class="form-control" name="notes_dhqa" readonly
                                        rows="3"><?= $row->notes_dhqa ?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php if ($row->approve == 5) { ?>
                                        <label>Apply to Customer</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="atc" id="exampleRadios<?= $l1++ ?>" value="No" checked >
                                            <label class="custom-control-label" for="exampleRadios<?= $l2++ ?>">
                                                No
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="atc" id="exampleRadios<?= $l3++ ?>" value="Yes">
                                            <label class="custom-control-label" for="exampleRadios<?= $l4++ ?>">
                                                Yes
                                            </label>
                                        </div>
                                        <small>*if you apply to customer, this 4m change request must be approve with marketing department</small>
                                    <?php } elseif ($row->status == 'Approve 5') {  ?>
                                    <label>Apply to Customer</label>
                                    <input type="text" class="form-control" name="" value="Yes" readonly id="">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php if ($row->approve == 6) { ?>
                            <label>Notes Marketing</label>
                            <textarea class="form-control" required name="notes_mkt"
                                rows="3"></textarea>
                            <?php } elseif ($row->approve > 6) {  ?>
                            <label>Notes Marketing</label>
                            <textarea class="form-control" name="notes_mkt" readonly
                                rows="3"><?= $row->notes_mkt ?></textarea>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="approve_number" value="<?= $row->approve ?>">
                        <input type="hidden" name="status" value="<?= $row->status ?>">
                        <input type="hidden" name="approve_id" value="<?= $row->app_id ?>">
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="text-left">
                                    <button type="submit" name="reject" value="1" class="btn btn-danger">Revise</button>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <script>
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow',
                'Green',
            ],
        datasets: [{
            data: [300, 50, 100, 40],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(123, 162, 235)',
            ],
            hoverOffset: 4
        }]
        };
        
        const config = {
        type: 'doughnut',
        data: data,
        };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
<?= $this->endSection(); ?>