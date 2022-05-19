<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Design Standard</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-transparent file-list">
                    <div class="card-body">
                        <div class="container text-center">
                        <div class="row">
                            <div class="col-12">
                                <a class="btn" style="background-color: #5e5d5a; color: white">Design Standard</a>
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
                            </div>
                            <div class="col-3 p-0">
                            <div class="halved right-line"></div>
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
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= base_url('') ?>/designstandard/area/1">View Details</a>
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
                                                    <a href="<?= base_url('') ?>/designstandard/area/1">Mechanical</a>
                                                    <span>design</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= base_url('') ?>/designstandard/area/2">View Details</a>
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
                                                    <a href="<?= base_url('') ?>/designstandard/area/2">Electrical</a>
                                                    <span>design</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>