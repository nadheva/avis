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
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= base_url('') ?>/avqs/dir2/<?= $avqsrow['id'] ?>/<?= $dir1row->id ?>"><?= $dir1row->dir ?></a></li>
                        <li class="breadcrumb-item" aria-current="page"><?= $dir2row->dir ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="<?= base_url('') ?>/avqs/dir2/<?= $avqsrow['id'] ?>/<?= $dir1row->id ?>" class="badge badge-secondary">⬅ Back</a>
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
                                <h5 class="card-title">File</h5>
                            </div>
                            <div class="col-6 text-right"> 
                                <?php if(user()->department_id == '3') :  ?>
                                <button type="button" data-toggle="modal" data-target="#newFile" class="btn btn-primary">Add File</button>
                                <?php endif ?>
                            </div>
                        </div>
                        <br>
                        <?php if(count($file) == 0) : ?>
                        <div class="row">
                            <div class="col-12 text-center" style="margin-top:100px">
                                <p>-No File Available-</p>
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
                            <?php foreach($file as $row) : ?>
                            <div class="col-md-3">
                                <div class="card folder">
                                    <div class="file-options dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a type="button" class="dropdown-item" href="<?= base_url('') ?>/avqs/download/<?= $avqsrow['avqs_name'] ?>/<?= $dir1row->dir ?>/<?= $dir2row->dir ?>/<?= $row->file ?>">Download</a>
                                            <?php if(user()->department_id == '3') :  ?>
                                            <a type="button" class="dropdown-item" data-target="#editFolder<?= $row->id ?>" data-toggle="modal">Rename</a>
                                            <a type="button" class="dropdown-item" onclick="del(<?= $row->id; ?>, <?= $avqsrow['id'] ?>, <?= $dir1row->id ?>, <?= $dir2row->id ?>)">Delete</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="folder-icon">
                                                    <?php $type = substr($row->file,-3);?>
                                                    <i class="material-icons" style="color : <?= ($type == 'pdf') ? '#f27e7e' : (($type == 'lsx') ? '#69bf73' : 'grey') ?>">
                                                        description
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="folder-info">
                                                    <a href="<?= base_url('') ?>/avqs/download/<?= $avqsrow['avqs_name'] ?>/<?= $dir1row->dir ?>/<?= $dir2row->dir ?>/<?= $row->file ?>"><?= $row->file ?></a>
                                                    <span>
                                                    <?php $filesize = filesize('public/theme/assets/av quality system/' . $avqsrow['avqs_name'] . '/' . $dir1row->dir. '/' . $dir2row->dir. '/' . $row->file); 
                                                    if ($filesize >= 1048576) { echo number_format($filesize / 1048576, 2) . ' MB'; } elseif ($filesize >= 1024) { echo number_format($filesize / 1024, 2) . ' KB'; } elseif ($filesize > 1) { echo ' Bytes'; } ?>
                                                    </span>
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
        <div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/avqs/addfile" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="file" class="filestyle" name="file">
                            </div>
                            <input type="hidden" name="avqs_id" value="<?= $avqsrow['id'] ?>">
                            <input type="hidden" name="avqsname" value="<?= $avqsrow['avqs_name'] ?>">
                            <input type="hidden" name="dir1id" value="<?= $dir1row->id ?>">
                            <input type="hidden" name="dir1name" value="<?= $dir1row->dir ?>">
                            <input type="hidden" name="dir2id" value="<?= $dir2row->id ?>">
                            <input type="hidden" name="dir2name" value="<?= $dir2row->dir ?>">
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
        <?php foreach($file as $row) : ?>
        <div class="modal fade" id="editFolder<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form action="<?= base_url('') ?>/avqs/updatefile/<?= $row->id ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?= $row->file ?>" name="newdir">
                            </div>
                            <input type="hidden" name="avqs_id" value="<?= $avqsrow['id'] ?>">
                            <input type="hidden" name="avqsname" value="<?= $avqsrow['avqs_name'] ?>">
                            <input type="hidden" name="dir1name" value="<?= $dir1row->dir ?>">
                            <input type="hidden" name="dir1id" value="<?= $dir1row->id ?>">
                            <input type="hidden" name="olddir" value="<?= $row->file ?>">
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
            function del(id,avqsid,iddir1,iddir2) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/avqs/delfile') ?>/${id}/${avqsid}/${iddir1}/${iddir2}`)
                        } else {
                            swal("This file is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>