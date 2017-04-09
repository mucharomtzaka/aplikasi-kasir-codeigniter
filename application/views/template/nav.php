<aside class="sidebar">
<div class="col-md-2">
		<div class="panel panel-default">
		  <div class="panel-body">
			<ul class="nav nav-pills nav-stacked">
			<?php if(!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin() && !$this->ion_auth->is_programmer()):?>
          <li class="active"><a href="<?= base_url('kasir');?>"><i class="fa fa-home"></i>Home</a>
          </li>
        <?php endif;?>
			<?php if(!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin() && !$this->ion_auth->is_programmer()):?>
			  <li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse1"><i class="fa fa-arrows-h"></i>Transaction</a>
			  		<div id="collapse1" class="panel-collapse collapse in">
				  		<ul>
				  			<li><a href="<?php echo base_url('kasir/data_transaksi');?>"><i class="fa fa-list"></i>
				  				Data Transaction</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  <?php endif;?>
			  	<li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse2"><i class="fa fa-users"></i>Members</a>
			  		<div id="collapse2" class="panel-collapse collapse in">
				  		<ul>
				  			<li><a href="<?php echo base_url('members/addnew');?>"><i class="fa fa-plus"></i>
				  				New Members</a></li>
				  			 <li><a href="<?php echo base_url('members/index');?>"><i class="fa fa-list"></i>
				  				Data Members</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  	<?php if($this->ion_auth->is_superadmin()):?>
			  	<li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse3"><i class="fa fa-user"></i>Users</a>
			  		<div id="collapse3" class="panel-collapse collapse in">
				  		<ul>
				  			 <li><a href="<?= base_url('users/create_users');?>"><i class="fa fa-plus"></i>New User</a></li>
                			<li><a href="<?= base_url('users/index');?>"><i class="fa fa-th"></i>List User</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  <?php endif;?>
			  	<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_programmer()):?>
			  	<li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse3"><i class="fa fa-calendar"></i>Schedule</a>
			  		<div id="collapse3" class="panel-collapse collapse in">
				  		<ul>
				  			 <li><a href="<?= base_url('schedule/new');?>"><i class="fa fa-plus"></i>New Schedule</a></li>
                			<li><a href="<?= base_url('schedule/index');?>"><i class="fa fa-th"></i>List Schedule</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  	<li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse4"><i class="fa fa-stack-exchange"></i>Product</a>
			  		<div id="collapse4" class="panel-collapse collapse in">
				  		<ul>
				  			 <li><a href="<?= base_url('product/formnewadd');?>"><i class="fa fa-plus"></i>New Product</a></li>
                			<li><a href="<?= base_url('product/index');?>"><i class="fa fa-th"></i>List Product</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  	<li class="active">
			  	<a data-toggle="collapse" data-parent="#accordion" 
			  		href="#collapse5"><i class="fa fa-book"></i>Report</a>
			  		<div id="collapse5" class="panel-collapse collapse in">
				  		<ul>
				  			<li><a href="<?= base_url('report/data_transaksi');?>">Data Transaction</a></li>
                			<li><a href="<?= base_url('report/data_stock');?>">Data Stock Product Sold Out</a></li>
				  		</ul>
			  		</div>
			  	</li>
			  	<?php endif;?>
			</ul>
		  </div>
		</div>
</div>
</aside>