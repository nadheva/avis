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

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="file" id="file" type="text" placeholder="*File" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="*Password (8 Digit)" maxlength="8" required>
                                </div>
                            </div>
              <!-- <div class="col-md-6">
                <input type="text" name="npk" id="npk" class="form-group" placeholder="*NPK" maxlength="4" required /><br />
                <input type="text" name="nama" id="nama" class="form-group bg-white" placeholder="*Nama Lengkap" required readonly /><br />
                <input type="text" name="departemen" id="departemen" class="form-group bg-white" placeholder="*Departemen" required readonly /><br />  
              </div>
              <div class="col-md-6">
                <select type="select" name="model" id="model" class="form-group" required >
                  <option value="" disabled selected style="font-color: solid green;">- Select Model -</option>

                </select>
                <br />

                <select type="select" name="file" id="file" class="form-group" required >
                  <option value="" disabled selected style="font-color: solid green;">- Select File -</option>
                </select>
                <br />

                <input type="password" name="password" id="password" class="form-group" placeholder="*Password (8 digit)" maxlength="8" required /><br /> 
              </div>
              <div class="row justify-content-end" style="width: 100%">
                <input class="col-xs-3 btn btn-success ml-1" type="submit" name="download" id="download" value="Download" />
                <input class="col-xs-3 btn btn-danger mx-1" type="reset" name="reset" id="reset" value="Reset" />
              </div>
            </div> -->
            <div class="row">
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
                    url: "<?= base_url('') ?>/bom_download/karyawan",    // file PHP yang akan merespon ajax
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
                      url: "<?= base_url('') ?>/bom_download/check",
                      data: { model: model}
                    })
                      .done(function( hasilajax ) {
                          $('select#file').html(hasilajax);
                      });
                  })
                  });
                </script>
<?= $this->endSection(); ?>