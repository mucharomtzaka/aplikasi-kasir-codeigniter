<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
			<?php if(isset($message)):?>
                <div class="alert alert-info alert-dismissible">
                     <?php echo $message;?>
                </div>
			<?php endif;?>
				<div class="alert alert-success">Pengaturan System </div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="nav-tabs-custom ">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-list">General</i></a></li>
                                  <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th">Backup Database</i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <?php echo form_open('settings/post');?>
                                        <div class="form-horizontal text-left">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Title</label>
                                                <div class="col-md-5">
                                                    <input type="text" name="title_bar" class="form-control" value="<?=$title_bar;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Header</label>
                                                <div class="col-md-5">
                                                    <input type="text" name="header" class="form-control" value="<?=$header;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">footer</label>
                                                <div class="col-md-5">
                                                    <input type="text" name="footer" class="form-control" value="<?=$footer;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">email</label>
                                                <div class="col-md-5">
                                                    <input type="email" name="email" class="form-control" value="<?=$email;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Contact</label>
                                                <div class="col-md-5">
                                                    <input type="number" name="contact" class="form-control" value="<?=$contact;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Address</label>
                                                <div class="col-md-5">
                                                    <textarea name="address" class="form-control textarea"><?=$address;?></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-save"></i>Save</button>
                                        </div>
                                    <?php echo form_close();?>
                                    </div>
                                     <div class="tab-pane active" id="tab_2">
                                        <p class="alert alert-info">Backup Database </p>
                                        <center><?=$linkbutton?><br></center>
                                        <p class="alert alert-info">Restore Database </p>
                                        <?php echo  form_open_multipart('settings/upload','class="form-horizontal"')?>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">File Sql</label>
                                            <div class="col-md-5">
                                              <input type="file" name="sql" class="form-control file" required="required">
                                            </div>
                                             <input type="submit" value="restore" name="restore" class="btn btn-primary" onclick="javascript: return confirm('Are you sure to restore Database. Continue ?')" />
                                          </div>
                                          <?php echo form_close();?>
                                     </div>
                                </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>