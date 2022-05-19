<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">Customer</li>
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
                                <h5 class="card-title">Customer List</h5>
                            </div>
                            <?php if(user()->level_id == "1" || user()->level_id == "4") : ?>
                            <div class="col-6">
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#newTask"
                                        class="btn btn-primary">Add Customer</button>
                                </div>
                            </div>
                            <?php endif ?>
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
                                    <th scope="col" style="width: 66.66%">Customer</th>
                                    <th scope="col" style="width: 36.66%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($customer as $cust) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $cust->customer_name ?></td>
                                    <td>
                                        <a href="<?= base_url('') ?>/project/<?= $cust->id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="top" title="View"><span
                                                class="material-icons" >visibility</span></a>
                                        <?php if(user()->level_id == "1" || user()->level_id == "4") : ?>
                                        <a href="<?= base_url('') ?>/customer/editcust/<?= $cust->id; ?>" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Edit"><span class="material-icons" >edit</span></a>
                                        <a type="button" class="badge badge-danger"
                                            onclick="del(<?= $cust->id; ?>)" data-toggle="tooltip" data-placement="top" title="Delete"><span class="material-icons"
                                                style="color: white;">delete</span></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('') ?>/customer/addcust" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Customer Name"
                                    name="customer_name">
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
        <script>
            function del(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this customer!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            location.replace(`<?= base_url('/customer/delcus') ?>/${id}`)
                        } else {
                            swal("This customer is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>