<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Title -->
  <title><?= $tittle ?></title>
  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="<?= base_url('/public/theme/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="<?= base_url('/public') ?>/theme/assets/images/icon.png" sizes="16x16">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/filesize/8.0.6/filesize.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


  <!-- Theme Styles -->
  <link href="<?= base_url('/public') ?>/theme/assets/css/dark_theme.css" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/css/custom.css" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/css/connect.min.css" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?= base_url('/public') ?>/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
  <!-- <link rel="manifest" href="<?= base_url('') ?>/public/assets/js/web.webmanifest"> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/gantt/modules/gantt.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
  
  <style>
    .blink {
      animation: blink-animation 1s steps(10, start) infinite;
      -webkit-animation: blink-animation 1s steps(10, start) infinite;
    }

    @keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }

    @-webkit-keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }
  </style>
  <script type="text/javascript">
    function startTime() {
      var today = new Date(),
        curr_hour = today.getHours(),
        curr_min = today.getMinutes(),
        curr_sec = today.getSeconds();
      curr_hour = checkTime(curr_hour);
      curr_min = checkTime(curr_min);
      curr_sec = checkTime(curr_sec);
      document.getElementById('clock').innerHTML = curr_hour + ":" + curr_min + ":" + curr_sec;
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    setInterval(startTime, 500);
  </script>
</head>

<!-- <body> -->
<body class="compact-sidebar">
        <!-- <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div> -->
  <div class="connect-container align-content-stretch d-flex flex-wrap">
    <?= $this->include('layout/sidebar'); ?>
    <?= $this->include('layout/topbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>