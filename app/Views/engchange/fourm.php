<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/engchange">Engineering Change</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $projectrow->project_name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/engchange" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-transparent file-list">
                    <div class="card-body">
                        <div class="container text-center">
                        <div class="row">
                            <div class="col-12">
                                <a class="btn" style="background-color: #5e5d5a; color: white">4M Change Request</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 right-line"></div>
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-3 p-0">
                            <div class="halved right-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved top-line"></div>
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line top-line"></div>
                            <div class="halved"></div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        </div>
                        <div class="row">
                            <?php foreach($fourm as $row) : ?>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= base_url('') ?>/engchange/list/<?= $row->id ?>">View Details</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="folder-icon">
                                                    <i class="material-icons" style="color:orange">folder</i>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="folder-info">
                                                    <a href="<?= base_url('') ?>/engchange/list/<?= $projectrow->id ?>/<?= $row->id ?>"><?= $row->fourm ?></a>
                                                    <span> request</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this area!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/engchange/delarea') ?>/${id}`)
                        } else {
                            swal("This area is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>