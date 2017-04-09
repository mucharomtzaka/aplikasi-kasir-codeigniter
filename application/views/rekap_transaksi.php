<section class="content">
	<div class="col-md-9">
		<div class="panel panel-default">
			 <div class="panel-header">
			 	<h1 class="alert alert-info"><?php echo $title;?> </h1> 
			 	<center class="alert alert-warning">per Tanggal : <?= date('d-m-Y');?></center>
			 	<div class="row">
			 		<div class="col-md-3">
			 			<fieldset>
			 				<legend>
			 				<i class="fa fa-dollar"></i>
			 				Total Pendapatan Penjualan
			 				</legend>
			 				<p class="alert alert-info">
			 					<?php foreach($pendapatan_tgl as $t):?>
				 				 Jumlah  : <?= 'Rp. ' . number_format($t->total_pendapatan, 0 , '' , '.' ) . ',-'?>
				 				<?php endforeach;?>
			 				</p>
			 			</fieldset>
			 			
			 		</div>
			 		<div class="col-md-4">
			 		<fieldset>
			 			<legend>
			 			<i class="fa fa-cart-plus"></i>
			 			Product Terlaris
			 			</legend>
			 			<table class="table">
			 			    <thead>
			 			    	<tr>
			 			    		<th>Nama Product</th>
			 						<th>Jumlah</th>
			 						<th>Tanggal</th>
			 			    	</tr>
			 			    </thead>
			 				<tbody>
			 					<?php foreach($product_terlaris as $t):?>
			 					<tr class="alert alert-success">
			 					<td> <?= $t->product ?></td>
			 					<td><?= $t->jml ?></td>	
			 					<td><?= $t->tgl_transaksi ?></td>	
			 					</tr>
			 					<?php endforeach;?>
			 				</tbody>
			 			</table>
			 		</fieldset>
			 		</div>
			 		<div class="col-md-4">
			 			<fieldset>
			 				<legend>
			 				<i class="fa fa-print"></i>
			 				  Cetak</legend>
			 				  <div class="form-horizontal">
			 				    <form name="print_report" id="print_report" role="form">
			 				    <input type="hidden" name="<?=$token_name;?>" id="token" value="<?=$crsf;?>">
			 				  		<div class="form-group">
			 				  		<label class="col-md-6 control-label"> Tanggal Transaksi</label>
			 				  			<div class="col-md-6">
			 				  				<input  name="tanggal_transaksi" type="text" id='tgl'
			 				  				 class="form-control" value="<?=$tanggal;?>">
			 				  			</div>
			 				  		</div>
			 			
			 				  		 <div class="pull-right">
			 				  		 	 <button id="print" name="print" class="btn btn-primary btn-lg" type="button">
			 				  		  	<i class="fa fa-print">Print</i>
			 				  		  </button>
			 				  		  <button id="reset" name="reset" class="btn btn-danger btn-lg" type="reset">
			 				  		  	<i class="fa fa-close">Reset</i>
			 				  		  </button>
			 				  		 </div>
			 				  	</form>
			 				  </div>
			 			</fieldset>
			 		</div>
			 	</div>
			 </div>
			 <div class="panel-body">
			 	<div class="table-responsive">
			 		<table class="table table-striped table-bordered table-hover" id="table_rekap">
			 		<thead>
			 			<tr>
			 				<th>No</th>
			 				<th>Kode Transaksi</th>
			 				<th>Tanggal Transaksi</th>
			 				<th>Kode Barang</th>
			 				<th>Nama Barang</th>
			 				<th>Harga Barang</th>
			 				<th>Quantity</th>
			 				<th>Total Harga</th>
			 				<th>Operator</th>
			 				<th>Shift</th>
			 				<th>Pelanggan</th>
			 			</tr>
			 		</thead>
			 			<tbody>
			 			</tbody>
			 		</table>
			 	</div>
			 </div>
			 <div class="panel-footer">
			 	<div class="row">
			 	
			 	 </div>
			 </div>
		</div>
	</div>
	 <link href="<?=base_url();?>/assets/datepicker/datepicker3.css" rel="stylesheet">
    <script src="<?=base_url();?>/assets/datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#table_rekap').DataTable({
						"ajax": {
			            "url": "<?= site_url('kasir/ajax_list_rekaptransaksi')?>",
			            "type": "GET"
			        }
			});
			 $('#tgl').datepicker({
              format: 'yyyy-mm-dd'
            });

			$('#print').on('click',function(){
				var tanggal_transaksi = $('#tgl').val();
				if(tanggal_transaksi == ''){
					alert('Please Insert Date Transaction ! ');
				}else{
					$('#modal-viewpdf').modal();
						var preview = $("#previewpdf");
		                resizePreview();

		                $(window).scroll(function() {
		                  var scrollTop = Math.min($(this).scrollTop(), preview.height()+preview.parent().offset().top) - 1;
		                  preview.css("margin-top", scrollTop + "px");
		                });

		                $(window).resize(resizePreview);
						$.ajax({
									url : "<?= site_url('kasir/exportpdf_transaksi_pertanggal')?>/"+tanggal_transaksi,
						            type: "GET",
						            dataType: "html",
						            success: function(data)
						            {
						               $('#previewpdf').attr('src','<?= site_url('kasir/exportpdf_transaksi_pertanggal')?>/'+tanggal_transaksi);
						               $('#tanggal_transaksi').val(''); // reset kembali
						            },
						            error: function (jqXHR, textStatus, errorThrown)
						            {
						                alert(errorThrown);
						            }
						});
					}
			});
		})

		function resizePreview(){
            var preview = $("#previewpdf");
            preview.height($(window).height() - preview.offset().top - 1);
          }
	</script>
</section>
 <div class="modal fade" id="modal-viewpdf" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Print Data Transaction </h4>
        </div>
            <div class="modal-body">
               <iframe id="previewpdf" name="previewpdf" src="about:blank" frameborder="0" width="100%"  marginheight="0" marginwidth="0"></iframe> 
            </div>
          <div class="modal-footer">

          </div>
        </div>
        
      </div>
      
    </div>
  </div>