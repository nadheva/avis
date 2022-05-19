<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$o = new stdClass;
$o->id='0';
$o->depart_name='--Choose--';
array_push($depart, $o);
foreach($depart as $row){
    $newDepart[$row->id] = $row->depart_name;
}
sort($newDepart);
$s = new stdClass;
$s->id='0';
$s->section_name='--Choose--';
array_push($section, $s);
foreach($section as $row){
    $newSection[$row->id] = $row->section_name;
}
sort($newSection);
?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item" aria-current="page">Manage User</li>
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
                               <h5 class="card-title">User List</h5>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target=".add-user"
                                        class="btn btn-primary">Add User</button>
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
                        <table class="table table-responsive" id="zero-conf">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 20%;">Full Name</th>
                                    <th scope="col" style="width: 20%;">Level</th>
                                    <th scope="col" style="width: 20%;">Department</th>
                                    <th scope="col" style="width: 20%;">Section</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($getAllUsers as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $user->fullname ?></td>
                                    <td><?= $user->level_name ?></td>
                                    <td><?= $user->depart_name ?></td>
                                    <td><?= $user->section_name ?></td>
                                    <td>
                                        <a href="<?= base_url('') ?>/admin/detail/<?= $user->userid; ?>" class="badge badge-info"><span class="material-icons">visibility</span></a>
                                        <a href="<?= base_url('') ?>/admin/edit/<?= $user->userid; ?>" class="badge badge-primary"><span class="material-icons">edit</span></a>
                                        <?php if ($user->level_id != 1) : ?>
                                        <a type="button" class="badge badge-danger" onclick="del(<?= $user->userid; ?>)"><span class="material-icons" style="color: white;">delete</span></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    <div class="modal fade add-user bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Input new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/public') ?><?= route_to('register') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email"
                                        class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                        name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>"
                                        value="<?= old('email') ?> " required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text"
                                        class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>"
                                        name="fullname" placeholder="Fullname" value="<?= old('fullname') ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Level</label>
                                <select class="js-states form-control level" tabindex="-1" style="display: none; width: 100%" name="level_id">
                                    <option value="0" hidden>-- Choose --</option>
                                    <?php foreach($level as $row ) { ?>
                                        <option value="<?= $row->id ?>"><?= $row->level_name ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                        <label>Department</label>
                                        <select class="js-states form-control depart" tabindex="-1" style="display: none; width: 100%" name="dept_id" id="departaa">
                                            <option>-- Choose --</option>
                                            <?php foreach($depart as $row ) { ?>
                                                <option value="<?= $row->id ?>"><?= $row->depart_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="department_id" id="depart">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                        <label>Section</label>
                                        <select id="sectionaa" class="js-states form-control section" tabindex="-1" style="display: none; width: 100%" name="sect_id">
                                            <option>-- Choose --</option>
                                            <?php foreach($section as $row ) { ?>
                                                <option value="<?= $row->id ?>"><?= $row->section_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="section_id" id="section">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password"
                                class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                placeholder="<?= lang('Auth.password') ?>" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="pass_confirm">Repeat Password</label>
                            <input type="password" name="pass_confirm"
                                class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                placeholder="Repeat Password" autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
    </script>
    
    <script>
        function del(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.replace(`<?= base_url('/admin/delete') ?>/${id}`)
                    } else {
                        swal("This user is safe!");
                    }
                });
        }
        var valDept = <?= json_encode($newDepart) ?>;
        var valSec = <?= json_encode($newSection) ?>;
    </script>
    <?= $this->endSection(); ?>