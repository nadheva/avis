<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="page-info">
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item" aria-current="page">Download BOM</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6">
 
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Download BOM</h5>
                          <form action="<?= base_url('') ?>/bom_download/create" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NPK</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="npk" id="npk" type="text" placeholder="*NPK" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="nama" id="nama" type="text" placeholder="*Nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Departemen</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="departemen" id="departemen" type="text" placeholder="*Departemen" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="model" id="model" type="text" placeholder="*Model" required>
                                    <option value="" disabled selected style="font-color: solid green;">- Select Model -</option>
                                    <?php foreach ($model as $us) : ?>
                                                <option value="<?= $us->model ?>"><?= $us->model ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="file" id="file" type="text" placeholder="*File" required>
                                    <option value="" disabled selected style="font-color: solid green;">- Select File -</option>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="*Password (8 Digit)" required>
                                </div>
                            </div>
                                <div class="row justify-content-end" style="width: 100%">
                                    <input type="submit" class="col-xs-3 btn btn-success ml-1" name="download" id="download" value="Download" />
                                    <input type="reset" class="col-xs-3 btn btn-danger ml-1" name="reset" id="reset" value="Reset" />
                                </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                <script type="text/javascript">
                $(document).ready(function(){
                $('#npk').keyup(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
                  var npkdata = $('#npk').val();  // AMBIL isi dari file NPM masukkan variabel 'npmfromfield'
                  $.ajax({        // Memulai ajax
                    type: "POST",      
                    url: "/bom_download/karyawan",    // file PHP yang akan merespon ajax
                    data: { npk: npkdata}   // data POST yang akan dikirim
                  })
                    .done(function( hasilajax ) {   // KETIKA PROSES Ajax Request Selesai
                      var obj = JSON.parse(hasilajax);
                        $('#nama').val(obj.nama);  // Isikan hasil dari ajak ke field 'nama'
                        $('#departemen').val(obj.dept); 
                    });
                })
                });
                </script>
                <script> 
                    $(function() { 
                        $("input[name='npk']").on('input', function(e) { 
                            $(this).val($(this).val().replace(/[^0-9]/g, '')); 
                        }); 
                    }); 
                </script>
                <script>
                $(document).ready(function(){
                  $('#model').change(function(){
                    var model = $(this).val();
                    $.ajax({
                      type: "POST",      
                      url: "/bom_download/file",
                      data: { model: model}
                    })
                      .done(function( hasilajax ) {
                          $('select#file').html(hasilajax);
                      });
                  })
                  });
                </script>
<?= $this->endSection(); ?>