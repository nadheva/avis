<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                    </ol>
                </nav>
            </div>
            <?php if (user()->level_id == "1" || user()->level_id == "4") : ?>
            <div class="col-6 text-right">
                <button type="button" data-toggle="modal" data-target="#newProject" class="btn btn-primary">Add
                    Project</button>
            </div>
            <?php endif ?>
        </div>
    </div>
    <div class="main-wrapper">
        <?= view('Myth\Auth\Views\_message_block') ?>
        <?php if (session()->has('pesan')) : ?>
        <div class="alert alert-primary alert-dismissible fade show">
            <?= session('pesan') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        <div class="row">
            <div class="col-xl">
                <div class="card card-transparent">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card bg-dark">
                                    <img src="<?= base_url('') ?>/public/theme/assets/photo/card3.jpg" class="card-img"
                                        style="opacity: 0.5;" alt="...">
                                    <div class="card-img-overlay">
                                        <div class="row">
                                            <div class="col-3">
                                                <button class="btn btn-lg btn-secondary" type="button">3</button>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h5 class="card-title mt-3 text-white">Product Type</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card stats-card text-center">
                                    <div class="card-body text-center">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" value="Cluster" type="submit" id="searchCluster">
                                                        <?php
                                                        echo count($cluster);
                                                        ?>
                                                    </button>
                                                    <p class="stats-text" style="color: black;">Cluster</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button" id="searchAHU">
                                                        <?php
                                                        echo count($ahu);
                                                        ?>
                                                    </button>
                                                    <p class="stats-text" style="color: black;">Audio Head Unit</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button"
                                                        id="searchPWBA">
                                                        <?php
                                                        echo count($pwba);
                                                        ?>
                                                    </button>
                                                    <p class="stats-text" style="color: black;">PWBA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card bg-dark">
                                    <img src="<?= base_url('') ?>/public/theme/assets/photo/card.jpg" class="card-img"
                                        style="opacity: 0.5;" alt="...">
                                    <div class="card-img-overlay">
                                        <div class="row">
                                            <div class="col-3">
                                                <button class="btn btn-lg btn-secondary" type="button">-</button>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h5 class="card-title mt-3 text-white">Product And Project</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card stats-card text-center">
                                    <div class="card-body text-center">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Pursuit Phase</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Development</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Pilot Phase</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Safe Launch</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Current Model</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">-</button>
                                                    <p class="stats-text" style="color: black;">Past Model Service</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-dark">
                                    <img src="<?= base_url('') ?>/public/theme/assets/photo/card2.jpg" class="card-img"
                                        style="opacity: 0.5;" alt="...">
                                    <div class="card-img-overlay">
                                        <div class="row">
                                            <div class="col-3">
                                                <a class="btn btn-lg btn-secondary" type="button" data-toggle="modal" style="color: #7d7d83;" data-target="#totCust"><?= count($customer) ?></a>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h5 class="card-title mt-3 text-white">Total Customer</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card stats-card">
                                    <div class="card-body align-items-center d-flex justify-content-center">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">
                                                        <?php 
                                                        foreach($customer as $row) {
                                                            if($row->type == '2 Wheel') {
                                                                $type2 [] = $row->id;
                                                            }
                                                        }
                                                        if(isset($type2)){
                                                            echo count($type2);
                                                        } else { echo '0'; }
                                                        ?>
                                                    </button>
                                                    <p class="stats-text" style="color: black;">2 Wheel</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stats-info">
                                                    <button class="btn btn-lg btn-success" type="button">
                                                        <?php 
                                                        foreach($customer as $row) {
                                                            if($row->type == '4 Wheel') {
                                                                $type4 [] = $row->type;
                                                            }
                                                        }
                                                        if(isset($type4)){
                                                            echo count($type4);
                                                        } else { echo '0'; }
                                                        ?>
                                                    </button>
                                                    <p class="stats-text" style="color: black;">4 Wheel</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
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
                                <h5 class="card-title">Project Summary</h5>
                            </div>
                        </div>
                        <br>
                        <table class="table table-responsive" id="zero-conf100">
                            <thead>
                                <tr>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Project Leader</th>
                                    <th scope="col">Last Update</th>
                                    <th scope="col">Quality</th>
                                    <th scope="col">Financial</th>
                                    <th scope="col">Delivery</th>
                                    <th scope="col">Current Event</th>
                                    <th scope="col">Next Event</th>
                                </tr>
                            </thead>
                            <tbody id="sum">
                                <?php $i = 1; ?>
                                <?php foreach ($project as $row) : ?>
                                <tr>
                                    <td>
                                        <a type="button" href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>" style="color: white; background-color:#62939f; font-size:20px" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><?= $row->project_name ?></a>
                                    </td>
                                    <td><?= $row->end_product ?></td>
                                    <td><?= $row->customer_name ?></td>
                                    <td><?= $row->fullname ?></td>
                                    <td><?= $row->lastupdate ?></td>
                                    <td>
                                        <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=quality#tabQuality"" id="qualityButton"><span class="dot-<?= $row->qual ?>"></span></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=cost#tabCost" id="qualityButton"><span class="dot-<?= $row->finance ?>"></span></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=delivery#tabEvent" id="eventNear"><span class="dot-<?= $row->delivery ?>"></span></a>
                                    </td>
                                    <td><?= $row->current_event ?></td>
                                    <td><?= $row->last_event ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="totCust" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Total Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 20%">Customer</th>
                                    <th scope="col" style="width: 20%">Type</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $y = 1; ?>
                                <?php foreach ($customer as $r) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $r->customer_name ?></td>
                                    <td><?= $r->type ?></td>
                                    <td>
                                        <a type="button" data-dismiss="modal" style="color: white;" class="badge badge-info" data-toggle="tooltip" data-placement="top" id="customer<?= $y++ ?>" title="View"><i class="material-icons">visibility</i></a>
                                        <?php if(user()->level_id == 4) : ?>
                                        <span data-toggle="modal" data-target="#editCust<?= $r->id ?>">
                                            <a type="button" data-dismiss="modal" style="color: white;" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">edit</i></a>
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
        <div class="modal fade bd-example-modal-lg" id="newProject" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/project/addproject" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="project_name">
                            </div>
                            <div class="form-group">
                                <label for="">Customer</label>
                                <select class="js-states form-control" name="cust_id" tabindex="-1"
                                    style="display: none; width: 100%">
                                    <?php foreach($customer as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->customer_name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="end">End Product</label>
                                <select class="js-states form-control" tabindex="-1" style="display: none; width: 100%"
                                    id="end" name="end_product">
                                    <option hidden>--Choose--</option>
                                    <option value="PWBA">PWBA</option>
                                    <option value="Cluster">Cluster</option>
                                    <option value="AHU">AHU</option>
                                </select>
                                <input type="hidden" id="name" name="endpro">
                            </div>
                            <div class="form-group">
                                <label for="end">Project Leader</label>
                                <select class="js-states form-control" tabindex="-1" style="display: none; width: 100%" name="leader">
                                    <?php foreach($user as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->fullname ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="row my-4">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel" class="btn btn-secondary mr-2"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach($customer as $row) : ?>
        <div class="modal fade bd-example-modal-lg" id="editCust<?= $row->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/customer/updatecust/<?= $row->id ?>" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Customer Name</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="customer_name" type="text"
                                        value="<?= $row->customer_name; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Type</label>
                                <div class="col-sm-7">
                                    <select class="js-states form-control" tabindex="-1" style="display: none; width: 100%" name="type">
                                        <option hidden>--Choose--</option>
                                        <option value="2 Wheel" <?= $row->type == '2 Wheel' ? 'selected' : '' ?>>2 Wheel</option>
                                        <option value="4 Wheel" <?= $row->type == '4 Wheel' ? 'selected' : '' ?>>4 Wheel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <button type="button" id="cancel" class="btn btn-secondary mr-2"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
            <script>
                $(document).ready(function() {
                    $('#zero-conf100').DataTable( {
                        "order": [[ 3, "desc" ]]
                    } );
                } );
                function del(id) {
                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this customer!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                location.replace(`<?= base_url('/customer/delcus') ?>/${id}`)
                            } else {
                                swal("This customer is safe!");
                            }
                        });
                }
            </script>
            <?= $this->endSection(); ?>