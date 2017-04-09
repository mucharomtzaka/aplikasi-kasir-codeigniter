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
    <script src="<?= base_url('assets/bootstrap/js/time.js') ?>"></script>
</head>
<body onload="waktu()">
<header class="main-header">
  <div id="header">
      <div class="row">
        <div class="row">
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
  </div>
</header>
<div class="wrapper">
  <section class="content">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4">
           <?php if($message){?>
                    <p><?php echo $message;?></p>
            <?php } ?>
        </div>
        <div class="col-md-4 text-center">
          <?php echo form_open('auth/postgetAuth');?>
            <div class="form-group <?php echo $has_notife;?>">
              <input type="text" class="form-control" placeholder="Email or Username" name="identity">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group <?php echo $has_notife;?>">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" name="remember"> <?php echo lang('login_remember_label');?>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('login_submit_btn');?></button>
              </div>
            
              <!-- /.col -->
            </div>
          <?php echo form_close();?>
             
        </div>
        <div class="col-md-4">
          <p class="login-box-msg">
          <div class="form-group has-error">
             <?php if($notif=='error'){?>
             <label class="control-label">
              <p> jika 3 kali memasukan email dan password Salah , Maka Akun Akan Terkunci Otomotis.</p></label>
            <?php }?>
           </div>
         </p>

        </div>
        <div class="col-md-12 text-center">
           <br>
           <h3 class="alert alert-info"> Informasi Jadwal Jaga Operator / Kasir </h3>
           <?= date('d-m-Y');?>
           <div class="row">
           <div class="col-md-4">
            <p class="alert alert-danger">
              Shift 1 : Pukul 00:00 - 08:00 Wib <br> Shift 2 : Pukul 08:00 - 16:00 wib <br> Shift 3 : Pukul 16:00 - 00:00 wib
            </p>
            </div>
            <div class="col-md-8">
            <div class="table-responsive">
              <table class="table" id="tableop">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Operator</th>
                    <th>Shift1</th>
                    <th>Shift2</th>
                    <th>Shift3</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <footer class="footer text-center">
           <small id="footer">Copyright <?= date('Y') ?>, All Right Reserved.</small>
  </footer>
</div>
<script type="text/javascript">
  $(function(){
    $('#tableop').DataTable({
      "ajax": {
            "url": "<?= site_url('auth/ajax_agenda')?>",
            "type": "GET"
        },
    });
  });
</script>
</body>
</html>