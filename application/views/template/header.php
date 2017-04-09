<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/reset.css') ?>">
  	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
  	<link rel="stylesheet" href="<?= base_url('assets/datatables/css/dataTables.bootstrap.css') ?>">
    <script src="<?= base_url('assets/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/maskMoney/jquery.maskMoney.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/time.js') ?>"></script>
</head>
<body onload="waktu()">
<header class="main-header" id="top">
<nav class="navbar navbar-static-top alert alert-success">
      <div class="container ">
        <div class="navbar-header">
        <?php if(!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin() && !$this->ion_auth->is_programmer()):?>
          <a href="<?= base_url('kasir');?>" class="navbar-brand"><i class="fa fa-shopping-cart"></i><b>e</b>Kasir</a>
        <?php endif;?>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if($this->ion_auth->is_superadmin() || $this->ion_auth->is_admin()):?>
              <li class="active"><a href="<?=base_url('dashboard');?>"><i class="fa fa-dashboard"></i>Dashboard<span class="sr-only">(current)</span></a></li>
            <?php endif;?>
            <?php if($this->ion_auth->is_superadmin()):?>
            <li><a href="<?=base_url('settings');?>"><i class="fa fa-gear"></i>Settings</a></li>
            <?php endif;?>
            <li><a href="javascript:void(0)"><i class="fa fa-comments">Chat Helps</i></a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" fa fa-user-secret"></i><?= $this->session->userdata('email');?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url('auth/gantipass');?>"><i class="fa fa-key"></i>Ganti Password</a></li>
                <li><a href="<?php echo base_url('auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
</nav>
<div id="header">
    <div class="row" >
      <div class="col-md-4">
        <h1><?=$header;?></h1> <br>
      </div>
      <div class="col-md-4 text-left">
          Alamat: <?=$address;?><br>
          Email:<?=$email;?> <br> Telephone/HP/Whatapps: <?=$contact;?>
      </div>
      <div class="col-md-4">
       <h2>
         <label id="jam"></label>:
         <label id="menit"></label>:
         <label id="detik"></label>
       </h2>
      </div>
    </div>
</div>
<div style="position: fixed; bottom: 20px; left: 25px; width: 40px; height: 40px; color: rgb(000, 238, 238); line-height: 40px; text-align: center; background-color: rgb(34, 45, 50); cursor: pointer; border-radius: 5px; z-index: 99999; opacity: 0.7;">
        <a href="#top"><i class="fa fa-chevron-up"></i></a>
  </div>
</header>
  