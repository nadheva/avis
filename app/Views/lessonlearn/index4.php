<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Lesson learned</li>
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
                                <h5 class="card-title">Lesson Learn List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <?php if(user()->department_id == "3") :  ?>
                                    <button type="button" data-toggle="modal" data-target="#newLesson" class="btn btn-primary">Add Lesson</button>
                                    <?php endif ?>
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
                        <table class="table table-responsive" id="zero-conf2">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 5%">Project</th>
                                    <th scope="col" style="width: 10%">Source</th>
                                    <th scope="col" style="width: 10%">Problem</th>
                                    <th scope="col" style="width: 15%">Rootcause</th>
                                    <th scope="col" style="width: 10%">Status</th>
                                    <th scope="col" style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($allLesson as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->project_name ?></td>
                                        <td><?= $row->source ?></td>
                                        <td><?= $row->problem ?></td>
                                        <td><?= $row->rootcause ?></td>
                                        <td>
                                            <span class="bcstm bcstm-<?= $row->status == 'Open' ? 'danger' : 'primary' ?>"><?= $row->status ?></span>
                                        </td>
                                        <td>
                                            <span data-toggle="modal" data-target="#viewLesson">
                                                <a type="button" style="color: white;" 
                                                data-id="<?= $row->id;?>" 
                                                data-project_name="<?= $row->project_name;?>" 
                                                data-source="<?= $row->source;?>" 
                                                data-problem="<?= $row->problem;?>" 
                                                data-rootcause="<?= $row->rootcause;?>" 
                                                data-countermeasure="<?= $row->countermeasure;?>" data-prevention="<?= $row->prevention;?>" 
                                                data-rootcause="<?= $row->rootcause;?>" 
                                                data-remaks="<?= $row->remaks;?>" 
                                                data-file="<?= $row->file;?>" 
                                                class="badge badge-info btn-view"
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="View">
                                                <span class="material-icons">visibility</span></a>
                                            </span>
                                            <?php if(user()->department_id == "3") :  ?>
                                                <span data-toggle="modal" data-target="#editLesson">
                                                    <a type="button" 
                                                    data-id="<?= $row->id;?>" 
                                                    data-project_name="<?= $row->project_name;?>" 
                                                    data-source="<?= $row->source;?>" 
                                                    data-problem="<?= $row->problem;?>" 
                                                    data-rootcause="<?= $row->rootcause;?>" 
                                                    data-countermeasure="<?= $row->countermeasure;?>" data-prevention="<?= $row->prevention;?>" 
                                                    data-rootcause="<?= $row->rootcause;?>" 
                                                    data-remaks="<?= $row->remaks;?>" 
                                                    data-file="<?= $row->file;?>"
                                                    class="badge badge-primary" type="button"  data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" style="color: white;">edit</span></a>
                                                </span>
                                                <a type="button" data-toggle="tooltip" data-placement="top" title="Delete" class="badge badge-danger" onclick="del(<?= $row->id; ?>)"><span class="material-icons" style="color: white;">delete</span></a>
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
        <!-- Form Add Lesson learn -->
        <div class="modal fade" id="newLesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/lessonlearn/addlesson" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <select class="js-states form-control" name="project_id" tabindex="-1" style="display: none; width: 100%">
                                            <?php foreach($project as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->project_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Source Claim</label>
                                        <select class="js-states form-control" name="source" tabindex="-1" style="display: none; width: 100%">
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Design">Design</option>
                                            <option value="Customer">Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Problem</label>
                                <input type="text" name="problem" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">File</label>
                                <input type="file" name="file" class="filestyle">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Countermeasure</label>
                                        <textarea class="form-control" required name="countermeasure" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Rootcause</label>
                                        <textarea class="form-control" required name="rootcause" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Prevention</label>
                                        <textarea class="form-control" required name="prevention" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Remaks</label>
                                        <textarea class="form-control" required name="remaks" rows="3"></textarea>
                                    </div>
                                </div>
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
        <!-- Modal Detail Lesson -->
        <div class="modal fade" id="viewLesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details Lesson</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/lessonlearn/" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <input type="text" name="project" readonly class="form-control project_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Source Claim</label>
                                        <input type="text" class="form-control source" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Problem</label>
                                <input type="text" class="form-control problem" readonly>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Countermeasure</label>
                                        <textarea class="form-control countermeasure" readonly name="countermeasure" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Rootcause</label>
                                        <textarea class="form-control rootcause" readonly required name="rootcause" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Prevention</label>
                                        <textarea class="form-control prevention" readonly required name="prevention" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Remaks</label>
                                        <textarea class="form-control remaks" readonly name="remaks" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-4 colFile">
                                    <div class="card card-transparent file-list recent-files">
                                        <div class="card-body">
                                            <label for="">File</label>
                                            <div class="card file">
                                                <div class="file-options dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item fileview" target="_blank">View</a>
                                                        <a class="dropdown-item fileview" target="_blank">Download</a>
                                                    </div>
                                                </div>
                                                <div class="card-header file-icon">
                                                    <i class="material-icons">description</i>
                                                </div>
                                                <div class="card-body file-info">
                                                    <p id="fileName"></p>
                                                    <span class="file-size" id="fileSize">
                                                    </span><br>
                                                    <span class="file-date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        <script>
            
            $(document).ready(function(){
                $('.btn-view').on('click',function(){
                const id = $(this).data('id');
                const project_name = $(this).data('project_name');
                const source = $(this).data('source');
                const problem = $(this).data('problem');
                const countermeasure = $(this).data('countermeasure');
                const rootcause = $(this).data('rootcause');
                const prevention = $(this).data('prevention');
                const remaks = $(this).data('remaks');
                const file = $(this).data('file');
                // console.log(filesize(500));
                // Set data to Form View
                $('.project_name').val(project_name);
                $('.source').val(source);
                $('.problem').val(problem);
                $('.countermeasure').val(countermeasure);
                $('.rootcause').val(rootcause);
                $('.prevention').val(prevention);
                $('.remaks').val(remaks);
                if(file === '') {
                    $('.colFile').attr("hidden", true);
                } else {
                    $('.colFile').attr("hidden", false);
                    $('#fileName').text(file);
                    $('.fileview').attr("href", `<?= base_url('public') ?>/theme/assets/lesson learn/${file}`).trigger('change');
                }
                // Call Modal View
                $('#viewModal').modal('show');
            });

            });

            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this lesson!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/lessonlearn/deletelesson') ?>/${id}`)
                        } else {
                            swal("This lesson is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>