<section class="content">
  <div class="col-md-10">
    <div class="panel panel-default">
      <div class="panel-header">
        <div class="alert alert-success"><?=$title;?> </div>
      </div>
      <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
              <?php echo form_open("auth/gantipass");?>
              <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
              </p>

              <p>
                    <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                    <?php echo form_input($new_password);?>
              </p>

              <p>
                    <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                    <?php echo form_input($new_password_confirm);?>
              </p>

              <?php echo form_input($user_id);?>
              <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>
              <?php echo form_close();?>
            </div>
             <div class="col-md-5">  
                   <?php if(isset($message)):?>
                     <?php echo $message;?>
                 <?php endif;?>
             </div>
        </div>
      </div>
    </div>
  </div>
</section>