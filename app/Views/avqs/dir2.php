<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>/avqs">AV Quality System</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= base_url('') ?>/avqs/dir1/<?= $avqsrow['id'] ?>"><?= $avqsrow['avqs_name'] ?></a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $dir1row->dir ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/avqs/dir1/<?= $avqsrow['id'] ?>" class="badge badge-secondary">⬅ Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-transparent file-list">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Directory</h5>
                            </div>
                            <div class="col-6 text-right"> 
                                <?php if(user()->department_id == '3') :  ?>
                                <button type="button" data-toggle="modal" data-target="#newFolder" class="btn btn-primary">Add Folder</button>
                                <?php endif ?>
                            </div>
                        </div>
                        <br>
                        <?php if(count($dir2) == 0) : ?>
                        <div class="row">
                            <div class="col-12 text-center" style="margin-top:100px">
                                <p>-No Folder Available-</p>
                            </div>
                        </div>
                        <?php endif ?>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <?php if (session()->has('pesan')) : ?>
                        <div class="alert alert-primary alert-dismissible fade show">
                            <?= session('pesan') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <br>
                        </div>
                        <?php endif ?>
                        <div class="row">
                            <?php foreach($dir2 as $row) : ?>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a type="button" class="dropdown-item" href="<?= base_url('') ?>/avqs/file/<?= $avqsrow['id'] ?>/<?= $dir1row->id ?>/<?= $row['id'] ?>">View Details</a>
                                            <?php if(user()->department_id == '3') :  ?>
                                            <a type="button" class="dropdown-item" data-target="#editFolder<?= $row['id'] ?>" data-toggle="modal">Rename</a>
                                            <a type="button" class="dropdown-item" onclick="del(<?= $row['id']; ?>, <?= $avqsrow['id'] ?>, <?= $dir1row->id ?>)">Delete</a>
                                            <?php endif ?>
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
                                                    <a href="<?= base_url('') ?>/avqs/file/<?= $avqsrow['id'] ?>/<?= $dir1row->id ?>/<?= $row['id'] ?>"><?= $row['dir'] ?></a>
                                                    <span><?= $row['countdir'] ?> File</span>
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
        <!-- Modal Add Folder -->
        <div class="modal fade" id="newFolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/avqs/adddir2" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Folder Name" name="dir">
                            </div>
                            <input type="hidden" name="avqs_id" value="<?= $avqsrow['id'] ?>">
                            <input type="hidden" name="avqsname" value="<?= $avqsrow['avqs_name'] ?>">
                            <input type="hidden" name="dir1id" value="<?= $dir1row->id ?>">
                            <input type="hidden" name="dir1name" value="<?= $dir1row->dir ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Folder -->
        <?php foreach($dir2 as $row) : ?>
        <div class="modal fade" id="editFolder<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rename Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/avqs/updatedir2/<?= $row['id'] ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?= $row['dir'] ?>" name="newdir">
                            </div>
                            <input type="hidden" name="avqs_id" value="<?= $avqsrow['id'] ?>">
                            <input type="hidden" name="avqsname" value="<?= $avqsrow['avqs_name'] ?>">
                            <input type="hidden" name="dir1name" value="<?= $dir1row->dir ?>">
                            <input type="hidden" name="dir1id" value="<?= $dir1row->id ?>">
                            <input type="hidden" name="olddir" value="<?= $row['dir'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <script>
            function del(id,avqsid,dir1id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this folder!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/avqs/deldir2') ?>/${id}/${avqsid}/${dir1id}`)
                        } else {
                            swal("This folder is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>