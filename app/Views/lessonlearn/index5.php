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
                                    <button type="button" class="btn btn-primary" onclick="addLesson()">Add Lesson</button>
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
                        <table class="table table-responsive" id="tableLessonLearn">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 10%">Source</th>
                                    <th scope="col" style="width: 10%">Problem</th>
                                    <th scope="col" style="width: 10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Project</label>
                                        <input type="text" name="project" class="form-control project_name">
                                        <input type="hidden" name="pid" class="form-control project_id">
                                        <div class="selectProject">
                                            <select class="js-states form-control" name="project_id" tabindex="-1" style="display: none; width: 100%">
                                                <?php foreach($project as $row) : ?>
                                                <option value="<?= $row->id ?>"><?= $row->project_name ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Source Claim</label>
                                        <input type="text" name="source" class="form-control source">
                                        <div class="selectSource">
                                            <select class="js-states form-contro selectSrc" name="source" tabindex="-1" style="display: none; width: 100%">
                                                <option id="manufacturing" value="Manufacturing">Manufacturing</option>
                                                <option id="design" value="Design">Design</option>
                                                <option id="customer" value="Customer">Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="singleProb">
                                <label for="">Problem</label>
                                <input type="text" name="addproblem" class="form-control problem">
                            </div>
                            <div class="row" id="statProb">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Problem</label>
                                        <input type="text" name="problem" class="form-control problem">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <div class="col-sm-7">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="status" id="exampleRadios1" value="Open">
                                                <label class="custom-control-label" for="exampleRadios1">
                                                    Open
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="status" id="exampleRadios2" value="Closed">
                                                <label class="custom-control-label" for="exampleRadios2">
                                                    Closed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" hidden="true" id="fileUpload">
                                <label for="">File</label>
                                <input type="file" name="file" class="filestyle">
                                <div class="text-right"><small class="text-muted">*optional</small></div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Countermeasure</label>
                                        <textarea class="form-control countermeasure" name="countermeasure" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Rootcause</label>
                                        <textarea class="form-control rootcause" required name="rootcause" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Prevention</label>
                                        <textarea class="form-control prevention" required name="prevention" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Remaks</label>
                                        <textarea class="form-control remaks" name="remaks" rows="3"></textarea>
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
                            <div class="footerButton">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary ml-3">Add</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready( function () {
            var table = $('#tableLessonLearn').DataTable({ 
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('lessonlearn/ajax_list')?>",
                    "type": "POST"
                },
                //optional
                "lengthMenu": [[5, 10, 25], [5, 10, 25]],
                "columnDefs": [
                { 
                    "targets": [],
                    "orderable": false,
                },
                ],
            });
            } );
        </script>

        <script type="text/javascript">
            var save_method; //for save method string

            function addLesson(){
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('#form').attr("action", "<?= site_url('lessonlearn/addlesson')?>");
                $('.project_name').attr("hidden", true);
                $('.source').attr("hidden", true);
                $('.countermeasure').attr("readonly", false);
                $('.rootcause').attr("readonly", false);
                $('.prevention').attr("readonly", false);
                $('.remaks').attr("readonly", false);
                $('.colFile').attr("hidden", true);
                $('#fileUpload').attr("hidden", false);
                $('.selectSource').attr("hidden", false);
                $('.selectProject').attr("hidden", false);
                $('.footerButton').attr("hidden", false);
                $('#singleProb').attr("hidden", false);
                $('#statProb').attr("hidden", true);
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Add Lesson Learn'); // Set Title to Bootstrap modal title
            }

            function view(id){
                save_method = 'view';
                $('#form')[0].reset(); // reset form value on modals
                <?php header('Content-type: application/json'); ?>
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?= site_url('lessonlearn/ajax_detail_view')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        // console.log(data);
                        $('.project_name').val(data.project_name).attr("hidden", false).attr("readonly", true);
                        $('.source').val(data.source).attr("hidden", false).attr("readonly", true);
                        $('.problem').val(data.problem).attr("readonly", true);
                        $('.countermeasure').val(data.countermeasure).attr("readonly", true);
                        $('.rootcause').val(data.rootcause).attr("readonly", true);
                        $('.prevention').val(data.prevention).attr("readonly", true);
                        $('.remaks').val(data.remaks).attr("readonly", true);
                        $('.selectSource').attr("hidden", true);
                        $('.selectProject').attr("hidden", true);
                        $('.footerButton').attr("hidden", true);
                        $('#singleProb').attr("hidden", false);
                        $('#statProb').attr("hidden", true);
                        if(data.file === null) {
                            $('.colFile').attr("hidden", true);
                        } else {
                            $('.colFile').attr("hidden", false);
                            $('#fileName').text(data.file);
                            $('.fileview').attr("href", `<?= base_url('public') ?>/theme/assets/lesson learn/${data.file}`).trigger('change');
                            $('.file-size').text(filesize(265318, {round: 0}));
                            $('.file-date').text(data.created_at);
                        }
                        $('#fileUpload').attr("hidden", true);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Detail Lesson Learn'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        alert('Error get data from ajax');
                    }
                });
            }

            function edit(id){
                save_method = 'edit';
                $('#form')[0].reset(); // reset form value on modals
                $('#form').attr("action", "<?= site_url('lessonlearn/updatelesson/')?>"+id);
                <?php header('Content-type: application/json'); ?>
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?= site_url('lessonlearn/ajax_detail_view')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('.project_name').val(data.project_name).attr("hidden", true).attr("readonly", true);
                        $('.project_id').val(data.project_id);
                        $('.source').val(data.source).attr("hidden", true).attr("readonly", true);
                        $('.problem').val(data.problem).attr("readonly", false);
                        $('.countermeasure').val(data.countermeasure).attr("readonly", false);
                        $('.rootcause').val(data.rootcause).attr("readonly", false);
                        $('.prevention').val(data.prevention).attr("readonly", false);
                        $('.remaks').val(data.remaks).attr("readonly", false);
                        $('.selectSource').attr("hidden", false);
                        // $('.selectSrc option:contains(' + data.source + ')').attr('selected', 'true');
                        $('[name="project_id"]').val(data.project_id).trigger('change');
                        $('[name="source"]').val(data.source).trigger('change');
                        $('.selectProject').attr("hidden", false);
                        $('.footerButton').attr("hidden", true);
                        $('.colFile').attr("hidden", true);
                        if(data.status === 'Open') {
                            $('#exampleRadios1').attr("checked", true);
                            $('#exampleRadios2').attr("checked", false);
                        } 
                        if(data.status === 'Closed') {
                            $('#exampleRadios2').attr("checked", true);
                            $('#exampleRadios1').attr("checked", false);
                        }
                        $('#fileUpload').attr("hidden", true);
                        $('.footerButton').attr("hidden", false);
                        $('#singleProb').attr("hidden", true);
                        $('#statProb').attr("hidden", false);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Lesson Learn'); // Set title to Bootstrap modal title

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        alert('Error get data from ajax');
                    }
                });
            }
        </script>

        <script>
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