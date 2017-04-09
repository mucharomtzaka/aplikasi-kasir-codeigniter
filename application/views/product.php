<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
			   <?php  if($message){?>
                <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <?php echo $message;?>
                    </div>
                      <?php }?>
                </div>
				<div class="alert alert-success"><?=$title;?></div>
			</div>
			<div class="panel-body">
                <a href="#" id="tambahproduct" class="btn btn-primary"> <i class="fa fa-plus"> Add </i> </a>
                <a href="#" id="printall" class="btn btn-primary"> <i class="fa fa-print"> Print Barcode All </i> </a>
                 <a href="<?=base_url('report/data_stock');?>" class="btn btn-warning">
                 <i class="fa fa-list">Stok Habis</i>
                 <span class="badge bg-green"><?=$count_stock_habis;?></span> </a>
                  </a>
                 <a href="#" id="viewpdf" class="btn btn-primary"> <i class="fa fa-file-pdf-o">File Pdf </i> </a>
				<div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-border" id="table_product">
                            <caption></caption>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Quantity Stok</th>
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
	</div>
</section>
<!-- Modal selesai -->
  <div class="modal fade" id="modal-formproductUpdate" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Update Product</h4>
        </div>
            <div class="modal-body">
                <div class="form-horizontal">
                <?php echo form_open_multipart('product/updateproduct'); ?>
                <input type="hidden" name="id" id="id" class="form-control">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-6">
                                <label for="varchar" class="control-label">Photo Product </label>
                                <img src="<?=base_url('assets/images/default-50x50.gif');?>" width="150px" height="150px" id="photos">
                                        <input type="file" class="form-control" name="photo" id="photo" placeholder="photo product"/ onchange="document.getElementById('photos').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="formupdate">
                            </div>
                        </div>
                    </div>
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">Update</i></button>
                    <button type="reset" class="btn btn-primary btn-lg" id="hapusgambar" ><i class="fa fa-close">Reset</i></button>
                  </div>
                <?php echo form_close();?>
            </div>
            </div>
          <div class="modal-footer">
            <p class="help-block pull-left alert alert-warning">*Format Gambar JPG/PNG <br /> * Ukuran Gambar Harus (570px) x (570px)</p>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
<script type="text/javascript">
        $(function(){
            $('#table_product').DataTable({
                        "ajax": {
                        "url": "<?= site_url('product/ajax_list_data')?>",
                        "type": "GET"
                    }
            });

            $('#tambahproduct').on('click',function(){
                $('#modal-formproductAdd').modal();

                if (window.XMLHttpRequest) {
                      // code for IE7+, Firefox, Chrome, Opera, Safari
                       xmlhttp = new XMLHttpRequest();
                  } else {
                      // code for IE6, IE5
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange = function() {
                       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          document.getElementById("formproduct").innerHTML = 
                          xmlhttp.responseText;
                      }
                  }
                  xmlhttp.open("GET", "<?= base_url('product/ajax_form_add') ?>",true);
                  xmlhttp.send();
            });
            $('#hapusgambar').on('click',function(){
                $('#photos').attr('src','');
            });

            $('#printall').on('click',function(){
                $('#modal-viewprintAll').modal();
                $('#preview').attr('src','<?=base_url('product/ajax_print_barcode_all');?>');
                  
            });

            $('#viewpdf').on('click',function(){
                $('#modal-viewpdf').modal();
                $('#previewpdf').attr('src','<?=base_url('product/exportpdf');?>');
                var preview = $("#previewpdf");
                resizePreview();

                $(window).scroll(function() {
                  var scrollTop = Math.min($(this).scrollTop(), preview.height()+preview.parent().offset().top) - 2;
                  preview.css("margin-top", scrollTop + "px");
                });

                $(window).resize(resizePreview);
            });         
        }); 

          function resizePreview(){
            var preview = $("#previewpdf");
            preview.height($(window).height() - preview.offset().top - 2);
          }


              function editproduct(kd,gambar){
                $('#modal-formproductUpdate').modal();
                $('#id').val(kd);
                $('#photos').attr('src','<?= base_url('assets/images/product') ?>/'+gambar);
                if (window.XMLHttpRequest) {
                      // code for IE7+, Firefox, Chrome, Opera, Safari
                       xmlhttp = new XMLHttpRequest();
                  } else {
                      // code for IE6, IE5
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange = function() {
                       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          document.getElementById("formupdate").innerHTML = 
                          xmlhttp.responseText;
                      }
                  }
                  xmlhttp.open("GET", "<?= base_url('product/get_ajax_product_by_id') ?>/"+kd,true);
                  xmlhttp.send();
            }

        function printbarcode(kdbar,id){
                $('#modal-viewprint').modal();
                 var dest = '<?= site_url('product/set_barcode')?>';
                  $.ajax({
                        url :dest+'/'+kdbar ,
                        type: "GET",
                        dataType: "html",
                        success: function(data)
                        {
                          $('#barcode').html('<img src="'+dest+'/'+kdbar+'" width="300px" height="300">');
                          $('#printed').on('click',function(){
                            var dest2 = '<?= site_url('product/ajax_print_barcode_by');?>'
                            $.ajax({
                                url:dest2+'/'+id,
                                type:'GET',
                                dataType: "html",
                                success:function(){
                                  $('#modal-viewprint').modal('hide');
                                 //alert('Harap Tenang ! Kami akan mengalihkan halaman lain');
                                 var url  = '<?=base_url('product/ajax_print_barcode_by')?>'+'/'+id;
                                 window.open(url,'_blank');
                                }
                            });
                          });
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert(errorThrown);
                        }
                    });
            }

            
</script>
<!-- Modal selesai -->
  <div class="modal fade" id="modal-formproductAdd" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form New Product</h4>
        </div>
            <div class="modal-body">
                <div class="form-horizontal">
                <?php echo form_open_multipart('product/addnew'); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-6">
                                <label for="varchar" class="control-label">Photo Product </label>
                                <img src="<?=base_url('assets/images/default-50x50.gif');?>" width="150px" height="150px" id="photos">
                                        <input type="file" class="form-control" name="photo" id="photo" placeholder="photo product"/ onchange="document.getElementById('photos').src = window.URL.createObjectURL(this.files[0])" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="formproduct">
                            </div>
                        </div>
                    </div>
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">Save</i></button>
                    <button type="reset" class="btn btn-primary btn-lg" id="hapusgambar" ><i class="fa fa-close">Reset</i></button>
                  </div>
                <?php echo form_close();?>
            </div>
            </div>
          <div class="modal-footer">
            <p class="help-block pull-left alert alert-warning">*Format Gambar JPG/PNG <br /> * Ukuran Gambar Harus (570px) x (570px)</p>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>

    <div class="modal fade" id="modal-viewprint" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Kode Barcode Product</h4>
        </div>
            <div class="modal-body">
              <center><div id="barcode"></div></center>
            </div>
          <div class="modal-footer">
             <a href="#" id="printed" class="btn btn-primary btn-lg"> <i class="fa fa-print"> Print</i> </a>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>

   <div class="modal fade" id="modal-viewprintAll" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Print Kode Barcode Product</h4>
        </div>
            <div class="modal-body">
               <iframe id="preview" name="preview" src="about:blank" frameborder="0" width="100%" marginheight="0" marginwidth="0"></iframe> 
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