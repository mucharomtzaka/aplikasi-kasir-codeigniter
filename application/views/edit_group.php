 <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="col-md-10">
        <div class="panel panel-default">
          <div class="panel-header">
          <h1><?php echo lang('edit_group_heading');?></h1>
          <p><?php echo lang('edit_group_subheading');?></p>

            <div id="infoMessage"><?php echo $message;?></div>
            <div class="panel-body">
              <div class="col-md-5">
                   <?php echo form_open(current_url());?>

                  <p>
                        <?php echo lang('edit_group_name_label', 'group_name');?> <br />
                        <?php echo form_input($group_name);?>
                  </p>

                  <p>
                        <?php echo lang('edit_group_desc_label', 'description');?> <br />
                        <?php echo form_input($group_description);?>
                  </p>

                  <p>
                      <button type="submit" class="btn btn-primary"><?php echo lang('edit_group_submit_btn');?></button>
                  </p>  
            <?php echo form_close();?>
               <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a>
              </div>
            </div>
        <p>></p>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
