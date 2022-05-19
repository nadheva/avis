<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/project"><?= $customer->customer_name ?></a></li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                        <li class="breadcrumb-item" aria-current="page"><?= $projectrow->project_name ?></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $event ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/project/detailproject/<?= $idp ?>/<?= $customer->id ?>" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="row d-flex">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <h5 class="card-title my-2" style="font-size: 19px;">
                                        <?= $event ?> - <?= $projectrow->project_name ?>
                                    </h5>
                                </div>
                                <div class="col-4">
                                </div>
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
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Task list</h5>
                        </div>
                        <?php if(user()->role == "ame" || user()->role == "admin") : ?>
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
                    <?php if (session()->has('pesan')) : ?>
                    <div class="alert alert-primary alert-dismissible fade show">
                        <?= session('pesan') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif ?>
                    <div class="table-responsive">
                    <table class="table" id="zero-conf">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Event</th>
                                <th scope="col" style="width: 20%;">Task</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Due date</th>
                                <th scope="col">PIC</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($project)) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($project as $prj) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $prj->event_name ?></td>
                                <td><?= $prj->concern ?></td>
                                <td>-</td>
                                <td><?= date("d M Y", strtotime($prj->due_date))?></td>
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
                                    <span onclick="viewTask(<?= $prj->task_id ?>)">
                                        <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                    </span>
                                <?php if (user()->level_id == 3 || user()->level_id == 1) : ?>
                                    <a type="button" class="badge badge-warning" onclick="editTask(<?= $prj->task_id ?>)"  data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                    <a type="button" class="badge badge-danger" onclick="del(<?= $prj->task_id; ?>, <?= $prj->project_id; ?>, <?= $customer->id ?>)"  data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
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
                                        <span data-toggle="modal" data-target="#updateChildTask<?= $ct->cid ?>" >
                                            <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                        </span>
                                        <?php if (user()->level_id == 3 || user()->level_id == 1) : ?>
                                            <span data-toggle="modal" data-target="#editChildTask<?= $ct->cid ?>" >
                                            <a type="button" class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                            </span>
                                            <a type="button" class="badge badge-danger" onclick="delchildtask(<?= $ct->cid; ?>, <?= $projectrow->id; ?>, <?= $customer->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
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
                    <form action="<?= base_url('') ?>/task/addtask/<?= $idp ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Event</label>
                            <input type="text" class="form-control" readonly value="<?= $event ?>">
                            <input type="hidden" name="event" value="<?= $event_id ?>">
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
                                    <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" id="e" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PIC</label>
                            <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                <option selected disabled>--Choose--</option>
                                <?php foreach  ($user as $us) : ?>
                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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
                                style="display: none; width: 100%;" required aria-placeholder="Choose">
                                <option disabled selected>-- Choose --</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                </div>
                <input type="hidden" name="project_id" id="project_id" value="<?= $idp ?>">
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <input type="hidden" name="eventid" value="<?= $event ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal View Task Detail -->
    <div class="modal fade bd-example-modal-lg" id="viewTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title task-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTask" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control concern" name="concern" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6 viewpic">
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" name="pic" readonly>
                                </div>
                            </div>
                            <div class="col-6 editpic">
                                <div class="form-group id_100">
                                    <label>PIC</label>
                                    <select required class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                        <?php foreach ($user as $us) : ?>
                                            <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 viewevent">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" name="event" readonly>
                                </div>
                            </div>
                            <div class="col-6 editevent">
                                <div class="form-group id_200">
                                    <label>Event</label>
                                    <select required class="js-states form-control" name="event" tabindex="-1" style="display: none; width: 100%">
                                        <?php foreach ($eventinternal as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->event_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Created At</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="created_at" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control due_date" placeholder="dd/mm/yyyy" name="due_date" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1">User Approval Request</label>
                                <ul class="list-group userApp">
                                </ul>
                            </div>
                            <div class="col-lg-4 colFile">
                                <div class="card card-transparent file-list recent-files">
                                    <div class="card-body">
                                        <label for="">File</label>
                                        <div class="card file">
                                            <div class="file-options dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item download" target="_blank">View</a>
                                                    <a class="dropdown-item download" >Download</a>
                                                </div>
                                            </div>
                                            <div class="card-header file-icon">
                                                <i class="material-icons">description</i>
                                            </div>
                                            <div class="card-body file-info">
                                                <p class="fileName"></p>
                                                <span class="file-size">
                                                </span><br>
                                                <span class="file-date"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cust_id">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="eventid" value="<?= $event ?>">
                        <div class="modal-footer footerEdit">
                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        <div class="row mt-4 mb-4 footerView">
                            <div class="col-6">
                                <?php if (user()->level_id == 3 ) : ?>
                                    <button type="button" class="btn btn-primary addChild">Add Child Task</button>
                                <?php endif ?>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Child Task -->
    <div class="modal fade bd-example-modal-lg" id="addChildTask" tabindex="-1" role="dialog"
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
                    <form id="formAddChildTask" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" name="event" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Parent Task</label>
                                    <input type="text" name="parent" class="form-control" readonly>
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
                                    <select class="js-states form-control" name="pic" tabindex="-1"
                                        style="display: none; width: 100%">
                                        <option disabled selected>--Choose--</option>
                                        <?php foreach ($user as $us) : ?>
                                        <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Due Date</label>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control ddct"
                                                placeholder="dd/mm/yyyy" id="e" name="due_date"
                                                value="<?= date('d/m/Y', time()) ?>" required>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>User Approval</label>
                                    <input type="text" name="user_approval" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Required Attachment File</label>
                                    <select class="js-states form-control" name="required_file" required tabindex="-1" style="display: none; width: 100%;" required aria-placeholder="Choose">
                                        <option disabled selected>-- Choose --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" class="form-control" name="user_app">
                <input type="hidden" name="fproj" value="1">
                <input type="hidden" name="eventid" value="<?= $event ?>">
                <input type="hidden" name="idc" value="<?= $customer->id ?>">
                <input type="hidden" name="project_id" value="<?= $projectrow->id ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal Detail Child Task -->
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
                                    <label>Task Update</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy"
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
                                                placeholder="dd/mm/yyyy" value="<?= date('Y-m-d', strtotime($ct->due_date)) ?>" required readonly>
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
    <!-- Modal Edit Child Task -->
    <?php foreach ($child_task as $ct) : ?>
    <div class="modal fade bd-example-modal-lg" id="editChildTask<?= $ct->cid ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Child Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('') ?>/task/editchildtask/<?= $ct->cid ?>" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" value="<?= $ct->concern ?>" name="concern" required >
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
                                    <select required class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                        <?php foreach ($user as $us) : ?>
                                            <option value="<?= $us->id ?>" <?= $us->id == $ct->pic ? 'selected' : '' ?>><?= $us->fullname ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                                    <label>Task Update</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="date" autocomplete="off" class="form-control"
                                                placeholder="dd/mm/yyyy"
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
                                                placeholder="dd/mm/yyyy" name="dudet" value="<?= date('Y-m-d', strtotime($ct->due_date)) ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="required_file" value="<?= $ct->c_file ?>">
                        <input type="hidden" name="project_name" value="<?= $ct->project_name ?>">
                        <input type="hidden" name="project_id" value="<?= $projectrow->id ?>">
                        <input type="hidden" name="cust_id" value="<?= $customer->id ?>">
                        <input type="hidden" name="eventid" value="<?= $event ?>">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <script>
        var user = <?= json_encode($user); ?>;
        console.log(user);
        function viewTask(id){
            $('#formTask')[0].reset(); // reset form value on modals
            <?php header('Content-type: application/json'); ?>
            //Ajax Load data from ajax
            $.ajax({
                url : "<?= site_url('task/ajax_detail_task')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // console.log(data);
                    var userApproval = data.userapp;
                    $('.userApp').empty();
                    const d = new Date(data.created_at);
                    var dateString = moment(d).format('YYYY-MM-DD');
                    $('.concern').val(data.concern).attr('readonly', true);
                    $('[name="pic"]').val(data.fullname);
                    $('[name="created_at"]').val(dateString).trigger('change');
                    $('.due_date').val(data.due_date).attr('readonly', true);
                    $('[name="event"]').val(data.event_name);
                    for(var x=0; x < userApproval.length; x++){
                        $(`<li class="list-group-item d-flex justify-content-between align-items-center listUser">${userApproval[x].routes}. ${userApproval[x].user_approval} ${userApproval[x].app === "202" ? '<span class="badge bg-primary rounded-pill check" style="color: white;">✔</span>' : ''}</li>`).appendTo('.userApp');
                    }
                    if(data.namafile === null) {
                            $('.colFile').attr("hidden", true);
                            $('.addChild').attr('onclick', function (i) {        
                                return `addChildTask(${data.id});`
                            });
                    } else {
                            $('.colFile').attr("hidden", false);
                            $('.fileName').text(data.namafile);
                            $('.download').attr("href", `<?= base_url('public') ?>/theme/assets/document/${data.project_name}/${data.namafile}`).trigger('change');
                            $('.file-size').text("Upload at:");
                            $('.file-date').text(data.request_at);
                            $('.addChild').attr('onclick', function (i) {        
                                return `addChildTask(${data.id});`
                            });
                    }
                    $('.footerView').attr('hidden', false);
                    $('.footerEdit').attr('hidden', true);
                    $('.viewpic').attr('hidden', false);
                    $('.editpic').attr('hidden', true);
                    $('.viewevent').attr('hidden', false);
                    $('.editevent').attr('hidden', true);
                    $('#viewTask').modal('show'); // show bootstrap modal when complete loaded
                    $('.task-title').text('Detail Task'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);
                    alert('Error get data from ajax');
                }
            });
        }

        function editTask(id){
            $('#formTask')[0].reset(); // reset form value on modals
            $('#formTask').attr("action", "<?= site_url('task/editTask/')?>"+id);
            <?php header('Content-type: application/json'); ?>
            //Ajax Load data from ajax
            $.ajax({
                url : "<?= site_url('task/ajax_detail_task')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // console.log(data);
                    var userApproval = data.userapp;
                    $('.userApp').empty();
                    const d = new Date(data.created_at);
                    var dateString = moment(d).format('YYYY-MM-DD');
                    $('.concern').val(data.concern).attr('readonly', false);
                    $('[name="pic"]').val(data.fullname);
                    $('[name="cust_id"]').val(data.cust_id);
                    $('[name="project_id"]').val(data.project_id);
                    $('[name="created_at"]').val(dateString).trigger('change');
                    $('.due_date').val(data.due_date).attr('readonly', false);
                    $('[name="event"]').val(data.event_name);
                    for(var x=0; x < userApproval.length; x++){
                        $(`<li class="list-group-item d-flex justify-content-between align-items-center listUser">${userApproval[x].routes}. ${userApproval[x].user_approval} ${userApproval[x].app === "202" ? '<span class="badge bg-primary rounded-pill check" style="color: white;">✔</span>' : ''}</li>`).appendTo('.userApp');
                    }
                    if(data.namafile === null) {
                            $('.colFile').attr("hidden", true);
                    } else {
                            $('.colFile').attr("hidden", false);
                            $('.fileName').text(data.namafile);
                            $('.download').attr("href", `<?= base_url('public') ?>/theme/assets/document/${data.project_name}/${data.namafile}`).trigger('change');
                            $('.file-size').text("Upload at:");
                            $('.file-date').text(data.request_at);
                            $('.addChild').attr('onclick', function (i) {        
                                return `addChildTask(${data.id});`
                            });
                    }
                    // if(data.pic === )
                    $('.footerView').attr('hidden', true);
                    $('.footerEdit').attr('hidden', false);
                    $('.viewpic').attr('hidden', true);
                    $('.editpic' ).attr('hidden', false);
                    $('.viewevent').attr('hidden', true);
                    $('.editevent' ).attr('hidden', false);
                    $("div.id_100 select").val(data.pic).change();
                    $("div.id_200 select").val(data.event).change();
                    $('#viewTask').modal('show'); // show bootstrap modal when complete loaded
                    $('.task-title').text('Edit Task'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);
                    alert('Error get data from ajax');
                }
            });
        }      

        function addChildTask(id){
            $('#formAddChildTask')[0].reset(); // reset form value on modals
            $('#formAddChildTask').attr("action", "<?= site_url('task/addchildtask/')?>"+id);
            <?php header('Content-type: application/json'); ?>
            //Ajax Load data from ajax
            $.ajax({
                url : "<?= site_url('task/ajax_detail_task')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // console.log(data);
                    $('[name="event"]').val(data.event_name);
                    $('[name="parent"]').val(data.concern);
                    $('[name="user_app"]').val(data.pic);
                    $('[name="user_approval"]').val(data.fullname);
                    $('.ddct').attr('readonly', false);
                    $('#viewTask').modal('hide'); // hide bootstrap modal when complete loaded
                    $('#addChildTask').modal('show'); // show bootstrap modal when complete loaded
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);
                    alert('Error get data from ajax');
                }
            });
        }

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
    <?= $this->endSection(); ?>