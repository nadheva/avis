<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/rio">RIO</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $project->project_name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/rio" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">RIO List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#newRio" class="btn btn-primary">Add RIO</button>
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
                                    <th scope="col" style="width: 10%">Type</th>
                                    <th scope="col" style="width: 20%">RIO</th>
                                    <th scope="col" style="width: 15%">PIC</th>
                                    <th scope="col" style="width: 15%">Status</th>
                                    <th scope="col" style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($rio as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->type ?></td>
                                        <td><?= $r->rio ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <?php if(time() <= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                            <span class="badge badge-<?= $r->status == 'In Progress' ? 'info' : 'warning' ?>"><?= $r->status ?></span>
                                            <?php } elseif (time() >= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                            <span class="badge badge-danger">Over Due</span>
                                            <?php } ?>
                                            <?php if($r->status == 'Done') { ?>
                                            <span class="badge badge-primary">Done</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span onclick="viewRio(<?= $r->rid ?>)">
                                                <a type="button" style="color: white;"  class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                            </span>
                                            <?php if (user()->role == "pm" || user()->role == "admin") : ?>
                                                <a type="button" class="badge badge-danger" onclick="del(<?= $r->rid; ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif ?>

                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php foreach ($child_rio as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->type ?></td>
                                        <td><?= $r->rio ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <?php if(time() <= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                            <span class="badge badge-<?= $r->status == 'In Progress' ? 'info' : 'warning' ?>"><?= $r->status ?></span>
                                            <?php } elseif (time() >= strtotime($r->due_date) && $r->status != 'Done') { ?>
                                            <span class="badge badge-danger">Over Due</span>
                                            <?php } ?>
                                            <?php if($r->status == 'Done') { ?>
                                            <span class="badge badge-primary">Done</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span onclick="viewChildRio(<?= $r->rid ?>)">
                                                <a type="button" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                            </span>
                                            <?php if (user()->role == "pm" || user()->role == "admin") : ?>
                                                <a type="button" class="badge badge-danger" onclick="del(<?= $r->rid; ?>)"><span class="material-icons" style="color: white;">delete</span></a>
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
        <!-- Form Add Rio -->
        <div class="modal fade" id="newRio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add RIO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/rio/addrio" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <input type="text" name="rio" readonly value="<?= $project->project_name ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <select class="js-states form-control" name="type" tabindex="-1" style="display: none; width: 100%">
                                            <option value="Risk">Risk</option>
                                            <option value="Issue">Issue</option>
                                            <option value="Opportunity">Opportunity</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="pid" value="<?= $project->id ?>">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="rio"  required class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>PIC</label>
                                        <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                            <?php foreach ($users as $us) : ?>
                                                <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>User Approval RIO</label>
                                        <input type="text" readonly name="uar" value="<?= user()->fullname ?>" class="form-control" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Required Attachment File</label>
                                        <select class="js-states form-control raf" required name="required_file" tabindex="-1" style="display: none; width: 100%;" aria-placeholder="Choose">
                                            <option value="" hidden>-- Choose --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="notesfile" style="display: none;">
                                <label>Notes Spesific Required File</label>
                                <input type="text" name="notes_file" class="form-control">
                            </div>
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" required name="notes" rows="3"></textarea>
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
        <!-- View Detail RIO -->
        <div class="modal fade" id="viewRio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title rio-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <input type="text" readonly name="project" class="form-control project_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <input type="text" readonly name="type" class="form-control type">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">RIO</label>
                                        <input type="text" readonly name="rio" class="form-control rio">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>PIC</label>
                                        <input type="text" readonly name="pic" class="form-control pic">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <label>User Approval RIO</label>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center userApp">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <div>
                                            <div class="input-group">
                                                <input readonly type="date" autocomplete="off" class="form-control duedate" name="due_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control desc" readonly name="notes" rows="3"></textarea>
                            </div>
                            <div class="form-group closingStatForm">
                                <label for="exampleFormControlTextarea1">Closing Statement</label>
                                <textarea class="form-control closingStat" readonly name="notes" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function viewRio(id){
                save_method = 'view';
                $('#form')[0].reset(); // reset form value on modals
                <?php header('Content-type: application/json'); ?>
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?= site_url('rio/ajax_detail_rio')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        // console.log(data);
                        $('.project_name').val(data.project_name);
                        $('.type').val(data.type);
                        $('.rio').val(data.rio);
                        $('.pic').val(data.fullname);
                        $('.duedate').val(data.due_date);
                        $('.desc').val(data.description);
                        if(data.closing_statement === null) {
                            $('.closingStatForm').attr('hidden', true);
                        } else {
                            $('.closingStatForm').attr('hidden', false);
                            $('.closingStat').val(data.closing_statement);
                        }
                        if(data.app === "202") {
                            $('.userApp').text(data.user_approval);
                            $(`<span class="badge bg-primary rounded-pill check" style="color: white;">✔</span>`).appendTo('.userApp');
                        } else {
                            $('.userApp').text(data.user_approval);
                        }
                        $('#viewRio').modal('show'); // show bootstrap modal when complete loaded
                        $('.rio-title').text('Detail Rio'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        alert('Error get data from ajax');
                    }
                });
            }

            function viewChildRio(id){
                save_method = 'view';
                $('#form')[0].reset(); // reset form value on modals
                <?php header('Content-type: application/json'); ?>
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?= site_url('rio/ajax_detail_childrio')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        // console.log(data);
                        $('.project_name').val(data.project_name);
                        $('.type').val(data.type);
                        $('.rio').val(data.rio);
                        $('.pic').val(data.fullname);
                        $('.duedate').val(data.due_date);
                        $('.desc').val(data.description);
                        if(data.closing_statement === null) {
                            $('.closingStatForm').attr('hidden', true);
                        } else {
                            $('.closingStatForm').attr('hidden', false);
                            $('.closingStat').val(data.closing_statement);
                        }
                        if(data.app === "202") {
                            $('.userApp').text(data.user_approval);
                            $(`<span class="badge bg-primary rounded-pill check" style="color: white;">✔</span>`).appendTo('.userApp');
                        } else {
                            $('.userApp').text(data.user_approval);
                        }
                        $('#viewRio').modal('show'); // show bootstrap modal when complete loaded
                        $('.rio-title').text('Detail Child Rio'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        alert('Error get data from ajax');
                    }
                });
            }

            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this RIO!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/rio/deleterio') ?>/${id}`)
                        } else {
                            swal("This customer is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>