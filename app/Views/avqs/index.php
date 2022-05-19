<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item" aria-current="page">AV Quality System</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="text-center">
        <div class="row">
            <div class="col-12" style="margin-left: 280px;">
                <div class="pyramid">
                    <?php foreach($avqs as $row) : ?>
                    <div class="zone">
                        <a href="<?= base_url('') ?>/avqs/dir1/<?= $row['id'] ?>" class="hov" style="text-decoration: none; color:azure; margin-top:15px; background-color:black; border-radius:5px"><?= $row['avqs_name'] ?></a>
                    </div>
                    <?php endforeach ?>
                </div>
                <svg width="0" height="0">
                    <defs>
                <clipPath id="part1" clipPathUnits= "objectBoundingBox">
                    <polygon points= "0.5 0, 1 1, 0 1"/>
                </clipPath>
                <clipPath id="part2" clipPathUnits= "objectBoundingBox">
                    <polygon points= "0.25 0,0.75 0, 1 1, 0 1"/>
                </clipPath>
                <clipPath id="part3" clipPathUnits= "objectBoundingBox">
                    <polygon points= "0.165 0,0.83 0, 1 1, 0 1"/>
                </clipPath>
                <clipPath id="part4" clipPathUnits= "objectBoundingBox">
                    <polygon points= "0.125 0,0.875 0, 1 1, 0 1"/>
                </clipPath>
                    </defs>
                </svg>
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
                            location.replace(`<?= base_url('/mguideline/delarea') ?>/${id}`)
                        } else {
                            swal("This area is safe!");
                        }
                    });
            }
        </script>
        <?= $this->endSection(); ?>