<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
			  		 <?php  if($message){?>
                     <?php echo $message;?>
                      <?php }?>
                </div>
				<div class="alert alert-success"><?=$title;?></div>
				<div class="panel-body">
				<div class="row">
					<?=anchor('users/create_users','New Users','class="btn btn-primary"><i class="fa fa-plus"></i');?>
<!-- 					<?=anchor('users/create_group','New Groups','class="btn btn-primary"><i class="fa fa-plus"></i');?> -->
					<div class="table-responsive">
				         <table class="table table-bordered table-hover " id="table_user" >
				         <thead>
				            <tr>
					          <th>No</th>
					            <th><?php echo lang('index_username_th');?></th>
					            <th ><?php echo lang('index_fname_th');?></th>
					            <th><?php echo lang('index_lname_th');?></th>
					            <th><?php echo lang('index_email_th');?></th>
					            <th><?php echo lang('index_status_th');?></th>
					            <th ><?php echo lang('index_groups_th');?></th>
					            <th><?php echo lang('index_action_th');?></th>
					         </tr>
				         </thead>
				         <tbody>
				         <?php
				         	 $start =0;
				         	 foreach($users as $users):?>
				         	<tr>
				         		<td><?=++$start;?></td>
				         		<td><?=$users->username;?></td>
				         		<td><?=$users->first_name;?></td>
				         		<td><?=$users->last_name;?></td>
				         		<td><?=$users->email;?></td>
				         		<td><?php echo ($users->active) ? anchor("users/deactivate/".$users->id, lang('index_active_link')) : anchor("users/activate/". $users->id, lang('index_inactive_link'));?></td>
				         		<td>
				                <?php foreach ($users->groups as $group):?>
				                  <?php echo anchor("users/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
				                 <?php endforeach?>
				                 </td>
				         		<td>
									<?php echo anchor("users/edit_users/".$users->id, 'Edit','class="btn btn-warning"><i class="fa fa-edit"></i') ;?>
					               <?php if($group->id !='1'&&$group->id !='4'){?>
					               <?php echo anchor(base_url("users/deleteusers/".$users->id.""),'delete','onclick="javasciprt: return confirm(\'Are You Sure  to Delete Users '.$users->username.' ?\')" class="btn btn-danger"><i class="fa fa-trash"></i') ;?>
					              <?php }?>
					              </td>
				         	</tr>
				         <?php endforeach;?>
				         </tbody>
				         </table>
			         </div>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function(){
		$('#table_user').DataTable();
		$('#addnew').on('click',function(){
			$('#modal-addnewform').modal();
		});
	})
</script>
   