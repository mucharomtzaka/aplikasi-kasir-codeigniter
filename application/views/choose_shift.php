<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/reset.css') ?>">
  	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <script src="<?= base_url('assets/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>
<body>
<header class="main-header">
  <div id="header">
      <h1>e-kASIR</h1>
  </div>
</header>
<div class="wrapper">
  <section class="content">
    <div class="col-md-12">
      <div class="row">
      <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
          <div class="panel panel-primary">
              <div class="pane-header">
              <p class="alert alert-info">Shift Operator</p>
              <p class="alert alert-success">
                Silahkan Pilih Shift Operator sesuai dengan Jadwal Jaga !
              <?=$message;?>
              </p>
              </div>
              <div class="panel-body form-horizontal">
              <?php echo form_open_multipart($aksi);?>
                <div class="form-group">
                  <label class="control-label col-md-5" for="tgl_transaksi">Operator :</label>
                 <div class="col-md-6">
                 <input type="text" class="form-control" name="operator" value="<?=$this->session->userdata('name');?>" readonly="readonly">
                 </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Shift:</label>
                  <div class="col-md-6">
                  <select name="shift" class="form-control" required="">
                    <option value="">Please choose </option>
                    <option value="1"> 1 {Pertama}</option>
                    <option value="2"> 2 {Kedua}</option>
                    <option value="3"> 3 {Ketiga}</option>
                  </select>
                  </div>
                </div>
                  <!-- /.col -->
                  <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Next</button>
                    <a href="<?=base_url('auth/logout');?>" class="btn btn-danger btn-block btn-flat">Logout</a>
                  </div>
              </div>
          </div>
              <!-- /.col -->
            </div>
          <?php echo form_close();?>
        </div>
        <div class="col-md-12 text-center">
          <br>
           <small id="footer">Copyright <?= date('Y') ?>, All Right Reserved.</small>
        </div>
      </div>

    </div>
  </section>
</div>

</body>
</html>