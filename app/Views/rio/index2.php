<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">RIO</li>
            </ol>
        </nav>
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
                                    <button type="button" data-toggle="modal" data-target="#newTask" class="btn btn-primary">Add RIO</button>
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
                                    <th scope="col" style="width: 10%">Type</th>
                                    <th scope="col" style="width: 15%">RIO</th>
                                    <th scope="col" style="width: 15%">PIC</th>
                                    <th scope="col" style="width: 10%">Status</th>
                                    <th scope="col" style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($rio as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $r->project_name ?></td>
                                        <td><?= $r->type ?></td>
                                        <td><?= $r->rio ?></td>
                                        <td><?= $r->fullname ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($r->status == 'In Progress') ? 'info' : (($r->status == 'Waiting Approve') ? 'warning' : 'primary') ?>">
                                                <?= $r->status ?></span>
                                        </td>
                                        <td>
                                          
                                            <a data-toggle="modal" type="button" style="color: white;" data-target="#viewRio<?= $r->rid ?>" class="badge badge-info"><span class="material-icons">visibility</span></a>
                                            <?php if (user()->role == "pm" || user()->role == "admin") : ?>
                                                <a href="<?= base_url('') ?>/rio/editrio/<?= $r->rid; ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
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
        <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="form-group">
                                <label for="">Project</label>
                                <select class="js-states form-control" name="project" tabindex="-1" style="display: none; width: 100%">
                                    <?php foreach ($project as $prj) : ?>
                                        <option value="<?= $prj->id ?>"><?= $prj->project_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select class="js-states form-control" name="type" tabindex="-1" style="display: none; width: 100%">
                                    <option value="Risk">Risk</option>
                                    <option value="Issue">Issue</option>
                                    <option value="Oportunity">Oportunity</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">RIO</label>
                                <input type="text" name="rio" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>PIC</label>
                                <select class="js-states form-control" name="pic" tabindex="-1" style="display: none; width: 100%">
                                    <?php foreach ($users as $us) : ?>
                                        <option value="<?= $us->id ?>"><?= $us->fullname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>User Approval RIO</label>
                                <input type="text" readonly name="uar" value="<?= user()->fullname ?>" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label>Due Date</label>
                                <div>
                                    <div class="input-group">
                                        <input type="date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" name="due_date" value="<?= date('d/m/Y', time()) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div> -->
                            <div class="form-group">
                                <label>Required Attachment File</label>
                                <select class="js-states form-control" name="required_file" tabindex="-1" style="display: none; width: 100%;" aria-placeholder="Choose">
                                    <option value="" hidden>-- Choose --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
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
        <?php foreach ($rio as $r) : ?>
            <div class="modal fade" id="viewRio<?= $r->rid ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Details RIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('') ?>/rio/addrio" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="">Project</label>
                                    <input type="text" readonly name="project" class="form-control" value="<?= $r->project_name ?>" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="text" readonly name="type" class="form-control" value="<?= $r->type ?>" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">RIO</label>
                                    <input type="text" readonly name="rio" class="form-control" value="<?= $r->rio ?>" id="">
                                </div>
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" readonly name="project" class="form-control" value="<?= $r->fullname ?>" id="">
                                </div>
                                <div class="form-group">
                                    <label>User Approval RIO</label>
                                    <input type="text" readonly name="uao" value="<?= $r->fullname ?>" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input readonly type="date" autocomplete="off" class="form-control" name="due_date" value="<?= date('Y-m-d', strtotime($r->due_date)) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" readonly name="notes" rows="3"></textarea>
                                </div> -->
                                <div class="form-group">
                                    <label>Required Attachment File</label>
                                    <input type="text" readonly name="required_file" value="<?= $r->file ?>" class="form-control" id="">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button> -->
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