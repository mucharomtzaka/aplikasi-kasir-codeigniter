<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
				<div class="alert alert-success"><?php echo $title;?> </div>
          <?php if(isset($message)):?>
                     <?php echo $message;?>
          <?php endif;?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="table-responsive">
          <a href="<?=base_url('product/index');?>" class="btn btn-warning">
                 <i class="fa fa-list">Stok Tersedia</i>
                 <span class="badge bg-green"><?=$count_stock_tersedia;?></span> </a>
           <a href="#" id="viewpdf" class="btn btn-primary"> <i class="fa fa-file-pdf-o">File Pdf </i> </a>
                    <table class="table table-striped table-bordered table-hover" id="table_rekap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
				</div>
			</div>
		</div>
	</div>
    <script type="text/javascript">
        $(function(){
            $('#table_rekap').DataTable({
                        "ajax": {
                        "url": "<?= site_url('report/ajax_list_data_stock')?>",
                        "type": "GET"
                    }
            });

            $('#viewpdf').on('click',function(){
                $('#modal-viewpdf').modal();
                $('#previewpdf').attr('src','<?=base_url('report/exportpdf_stock_habis');?>');
                var preview = $("#previewpdf");
                resizePreview();

                $(window).scroll(function() {
                  var scrollTop = Math.min($(this).scrollTop(), preview.height()+preview.parent().offset().top) - 2;
                  preview.css("margin-top", scrollTop + "px");
                });

                $(window).resize(resizePreview);
            });        
        }) 

         function resizePreview(){
            var preview = $("#previewpdf");
            preview.height($(window).height() - preview.offset().top - 2);
          } 

         function editStock(kd){
                $('#modal-editstock').modal();
                $('#id').val(kd);
                if (window.XMLHttpRequest) {
                      // code for IE7+, Firefox, Chrome, Opera, Safari
                       xmlhttp = new XMLHttpRequest();
                  } else {
                      // code for IE6, IE5
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange = function() {
                       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          document.getElementById("barang_modal").innerHTML = 
                          xmlhttp.responseText;
                      }
                  }
                  xmlhttp.open("GET", "<?= base_url('report/get_ajax_stock_by_id') ?>/"+kd,true);
                  xmlhttp.send();
            }
    </script>
</section>
<!-- Modal selesai -->
  <div class="modal fade" id="modal-editstock" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Stock Product</h4>
        </div>
            <div class="modal-body">
                <div class="form-horizontal">
            <?php echo form_open('report/updatestock'); ?>
              <input type="hidden" name="id" id="id" class="form-control">
              <div id="barang_modal">
              </div>
             <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">Update</i></button>
              <button type="reset" class="btn btn-primary btn-lg"><i class="fa fa-close">Reset</i></button>
            <?php echo form_close();?>
            </div>
            </div>
          <div class="modal-footer">
          </div>
        </div>
        
      </div>
      
    </div>
  </div>

   <div class="modal fade" id="modal-viewpdf" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Preview File Pdf</h4>
        </div>
            <div class="modal-body">
               <iframe id="previewpdf" name="previewpdf" src="about:blank" frameborder="0" width="100%"  marginheight="30%" marginwidth="0"></iframe> 
            </div>
          <div class="modal-footer">

          </div>
        </div>
        
      </div>
      
    </div>
  </div>