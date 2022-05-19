<?php 
// dd($project, $apu, $tlist);
// dd($timeline);
$timelines = [ "RFQ Feedback" => $projectrow->rfq_feedback, "Design Freeze" => $projectrow->design_freeze, "PP1 SMT" => $projectrow->pp1smt, "PP2 SMT" => $projectrow->pp2smt, "PP3 SMT" => $projectrow->pp3smt, "PP1 FA" => $projectrow->pp1fa, "PP2 FA" => $projectrow->pp2fa, "PP3 FA" => $projectrow->pp3fa, "Ramp Up & SOP SMT" => $projectrow->sop_smt, "Ramp Up & SOP FA" => $projectrow->sop_fa, "Safe Launch" => $projectrow->safe_launch, "Regular Production" => $projectrow->regular_production, "EOP (Service Part)" => $projectrow->eop ];
$i = 0;
$np = $projectrow->project_name;
foreach ($timeline as $key => $value){
    $ekn[] = $value->timeline_name;
    $tkn[] = $value->start;
    $finish[] = $value->finish;
    $tkcl[$value->timeline_name] = $value->start;
    $tkcl2[$value->start] = $value->timeline_name;
}
foreach ($timelines as $key => $value ) {
    if (isset($value)) {
        if(!isset($tkcl)) {
            $name[] = $key;
            $date[] = $value;
        }
        $test[] = [$key];
        $dates[$key] =  $value;
        $dates2[$value] =  $key;
        $zz[$value] =  $key;
    }
}
$f = array_slice($dates,1);
$add = date('Y-m-d',strtotime(end($f) . ' +1 day'));
array_push($f,$add);
// dd($f);
foreach ($f as $key => $value) {
    $endf[] = date('Y-m-d', strtotime('-1 day', strtotime($value)));
}
// dd($f,$endf);
if(isset($finish)){
$fsh = array_merge($endf,$finish);
asort($fsh);
}
if(!isset($finish)){
$fsh = $endf;
asort($fsh);
}
// foreach ($fsh as $key => $value) {
//     $newFsh[] = date('Y-m-d', strtotime('-1 day', strtotime($value)));
// }
// dd($endf,$finish,$fsh);
if(isset($tkcl)){
    $arr = array_merge($tkcl,$dates);
    asort($arr);
    foreach($arr as $key => $value) {
        $newEvent[$value] = $key;
        $name[] = $key;
        $date[] = $value;
    }
}
// dd($arr,$ekn,$finish);
// dd($tkcl2,$dates2,$arr,$newEvent);
// dd($tkn,$ekn,$name,$date, $tkcl, $dates);
// dd($material_cost);
$ptk = '"';
// $fin = array_slice($date,1);
// $add = date('Y-m-d',strtotime(end($fin) . ' +1 day'));
// array_push($fin,$add);
// foreach($fin as $key => $value) {
//     $newFin[] = date('Y-m-d', strtotime('-1 day', strtotime($value)));
// }
// dd($name);
$t = $ptk . join('","' , $name) . $ptk;
$w = $ptk . join('","' , $date) . $ptk;
$as = $ptk . join('","' , $fsh) . $ptk;
// dd($name,$date,$fsh,$finish,$endf);
// dd($date,$fin,$newFin);
function closesteventname($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[$key] = strtotime($value);
    }
    foreach ($newDates as $key => $value)
    {
        if ($value > time()){
            $tgl = date('d M Y', $value);
            return $key;
        }
    }
}
function closesteventdate($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[$key] = strtotime($value);
    }
    foreach ($newDates as $key => $value)
    {
        if ($value > time()){
            $tgl = date('d M Y', $value);
            return $tgl;
        }
    }
}
function currenteventname($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[strtotime($value)] = $key;
    }
    krsort($newDates);
    // var_dump($newDates);
    // die;
    dd($newDates, time());
    foreach ($newDates as $key => $value)
    {
        if ($key <= time()){
            return $value;
        } else {
            return 'NOT';
        }
    } 
}
function currenteventdate($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[$key] = strtotime($value);
    }
    rsort($newDates);
    foreach ($newDates as $key => $value)
    {
        if ($value <= time()){
            $tgl = date('d M Y', $value);
            return $tgl;
        } else {
            return 'AVAILABLE';
        }
    }
}
function lasteventname($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[$key] = strtotime($value);
    }
    // dd($newDates);
    // end($newDates);
    // return prev($newDates);
    foreach ($newDates as $key => $value)
    {
        if ($value < time()){
            $nn[] = $key;
        }
    }
    if(isset($nn)){
        $n = array_slice($nn,-2);
        return $n[0];
    } else {
        return "NOT";
    }
}
function lasteventdate($dates)
{
    foreach($dates as $key => $value)
    {
        $newDates[$key] = strtotime($value);
    }
    // krsort($newDates);
    foreach ($newDates as $key => $value)
    {
        if ($value <= time()){
            $nn[] = $value;
        }
    }
    if(isset($nn)) {
        $n = array_slice($nn,-2);
        return date('d M Y', $n[0]);
    } else {
        return "AVAILABLE";
    }
}
$nexteventname = closesteventname($dates);
$nexteventdate = closesteventdate($dates);
$currenteventname = currenteventname($dates);
$currenteventdate = currenteventdate($dates);
$lasteventname = lasteventname($dates);
$lasteventdate = lasteventdate($dates);
dd($currenteventname);
foreach ($task as $tsk) {
        if (date("Y-m-d", strtotime($tsk->due_date)) <= date("Y-m-d", time()) && $tsk->status == 'In Progress') {
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
    if($ct->project_id == $projectrow->id) {
        if (date("Y-m-d", strtotime($ct->due_date)) <= date("Y-m-d", time()) && $ct->cstat == 'In Progress') {
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
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="<?= base_url('') ?>/project/<?= $customer->id ?>"><?= $customer->customer_name ?></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                        <li class="breadcrumb-item" aria-current="page"><?= $projectrow->project_name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/project/<?= $customer->id ?>" class="badge badge-secondary">⬅ Back</a>
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
                                <?php if(user()->role == 'ame' || user()->role == 'pm') : ?>
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal"
                                    data-target="#addTimeline">Add timeline</button>
                                <?php endif ?>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h5 class="card-title my-2 pl-2" style="font-size: 19px;">
                                        <?= $projectrow->project_name ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        <br>
                        <div class="text-center mx-auto rounded mx-auto d-block" style="width:20rem" class="">
                            <img src="<?= base_url('') ?>/public/theme/assets/images/card_1.jpg" style="border-radius: 10px;" class="img-fluid">
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
                                    <?php if(isset($lasteventname)) : ?>
                                    <?php if($lasteventdate == 'AVAILABLE') : ?>
                                    <a href="" type="button" style="color: white; background: #43a0b5"
                                        class="btn btn-lg">
                                        <?= $lasteventname ?><br><?= $lasteventdate ?>
                                    </a>
                                    <?php endif ?>
                                    <?php if($lasteventdate != 'AVAILABLE') : ?>
                                    <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $lasteventname ?>"
                                        type="button" style="color: white; background: #43a0b5" class="btn btn-lg">
                                        <?= $lasteventname ?><br><?= date('d M Y', strtotime($lasteventdate))?>
                                    </a>
                                    <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <div class="col-4">
                                    <?php if(isset($currenteventname)) : ?>
                                    <?php if($currenteventdate == 'AVAILABLE') : ?>
                                    <a href="" type="button" style="color: white; background: #598e91"
                                        class="btn btn-lg">
                                        <?php if($currenteventdate == 'AVAILABLE') : ?>
                                        <?= $currenteventname ?><br><?= $currenteventdate ?>
                                        <?php endif; ?>
                                    </a>
                                    <?php endif ?>
                                    <?php if($currenteventdate != 'AVAILABLE') : ?>
                                    <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $currenteventname ?>"
                                        type="button" style="color: white; background: #598e91" class="btn btn-lg">
                                        <?= $currenteventname ?><br><?= date('d M Y', strtotime($currenteventdate))?>
                                    </a>
                                    <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <div class="col-4">
                                    <?php if(isset($nexteventname)) : ?>
                                    <div class="blink">
                                        <?php if($nexteventdate != 'AVAILABLE') : ?>
                                        <a href="<?= base_url('') ?>/project/event/<?= $id; ?>/<?= $customer->id ?>/<?= $nexteventname ?>"
                                            type="button" style="color: white; background: #e08012" class="btn btn-lg">
                                            <div class="blink">
                                                <?= $nexteventname ?><br>
                                                <?php
                                                        $date1 = new DateTime(date('m/d/Y', time()));
                                                        $date2 = new DateTime(date('m/d/Y', strtotime($nexteventdate)));
                                                        $diff = $date1->diff($date2);
                                                        ?>
                                                <?= $diff->d ?>
                                                Days Left
                                            </div>
                                        </a>
                                        <?php endif ?>
                                    </div>
                                    <?php endif ?>
                                    <?php if(!isset($nexteventdate)) : ?>
                                        <a href="" type="button" style="color: white; background: #e08012"
                                            class="btn btn-lg">
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
        <div class="row" style="display: none;" id="eventDetails">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div id="gantt" style="margin-top: 20px;"></div><br>
                        <div class="row">
                            <div class="col-6">
                                <!-- <div id="chart"></div> -->
                            </div>
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
                                if(isset($done) && isset($c_done)){
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
                        <a href="<?= base_url('') ?>/task">
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
                                if(isset($inprogress) && isset($c_inprogress)){
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
                        <a href="<?= base_url('') ?>/task">
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
                                if(isset($waiting) && isset($c_waiting)){
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
                        <a href="<?= base_url('') ?>/task">
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
                                if(isset($overdue) && isset($c_overdue)){
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
                        <a href="<?= base_url('') ?>/task">
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
                        <?php if(user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                        <div class="col-6">
                            <div class="text-right">
                                <button type="button" data-toggle="modal" data-target="#newTask"
                                    class="btn btn-primary">Add Task</button>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                    <br>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <table class="table table-responsive" id="zero-conf">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;">#</th>
                                <th scope="col" style="width: 15%;">Event</th>
                                <th scope="col" style="width: 20%;">Task</th>
                                <th scope="col" style="width: 5%;">Parent</th>
                                <th scope="col" style="width: 15%;">Due date</th>
                                <th scope="col" style="width: 15%;">PIC</th>
                                <th scope="col" style="width: 10%">Status</th>
                                <th scope="col" style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if(isset($project)) : ?>
                            <?php foreach ($project as $prj) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $prj->event ?></td>
                                <td><?= $prj->concern ?></td>
                                <td>-</td>
                                <td><?= date("d M Y", strtotime($prj->due_date))?></td>
                                <td><?= $prj->fullname ?></td>
                                <td>
                                    <span class="badge badge-<?= ($prj->status == 'In Progress') ? 'info' : (($prj->status == 'Waiting Approve') ? 'warning' : 'primary')?>">
                                        <?= $prj->status ?>
                                    </span>
                                    <?php if(date("Y-m-d", strtotime($prj->due_date)) < date("Y-m-d", time()) && $prj->status == 'In Progress') : ?>
                                        <span class="badge badge-danger">Over Due</span></td>
                                    <?php endif ?>
                                <td>
                                    <?php if($prj->pic == user()->id ) : ?>
                                    <a type="button" style="color: white;" href="<?= base_url('') ?>/task"
                                        class="badge badge-primary"><span class="material-icons">check</span></a>
                                    <?php endif; ?>
                                    <?php if($prj->pic != user()->id) : ?>
                                    <a data-toggle="modal" type="button" style="color: white;"
                                        data-target="#updateTask<?= $prj->task_id ?>" class="badge badge-info"><span
                                            class="material-icons">visibility</span></a>
                                    <?php endif ?>
                                    <!-- <a data-toggle="modal" type="button" style="color: white;"
                                            data-target="#updateTask<?= $prj->task_id ?>" class="badge badge-primary"><span
                                                class="material-icons">check</span></a> -->
                                    <?php if(user()->role == "ame" || user()->role == "admin") : ?>
                                    <!-- <a type="button" class="badge badge-primary"
                                            onclick="acc(<?= $prj->task_id ?>, <?= $id; ?>)"><span class="material-icons"
                                                style="color: white;">check</span></a> -->
                                    <a type="button" class="badge badge-danger"
                                        onclick="del(<?= $prj->task_id; ?>, <?= $id; ?>, <?= $customer->id ?>)"><span
                                            class="material-icons" style="color: white;">delete</span></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                                <?php foreach ($child_task as $ct) : ?>
                                    <?php if($ct->project_id == $projectrow->id): ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $ct->event ?></td>
                                    <td><?= $ct->concern ?></td>
                                    <td><?= $ct->parent ?></td>
                                    <td><?= date("d M Y", strtotime($ct->due_date))?></td>
                                    <td><?= $ct->fullname ?></td>
                                    <td>
                                        <?php if($ct->cstat == 'Rejected') : ?>
                                        <span class="badge badge-danger">
                                            <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                        <?php if(date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->cstat == 'In Progress') : ?>
                                        <span class="badge badge-danger">Over Due</span></td>
                                        <?php endif ?>
                                        <?php if(date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time()) && $ct->cstat == 'Done') : ?>
                                        <span class="badge badge-primary">Done</span></td>
                                        <?php endif ?>
                                        <?php if(date("Y-m-d", strtotime($ct->due_date)) >= date("Y-m-d", time())) : ?>
                                        <?php if($ct->cstat != 'Rejected') : ?>
                                        <span  class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary')?>">
                                        <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <?php if(date("Y-m-d", strtotime($ct->due_date)) < date("Y-m-d", time())) : ?>
                                        <?php if($ct->cstat != 'Done') : ?>
                                        <span  class="badge badge-<?= ($ct->cstat == 'In Progress') ? 'info' : (($ct->cstat == 'Waiting Approve') ? 'warning' : 'primary')?>">
                                        <?= $ct->cstat ?></span></td>
                                        <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if( $ct->cstat == 'In Progress') : ?>
                                        <a type="button" data-toggle="modal" data-target="#updateChildTask<?= $ct->cid ?>" class="badge badge-primary"><span class="material-icons" style="color: white;">check</span></a>
                                        <?php if($ct->parent == '-') : ?>
                                        <a type="button" data-toggle="modal"
                                            data-target="#listChildTask<?= $ct->ctask_id ?>"
                                            class="badge badge-info"><span class="material-icons"
                                                style="color: white;">escalator_warning</span></a>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <?php if( $ct->cstat != 'In Progress') : ?>
                                        <a type="button" data-toggle="modal"
                                            data-target="#viewChildTaskUser<?= $ct->cid ?>" class="badge badge-info"><span
                                                class="material-icons" style="color: white;">visibility</span></a>
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
    <div>
    <div class="row" style="display: none;" id="cost">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h5 class="card-title">Budget Project</h5>
                                </div>
                                <div class="text-left">
                                    <?php if(user()->role != 'user') : ?>
                                    <button type="button" data-toggle="modal" data-target="#editBudget"
                                        class="btn btn-success btn-sm">Edit Budget</button>
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
                                    <?php if(user()->role != 'user') : ?>
                                    <button type="button" data-toggle="modal" data-target="#editCost"
                                        class="btn btn-success btn-sm">Edit Launch Cost</button>
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
                                    <?php if(user()->role != 'user') : ?>
                                    <button type="button" data-toggle="modal" data-target="#editMaterial"
                                        class="btn btn-success btn-sm">Edit Material</button>
                                    <?php endif ?>
                                </div>
                                <br><br>
                                <canvas id="Material" width="100px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <div class="row" style="display: none;" id="qualityDetails">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Quality list</h5>
                        </div>
                        <?php if(user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                        <div class="col-6">
                            <div class="text-right">
                                <button type="button" data-toggle="modal" data-target="#addQuality"
                                    class="btn btn-primary">Add Issue</button>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table" id="zero-conf2">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 5%;">Event</th>
                                    <th scope="col" style="width: 20%;">Date</th>
                                    <th scope="col" style="width: 40%;">Issue</th>
                                    <th scope="col" style="width: 20%">Status</th>
                                    <th scope="col" style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            <?php if(isset($quality)) : ?>
                            <?php foreach ($quality as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row->event ?></td>
                                <td><?= date("d M Y", strtotime($row->date))?></td>
                                <td><?= $row->issue ?></td>
                                <td>
                                    <span class="badge badge-<?= ($row->status == 'Open') ? 'danger' : (($row->status == 'Waiting Approve') ? 'warning' : 'primary')?>">
                                        <?= $row->status ?>
                                    </span>
                                <td>
                                    <a data-toggle="modal" type="button" style="color: white;"
                                        data-target="#viewQuality<?= $row->id ?>" class="badge badge-info"><span class="material-icons">visibility</span></a>
                                    <?php if(user()->section == 'Quality Control' || user()->role == 'admin' || user()->role == 'ame') ?>
                                    <a data-toggle="modal" type="button" style="color: white;"
                                        data-target="#editQuality<?= $row->id ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
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
    <div class="row" style="display: none;" id="productivity">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Productivity list</h5>
                        </div>
                        <?php if(user()->role == "ame" || user()->role == "pm" || user()->role == "admin") : ?>
                        <div class="col-6">
                            <div class="text-right">
                                <button type="button" data-toggle="modal" data-target="#addQuality"
                                    class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table" id="zero-conf3">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 5%;">Event</th>
                                    <th scope="col" style="width: 20%;">Date</th>
                                    <th scope="col" style="width: 40%;">Issue</th>
                                    <th scope="col" style="width: 20%">Status</th>
                                    <th scope="col" style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal New Task -->
    <div class="modal fade bd-example-modal-lg" id="newTask" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/addtask/<?= $id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1"
                                style="display: none; width: 100%">
                                <?php if(isset($currenteventname)) : ?>
                                <?php foreach  ($timelines as $key => $value) : ?>
                                <?php if (isset($value)) : ?>
                                <option value="<?= $key ?>"><?= $key ?></option>
                                <?php endif ?>
                                <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" id="new-task-name" placeholder="Task" name="concern"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <div>
                                <div class="input-group">
                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy"
                                        id="e" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PIC</label>
                            <select class="js-states form-control" name="pic" tabindex="-1"
                                style="display: none; width: 100%">
                                <?php foreach  ($user as $us) : ?>
                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>Type Approval</label>
                            <select class="type1 js-states form-control" name="type_approval" tabindex="-1"
                                style="display: none; width: 100%;" aria-placeholder="Choose">
                                <option value="" hidden>-- Choose --</option>
                                <option value="Route Approval">Route Approval</option>
                                <option value="Paralel Approval">Paralel Approval</option>
                            </select>
                        </div>
                        <div class="form-group" id="divParalel1" style="display: none;">
                            <label>User Approval</label>
                            <select class="js-states form-control" multiple="multiple" name="app[]" tabindex="-1"
                                style="display: none; width: 100%;" aria-placeholder="Choose">
                                <?php foreach  ($user as $us) : ?>
                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> -->
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Route</label>
                                    <?php for($x=1;$x<6;$x++) : ?>
                                    <div class="form-group">
                                        <select disabled class="route<?= $x ?> js-states form-control" tabindex="-1"
                                            style="display: none; width: 100%" name="route_num[]">
                                            <option value="-">-</option>
                                            <?php for($r=1;$r<6;$r++) : ?>
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
                                    <?php for($x=1;$x<6;$x++) : ?>
                                    <div class="form-group">
                                        <select disabled class="userapp<?= $x ?> js-states form-control" name="lau[]"
                                            tabindex="-1" style="display: none; width: 100%">
                                            <option value="--Choose--">--Choose--</option>
                                            <?php foreach  ($user as $us) : ?>
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
                            <select class="js-states form-control" name="required_file" tabindex="-1"
                                style="display: none; width: 100%;" aria-placeholder="Choose">
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
    <!-- Modal Add Issue Quality -->
    <div class="modal fade bd-example-modal-lg" id="addQuality" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Issue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addquality" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <select class="js-states form-control" name="event" tabindex="-1"
                                style="display: none; width: 100%">
                                <?php if(isset($currenteventname)) : ?>
                                <?php foreach  ($timelines as $key => $value) : ?>
                                <?php if (isset($value)) : ?>
                                <option value="<?= $key ?>"><?= $key ?></option>
                                <?php endif ?>
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
                            <select class="js-states form-control" name="lead" tabindex="-1"
                                style="display: none; width: 100%">
                                <?php foreach  ($user as $us) : ?>
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
    <!-- Modal View Quality -->
    <?php foreach ($quality as $row) : ?>
    <div class="modal fade bd-example-modal-lg" id="viewQuality<?= $row->id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details Quality</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/addquality" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
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
    <!-- Modal Edit Quality -->
    <?php $i=1;$y=2; ?>
    <?php foreach ($quality as $row) : ?>
    <div class="modal fade" id="editQuality<?= $row->id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Quality</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/quality/editquality/<?= $row->id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <select class="js-states form-control" name="status" tabindex="-1" style="display: none; width: 100%">
                                <option value="Open" <?= ($row->status == 'Open') ? 'selected' :  '' ?>>Open</option>
                                <option value="Closed"  <?= ($row->status == 'Closed') ? 'selected' :  '' ?>>Closed</option>
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
    <!-- Modal View Task Detail -->
    <?php if(isset($project)) : ?>
    <?php foreach ($project as $prj) : ?>
    <div class="modal fade bd-example-modal-lg" id="updateTask<?= $prj->task_id ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Task</h5>
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
                                    <input type="text" class="form-control" value="<?= $prj->event ?>" name="event"
                                        required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Current Date</label>
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
                                                value="<?= date('Y-m-d', strtotime($prj->due_date)) ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approvel Request</label>
                                <ul class="list-group">
                                    <?php foreach ($apu as $prove) : ?>
                                    <?php $prove_user[] = $prove->approve_user; ?>
                                    <?php if ($prj->task_id == $prove->a_task_id) : ?>
                                    <?php if ($prj->status == 'Rejected') : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $prove->routes ?>. <?= $prove->fullname ?>
                                        <?php if ($prove->t_app >= $prove->ap) : ?>
                                        <span class="badge bg-danger rounded-pill" style="color: white;">X</span>
                                        <?php endif ?>
                                    </li>
                                    <?php endif ?>
                                    <?php if ($prj->status != 'Rejected') : ?>
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
                            <?php if(isset($prj->a_file)) : ?>
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
                                                        href="<?= base_url('/public') ?>/theme/assets/document/<?= $prj->fullname ?>/<?= $prj->a_file ?>">View</a>
                                                    <a class="dropdown-item" href="#">Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p><?= $prj->a_file ?></p>
                                                <span class="file-size">
                                                    <?php 
                                                        $filesize = filesize('public/theme/assets/document/'.$prj->project_name.'/'. $prj->a_file);
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
                                                    <?= date('d M Y', strtotime($prj->update_date)) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <?php if($prj->pic == user()->id) : ?>
                        <div class="form-group" id="divParalel<?= $prj->task_id ?>" style="display: none;">
                            <label>User Approval</label>
                            <select class="js-states form-control" multiple="multiple" name="app[]" tabindex="-1"
                                style="display: none; width: 100%;" aria-placeholder="Choose">
                                <?php foreach  ($user as $us) : ?>
                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row" id="divRoute<?= $prj->task_id ?>" style="display: none;">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Route</label>
                                    <?php for($x=1;$x<6;$x++) : ?>
                                    <div class="form-group">
                                        <select class="js-states form-control" name="numroot" tabindex="-1"
                                            style="display: none; width: 100%">
                                            <option value="<?= $x ?>"><?= $x ?></option>
                                        </select>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label>User Approval</label>
                                    <?php for($x=1;$x<6;$x++) : ?>
                                    <div class="form-group">
                                        <select class="js-states form-control" name="lau[]" tabindex="-1"
                                            style="display: none; width: 100%">
                                            <option>--Choose--</option>
                                            <?php foreach  ($user as $us) : ?>
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
                </div>
                <input type="hidden" name="project_id" id="project_id" value="<?= $id ?>">
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <?php if($prj->pic == user()->id) : ?>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <?php endif ?>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <!-- Modal Add Timeline -->
    <div class="modal fade bd-example-modal-lg" id="addTimeline" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/project/addtimeline/<?= $id ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="wrapper row">
                            <?php for($x=1;$x<5;$x++) : ?>
                            <div class="col-3">
                                <div class="form-group" id="timeline<?= $x ?>">
                                    <input type="text" class="form-control" placeholder="Input timeline"
                                        name="timeline_name[]">
                                    <input type="date" autocomplete="off" class="form-control mt-2"
                                        style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]">
                                    <input type="date" autocomplete="off" class="form-control mt-2"
                                        style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="finish[]">
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
                                    <button type="button" id="cancel2" class="btn btn-secondary"
                                        data-dismiss="modal">Cancel</button>
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
    <!-- Modal Edit Budget -->
    <div class="modal fade" id="editBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                        <input type="text" name="total" id="rupiah8" class="form-control" value="<?=  number_format($budget->total,0, ".", ".") ?>">
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
                                        <input type="text" name="tooling" id="rupiah9" class="form-control" value="<?= number_format($budget->tooling,0, ".", ".") ?>">
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
                                        <input type="text" name="used_tooling" id="rupiah10" class="form-control" value="<?= number_format($budget->used_tooling,0, ".", ".") ?>">
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
                                        <input type="text" name="smt" id="rupiah11" class="form-control" value="<?= number_format($budget->smt,0, ".", ".")?>">
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
                                        <input type="text" name="used_smt" id="rupiah12" class="form-control" value="<?= number_format($budget->used_smt,0, ".", ".") ?>">
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
                                        <input type="text" name="fa" id="rupiah13" class="form-control" value="<?= number_format($budget->fa,0, ".", ".") ?>">
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
                                        <input type="text" name="used_fa" id="rupiah14" class="form-control" value="<?= number_format($budget->used_fa,0, ".", ".") ?>">
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
    <div class="modal fade" id="editCost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                        <input type="text" id="rupiah1" name="total" class="form-control" value="<?= number_format($launch_cost->total,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah2" name="pv" class="form-control" value="<?= number_format($launch_cost->pv,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah3" name="used_pv" class="form-control" value="<?= number_format($launch_cost->used_pv,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah4" name="launch" class="form-control" value="<?= number_format($launch_cost->launch,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah5" name="used_launch" class="form-control" value="<?= number_format($launch_cost->used_launch,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah6" name="other" class="form-control" value="<?= number_format($launch_cost->other,0, ".", ".")?>">
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
                                        <input type="text" id="rupiah7" name="used_other" class="form-control" value="<?= number_format($launch_cost->used_other,0, ".", ".")?>">
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
    <div class="modal fade" id="editMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                        <input type="text" name="total" id="rupiah15" class="form-control" value="<?= number_format($material_cost->total,0, ".", ".")?>">
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
                                        <input type="text" name="mcomp" id="rupiah16" class="form-control" value="<?= number_format($material_cost->mcomp,0, ".", ".")?>">
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
                                        <input type="text" name="used_mcomp" id="rupiah17" class="form-control" value="<?= number_format($material_cost->used_mcomp,0, ".", ".")?>">
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
                                        <input type="text" name="ecomp" id="rupiah18" class="form-control" value="<?= number_format($material_cost->ecomp,0, ".", ".")?>">
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
                                        <input type="text" name="used_ecomp" id="rupiah19" class="form-control" value="<?= number_format($material_cost->used_ecomp,0, ".", ".")?>">
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
    </script>

    <!-- Event Graph -->
    <script>
        // THE CHART
        var jArray = [<?= $t ?>];
        var wArray = [<?= $w ?>];
        var fArray = [<?= $as ?>];

        console.log(wArray);
        console.log(jArray);
        console.log(fArray);

        let datasz = [{}];
        var ys = 1;
        for(var i = 0; i < jArray.length; i++){
            datasz.push({
            name: jArray[i],
            start: Date.UTC(wArray[i].substr(0,4), (wArray[i].substr(5,2)-1), wArray[i].substr(8,2),00),
            end: Date.UTC(fArray[i].substr(0,4), (fArray[i].substr(5,2)-1), fArray[i].substr(8,2),23),
            })
        }

        console.log(datasz);
        // var activities = [{
        // title: 'Hello',
        // budget: '100$',
        // target: '1200',
        // start: Date.UTC(2014, 10, 18),
        // end: Date.UTC(2014, 10, 25),
        // }, {
        // title: 'Hello1',
        // budget: '110$',
        // target: '900',
        // start: Date.UTC(2014, 10, 25),
        // end: Date.UTC(2014, 10, 27),
        // }, {
        // title: 'Hello2',
        // budget: '80$',
        // target: '1100',
        // start: Date.UTC(2014, 10, 30),
        // end: Date.UTC(2014, 10, 28),
        // }, ]

        // console.log(activities);
        // let datas = [{}];

        // for (let x = 0; x < activities.length; x++) {
        // datas.push({
        //     name: activities[x].title,
        //     start: activities[x].start,
        //     end: activities[x].end
        // })
        // };

        // console.log(datas);

        // console.log(data);
        Highcharts.ganttChart('gantt', {
            title: {
                text: 'Grafik Schedule Project <?= $np ?>'
            },

            yAxis: {
                uniqueNames: true
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
                enabled: true
            },
            rangeSelector: {
                enabled: true,
                selected: 0
            },
            series: [{
                data: datasz
            }]
            // series: [{
            //     name: 'Project 1',
            //     data: [{
            //         start: Date.UTC(2021, 7, 31, 0),
            //         end: Date.UTC(2021, 7, 31, 23),
            //         completed: 0.35,
            //         name: 'PP1'
            //     }, {
            //         start: Date.UTC(2021, 8, 3, 0),
            //         end: Date.UTC(2021, 8, 3, 23),
            //         completed: 0.5,
            //         name: 'PP2'
            //     }, {
            //         start: Date.UTC(2021, 8, 7, 0),
            //         end: Date.UTC(2021, 8, 7, 23),
            //         completed: 0.15,
            //         name: 'PP3'
            //     }, {
            //         start: Date.UTC(2021, 8, 8, 1),
            //         end: Date.UTC(2021, 8, 8, 23),
            //         name: 'Release'
            //     }]
            // }]
        });
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
                data: [<?= $material_cost->mcomp + $material_cost->ecomp ?>, <?= $material_cost->used_mcomp ?> , <?= $material_cost->used_ecomp ?>]
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