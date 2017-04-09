<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
				<div class="alert alert-success"> New Schedule</div>
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
                        <input type="text" name="tgl" class="form-control" id="tgl" value="<?=$tanggal;?>"required="required">
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
</section>
<script type="text/javascript">
    $(function(){
        $('#tgl').datepicker({
              format: 'yyyy-mm-dd'
            });
    })
</script>