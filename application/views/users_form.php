<section>
  <div class="col-md-10">
    <div class="panel panel-default">
        <div class="panel-header">
          <div class="alert alert-success"><?=$title;?></div>
        </div>
        <div class="panel-body">
            <div class="row">
              <?php echo form_open($action);?>
                <div class="form-horizontal">
                 
                  <div class="col-md-5">
                        <p>
                              <?php echo lang('create_user_fname_label', 'first_name');?> <br />
                              <?php echo form_input($first_name);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_lname_label', 'last_name');?> <br />
                              <?php echo form_input($last_name);?>
                        </p>
                        
                        <?php
                        if($identity_column!=='email') {
                            echo '<p>';
                            echo lang('create_user_identity_label', 'identity');
                            echo '<br />';
                            echo form_input($identity,array('class'=>'form-control'));
                            echo '</p>';
                        }
                        ?>

                        <p>
                              <?php echo lang('create_user_company_label', 'company');?> <br />
                              <?php echo form_input($company);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_phone_label', 'phone');?> <br />
                              <?php echo form_input($phone);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_label', 'password');?> <br />
                              <?php echo form_input($password);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                              <?php echo form_input($password_confirm);?>
                        </p>

                              </div>
                </div>
                  <div class="col-md-5">
                     <button type="submit" class="btn btn-primary">
                     <i class="fa fa-plus"></i>
                     <?php echo lang('create_user_submit_btn');?></button>
                    <button type="reset" class="btn btn-warning"><i class="fa fa-minus"> </i>Reset</button>
                    <?php echo $message;?>
                  </div>
               <?php echo form_close();?>
            </div>
        </div>
      </div>
  </div>
</section>