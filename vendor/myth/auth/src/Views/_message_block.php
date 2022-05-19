<?php if (session()->has('message')) : ?>
<div class="alert alert-primary alert-dismissible fade show">
	<?= session('message') ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
<div class="alert alert-danger alert-dismissible fade show">
	<?= session('error') ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php endif ?>


<?php if (session()->has('errors')) : ?>
<ul class="alert alert-danger">
	<?php foreach (session('errors') as $error) : ?>
	<li><?= $error ?></li>
	<?php endforeach ?>
</ul>
<?php endif ?>