<?php
// dd($statfinance);
$i = 0;
$np = $projectrow->project_name;
foreach ($task as $tsk) {
    if (date("Y-m-d", strtotime($tsk->due_date)) < date("Y-m-d", time()) && $tsk->status == 'In Progress') {
        $overdue[] = $tsk->due_date;
    }
    if ($tsk->status == 'In Progress' && date("Y-m-d", strtotime($tsk->due_date)) >= date("Y-m-d", time())) {
        $inprogress[] = $tsk->status;
    }
    if ($tsk->status == 'Waiting Approve') {
        $waiting[] = $tsk->status;
    }
    if ($tsk->status == 'Done') {
        $done[] = $tsk->status;
    }
}
foreach ($child_task as $ct) {
    if ($ct->project_id == $projectrow->id) {
        if (date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->cstat == 'In Progress') {
            $c_overdue[] = $ct->due_date;
        }
        if ($ct->cstat == 'In Progress' && date("Y-m-d", strtotime($ct->due_date)) >= date("Y-m-d", time())) {
            $c_inprogress[] = $ct->cstat;
        }
        if ($ct->cstat == 'Waiting Approve') {
            $c_waiting[] = $ct->cstat;
        }
        if ($ct->cstat == 'Done') {
            $c_done[] = $ct->cstat;
        }
    }
}
foreach ($productivity as $row) {
    $eventprod[] = [
        "eventname" => str_replace(" ","",$row->event_name),
        "station" => $row->station,
        "ct_target" => $row->ct_target,
        "ct_actual" => $row->ct_actual,
        "ftt_target" => $row->ftt_target,
        "ftt_actual" => $row->ftt_actual,
        "rr_target" => $row->rr_target,
        "rr_actual" => $row->rr_actual,
    ];
}
if(isset($eventprod)) {
    foreach($eventprod as $row)
    {
    $resEventProd[$row["eventname"]][] = [
        "station" => $row["station"],
        "ct_target" => $row["ct_target"],
        "ct_actual" => $row["ct_actual"],
        "ftt_target" => $row["ftt_target"],
        "ftt_actual" => $row["ftt_actual"],
        "rr_target" => $row["rr_target"],
        "rr_actual" => $row["rr_actual"],
        ];
    }
    // $arrEvent = array_unique($eventprod);
    foreach($resEventProd as $key => $value)
    {
        if($key == 'PP1'){
            // echo $value[0]['ct_target'];
        }
        $prodEventName[] = $key;
    }
    
    foreach ($resEventProd as $key => $val) {
            foreach($val as $row) {
               $ot[$key][] = $row['ct_actual'];
            }
    }
}
// dd($ot['PP1']);
// dd($resEventProd);
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/project/<?= $customer->id ?>"><?= $customer->customer_name ?></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                        <li class="breadcrumb-item" aria-current="page"><?= $projectrow->project_name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/project" class="badge badge-secondary">⬅ Back</a>
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
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h5 class="card-title my-2 pl-2" style="font-size: 19px;">
                                        <?= $projectrow->project_name ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                            <?php if (user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                                <button class="btn btn-secondary ml-3" data-toggle="modal" data-target="#editPict"><i class="fa fa-picture"></i>
                                    Edit Picture</button>
                            <?php endif ?>
                            </div>
                        </div>
                        <br>
                        <div class="text-center mx-auto rounded mx-auto d-block" style="width:20rem" class="">
                            <img src="<?= base_url('') ?>/public/theme/assets/photo/<?= $projectrow->pict ?>" style="border-radius: 10px;" class="img-fluid">
                        </div>
                        <br>
                        <div class="text-center">
                            <div class="row d-flex">
                                <div class="col-4">
                                    <p>Last Event</p>
                                </div>
                                <div class="col-4">
                                    <p>Current Event</p>
                                </div>
                                <div class="col-4">
                                    <p>Next Event</p>
                                </div>
                            </div>
                            <div class="row justify-content-left">
                                <div class="col-4">
                                    <?php if (!isset($lastEvent->event)) : ?>
                                        <a href="" type="button" style="color: white; background: #43a0b5" class="btn btn-lg">NOT<br>AVAILABLE
                                        </a>
                                    <?php endif ?>
                                    <?php if (isset($lastEvent->event)) : ?>
                                        <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $lastEvent->event ?>" type="button" style="color: white; background: #43a0b5" class="btn btn-lg">
                                            <?= $lastEvent->event ?><br><?= $lastEvent->date ?>
                                        </a>
                                    <?php endif ?>
                                </div>
                                <div class="col-4">
                                    <?php if (!isset($currentEvent->event)) : ?>
                                        <a href="" type="button" style="color: white; background: #598e91" class="btn btn-lg">NOT<br>AVAILABLE
                                        </a>
                                    <?php endif; ?>
                                    <?php if (isset($currentEvent->date)) : ?>
                                        <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $currentEvent->event ?>" type="button" style="color: white; background: #598e91" class="btn btn-lg">
                                            <?= $currentEvent->event ?><br><?= $currentEvent->date ?>
                                        </a>
                                    <?php endif ?>
                                </div>
                                <div class="col-4">
                                    <?php if (isset($nextEvent->event)) : ?>
                                        <div class="blink">
                                            <?php if ($nextEvent->date != 'AVAILABLE') : ?>
                                                <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $nextEvent->event ?>" type="button" style="color: white; background: #e08012" class="btn btn-lg">
                                                    <div class="blink">
                                                        <?= $nextEvent->event ?><br>
                                                        <?php
                                                        $date1=date_create(date('Y-m-d', strtotime($nextEvent->date)));
                                                        $date2=date_create(date('Y-m-d', time()));
                                                        $diff=date_diff($date1,$date2);
                                                        echo $diff->format("%a Days left");
                                                        ?>
                                                    </div>
                                                </a>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!isset($nextEvent->date)) : ?>
                                        <a href="" type="button" style="color: white; background: #e08012" class="btn btn-lg">
                                            <div class="blink">
                                                NOT<br>AVAILABLE
                                            </div>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button class="btn btn-secondary ml-3" id="taskButton"><i class="fa fa-tasks"></i>
                                Tasks</button>
                            <button class="btn btn-secondary ml-3" id="eventNear"><i class="fas fa-calendar"></i>
                                Events</button>
                            <button class="btn btn-secondary ml-3" value="cost" id="costButton"><i class="fas fa-money-check-alt"></i> Cost</button>
                            <button class="btn btn-secondary ml-3" id="qualityButton"><i class="fas fa-chart-line"></i> Quality</button>
                            <button class="btn btn-secondary ml-3" id="productivityButton"><i class="fab fa-medapps"></i> Productivity</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-primary alert-dismissible fade show">
                <?= session('pesan') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <?php if (session()->has('errorfix')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session('errorfix') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div style="display: none;" id="eventDetails">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <?php if (!empty($eventCustomer) || !empty($eventInternal)) : ?>
                                <div id="eventSchedule"></div>
                            <?php endif ?>
                            <?php if (empty($eventCustomer) || empty($eventInternal)) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-center">
                                    Grafik event schedule not available! must have event customer and event internal
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Event Customer</h5>
                                </div>
                                    <div class="col-6">
                                        <?php if (user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                                        <div class="text-right">
                                            <button type="button" data-toggle="modal" data-target="#addEventCust" class="btn btn-primary">Add Event</button>
                                        </div>
                                        <?php endif ?>
                                    </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="zero-conf3">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 5%;">#</th>
                                            <th scope="col" style="width: 5%;">Event</th>
                                            <th scope="col" style="width: 20%;">Start</th>
                                            <th scope="col" style="width: 20%;">Finish</th>
                                            <th scope="col" style="width: 20%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php if (isset($eventCustomer)) : ?>
                                            <?php foreach ($eventCustomer as $row) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++ ?></th>
                                                    <td><?= $row->event_name ?></td>
                                                    <td><?= date("d M Y", strtotime($row->start)) ?></td>
                                                    <td><?= date("d M Y", strtotime($row->end)) ?></td>
                                                    <td>
                                                        <?php if (user()->section == 'Project Manager' || user()->role == 'admin' || user()->role == 'ame') { ?>
                                                            <span data-toggle="modal" data-target="#editEventCust<?= $row->id ?>" >
                                                                <a type="button" style="color: white;" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                                            </span>
                                                            <a type="button" class="badge badge-danger" onclick="delEventCust(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                                        <?php } else { ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Event Internal</h5>
                                </div>
                                    <div class="col-6">
                                        <?php if (user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                                        <div class="text-right">
                                            <button type="button" data-toggle="modal" data-target="#addEventInt" class="btn btn-primary">Add Event</button>
                                        </div>
                                        <?php endif ?>
                                    </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="zero-conf4">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 5%;">#</th>
                                            <th scope="col" style="width: 5%;">Event</th>
                                            <th scope="col" style="width: 20%;">Start</th>
                                            <th scope="col" style="width: 20%;">Finish</th>
                                            <th scope="col" style="width: 20%;">Flag</th>
                                            <th scope="col" style="width: 20%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php if (isset($eventInternal)) : ?>
                                            <?php foreach ($eventInternal as $row) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++ ?></th>
                                                    <td><?= $row->event_name ?></td>
                                                    <td><?= date("d M Y", strtotime($row->start)) ?></td>
                                                    <td><?= date("d M Y", strtotime($row->end)) ?></td>
                                                    <td><span class="dot-<?= $row->flag ?>"></span></td>
                                                    <td>
                                                        <?php if (user()->section == 'Project Manager' || user()->role == 'admin' || user()->role == 'ame') { ?>
                                                            <span data-toggle="modal" data-target="#editEventInt<?= $row->id ?>" >
                                                                <a type="button" style="color: white;" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                                            </span>
                                                        <a type="button" class="badge badge-danger" onclick="delEventInt(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                                        <?php } else { ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                </tr>
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
    <div class="row" style="display: block;" id="taskList">
        <div class="row stats-row">
            <div class="col-lg-3 col-md-12">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($done) && isset($c_done)) {
                                    echo count($done) + count($c_done);
                                } elseif (isset($done)) {
                                    echo count($done);
                                } elseif (isset($c_done)) {
                                    echo count($c_done);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
                            </h5>
                            <p class="stats-text">Done</p>
                        </div>
                        <a>
                            <div class="stats-icon change-success">
                                <i class="material-icons">check_circle</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">
                                <?php
                                if (isset($inprogress) && isset($c_inprogress)) {
                                    echo count($inprogress) + count($c_inprogress);
                                } elseif (isset($inprogress)) {
                                    echo count($inprogress);
                                } elseif (isset($c_inprogress)) {
                                    echo count($c_inprogress);
                                } else {
                                    echo 0;
                                }
                                ?>
                                <span class="stats-change stats-change-basic">Task</span>
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
            </div>
            <div class="col-lg-3 col-md-12">
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
                        <a>
                            <div class="stats-icon change-warning">
                                <i class="material-icons">hourglass_bottom</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
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
                        <a>
                            <div class="stats-icon change-danger">
                                <i class="material-icons">warning</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Task list</h5>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                    <?php if (user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                                    <button type="button" data-toggle="modal" style="display: none;" id="addTask" data-target="#newTask" class="btn btn-primary">Add Task</button>
                                    <?php endif ?>
                                    <button class="btn btn-secondary ml-3" id="showTaskList"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="tasklist" style="display: none;">
                    <br>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <div class="table-responsive">
                    <table class="table" id="zero-conf">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 1%;">#</th>
                                <th scope="col" style="width: 15%;">Event</th>
                                <th scope="col" style="width: 20%;">Task</th>
                                <th scope="col" style="width: 15%;">Parent</th>
                                <th scope="col" style="width: 15%;">Due date</th>
                                <th scope="col" style="width: 15%;">PIC</th>
                                <th scope="col" style="width: 10%">Status</th>
                                <th scope="col" style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (isset($project)) : ?>
                                <?php foreach ($project as $prj) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $prj->event_name ?></td>
                                        <td><?= $prj->concern ?></td>
                                        <td>-</td>
                                        <td><?= date("d M Y", strtotime($prj->due_date)) ?></td>
                                        <td><?= $prj->fullname ?></td>
                                        <td>
                                            <?php if ($prj->status == 'Revise') : ?>
                                            <span class="badge badge-danger">
                                                <?= $prj->status ?></span>
                                        </td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($prj->due_date)) < date("Y-m-d", time()) && $prj->status == 'In Progress') : ?>
                                        <span class="badge badge-danger">Over Due</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($prj->due_date)) < date("Y-m-d", time()) && $prj->status == 'Done') : ?>
                                        <span class="badge badge-primary">Done</span></td>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($prj->due_date)) >= date("Y-m-d", time())) : ?>
                                        <?php if ($prj->status != 'Revise') : ?>
                                        <span
                                            class="badge badge-<?= ($prj->status == 'In Progress') ? 'info' : (($prj->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $prj->status ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <?php if (date("Y-m-d", strtotime($prj->due_date)) < date("Y-m-d", time())) : ?>
                                        <?php if ($prj->status != 'Done' && $prj->status != 'Revise' && $prj->status != 'In Progress') : ?>
                                        <span
                                            class="badge badge-<?= ($prj->status == 'In Progress') ? 'info' : (($prj->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                            <?= $prj->status ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                    <td>
                                        <?php if ($prj->pic == user()->id) : ?>
                                            <a type="button" style="color: white;" href="<?= base_url('') ?>/task" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons">check</span></a>
                                        <?php endif; ?>
                                        <?php if ($prj->pic != user()->id) : ?>
                                            <span data-toggle="modal" data-target="#updateTask<?= $prj->task_id ?>">
                                                <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                            </span>
                                        <?php endif ?>
                                        <?php if (user()->level_id == 3 || user()->level_id == 1) : ?>
                                            <a type="button" class="badge badge-danger" onclick="del(<?= $prj->task_id; ?>, <?= $id; ?>, <?= $customer->id ?>)"  data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                            <?php foreach ($child_task as $ct) : ?>
                                <?php if ($ct->project_id == $projectrow->id) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $ct->event_name ?></td>
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
                                        <?php if ($ct->cstat != 'Done' && $ct->cstat != 'In Progress') : ?>
                                            <span class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                    <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($ct->pic == user()->id) : ?>
                                            <a type="button" style="color: white;" href="<?= base_url('') ?>/task" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Detail Approve"><span class="material-icons">check</span></a>
                                        <?php endif; ?>
                                        <?php if ($ct->pic != user()->id) : ?>
                                            <span data-toggle="modal" data-target="#updateChildTask<?= $ct->cid ?>" >
                                                <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                            </span>
                                        <?php endif ?>
                                        <?php if (user()->level_id == 3 || user()->level_id == 1) : ?>
                                            <a type="button" class="badge badge-danger" onclick="delchildtask(<?= $ct->cid; ?>, <?= $id; ?>, <?= $customer->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                        <?php endif; ?>
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
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">PIC Performance</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-secondary ml-3" id="showPpfmList"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div id="piclist" style="display: none;">
                    <br>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <div class="table-responsive">
                    <table class="table" id="zero-conf11">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 1%;">#</th>
                                <th scope="col" style="width: 25%;">PIC</th>
                                <th scope="col" style="width: 10%;">Total</th>
                                <th scope="col" style="width: 10%;">Open</th>
                                <th scope="col" style="width: 10%;">Closed</th>
                                <th scope="col" style="width: 10%;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (isset($picperform)) : ?>
                                <?php foreach ($picperform as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row['fullname'] ?></td>
                                        <td><?= $row['total'] ?></td>
                                        <td class="text-center" style="vertical-align : middle;text-align:center;">
                                            <?php if($row['open'] != 0) { ?>
                                            <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #f55e5e; color: white">
                                            <?php } else { ?>
                                            <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #36a1ea; color: white">
                                            <?php } ?>
                                            <?= $row['open'] ?>
                                        </td>
                                        <td><?= $row['done'] ?></td>
                                        <td><?= $row['percent']; ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none;" id="cost">
        <!-- Stats -->
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Last Update</th>
                                        <th scope="col">Budget Project</th>
                                        <th scope="col">Launch Cost</th>
                                        <th scope="col">Material Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?= $lastupdatedfinance ?></td>
                                    <td><span class="dot-<?= $statfinance['budget'] ?>"></span></td>
                                    <td><span class="dot-<?= $statfinance['launch_cost'] ?>"></span></td>
                                    <td><span class="dot-<?= $statfinance['material_cost'] ?>"></span></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h5 class="card-title">Budget Project</h5>
                                </div>
                                <div class="text-left">
                                    <?php if (user()->role != 'user') : ?>
                                        <button type="button" data-toggle="modal" data-target="#editBudget" class="btn btn-success btn-sm">Edit Budget</button>
                                    <?php endif ?>
                                </div>
                                <br><br>
                                <canvas id="Budget" width="100px"></canvas>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h5 class="card-title">Launch Cost Project</h5>
                                </div>
                                <div class="text-left">
                                    <?php if (user()->role != 'user') : ?>
                                        <button type="button" data-toggle="modal" data-target="#editCost" class="btn btn-success btn-sm">Edit Launch Cost</button>
                                    <?php endif ?>
                                </div>
                                <br><br>
                                <canvas id="LaunchCost" width="100px"></canvas>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6">
                                <div class="text-center">
                                    <h5 class="card-title">Material Cost</h5>
                                </div>
                                <div class="text-left">
                                    <?php if (user()->role != 'user') : ?>
                                        <button type="button" data-toggle="modal" data-target="#editMaterial" class="btn btn-success btn-sm">Edit Material</button>
                                    <?php endif ?>
                                </div>
                                <br><br>
                                <canvas id="Material" width="100px"></canvas>
                            </div>
                            <div class="col-6">
                                <!-- <div class="text-center">
                                    <h5 class="card-title">Cek</h5>
                                </div>
                                <br><br>
                                <canvas id="canvas" width="100px"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: none;" id="qualityDetails">
        <div class="card card-transparent">
            <!-- Stats -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Last Update</th>
                                            <th scope="col">ISSUE CUSTOMER @DEVELOPMENT</th>
                                            <th scope="col">ISSUE CUSTOMER @SAFE LAUNCH</th>
                                            <th scope="col">CUSTOMER PPAP</th>
                                            <th scope="col">SUPPLIER PPAP</th>
                                            <th scope="col">PV TEST STATUS</th>
                                            <th scope="col">PV TEST SUMMARY</th>
                                            <th scope="col">COMPONEN APPROVAL STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><?= $lastupdatedquality ?></td>
                                        <td>
                                            <?php
                                            foreach($quality as $row){ $statqualdev[] = $row->status; } 
                                            if(!isset($statqualdev)){ $statqualdev = []; }
                                            if(in_array('Open',$statqualdev)){
                                                echo '<span class="dot-red">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($issueSafelaunch as $row){ $statqualsl[] = $row->status; } 
                                            if(!isset($statqualsl)){ $statqualsl = []; }
                                            if(in_array('Open',$statqualsl)){
                                                echo '<span class="dot-red">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($issueCustPPAP as $row){ $statqualppap[] = $row->flag; } 
                                            if(!isset($statqualppap)){ $statqualppap = []; }
                                            if(in_array('Red',$statqualppap)){
                                                echo '<span class="dot-red">';
                                            } elseif (in_array('Yellow',$statqualppap)) {
                                                echo '<span class="dot-yellow">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($issueSupPPAP as $row){ $statqualsup[] = $row->flag; } 
                                            if(!isset($statqualsup)){ $statqualsup = []; }
                                            if(in_array('Red',$statqualsup)){
                                                echo '<span class="dot-red">';
                                            } elseif (in_array('Yellow',$statqualsup)) {
                                                echo '<span class="dot-yellow">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($pvtest as $row){ $statqualpv[] = $row->flag; } 
                                            if(!isset($statqualpv)){ $statqualpv = []; }
                                            if(in_array('Red',$statqualpv)){
                                                echo '<span class="dot-red">';
                                            } elseif (in_array('Yellow',$statqualpv)) {
                                                echo '<span class="dot-yellow">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($pvtestsum as $row){ $statqualpvsum[] = $row->flag; } 
                                            if(!isset($statqualpvsum)){ $statqualpvsum = []; }
                                            if(in_array('Red',$statqualpvsum)){
                                                echo '<span class="dot-red">';
                                            } elseif (in_array('Yellow',$statqualpvsum)) {
                                                echo '<span class="dot-yellow">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach($cas as $row){ $statqualcas[] = $row->flag; } 
                                            if(!isset($statqualcas)){ $statqualcas = []; }
                                            if(in_array('Red',$statqualcas)){
                                                echo '<span class="dot-red">';
                                            } elseif (in_array('Yellow',$statqualcas)) {
                                                echo '<span class="dot-yellow">';
                                            } else {
                                                echo '<span class="dot-green">';
                                            }
                                            ?>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quality Issue Development -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Issue Customer @Development </h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="addCustDev" data-toggle="modal" data-target="#addQuality" class="btn btn-primary">Add Issue</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showCustDev"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="custdevvv" style="display: none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf2">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Event</th>
                                                <th scope="col" style="width: 20%;">Date</th>
                                                <th scope="col" style="width: 40%;">Issue</th>
                                                <th scope="col" style="width: 20%;">Description</th>
                                                <th scope="col" style="width: 20%;">Lead</th>
                                                <th scope="col" style="width: 20%">Status</th>
                                                <th scope="col" style="width: 20%">Closing Action</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($quality)) : ?>
                                                <?php foreach ($quality as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->event_name ?></td>
                                                        <td><?= date("d M Y", strtotime($row->date)) ?></td>
                                                        <td><?= $row->issue ?></td>
                                                        <td><?= $row->description ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td>
                                                            <span class="bcstm bcstm-<?= ($row->status == 'Open') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                                <?= $row->status ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $row->closing_action ?></td>
                                                        <td>
                                                            <!-- <a data-toggle="modal" type="button" style="color: white;" data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a> -->
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editQuality<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delIssueDev(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality Issue Safe Launch -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Issue Customer @Safe Launch </h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="addCustSl" data-toggle="modal" data-target="#addIssueSL" class="btn btn-primary">Add Issue</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showCustSl"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="custsl" style="display: none;">
                            <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf6">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Event</th>
                                                <th scope="col" style="width: 20%;">Date</th>
                                                <th scope="col" style="width: 40%;">Issue</th>
                                                <th scope="col" style="width: 20%;">Description</th>
                                                <th scope="col" style="width: 20%;">Lead</th>
                                                <th scope="col" style="width: 20%">Status</th>
                                                <th scope="col" style="width: 20%">Closing Action</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($issueSafelaunch)) : ?>
                                                <?php foreach ($issueSafelaunch as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->event_name ?></td>
                                                        <td><?= date("d M Y", strtotime($row->date)) ?></td>
                                                        <td><?= $row->issue ?></td>
                                                        <td><?= $row->description ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td>
                                                            <span class="bcstm bcstm-<?= ($row->status == 'Open') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                                <?= $row->status ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $row->closing_action ?></td>
                                                        <td>
                                                            <!-- <a data-toggle="modal" type="button" style="color: white;" data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a> -->
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editIssueSl<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delIssueSl(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality Issue Customer PPAP -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Customer PPAP </h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="btnAddCustPpap" data-toggle="modal" data-target="#addCustPpap" class="btn btn-primary">Add Entry</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showCustPpap"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="custppap" style="display: none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf8">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Event</th>
                                                <th scope="col" style="width: 20%;">Required Items</th>
                                                <th scope="col" style="width: 40%;">Submission Date</th>
                                                <th scope="col" style="width: 20%;">PIC</th>
                                                <th scope="col" style="width: 20%">Status</th>
                                                <th scope="col" style="width: 20%">Flag</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($issueCustPPAP)) : ?>
                                                <?php foreach ($issueCustPPAP as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->event_name ?></td>
                                                        <td><?= $row->required_items ?></td>
                                                        <td><?= date("d M Y", strtotime($row->submission_date)) ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td>
                                                            <span class="bcstm bcstm-<?= ($row->status == 'Open') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                                <?= $row->status ?>
                                                            </span>
                                                        </td>
                                                        <td><span class="bcstm bcstm-<?= ($row->flag == 'Red') ? 'danger' : (($row->flag == 'Yellow') ? 'warning' : 'primary') ?>">&empty;</span></td>
                                                        <td>
                                                            <!-- <a data-toggle="modal" type="button" style="color: white;" data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a> -->
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editIssueCustPPAP<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delIssueCustPPAP(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality Issue Supplier PPAP -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Supplier PPAP </h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="btnAddSupPpap" data-toggle="modal" data-target="#addSupPpap" class="btn btn-primary">Add Entry</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showSupPpap"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="supppap" style="display : none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf9">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Supplier</th>
                                                <th scope="col" style="width: 20%;">Component</th>
                                                <th scope="col" style="width: 40%;">Target Date</th>
                                                <th scope="col" style="width: 20%;">PIC</th>
                                                <th scope="col" style="width: 20%">Status</th>
                                                <th scope="col" style="width: 20%">Flag</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($issueSupPPAP)) : ?>
                                                <?php foreach ($issueSupPPAP as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->supplier ?></td>
                                                        <td><?= $row->component ?></td>
                                                        <td><?= date("d M Y", strtotime($row->target_date)) ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td>
                                                            <span class="bcstm bcstm-<?= ($row->status == 'Open') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                                <?= $row->status ?>
                                                            </span>
                                                        </td>
                                                        <td><span class="bcstm bcstm-<?= ($row->flag == 'Red') ? 'danger' : (($row->flag == 'Yellow') ? 'warning' : 'primary') ?>">&empty;</span></td>
                                                        <td>
                                                            <!-- <a data-toggle="modal" type="button" style="color: white;" data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a> -->
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editIssueSupPPAP<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delIssueSupPPAP(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality PV Test Status -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">PV Test Status </h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="btnAddPvTest" data-toggle="modal" data-target="#addPvTest" class="btn btn-primary">Add Issue</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showPvTest"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="pvtest" style="display : none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf10">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Test Item</th>
                                                <th scope="col" style="width: 20%;">Planned Start</th>
                                                <th scope="col" style="width: 40%;">Planned Completed</th>
                                                <th scope="col" style="width: 20%;">Actual Start</th>
                                                <th scope="col" style="width: 20%">Actual Completed</th>
                                                <th scope="col" style="width: 20%">Result</th>
                                                <th scope="col" style="width: 20%">Flag</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($pvtest)) : ?>
                                                <?php foreach ($pvtest as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->test_item ?></td>
                                                        <td><?= date("d M Y", strtotime($row->plan_start)) ?></td>
                                                        <td><?= date("d M Y", strtotime($row->plan_completed)) ?></td>
                                                        <td><?= date("d M Y", strtotime($row->actual_start)) ?></td>
                                                        <td><?= date("d M Y", strtotime($row->actual_completed)) ?></td>
                                                        <td><?= $row->result ?></td>
                                                        <td><span class="bcstm bcstm-<?= ($row->flag == 'Red') ? 'danger' : (($row->flag == 'Yellow') ? 'warning' : 'primary') ?>">&empty;</span></td>
                                                        <td>
                                                            <!-- <a data-toggle="modal" type="button" style="color: white;" data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a> -->
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editPvTest<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delPvTest(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality PV Test Sum -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">PV Test Summary</h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" id="btnAddPvTestSum" data-toggle="modal" data-target="#addPvTestSum" class="btn btn-primary">Add Entry</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showPvTestSum"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="pvtestsum" style="display : none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf14">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Total test</th>
                                                <th scope="col" style="width: 20%;">Test Done</th>
                                                <th scope="col" style="width: 40%;">Past First Test</th>
                                                <th scope="col" style="width: 20%">Flag</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($pvtestsum)) : ?>
                                                <?php foreach ($pvtestsum as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->total_test ?></td>
                                                        <td><?= $row->test_done ?></td>
                                                        <td><?= $row->past_first_test ?>%</td>
                                                        <td><span class="bcstm bcstm-<?= ($row->flag == 'Red') ? 'danger' : (($row->flag == 'Yellow') ? 'warning' : 'primary') ?>">&empty;</span></td>
                                                        <td>
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editPvTestSum<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delPvTestSum(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
            <!-- Quality Componen Approval Status -->
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Componen Approval Status</h5>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <?php if (user()->department_id == 3) : ?>
                                            <button type="button" style="display: none;" data-target="#addCas" id="btnAddcas" data-toggle="modal" class="btn btn-primary">Add Entry</button>
                                        <?php endif ?>
                                        <button class="btn btn-secondary ml-3" id="showcas" ><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="cas" style="display : none;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="zero-conf12">  
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">#</th>
                                                <th scope="col" style="width: 5%;">Comp.</th>
                                                <th scope="col" style="width: 20%;">Supplier</th>
                                                <th scope="col" style="width: 40%;">SC Point</th>
                                                <th scope="col" style="width: 20%">ESER/AAR Stat</th>
                                                <th scope="col" style="width: 20%">Remark</th>
                                                <th scope="col" style="width: 20%">Lead</th>
                                                <th scope="col" style="width: 20%">Status</th>
                                                <th scope="col" style="width: 20%">Flag</th>
                                                <th scope="col" style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (isset($cas)) : ?>
                                                <?php foreach ($cas as $row) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= $row->component ?></td>
                                                        <td><?= $row->supplier ?></td>
                                                        <td><?= $row->sc_point ?>%</td>
                                                        <td><?= $row->eser_aar_status ?></td>
                                                        <td><?= $row->remark ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td><span class="bcstm bcstm-<?= ($row->status == 'Red') ? 'danger' : (($row->status == 'Yellow') ? 'warning' : 'primary') ?>"><?= $row->status ?></span></td>
                                                        <td><span class="bcstm bcstm-<?= ($row->flag == 'Red') ? 'danger' : (($row->flag == 'Yellow') ? 'warning' : 'primary') ?>">&empty;</span></td>
                                                        <td>
                                                            <?php if (user()->department_id == 3) { ?>
                                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#editCas<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                                            <a type="button" class="badge badge-danger" onclick="delCas(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
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
    <div class="row" style="display: none;" id="productivity">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Productivity list</h5>
                        </div>
                        <?php if (user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                            <div class="col-6">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#addProductivity" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                    <table id="complex-header" class="table table-prod">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="width:10%; vertical-align : middle;text-align:center;">Event</th>
                            <th rowspan="2" class="text-center" style="width:20%; vertical-align : middle;text-align:center;">Station</th>
                            <th colspan="2" class="text-center" style="width:15%;">Cycle Time(s)</th>
                            <th colspan="2" class="text-center" style="width:15%;">FTT(%)</th>
                            <th colspan="2" class="text-center" style="width:10%;">Rejection Rate(%)</th>
                            <th colspan="2" class="text-center" style="width:10%;">Available Time(s)</th>
                            <th rowspan="2" class="text-center" style="width:20%; vertical-align : middle;text-align:center;">Action</th>
                            <th rowspan="2" class="text-center col-sm-4" style="width:20%; margin-left:10px; vertical-align : middle;text-align:center;">Graph</th>
                        </tr>
                        <tr>
                            <th>Target</th>
                            <th>Actual</th>
                            <th>Target</th>
                            <th>Actual</th>
                            <th>Target</th>
                            <th>Actual</th>
                            <th>Target</th>
                            <th>Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 1 ?>
                        <?php if(isset($productivity)) : ?>
                            <?php foreach($productivity as $row) : ?>
                            <tr>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->event_name ?></td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->station ?>
                                </td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->ct_target ?>s</td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?php if($row->ct_actual<$row->ct_target) { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #36a1ea; color: white">
                                <?php } else { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #f55e5e; color: white">
                                <?php } ?>
                                <?= $row->ct_actual ?>s</td>
                                </span>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->ftt_target ?>%</td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?php if($row->ftt_actual>$row->ftt_target) { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #36a1ea; color: white">
                                <?php } else { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #f55e5e; color: white">
                                <?php } ?>
                                <?= $row->ftt_actual ?>%</td>
                                </span>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->rr_target ?>%</td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?php if($row->rr_actual<$row->rr_target) { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #36a1ea; color: white">
                                <?php } else { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #f55e5e; color: white">
                                <?php } ?>
                                <?= $row->rr_actual ?>%</td>
                                </span>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->at_target ?>s</td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?php if($row->at_actual<$row->at_target) { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #36a1ea; color: white">
                                <?php } else { ?>
                                <span style="padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; background-color: #f55e5e; color: white">
                                <?php } ?>
                                <?= $row->at_actual ?>s</td>
                                </span>
                                <td>
                                    <?php if (user()->section == 'Project Manager' || user()->role == 'admin' || user()->role == 'ame') { ?>
                                    <a data-toggle="modal" type="button" style="color: white;" data-target="#editProductivity<?= $row->id ?>"
                                        class="badge badge-primary mb-2"><span class="material-icons">edit</span></a>
                                    <a type="button" class="badge badge-danger"
                                        onclick="delProductivity(<?= $row->id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span class="material-icons"
                                            style="color: white;">delete</span></a>
                                    <?php } else { ?>
                                    -
                                    <?php } ?>
                                </td>
                                <td class="text-center" style="vertical-align : middle;text-align:center;">
                                <?= $row->event_name ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal New Task -->
    <div class="modal fade bd-example-modal-lg" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/addtask/<?= $id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1" style="display: none; width: 100%">
                                <?php if (isset($eventInternal)) : ?>
                                    <?php foreach ($eventInternal as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" id="new-task-name" placeholder="Task" name="concern" required>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <div>
                                <div class="input-group">
                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" id="e" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PIC</label>
                            <select required class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                <?php foreach ($user as $us) : ?>
                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Route</label>
                                    <?php for ($x = 1; $x < 6; $x++) : ?>
                                        <div class="form-group">
                                            <select disabled class="route<?= $x ?> js-states form-control" tabindex="-1" style="display: none; width: 100%" name="route_num[]">
                                                <option value="-">-</option>
                                                <?php for ($r = 1; $r < 6; $r++) : ?>
                                                    <option value="<?= $r ?>"><?= $r ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label>User Approval</label>
                                    <?php for ($x = 1; $x < 6; $x++) : ?>
                                        <div class="form-group">
                                            <select disabled class="userapp<?= $x ?> js-states form-control" name="lau[]" tabindex="-1" style="display: none; width: 100%">
                                                <option value="--Choose--">--Choose--</option>
                                                <?php foreach ($user as $us) : ?>
                                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Required Attachment File</label>
                            <select class="js-states form-control" name="required_file" tabindex="-1" style="display: none; width: 100%;" required aria-placeholder="Choose">
                                <option value="" hidden>-- Choose --</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                </div>
                <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <?php if (isset($count_task)) :  ?>
                    <input type="hidden" name="task_id" value="<?= $count_task->id ?>">
                <?php endif ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add Child Task -->
    <?php foreach ($project as $prj) : ?>
    <div class="modal fade bd-example-modal-lg" id="addChildTask<?= $prj->task_id ?>" tabindex="-1" role="dialog"
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
                    <form action="<?= base_url('') ?>/task/addChildTask/<?= $prj->task_id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" placeholder="<?= $prj->event_name ?>" name="event"
                                        readonly value="<?= $prj->event_name ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent Task</label>
                                    <input type="text" class="form-control" value="<?= $prj->concern ?>" readonly>
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
                                    <input type="text" class="form-control" readonly value="<?= $prj->fullname ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Required Attachment File</label>
                                    <select class="js-states form-control" name="required_file" tabindex="-1"
                                        style="display: none; width: 100%;" required aria-placeholder="Choose">
                                        <option value="">-- Choose --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" class="form-control" name="user_app" readonly value="<?= $prj->pic ?>">
                <input type="hidden" name="fproj" value="1">
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <input type="hidden" name="project_id" value="<?= $id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- Modal Request Approval Child Task -->
    <?php foreach ($child_task as $ct) : ?>
    <div class="modal fade bd-example-modal-lg" id="updateChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Child Task</h5>
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
                                    <input type="text" class="form-control" value="<?= $ct->fullname ?>" name="pic" required
                                        readonly>
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
                                    <label>Request Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy" name="due_date"
                                                value="<?= date('Y-m-d', time()) ?>" required readonly>
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
                                                value="<?= date('Y-m-d', strtotime($ct->due_date)) ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="required_file" value="<?= $ct->c_file ?>">
                        <input type="hidden" name="project_name" value="<?= $ct->project_name ?>">
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
                            <?php if (isset($ct->namafile)) { ?>
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
                                                        href="<?= base_url('public') ?>/theme/assets/document/<?= $ct->project_name ?>/<?= $ct->namafile ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $ct->namafile ?></p>
                                                <span class="file-size"></span><br>
                                                <span class="file-date">Upload at:
                                                    <?= date('d M Y', strtotime($ct->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } elseif ($ct->cstat != 'In Progress' && $ct->namafile == NULL) { ?>
                            <div class="col-lg-4">
                                <label for="">File</label>
                                <input type="text" readonly class="form-control" value="No Attachment File" name="" id="">
                            </div>
                            <?php } ?>
                        </div>
                        <?php if (isset($ct->desc)) : ?>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" readonly name="notes" rows="3"><?= $ct->desc ?></textarea>
                        </div>
                        <?php endif ?>
                        <div class="modal-footer">
                            
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- Modal Add Issue Quality Development-->
    <div class="modal fade bd-example-modal-lg" id="addQuality" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Issue CUSTOMER @DEVELOPMENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addquality" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1" style="display: none; width: 100%">
                                <?php if (isset($eventCustomer)) : ?>
                                    <?php foreach ($eventCustomer as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Issue</label>
                            <input type="text" class="form-control" placeholder="Issue" name="issue" required>
                        </div>
                        <div class="form-group">
                            <label>Lead</label>
                            <select class="js-states form-control" name="lead" tabindex="-1" style="display: none; width: 100%">
                                <?php foreach ($user as $us) : ?>
                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" required class="form-control" id="" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Closing Action</label>
                            <input type="text" class="form-control" placeholder="Closing Action" name="closing_action" required>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add Issue Quality Safe Launch-->
    <div class="modal fade bd-example-modal-lg" id="addIssueSL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Issue CUSTOMER @Safe Launch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addqualitysl" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1" style="display: none; width: 100%">
                                <?php if (isset($eventCustomer)) : ?>
                                    <?php foreach ($eventCustomer as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Issue</label>
                            <input type="text" class="form-control" placeholder="Issue" name="issue" required>
                        </div>
                        <div class="form-group">
                            <label>Lead</label>
                            <select class="js-states form-control" name="lead" tabindex="-1" style="display: none; width: 100%">
                                <?php foreach ($user as $us) : ?>
                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" required class="form-control" id="" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Closing Action</label>
                            <input type="text" class="form-control" placeholder="Closing Action" name="closing_action" required>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add Issue Quality Cust PPAP-->
    <div class="modal fade bd-example-modal-lg" id="addCustPpap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Issue CUSTOMER PPAP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addqcustppap" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1" style="display: none; width: 100%">
                                <?php if (isset($eventCustomer)) : ?>
                                    <?php foreach ($eventCustomer as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Required Items</label>
                            <input type="text" class="form-control" placeholder="Item" name="required_items" required>
                        </div>
                        <div class="form-group">
                            <label>Submission Date</label>
                                <div>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" id="e" name="submission_date" value="<?= date('d/m/Y', time()) ?>" required>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label>PIC</label>
                            <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                <?php foreach ($user as $us) : ?>
                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add Issue Quality Sup PPAP-->
    <div class="modal fade bd-example-modal-lg" id="addSupPpap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Issue Supplier PPAP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addqsupppap" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" placeholder="Supplier" name="supplier" required>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Component</label>
                            <input type="text" class="form-control" placeholder="Component" name="component" required>
                        </div>
                        <div class="form-group">
                            <label>Target Date</label>
                                <div>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" id="e" name="target_date" required>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label>PIC</label>
                            <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                <?php foreach ($user as $us) : ?>
                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add PV Test Status-->
    <div class="modal fade bd-example-modal-lg" id="addPvTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New PV Test Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addpvstatus" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Test Item</label>
                            <input type="text" class="form-control" placeholder="Test Item" name="test_item" required>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Planned Start</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="plan_start" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Planned Completed</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="plan_completed" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Actual Start</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="actual_start" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Actual Completed</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="actual_completed" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Result</label>
                            <input type="text" class="form-control" placeholder="Result" name="result" required>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add PV Test Summary-->
    <div class="modal fade bd-example-modal-md" id="addPvTestSum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New PV Test Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addpvsummary" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Total Test</label>
                            <input type="text" class="form-control" placeholder="Total Test" name="total_test" required>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Test Done</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Test Done" name="test_done" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Past First Test</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Past First Test" name="past_first_test" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add Component Approval Status-->
    <div class="modal fade bd-example-modal-md" id="addCas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Component Approval Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addcas" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Component</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Component" name="component" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Supplier</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Supplier" name="supplier" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>SC Point (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="SC Point (%)" name="sc_point" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>All Point (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="All Point (%)" name="all_point" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Cp/Cpk Compliance (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Cp/Cpk Compliance (%)" name="compliance" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Visual</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Visual" name="visual" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Component Level Testing</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Component Level Testing" name="clt" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>ESER/AAR status</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="ESER/AAR status" name="eser_aar_status" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Remark</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Remark" name="remark" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Lead</label>
                                    <div class="input-group">
                                        <select class="js-states form-control" name="lead" tabindex="-1" style="display: none; width: 100%">
                                            <?php foreach ($user as $us) : ?>
                                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal View Quality -->
    <?php foreach ($quality as $row) : ?>
        <div class="modal fade bd-example-modal-lg" id="viewQuality<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details Quality</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/addquality" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Event</label>
                                        <input type="text" name="event" readonly class="form-control" value="<?= $row->event ?>" id="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Lead</label>
                                        <input type="text" class="form-control" readonly name="issue" value="<?= $row->fullname ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="project_id" value="<?= $id ?>">
                            <div class="form-group">
                                <label>Issue</label>
                                <input type="text" class="form-control" readonly name="issue" value="<?= $row->issue ?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" readonly class="form-control" id="" rows="3"><?= $row->description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Closing Action</label>
                                <input type="text" class="form-control" placeholder="Closing Action" name="closing_action" readonly value="<?= $row->closing_action ?>">
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button> -->
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php $i = 1;
    $y = 2; ?>
    <!-- Modal Edit Issue Development-->
    <?php foreach ($quality as $row) : ?>
        <div class="modal fade bd-example-modal-md" id="editQuality<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Issue Development</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editquality/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Issue</label>
                                <input type="text" class="form-control" name="issue" value="<?= $row->issue ?>">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Description</label>
                                <textarea name="description" cols="30" class="form-control" rows="3"><?= $row->description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                    <option value="Closed" <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Closing Action</label>
                                <input type="text" class="form-control" name="closing_action" value="<?= $row->closing_action ?>">
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Issue Safe Launch-->
    <?php foreach ($issueSafelaunch as $row) : ?>
        <div class="modal fade" id="editIssueSl<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Issue Safe Launch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editqualitysl/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Issue</label>
                                <input type="text" class="form-control" name="issue" value="<?= $row->issue ?>">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Description</label>
                                <textarea name="description" cols="30" class="form-control" rows="3"><?= $row->description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                    <option value="Closed" <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-form-label">Closing Action</label>
                                <input type="text" class="form-control" name="closing_action" value="<?= $row->closing_action ?>">
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Issue Customer PPAP-->
    <?php foreach ($issueCustPPAP as $row) : ?>
        <div class="modal fade" id="editIssueCustPPAP<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Issue Customer PPAP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editqualitycustppap/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                    <option value="Closed" <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Flag</label>
                                <select class="js-states form-control" name="flag" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Red" <?= ($row->flag == 'Red') ? 'selected' :  '' ?>>Red</option>
                                    <option value="Yellow" <?= ($row->flag == 'Yellow') ? 'selected' :  '' ?>>Yellow</option>
                                    <option value="Green" <?= ($row->flag == 'Green') ? 'selected' :  '' ?>>Green</option>
                                </select>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Issue Suppplier PPAP-->
    <?php foreach ($issueSupPPAP as $row) : ?>
        <div class="modal fade" id="editIssueSupPPAP<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Issue Suppplier PPAP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editqualitysupppap/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                    <option value="Closed" <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Flag</label>
                                <select class="js-states form-control" name="flag" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Red" <?= ($row->flag == 'Red') ? 'selected' :  '' ?>>Red</option>
                                    <option value="Yellow" <?= ($row->flag == 'Yellow') ? 'selected' :  '' ?>>Yellow</option>
                                    <option value="Green" <?= ($row->flag == 'Green') ? 'selected' :  '' ?>>Green</option>
                                </select>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Test Status-->
    <?php foreach ($pvtest as $row) : ?>
        <div class="modal fade" id="editPvTest<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pv Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editpvtest/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Flag</label>
                                <select class="js-states form-control" name="flag" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Red" <?= ($row->flag == 'Red') ? 'selected' :  '' ?>>Red</option>
                                    <option value="Yellow" <?= ($row->flag == 'Yellow') ? 'selected' :  '' ?>>Yellow</option>
                                    <option value="Green" <?= ($row->flag == 'Green') ? 'selected' :  '' ?>>Green</option>
                                </select>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Test Summary-->
    <?php foreach ($pvtestsum as $row) : ?>
        <div class="modal fade" id="editPvTestSum<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pv Test Summary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/quality/editpvtestsum/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Flag</label>
                                <select class="js-states form-control" name="flag" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Red" <?= ($row->flag == 'Red') ? 'selected' :  '' ?>>Red</option>
                                    <option value="Yellow" <?= ($row->flag == 'Yellow') ? 'selected' :  '' ?>>Yellow</option>
                                    <option value="Green" <?= ($row->flag == 'Green') ? 'selected' :  '' ?>>Green</option>
                                </select>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Test Summary-->
    <?php foreach ($cas as $row) : ?>
    <div class="modal fade bd-example-modal-md" id="editCas<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Component Approval Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/editcas/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Component</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Component" name="component" value="<?= $row->component ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Supplier</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Supplier" name="supplier" value="<?= $row->supplier ?>"  required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="project_id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>SC Point (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="SC Point (%)" name="sc_point" value="<?= $row->sc_point ?>"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>All Point (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="All Point (%)" value="<?= $row->all_point ?>"  name="all_point" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Cp/Cpk Compliance (%)</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Cp/Cpk Compliance (%)" value="<?= $row->cpcpk_compliance ?>"  name="compliance" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Visual</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Visual" value="<?= $row->visual ?>"  name="visual" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Component Level Testing</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Component Level Testing" value="<?= $row->component_level_testing ?>"  name="clt" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>ESER/AAR status</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="ESER/AAR status" value="<?= $row->eser_aar_status ?>"  name="eser_aar_status" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Remark</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Remark" value="<?= $row->remark ?>"  name="remark" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Lead</label>
                                    <div class="input-group">
                                        <select class="js-states form-control" name="lead" tabindex="-1" style="display: none; width: 100%">
                                            <option value="<?= $row->lead ?>"><?= $row->fullname ?></option>
                                            <?php foreach ($user as $us) : ?>
                                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Status</label>
                                    <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                        <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                        <option value="Closed" <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Flag</label>
                                    <select class="js-states form-control" name="flag" tabindex="-1" style="display: none; width: 100%">
                                        <option value="Red" <?= ($row->flag == 'Red') ? 'selected' :  '' ?>>Red</option>
                                        <option value="Yellow" <?= ($row->flag == 'Yellow') ? 'selected' :  '' ?>>Yellow</option>
                                        <option value="Green" <?= ($row->flag == 'Green') ? 'selected' :  '' ?>>Green</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <!-- Modal Edit Event Customer -->
    <?php foreach ($eventCustomer as $row) : ?>
        <div class="modal fade" id="editEventCust<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Event Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/editEventCust/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Event Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="event_name" class="form-control" value="<?= $row->event_name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Start</label>
                                <div class="col-sm-9">
                                    <input type="date" name="start" class="form-control" value="<?= $row->start ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Finish</label>
                                <div class="col-sm-9">
                                    <input type="date" name="end" class="form-control" value="<?= $row->end ?>">
                                </div>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Event Internal -->
    <?php foreach ($eventInternal as $row) : ?>
        <div class="modal fade" id="editEventInt<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Event Internal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/editEventInt/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Event Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="event_name" class="form-control" value="<?= $row->event_name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Start</label>
                                <div class="col-sm-9">
                                    <input type="date" name="start" class="form-control" value="<?= $row->start ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Finish</label>
                                <div class="col-sm-9">
                                    <input type="date" name="end" class="form-control" value="<?= $row->end ?>">
                                </div>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Productivity -->
    <?php foreach ($productivity as $row) : ?>
        <div class="modal fade" id="editProductivity<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/productivity/editProductivity/<?= $row->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Event</label>
                                <div class="col-sm-6">
                                    <input type="text" name="event" class="form-control" value="<?= $row->event_name ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Station</label>
                                <div class="col-sm-6">
                                    <input type="text" name="station" class="form-control" value="<?= $row->station ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Cycle Time Target</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ct_target" class="form-control" value="<?= $row->ct_target ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Cycle Time Actual</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ct_actual" class="form-control" value="<?= $row->ct_actual ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">FTT Target</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ftt_target" class="form-control" value="<?= $row->ftt_target ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">FTT Actual</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ftt_actual" class="form-control" value="<?= $row->ftt_actual ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Rejection Rate Target</label>
                                <div class="col-sm-6">
                                    <input type="number" name="rr_target" class="form-control" value="<?= $row->rr_target ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Rejection Rate Actual</label>
                                <div class="col-sm-6">
                                    <input type="number" name="rr_actual" class="form-control" value="<?= $row->rr_actual ?>">
                                </div>
                            </div>
                    </div>
                    <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit Picture -->
    <div class="modal fade" id="editPict" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Picture Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/project/editPict" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" name="photo" class="filestyle"">
                            </div>
                        </div>
                        <input type="hidden" name="idc" value="<?= $customer->id ?>">
                        <input type="hidden" name="photo_lama" value="<?= $projectrow->pict ?>">
                                <input type="hidden" name="project_id" value="<?= $id ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View Graph Productivity -->
    <?php if(isset($resEventProd)) : ?>
    <?php foreach($resEventProd as $key => $value) : ?>
    <div class="modal fade" id="viewGraphProd<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title text-center">Graph Productivity <?= $key ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="modal-title text-center"><?= $key ?></h5>
                            <canvas id="Productivity<?= $key ?>" width="100px"></canvas>
                        </div>
                        <div class="col-6">
                            <h5 class="modal-title text-center">Cycle Time</h5>
                            <canvas id="cycleTime<?= $key ?>" width="100px"></canvas>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="modal-title text-center">FFT</h5>
                            <canvas id="ftt<?= $key ?>" width="100px"></canvas>
                        </div>
                        <div class="col-6">
                            <h5 class="modal-title text-center">Rejection Rate</h5>
                            <canvas id="rr<?= $key ?>" width="100px"></canvas>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <?php endif ?>
    <!-- Modal View Task Detail -->
        <?php if (isset($project)) : ?>
            <?php foreach ($project as $prj) : ?>
                <div class="modal fade bd-example-modal-lg" id="updateTask<?= $prj->task_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Task</h5>
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
                                                <label>Last Update</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('Y-m-d', strtotime($prj->updated_at)) ?>" required readonly>
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
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleFormControlTextarea1">User Approval Request</label>
                                            <ul class="list-group">
                                                <?php foreach ($apu as $prove) : ?>
                                                    <?php $prove_user[] = $prove->approve_user; ?>
                                                    <?php if ($prj->task_id == $prove->a_task_id) : ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= $prove->routes ?>. <?= $prove->fullname ?>
                                                                <?php if ($prove->t_app >= $prove->ap && $prj->status == 'Revise') : ?>
                                                                    <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                                                <?php endif ?>
                                                                <?php if ($prove->ap == 202) : ?>
                                                                    <span class="badge bg-primary rounded-pill" style="color: white;">✔</span>
                                                                <?php endif ?>
                                                            </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php if (isset($prj->namafile)) { ?>
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
                                                                <p><?= $prj->namafile ?></p>
                                                                <span class="file-size">
                                                                    <?php
                                                                    $filesize = filesize('public/theme/assets/document/' . $prj->project_name . '/' . $prj->namafile);
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
                                                                    <?= date('d M Y', strtotime($prj->request_at)) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } elseif ($prj->status != 'In Progress' && $prj->namafile == NULL) { ?>
                                            <div class="col-lg-4">
                                                <label for="">File</label>
                                                <input type="text" class="form-control" value="No Attachment File" readonly name="" id="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($prj->pic == user()->id) : ?>
                                        <div class="form-group" id="divParalel<?= $prj->task_id ?>" style="display: none;">
                                            <label>User Approval</label>
                                            <select class="js-states form-control" multiple="multiple" name="app[]" tabindex="-1" style="display: none; width: 100%;" aria-placeholder="Choose">
                                                <?php foreach ($user as $us) : ?>
                                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="row" id="divRoute<?= $prj->task_id ?>" style="display: none;">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="">Route</label>
                                                    <?php for ($x = 1; $x < 6; $x++) : ?>
                                                        <div class="form-group">
                                                            <select class="js-states form-control" name="numroot" tabindex="-1" style="display: none; width: 100%">
                                                                <option value="<?= $x ?>"><?= $x ?></option>
                                                            </select>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label>User Approval</label>
                                                    <?php for ($x = 1; $x < 6; $x++) : ?>
                                                        <div class="form-group">
                                                            <select class="js-states form-control" name="lau[]" tabindex="-1" style="display: none; width: 100%">
                                                                <option>--Choose--</option>
                                                                <?php foreach ($user as $us) : ?>
                                                                    <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Notes</label>
                                            <textarea class="form-control" name="notes" rows="3"></textarea>
                                        </div>
                                    <?php endif ?>
                                <div class="row mt-4 mb-4">
                                    <div class="col-6">
                                        <?php if (user()->level_id == 3 ) : ?>
                                            <button type="button" data-toggle="modal" data-target="#addChildTask<?= $prj->task_id ?>" data-dismiss="modal" class="btn btn-primary">Add Child Task</button>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                            <input type="hidden" name="idc" value="<?= $customer->id ?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- Modal Add Event Customer -->
        <div class="modal fade bd-example-modal-lg" id="addEventCust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Event Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/addEventCust" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="wrapper row">
                                <?php for ($x = 1; $x < 4; $x++) : ?>
                                    <div class="col-4">
                                        <div class="form-group" id="timeline<?= $x ?>">
                                            <label for="">Event</label>
                                            <input type="text" class="form-control mb-2" placeholder="Input Event" name="event_name[]">
                                            <label for="">Start</label>
                                            <input type="date" autocomplete="off" class="form-control mb-2" style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]">
                                            <label for="">Finish</label>
                                            <input type="date" autocomplete="off" class="form-control mb-2" style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="end[]">
                                        </div>
                                    </div>
                                <?php endfor ?>
                            </div>
                            <div class="row my-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="button" class="add_fields btn btn-primary">Add More</button>
                                    </div>
                                </div>
                                <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel2" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit2" class="btn btn-primary ml-2">Add</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- <div class="modal-footer" id="submit2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Add Event Internal-->
        <div class="modal fade bd-example-modal-lg" id="addEventInt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Event Internal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/addEventInt" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="wrapper row">
                                <?php for ($x = 1; $x < 4; $x++) : ?>
                                    <div class="col-4">
                                        <div class="form-group" id="timeline<?= $x ?>">
                                            <label for="">Event</label>
                                            <input type="text" class="form-control mb-2" placeholder="Input Event" name="event_name[]">
                                            <label for="">Start</label>
                                            <input type="date" autocomplete="off" class="form-control mb-2" style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]">
                                            <label for="">Finish</label>
                                            <input type="date" autocomplete="off" class="form-control mb-2" style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="end[]">
                                        </div>
                                    </div>
                                <?php endfor ?>
                            </div>
                            <div class="row my-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="button" class="add_fields btn btn-primary">Add More</button>
                                    </div>
                                </div>
                                <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel2" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit2" class="btn btn-primary ml-2">Add</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- <div class="modal-footer" id="submit2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Add Productivity-->
        <div class="modal fade bd-example-modal-xl" id="addProductivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Productivity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/productivity/addProductivity" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="wrapper row">
                                <div class="col-2 mt-3">
                                    <div class="form-group">
                                        <label for="">Event</label>
                                        <select class="js-states form-control prodEvent" id="prodEvent" name="event" tabindex="-1" style="display: none; width: 100%">
                                            <?php if (isset($eventInternal)) : ?>
                                                <?php foreach ($eventInternal as $row) : ?>
                                                    <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                                <?php endforeach; ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    <div class="form-group">
                                        <label for="">Station</label>
                                        <input type="text" class="form-control" placeholder="Input Station" name="station[]">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Cycle Time</label>
                                        <input type="number" class="form-control mb-2" placeholder="Target" name="ct_target">
                                        <input type="number" class="form-control mb-2" placeholder="Actual" name="ct_actual[]">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">FTT</label>
                                        <input type="number" class="form-control mb-2" placeholder="Target" name="ftt_target">
                                        <input type="number" class="form-control mb-2" placeholder="Actual" name="ftt_actual[]">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Rejection Rate</label>
                                        <input type="number" class="form-control mb-2" placeholder="Target" name="rr_target">
                                        <input type="number" class="form-control mb-2" placeholder="Actual" name="rr_actual[]">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Available Time</label>
                                        <input type="number" class="form-control mb-2" placeholder="Target" name="at_target">
                                        <input type="number" class="form-control mb-2" placeholder="Actual" name="at_actual[]">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                            <input type="hidden" name="idc" value="<?= $customer->id ?>">
                            <div class="row my-4">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button type="button" class="add_station btn btn-primary">Add Station</button>
                                    </div>
                                </div>
                                <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel2" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit2" class="btn btn-primary ml-2">Add</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Budget -->
        <div class="modal fade" id="editBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Budget</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/editbudget/<?= $projectrow->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Total Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="total" id="rupiah8" class="form-control" value="<?= number_format($budget->total, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tooling Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="tooling" id="rupiah9" class="form-control" value="<?= number_format($budget->tooling, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tooling Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="used_tooling" id="rupiah10" class="form-control" value="<?= number_format($budget->used_tooling, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">SMT Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="smt" id="rupiah11" class="form-control" value="<?= number_format($budget->smt, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">SMT Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="used_smt" id="rupiah12" class="form-control" value="<?= number_format($budget->used_smt, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">FA Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="fa" id="rupiah13" class="form-control" value="<?= number_format($budget->fa, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">FA Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="used_fa" id="rupiah14" class="form-control" value="<?= number_format($budget->used_fa, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Cost -->
        <div class="modal fade" id="editCost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/editlaunch/<?= $projectrow->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Total Launch Cost</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah1" name="total" class="form-control" value="<?= number_format($launch_cost->total, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">PV</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah2" name="pv" class="form-control" value="<?= number_format($launch_cost->pv, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">PV Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah3" name="used_pv" class="form-control" value="<?= number_format($launch_cost->used_pv, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Launch Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah4" name="launch" class="form-control" value="<?= number_format($launch_cost->launch, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Launch Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah5" name="used_launch" class="form-control" value="<?= number_format($launch_cost->used_launch, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Other Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah6" name="other" class="form-control" value="<?= number_format($launch_cost->other, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Other Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" id="rupiah7" name="used_other" class="form-control" value="<?= number_format($launch_cost->used_other, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Material -->
        <div class="modal fade" id="editMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Material</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/editmaterial/<?= $projectrow->id ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Total Material Cost</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="total" id="rupiah15" class="form-control" value="<?= number_format($material_cost->total, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">M-Comp Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="mcomp" id="rupiah16" class="form-control" value="<?= number_format($material_cost->mcomp, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">M-Comp Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="used_mcomp" id="rupiah17" class="form-control" value="<?= number_format($material_cost->used_mcomp, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">E-Comp Budget</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="ecomp" id="rupiah18" class="form-control" value="<?= number_format($material_cost->ecomp, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">E-Comp Used</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">IDR</span>
                                        </div>
                                        <input type="text" name="used_ecomp" id="rupiah19" class="form-control" value="<?= number_format($material_cost->used_ecomp, 0, ".", ".") ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="idc" value="<?= $customer->id ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Event Schedule Graph -->
        <script>
            var today = new Date(),
                day = 1000 * 60 * 60 * 24,
                // Utility functions
                dateFormat = Highcharts.dateFormat,
                defined = Highcharts.defined,
                isObject = Highcharts.isObject;
            today = today.getTime();

            var eventCustomer = <?= json_encode($jsonEventCustomer) ?>;
            // console.log(eventCustomer);
            var eventInternal = <?= json_encode($jsonEventInternal) ?>;
            eventInternal.sort(function(a, b) {
                return a.start - b.start;
            });
            eventCustomer.sort(function(a, b) {
                return a.start - b.start;
            });

            Highcharts.ganttChart('eventSchedule', {
                dataSorting: {
                    enabled: true,
                    sortKey: 'value'
                },
                time: {
                    useUTC: false,
                },
                series: [{
                    name: 'Customer',
                    data: eventCustomer
                }, {
                    name: 'Internal',
                    data: eventInternal
                }],
                tooltip: {
                    pointFormatter: function() {
                        var point = this,
                            format = '%e %b %Y',
                            options = point.options,
                            // completed = options.completed,
                            // amount = isObject(completed) ? completed.amount : completed,
                            // status = ((amount || 0) * 100) + '%',s
                            lines;

                        lines = [{
                            value: point.name,
                            style: 'font-weight: bold;'
                        }, {
                            title: 'Start',
                            value: dateFormat(format, point.start+86400000)
                        }, {
                            visible: !options.milestone,
                            title: 'End',
                            value: dateFormat(format, point.end+86400000)
                        }, 
                        // {
                        //     title: 'Completed',
                        //     value: status
                        // }
                    ];

                        return lines.reduce(function(str, line) {
                            var s = '',
                                style = (
                                    defined(line.style) ? line.style : 'font-size: 0.8em;'
                                );
                            if (line.visible !== false) {
                                s = (
                                    '<span style="' + style + '">' +
                                    (defined(line.title) ? line.title + ': ' : '') +
                                    (defined(line.value) ? line.value : '') +
                                    '</span><br/>'
                                );
                            }
                            return str + s;
                        }, '');
                    }
                },
                title: {
                    text: 'Grafik Schedule Project <?= $projectrow->project_name ?>'
                },
                // xAxis: [{
                //     labels: {
                //     format: '{value:%w}' // day of the week
                //     },
                //     grid: { // default setting
                //     enabled: true 
                //     },
                //     tickInterval: 1000 * 60 * 60 * 24, // Day
                // }],
                xAxis: {
                    currentDateIndicator: true,
                    min: today - 4 * day,
                    max: today + 9 * day,
                    grid: true,
                    tickInterval: 1000 * 60 * 60 * 24, // Day
                    // tickInterval: 1000 * 60 * 60 * 24 * 7 // week
                },
                navigator: {
                    enabled: true,
                    liveRedraw: true,
                    series: {
                        type: 'gantt',
                        pointPlacement: 0.5,
                        pointPadding: 0.25
                    },
                    yAxis: {
                        min: 0,
                        max: 3,
                        reversed: true,
                        categories: []
                    }
                },
                scrollbar: {
                    enabled: true,
                },
            });
        </script>

        <!-- Delete Task -->
        <script>
            function del(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this task!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/task/deletetask') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This task is safe!");
                        }
                    });
            }
            function delchildtask(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this child task!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/task/deletechildtask') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This child task is safe!");
                        }
                    });
            }
        </script>

        <!-- Delete Event Customer & internal -->
        <script>
            function delEventCust(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this event!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/project/deleteEventCust') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This event is safe!");
                        }
                    });
            }

            function delEventInt(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this event!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/project/deleteEventInt') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This event is safe!");
                        }
                    });
            }
        </script>

        <!-- Delete Quality -->
        <script>
            function delIssueDev(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this issue!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delIssueDev') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This issue is safe!");
                        }
                    });
            }

            function delIssueSl(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this issue!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delIssueSl') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This issue is safe!");
                        }
                    });
            }

            function delIssueCustPPAP(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this issue!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delIssueCustPPAP') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This issue is safe!");
                        }
                    });
            }

            function delIssueSupPPAP(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this issue!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delIssueSupPPAP') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This issue is safe!");
                        }
                    });
            }

            function delPvTest(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this pv test!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delPvTest') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This pv test is safe!");
                        }
                    });
            }

            function delPvTestSum(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this pv summary!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/quality/delPvTestSum') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This pv summary is safe!");
                        }
                    });
            }
        </script>

        <!-- Delete Productivity -->
        <script>
            function delProductivity(id, idp, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this station!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/productivity/delProductivity') ?>/${id}/${idp}/${idc}`)
                        } else {
                            swal("This station is safe!");
                        }
                    });
            }
        </script>
        
        <!-- Budget Graph -->
        <script>
            var ctx = document.getElementById("Budget");

            var data = {
                labels: ["Total", "Tooling", "SMT", "FA"],
                datasets: [{
                    label: "Budget (IDR)",
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    data: [<?= $budget->total ?>, <?= $budget->tooling ?>, <?= $budget->smt ?>, <?= $budget->fa ?>]
                }, {
                    label: "Actual Expense (IDR)",
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    data: [<?= $budget->tooling + $budget->smt + $budget->fa ?>, <?= $budget->used_tooling ?>, <?= $budget->used_smt ?>, <?= $budget->used_fa ?>]
                }]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        </script>

        <!-- Productivity Graph -->
        <?php if(isset($resEventProd)) : ?>
        <?php foreach($resEventProd as $key => $value) : ?>
        <script>
            var ctx = document.getElementById("Productivity<?= $key ?>");
            <?php foreach ($value as $row) {
                $ftt_actual[$key][] = $row['ftt_actual'];
                $rr_actual[$key][] = $row['rr_actual'];
                $ct_actual[$key][] = $row['ct_actual'];
                $ct_target = $row['ct_target'];
                $ftt_target = $row['ftt_target'];
                $rr_target = $row['rr_target'];
                // $ct_target = $row['ct_target'];
            } ?>
            var ctachieve = <?= max($ct_actual[$key]) ?>;
            var fttachieve = <?= min($ftt_actual[$key]) ?>;
            var rrachieve = <?= max($rr_actual[$key]) ?>;
            var data = {
                labels: ["Cycle Time", "FTT", "Rejection Rate", "OEE"],
                datasets: [{
                    label: "Target",
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    data: [<?= $ct_target ?>, <?= $ftt_target ?>, <?= $rr_target ?>, <?= $ct_target ?>]
                }, {
                    label: "Achievement",
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    data: [ctachieve, fttachieve, rrachieve, rrachieve]
                }]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        </script>
        <?php endforeach ?>
        <?php endif ?>

        
        <script>
            var ctx = document.getElementById("canvas");
            Chart.pluginService.register({
                afterDraw: function(chart) {
                    if (typeof chart.config.options.lineAt != 'undefined') {
                        var lineAt = chart.config.options.lineAt;
                        var ctxPlugin = chart.chart.ctx;
                        var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
                        var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
                        
                        // I'm not good at maths
                        // So I couldn't find a way to make it work ...
                        // ... without having the `min` property set to 0
                        if(yAxe.min != 0) return;
                        
                        ctxPlugin.strokeStyle = "#f55e5e";
                        ctxPlugin.beginPath();
                        lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
                        lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
                        ctxPlugin.moveTo(xAxe.left, lineAt);
                        ctxPlugin.lineTo(xAxe.right, lineAt);
                        ctxPlugin.stroke();
                    }
                }
            });
            var densityData = {
                label: 'Series 1',
                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                data: [15,20,30,15]
            };
            var line = 35;
            var myChart = new Chart(ctx, {
                type: 'bar',
                        data: {
                            labels: ["Station 1", "Station 2", "Station 3", "Station 4"],
                            datasets: [densityData]
                        },
                options: {
                    lineAt: line,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: line+10,
                            }
                        }]
                    }
                }
            });
        </script>

        <!-- Graph Cycle Time -->
        <?php if(isset($resEventProd)) : ?>
        <?php foreach($resEventProd as $key => $value) : ?>
        <script>
            var ctx = document.getElementById("cycleTime<?= $key ?>");
            Chart.pluginService.register({
                afterDraw: function(chart) {
                    if (typeof chart.config.options.lineAt != 'undefined') {
                        var lineAt = chart.config.options.lineAt;
                        var ctxPlugin = chart.chart.ctx;
                        var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
                        var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
                        
                        if(yAxe.min != 0) return;
                        
                        ctxPlugin.strokeStyle = "#f55e5e";
                        ctxPlugin.beginPath();
                        lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
                        lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
                        ctxPlugin.moveTo(xAxe.left, lineAt);
                        ctxPlugin.lineTo(xAxe.right, lineAt);
                        ctxPlugin.stroke();
                    }
                }
            });
            <?php foreach ($value as $row) {
                $station[$key][] = $row['station'];
                $ct_actual[$key][] = $row['ct_actual'];
                $ct_target = $row['ct_target'];
            } ?>
            var station = <?= json_encode($station[$key]) ?>;
            var ct_actual = <?= json_encode($ct_actual[$key]) ?>;
            var ct_target = <?= $ct_target ?>;
            var densityData = {
                label: 'Actual',
                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                data: ct_actual
            };
            var line = ct_target;
            var myChart = new Chart(ctx, {
                type: 'bar',
                        data: {
                            labels: station,
                            datasets: [densityData]
                        },
                options: {
                    lineAt: line,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: line+10,
                            }
                        }]
                    }
                }
            });
        </script>
        <?php endforeach ?>
        <?php endif ?>
        
        <!-- Graph FTT -->
        <?php if(isset($resEventProd)) : ?>
        <?php foreach($resEventProd as $key => $value) : ?>
        <script>
            var ctx = document.getElementById("ftt<?= $key ?>");
            Chart.pluginService.register({
                afterDraw: function(chart) {
                    if (typeof chart.config.options.lineAt != 'undefined') {
                        var lineAt = chart.config.options.lineAt;
                        var ctxPlugin = chart.chart.ctx;
                        var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
                        var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
                        
                        if(yAxe.min != 0) return;
                        
                        ctxPlugin.strokeStyle = "#f55e5e";
                        ctxPlugin.beginPath();
                        lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
                        lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
                        ctxPlugin.moveTo(xAxe.left, lineAt);
                        ctxPlugin.lineTo(xAxe.right, lineAt);
                        ctxPlugin.stroke();
                    }
                }
            });
            <?php foreach ($value as $row) {
                $stationfttt[$key][] = $row['station'];
                $ftt_actual[$key][] = $row['ftt_actual'];
                $ftt_target = $row['ftt_target'];
            } ?>
            var stationfttt = <?= json_encode($stationfttt[$key]) ?>;
            var ftt_actual = <?= json_encode($ftt_actual[$key]) ?>;
            var ftt_target = <?= $ftt_target ?>;
            var densityData = {
                label: 'Actual',
                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                data: ftt_actual
            };
            var line = ftt_target;
            var myChart = new Chart(ctx, {
                type: 'bar',
                        data: {
                            labels: stationfttt,
                            datasets: [densityData]
                        },
                options: {
                    lineAt: line,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: line+10,
                            }
                        }]
                    }
                }
            });
        </script>
        <?php endforeach ?>
        <?php endif ?>
        
        <!-- Graph Rejection Rate -->
        <?php if(isset($resEventProd)) : ?>
        <?php foreach($resEventProd as $key => $value) : ?>
        <script>
            var ctx = document.getElementById("rr<?= $key ?>");
            Chart.pluginService.register({
                afterDraw: function(chart) {
                    if (typeof chart.config.options.lineAt != 'undefined') {
                        var lineAt = chart.config.options.lineAt;
                        var ctxPlugin = chart.chart.ctx;
                        var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
                        var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
                        
                        if(yAxe.min != 0) return;
                        
                        ctxPlugin.strokeStyle = "#f55e5e";
                        ctxPlugin.beginPath();
                        lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
                        lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
                        ctxPlugin.moveTo(xAxe.left, lineAt);
                        ctxPlugin.lineTo(xAxe.right, lineAt);
                        ctxPlugin.stroke();
                    }
                }
            });
            <?php foreach ($value as $row) {
                $stationrr[$key][] = $row['station'];
                $rr_actual[$key][] = $row['rr_actual'];
                $rr_target = $row['rr_target'];
            } ?>
            var stationrr = <?= json_encode($stationrr[$key]) ?>;
            var rr_actual = <?= json_encode($rr_actual[$key]) ?>;
            var rr_target = <?= $rr_target ?>;
            var densityData = {
                label: 'Actual',
                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                data: rr_actual
            };
            var line = rr_target;
            var myChart = new Chart(ctx, {
                type: 'bar',
                        data: {
                            labels: stationrr,
                            datasets: [densityData]
                        },
                options: {
                    lineAt: line,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: line+10,
                            }
                        }]
                    }
                }
            });
        </script>
        <?php endforeach ?>
        <?php endif ?>

        <!-- Material Graph -->
        <script>
            var ctx = document.getElementById("Material");

            var data = {
                labels: ["Total", "M-Comp", "E-Comp"],
                datasets: [{
                    label: "Budget (IDR)",
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    data: [<?= $material_cost->total ?>, <?= $material_cost->mcomp ?>, <?= $material_cost->ecomp ?>]
                }, {
                    label: "Actual Expense (IDR)",
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    data: [<?= $material_cost->mcomp + $material_cost->ecomp ?>, <?= $material_cost->used_mcomp ?>, <?= $material_cost->used_ecomp ?>]
                }]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        </script>

        <!-- Launch Cost Graph -->
        <script>
            var ctx = document.getElementById("LaunchCost");

            var data = {
                labels: ["Total", "PV", "Launch", "Other"],
                datasets: [{
                    label: "Budget (IDR)",
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    data: [<?= $launch_cost->total ?>, <?= $launch_cost->pv ?>, <?= $launch_cost->launch ?>, <?= $launch_cost->other ?>]
                }, {
                    label: "Actual Expense  (IDR)",
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    data: [<?= $launch_cost->pv + $launch_cost->launch + $launch_cost->other ?>, <?= $launch_cost->used_pv ?>, <?= $launch_cost->used_launch ?>, <?= $launch_cost->used_other ?>]
                }]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        </script>

        <?= $this->endSection(); ?>