<div class="page-footer">
    <div class="row">
        <div class="col-md-12">
            <span class="footer-text"><?= date('Y') ?> © Astra Visteon Indonesia</span>
        </div>
    </div>
    
    <button style="
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 10px;
  border: none;
  outline: none;
  background-color: grey;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 4px;" onclick="topFunction()" class="btn btn-secondary" id="toTop" title="Go to top"><i class="material-icons-outlined">arrow_upward</i></button>
</div>
</div>
</div>
<script>
//Get the button
var mybutton = document.getElementById("toTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<!-- Javascripts -->
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/popper.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/bootstrap-filestyle.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/blockui/jquery.blockUI.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/connect.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/pages/datatables.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/pages/select2.js"></script>
<script src="<?= base_url('/public') ?>/theme/assets/js/script.js">
var ok = 'yyy';
</script>
<!--Wysiwig js-->
<script src="<?= base_url('/public') ?>/theme/assets/plugins/tinymce/tinymce.min.js"></script>
<!-- <script src="<?= base_url('') ?>/public/assets/js/register.js"></script> -->

</html>