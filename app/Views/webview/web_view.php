<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Web View</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('/public') ?>/theme/assets/images/icon.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">  


    <!-- Theme Styles -->
    <link href="<?= base_url('/public') ?>/theme/assets/css/connect.min.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/css/dark_theme.css" rel="stylesheet">
    <link href="<?= base_url('/public') ?>/theme/assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="page-sidebar">
            <div class="logo-box">
                <a href="<?= base_url() ?>">
                    <img id="myImage" src="<?= base_url('/public') ?>/theme/assets/images/logo-light.png" width="150px" class="img-fluid" alt="">
                </a>
                <a href="#" id="sidebar-close">
                    <i class="material-icons">close</i>
                </a> 
                <a href="#" id="sidebar-state">
                    <i class="material-icons">keyboard_double_arrow_left</i>
                    <i class="material-icons compact-sidebar-icon">keyboard_double_arrow_right</i>
                </a>
            </div>
            <div class="page-sidebar-inner slimscroll">
                <ul class="accordion-menu">
                    <!-- <li class="sidebar-title">
                        Apps
                    </li>
                    <li class="active-page">
                        <a href="index.html" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="page-container">
            <div class="page-header">
                <nav class="navbar navbar-expand">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav">
                        <li class="nav-item small-screens-sidebar-link">
                            <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="page-content">
                <div class="page-info">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Apps</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="main-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                  <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
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
                                                    <table class="table table-responsive" id="zero-conf100" style="width: 85%;">
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
                                                                    <a type="button" href="<?= base_url('') ?>/project/detailproject/<?= $row->id ?>/<?= $row->cust_id ?>" style="color: white; background-color:#62939f; font-size:20px" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><?= $row->project_name ?></a>
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

</div>
</div>
<div class="page-footer">
    <div class="row">
        <div class="col-md-12">
            <span class="footer-text"><?= date('Y') ?> © Astra Visteon Indonesia</span>
        </div>
    </div>
</div>
</div>
</div>

<!-- Javascripts -->
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/popper.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/blockui/jquery.blockUI.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/connect.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/pages/dashboard.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/pages/datatables.js"></script>
</body>
</html>

<script type="text/javascript">
 $(document).ready(function() {
    table = $('#zero-conf100').DataTable({
       "searching": false,
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": true,
       "bInfo": false,
       "bAutoWidth": false ,
       "order": [[ 3, "desc" ]]
   });
});
 setTimeout(function() {
     location.reload();
 }, 30000); 


</script>