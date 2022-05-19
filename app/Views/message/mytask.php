<?php if (session()->has('pesanapprove')) : ?>
<div class="alert alert-primary alert-dismissible fade show">
    <?= session('pesanapprove') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>
<?php if (session()->has('pesancancel')) : ?>
<div class="alert alert-primary alert-dismissible fade show">
    <?= session('pesancancel') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>
<?php if (session()->has('pesanwd')) : ?>
<div class="alert alert-primary alert-dismissible fade show">
    <?= session('pesanwd') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>
<?php if (session()->has('pesannewchildtask')) : ?>
<div class="alert alert-primary alert-dismissible fade show">
    <?= session('pesannewchildtask') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>
<?php if (session()->has('errordoc')) : ?>
<div class="alert alert-danger alert-dismissible fade show">
    <?= session('errordoc') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>
<?php if (session()->has('errornotes')) : ?>
<div class="alert alert-danger alert-dismissible fade show">
    <?= session('errornotes') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif ?>