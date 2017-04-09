<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
			<?php if(isset($message)):?>
        <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <?php echo $message;?>
        </div>
			<?php endif;?>
				<div class="alert alert-success"><?=$title;?> </div>
			</div>
			<div class="panel-body">
            <a href="#" id="tambahjadwal" class="btn btn-primary"> <i class="fa fa-plus"> Add </i> </a>
				<div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="table_data">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Operator</th>
                            <th>Tanggal</th>
                            <th>Shift1</th>
                            <th>Shift2</th>
                            <th>Shift3</th>
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
    <link href="<?=base_url();?>/assets/datepicker/datepicker3.css" rel="stylesheet">
    <script src="<?=base_url();?>/assets/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#table_data').DataTable({
                        "ajax": {
                        "url": "<?= site_url('schedule/ajax_list_jadwal')?>",
                        "type": "GET"
                    }
            });
            $('#tambahjadwal').on('click',function(){
                $('#modal-addjadwal').modal();

            });
            $('#tgl').datepicker({
              format: 'yyyy-mm-dd'
            });
         });

            function editjadwal(kd){
                $('#modal-editjadwal').modal();
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
                  xmlhttp.open("GET", "<?= base_url('schedule/ajax_form_edit') ?>/"+kd,true);
                  xmlhttp.send();
            }
</script>
 <div class="modal fade" id="modal-editjadwal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Schedule Operator</h4>
        </div>
            <div class="modal-body">
            <div class="panel panel-default">
                  <div class="panel-header">
                    <div class="alert alert-success">Form Update Schedule</div>
                  </div>
                  <div class="panel-body text-center form-horizontal">
                  <?php echo form_open('Schedule/update');?>
                  <div id="formupdate"></div> 
                  <div class="pull-right">
                     <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save">update</i></button>
                    <button type="reset" class="btn btn-primary btn-lg" id="hapusgambar" ><i class="fa fa-close">Reset</i></button>
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
   <div class="modal fade" id="modal-addjadwal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Schedule Operator</h4>
        </div>
            <div class="modal-body">
                <div class="panel panel-default">
                  <div class="panel-header">
                    <div class="alert alert-success">Form New Schedule</div>
                  </div>
                  <div class="panel-body text-center form-horizontal">
                    <?php echo form_open('Schedule/addnew');?>
                    <div class="form-group">
                      <label class="col-md-2 control-label"> Name Operator</label>
                      <div class="col-md-7">
                        <input type="text" name="name_operator" class="form-control" id="name_operator" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label"> Date</label>
                      <div class="col-md-3">
                        <input type="text" name="tgl" class="form-control" id="tgl" value="<?=$tanggal;?>" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-2 control-label"> Choose Shift</label>
                        <div class="col-md-3">
                        <div class="checkbox">
                          <label><input type="checkbox" name="shift1" value="1">Shift 1 </label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="shift2" value="1">Shift 2 </label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="shift3" value="1">Shift 3 </label>
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
            </div>
          <div class="modal-footer">
            <p class="alert alert-info">
              Masukan Data  Operator sesuai jadwal
            </p>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</section>
