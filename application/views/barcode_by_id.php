<!DOCTYPE html>
<html lang="en">
<head>
	<title>Print Barcode</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/reset.css') ?>">
  	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <script src="<?= base_url('assets/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>
<body>
<div class="wrapper">
	<div class="col-md-12">
		<div class="row">
		<img src="<?=base_url('product/set_barcode/'.$kd_barang.'');?>" width="150px" height="100px">
		</div>
	</div>
</div>
<script type="text/javascript">
	try {
		this.print();
	}
	catch(e) {
		window.onload = window.print;
	}
</script>
</body>
</html>