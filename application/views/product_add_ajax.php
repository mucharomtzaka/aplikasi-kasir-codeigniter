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
				 <div class="form-horizontal">
                <?php echo form_open_multipart('product/addnew'); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-6">
                                <label for="varchar" class="control-label">Photo Product </label>
                                <img src="<?=base_url('assets/images/default-50x50.gif');?>" width="250px" height="250px" id="photos">
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
			<div class="panel-footer">
				  <p class="help-block pull-left alert alert-warning">*Format Gambar JPG/PNG <br /> * Ukuran Gambar Harus (570px) x (570px)</p>
			</div>
	</div>
</section>
<script type="text/javascript">
	$(function(){
            $('#hapusgambar').on('click',function(){
                $('#photos').attr('src','');
            })
            showform();
	});

	function showform(){
				var sitedestination = '<?= base_url('product/ajax_form_add') ?>';
				if (window.XMLHttpRequest) {
                      // code for IE7+, Firefox, Chrome, Opera, Safari
                       xmlhttp = new XMLHttpRequest();
                  }else{
                  	// code for IE6, IE5
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }

                  xmlhttp.onreadystatechange = function() {
                       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          document.getElementById("formproduct").innerHTML = 
                          xmlhttp.responseText;
                      }
                  }

                  xmlhttp.open("GET",sitedestination,true);
                  xmlhttp.send();
	}
</script>