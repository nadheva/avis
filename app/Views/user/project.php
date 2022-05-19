<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/customer">Customer</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $customer->customer_name ?></li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/customer" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">Project List</h5>
                            </div>
                            <?php if (user()->level_id == "1" || user()->level_id == "4") : ?>
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#newTask" class="btn btn-primary">Add Project</button>
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
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 30%;">Project</th>
                                    <th scope="col" style="width: 20%;">Start</th>
                                    <th scope="col" style="width: 15%;">Customer</th>
                                    <th scope="col" style="width: 15%;">End Product</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($project as $prj) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $prj->project_name ?></td>
                                        <td><?= date("d M Y", strtotime($prj->start)) ?></td>
                                        <td><?= $prj->customer_name ?></td>
                                        <td><?= $prj->end_product ?></td>
                                        <td><span class="badge badge-info">
                                                <?= $prj->status ?>
                                            </span></td>
                                        <td>
                                            <a href="<?= base_url('') ?>/project/detailproject/<?= $prj->p_id; ?>/<?= $customer->id ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span class="material-icons">visibility</span></a>
                                            <?php if (user()->level_id == "1" || user()->level_id == "4") : ?>
                                                <a href="<?= base_url('') ?>/project/editproject/<?= $prj->p_id; ?>/<?= $customer->id ?>" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons">edit</span></a>
                                                <a type="button" class="badge badge-danger" onclick="del(<?= $prj->p_id ?>, <?= $customer->id ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons" style="color: white;">delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/addproject" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="project_name">
                            </div>
                            <div class="form-group">
                                <label for="">Customer</label>
                                <input type="text" class="form-control" placeholder="<?= $customer->customer_name ?>" name="customer" readonly value="<?= $customer->customer_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="end">End Product</label>
                                <select class="js-states form-control" tabindex="-1" style="display: none; width: 100%" id="end" name="end_product">
                                    <option hidden>--Choose--</option>
                                    <option value="PWBA">PWBA</option>
                                    <option value="Cluster">Cluster</option>
                                </select>
                                <input type="hidden" id="name" name="endpro">
                            </div>
                            <div class="row my-4">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                    <input type="hidden" name="cust_id" value="<?= $customer->id ?>">
                    <input type="hidden" name="project_id" value="<?= $project_id ?>">
                    </form>
                </div>
            </div>
        </div>
        <script type='text/javascript'>
            $(window).load(function() {
                $("#endproduct").change(function() {
                    console.log($("#endproduct option:selected").val());
                    if ($("#endproduct option:selected").val() == 'Cluster') {
                        $('#details').prop('hidden', false);
                        $('#labeldetails').prop('hidden', false);
                    } else {
                        $('#details').prop('hidden', true);
                        $('#labeldetails').prop('hidden', true);
                    }
                });
            });
        </script>
        <script>
            function del(id, idc) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this project!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/project/deleteproject') ?>/${id}/${idc}`)
                        } else {
                            swal("This project is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>