  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
<h1><?php echo lang('create_group_heading');?></h1>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("users/create_group");?>
	<div class="box-body">
     <div class="col-md-5">
     	 <p>
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
      </p>
    
     </div>
     <div class="col-md-5">
        <div class="box-footer">
        <p><button type="submit" class="btn btn-primary"><i class="fa fa-plus"> </i><?php echo lang('create_group_submit_btn');?></button></p>
         <p><button type="reset" class="btn btn-warning"><i class="fa fa-minus"> </i>Reset</button></p>

    <?php echo form_close();?>
     <p> <a href="<?=base_url('users/index')?>" class="btn btn-success"><i class="fa fa-arrow-left"> </i> Back</a></p>
    </div>
     </div>
     </div>
    
     </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->