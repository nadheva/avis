<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts - SantriKoding.com</title>
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">

</head>

<body style="background: lightgray">

    <div class="mt-3">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                        </li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tabel Summary Project</h5>
                                            <table class="table table-responsive" id="zero-conf100">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Project Name</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Customer</th>
                                                        <th scope="col">Project Leader</th>
                                                        <th scope="col">Last Update</th>
                                                        <!--  <th scope="col">Quality</th>
                                                                <th scope="col">Financial</th>
                                                                <th scope="col">Delivery</th> -->
                                                        <th scope="col">Current Event</th>
                                                        <th scope="col">Next Event</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sum">
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($project as $row) : ?>
                                                    <tr>
                                                        <td>
                                                            <a type="button"
                                                                href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>"
                                                                style="color: white; background-color:#62939f; font-size:20px"
                                                                class="badge badge-info" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="View"><?= $row->project_name ?></a>
                                                        </td>
                                                        <td><?= $row->end_product ?></td>
                                                        <td><?= $row->customer_name ?></td>
                                                        <td><?= $row->fullname ?></td>
                                                        <td><?= $row->lastupdate ?></td>
                                                        <!-- <td>
                                                                    <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=quality#tabQuality" id="qualityButton"><span class="dot-<?= $row->qual ?>"></span></a>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=cost#tabCost" id="qualityButton"><span class="dot-<?= $row->finance ?>"></span></a>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>?show=delivery#tabEvent" id="eventNear"><span class="dot-<?= $row->delivery ?>"></span></a>
                                                                </td> -->
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
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tabel 2</h5>
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tabel 3</h5>
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/popper.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.js"></script>
    <script src="<?= base_url('/public') ?>/theme/assets/js/pages/datatables.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            table = $('#zero-conf100').DataTable({
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
            });
        });
        setTimeout(function () {
            location.reload();
        }, 30000);
    </script>


</body>

</html>