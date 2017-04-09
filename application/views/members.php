<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<?php if(isset($message)):?>
				<div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <?php echo $message;?>
                </div>
			<?php endif;?>
			<div class="panel-header">
				<h1 class="alert alert-info"> <?=$title;?></h1>
			</div>
			<div class="panel-body">
			<a href="#" id="tambahmember" class="btn btn-primary"> <i class="fa fa-plus"> Add </i> </a>
				<div class="table-responsive">
					<table class="table table-hover" id="table_data">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Pelanggan</th>
								<th>Nama </th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Email</th>
								<th>Kontak</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-addmember" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Members</h4>
        </div>
            <div class="modal-body">
            <div class="panel panel-default">
                  <div class="panel-header">
                    <div class="alert alert-success">Form New Members</div>
                  </div>
                  <div class="panel-body text-center form-horizontal">
                  <?php echo form_open('members/save');?>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Kode Pelanggan</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kode_pelanggan" class="form-control" value="<?=$kode_pelanggan;?>" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Nama Pelanggan</label>
                 	 <div class="col-md-7">
                 	 	<input type="text" name="nama_pelanggan" class="form-control" value="" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Pendaftaran</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_register" class="form-control" value="<?=$tgl_register;?>" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Lahir</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_lahir" class="form-control" id="tgl" value="" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Email</label>
                 	 <div class="col-md-7">
                 	 	<input type="email" name="email"  value="" class="form-control" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">jenis Kelamin</label>
                 	 <div class="col-md-4">
                 	 	<select name="jk" class="form-control" required="required">
                 	 		<option value=""> Pilih Jenis Kelamin</option>
                 	 		<option value="Laki-laki"> Laki - laki </option>
                 	 		<option value="Perempuan"> Perempuan </option>
                 	 	</select>
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Kontak </label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kontak" id="kontak" value="" class="form-control" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Alamat</label>
                 	 <div class="col-md-7">
                 	 	<textarea name="alamat" class="form-control" required="required"></textarea>
                 	 </div>
                  </div>
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">Save</i></button>
                    <button type="reset" class="btn btn-primary btn-lg" ><i class="fa fa-close">Reset</i></button>
                  </div>
                    <?php echo form_close();?>
                </div>    
            </div>
          <div class="modal-footer">
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="modal-editmembers" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Member</h4>
        </div>
            <div class="modal-body">
            <div class="panel panel-default">
            	
                  <div class="panel-header">
                    <div class="alert alert-success">Form Update Member</div>
                  </div>
                  <div class="panel-body text-center form-horizontal">
                  <?php echo form_open_multipart('members/update');?>
                  <input type="hidden" name="id" id="id" class="form-control">
                  <div id="formupdate"></div> 
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">update</i></button>
                    <button type="reset" class="btn btn-primary btn-lg"><i class="fa fa-close">Reset</i></button>
                  </div>
                    <?php echo form_close();?>
                </div>    
            </div>
          <div class="modal-footer">
          </div>
        </div>
        
      </div>
      
    </div>
  </div>

</section>
<link href="<?=base_url();?>/assets/datepicker/datepicker3.css" rel="stylesheet">
<script src="<?=base_url();?>/assets/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
        $(function(){
            $('#table_data').DataTable({
                        "ajax": {
                        "url": "<?= site_url('members/ajax_list_data')?>",
                        "type": "GET"
                    }
            });
            $('#tambahmember').on('click',function(){
                $('#modal-addmember').modal();

            });
            $('#tgl').datepicker({
              format: 'yyyy-mm-dd'
            });
         });

            function editmembers(kd){
                $('#modal-editmembers').modal();
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
                          document.getElementById("formupdate").innerHTML = 
                          xmlhttp.responseText;
                      }
                  }
                  xmlhttp.open("GET", "<?= base_url('members/ajax_form_edit') ?>/"+kd,true);
                  xmlhttp.send();
            }
</script>

  


