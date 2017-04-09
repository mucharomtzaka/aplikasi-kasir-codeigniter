<?php require_once(APPPATH.'views/modal/modal-nota.php');?>
<?php require_once(APPPATH.'views/modal/modal-cari.php');?>
<?php require_once(APPPATH.'views/modal/modal-pelanggan.php');?>
<?php require_once(APPPATH.'views/modal/editcartmodal.php');?>
<section class="content">
<div class="col-md-10">
		<div class="panel panel-default">
			<?php if(isset($message)):?>
                     <?php echo $message;?>
			<?php endif;?>
			<div class="panel-body">
				<div class="row">
					<p class="alert alert-warning">Transaksi Penjualan</p>
					<form class="form-horizontal" name="transaksi" method="POST" id="form_transaksi" role="form">
					<input type="hidden" name="<?=$token_name;?>" id="token" value="<?=$crsf;?>" style="display:none;">
					<div class="col-md-5">
						<p class="alert alert-danger">
						         	Masukan Kode Pelanggan
						         </p>
			             <div class="form-group">
						  <label class="control-label col-md-3" for="kode_pelanggan">Kode Pelanggan :</label>
						   <div class="col-md-7">
							 <input type="text" class="form-control reset" placeholder="ex:P0002 , Optional" name="kode_pelanggan" id="kode_pelanggan" readonly="readonly">
						   </div>
						   <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modal-cari-pelanggan">
						   <i class="fa fa-search">Cari</i></a>
				         </div>
						<div class="form-group">
						  			<label class="control-label col-md-6" for="kode_transaksi">Nomor Transaksi :</label>
							  		<div class="col-md-6">
										  <input type="text" class="form-control" 
											name="kode_transaksi" id="kode_transaksi"  value="<?=$kode_transaksi ?>" 
											readonly="readonly">
									 </div>
						  	</div>
						  	 <div class="form-group">
									<label class="control-label col-md-6" for="tgl_transaksi">Tgl.Transaksi :</label>
									 <div class="col-md-6">
									  <input type="text" class="form-control" id="tgl_transaksi" 
										name="tgl_transaksi" value="<?= date('d-m-Y') ?>" 
										readonly="readonly">
									 </div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-6" for="tgl_transaksi">Operator :</label>
								 <div class="col-md-6">
								 <input type="text" class="form-control" name="operator" value="<?=$this->session->userdata('name');?>" id="operator" readonly="readonly">
								 </div>
							</div>
							<div class="form-group">
							  <label class="control-label col-md-6" for="tgl_transaksi">Shift:</label>
								 <div class="col-md-2">
								 <input type="text" class="form-control" name="operator" value="<?=$this->session->userdata('shift');?>" readonly="readonly">
								 </div>
							</div>		         
					</div>
					<div class="col-md-7">
						<fieldset>
						<legend>Input Product</legend>
						 	<div class="nav-tabs-custom">
							 	<ul class="nav nav-tabs">
					              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-list">Automatic</i></a></li>
					              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th">Manual</i></a></li>
					            </ul>
			            		<div class="tab-content">
						         <div class="tab-pane active" id="tab_1">
						         <p class="alert alert-danger">
						         	Masukan Kode Barang dengan Barcode Mesin
						         </p>
						              	<div class="form-group">
									      <label class="control-label col-md-3" 
									      	for="id_barang">Kode Barang :</label>
									      <div class="col-md-5">
									        <input type="text" class="form-control reset" 
									        	placeholder="ex:B0002" name="id_barang" id="kd_barang">
									      </div>
									       <a href="<?php echo site_url();?>#tab_1" class="btn btn-warning" ><i class="fa fa-refresh"></i></a>
									    </div>
					              </div>
				              	  <div class="tab-pane" id="tab_2">
						              <p class="alert alert-danger">
							         	Masukan Kode Barang dengan cara manual
							         </p>
						              	<div class="form-group">
									      <label class="control-label col-md-3" 
									      	for="id_barang">Kode Barang :</label>
									      <div class="col-md-5">
									         <input type="text" class="form-control reset" 
									        	placeholder="ex:B0002" name="id_barang" id="id_barang">
									      </div>
						                   <div class="col-md-4">
									      	<a href="#" class="btn btn-primary" 
									      		data-toggle="modal" 
									      		data-target="#modal-cari-barang">
									      		<i class="fa fa-search">Cari</i></a>
									      	 <a href="<?php echo site_url();?>#tab_2" class="btn btn-warning" ><i class="fa fa-refresh"></i></a>
								          </div>
									    </div>
										<div id="barang">
											    <div class="form-group">
											      <label class="control-label col-md-3" 
											      	for="nama_barang">Nama Barang :</label>
											      <div class="col-md-8">
											        <input type="text" class="form-control reset" 
											        	name="nama_barang" id="nama_barang" 
											        	readonly="readonly">
											      </div>
											    </div>
											    <div class="form-group">
											      <label class="control-label col-md-3" 
											      	for="harga_barang">Harga (Rp) :</label>
											      <div class="col-md-8">
											        <input type="text" class="form-control reset" 
											        	name="harga_barang" id="harga_barang" 
											        	readonly="readonly">
											      </div>
											    </div>
											    <div class="form-group">
											      <label class="control-label col-md-3" 
											      	for="qty">Quantity :</label>
											      <div class="col-md-4">
											        <input type="number" class="form-control reset" 
											        	autocomplete="off" onchange="subTotal(this.value)" 
											        	onkeyup="subTotal(this.value)" id="qty" min="0" 
											        	name="qty" placeholder="Isi qty...">
											      </div>
											    </div>
										 </div><!-- end id barang -->
										  <div class="form-group">
									      <label class="control-label col-md-3" 
									      	for="sub_total">Sub-Total (Rp):</label>
										      <div class="col-md-8">
										        <input type="text" class="form-control reset" 
										        	name="sub_total" id="sub_total" 
										        	readonly="readonly">
										      </div>
									    </div>
									    <div class="form-group">
									    	 <div class="alert alert-warning" id="cekstock"></div>
									    </div>
									    <div class="form-group">
									    	<div class="col-md-offset-6 col-md-6">
									      		<button type="button" class="btn btn-primary" 
									      		id="tambah" onclick="addbarang_manual()">
									      		  <i class="fa fa-plus"></i> Tambah</button>
									      	<!-- 	<button type="reset" class="btn btn-warning" 
									      		id="resetform">
									      		  <i class="fa fa-minus"></i> Reset</button> -->
									            <a href="#" class="btn btn-warning" id="resetform" onclick="resetform()" ><i class="fa fa-remove">Reset</i></a>
									    	</div>
									    	</div>
				             	 		</div>  
			           		 		</div>
				  				</div>
				  			</div>
		  				</fieldset>
		  				<div class="col-md-5">
							
						</div>
					</div>
					
			</form>

					<div class="col-md-12 mb">
				      <div class="row">
				      	<div class="col-md-9">
				      				<div id="notice"></div>
				      		<fieldset>
					      	<div class="table-responsive">
					      		<table id="table_transaksi" class="table table-striped 
					      		table-bordered table-hover">
					      		<caption>
					      		<p class="alert alert-info">
					      		<i class="fa fa-cart-plus"></i>Daftar Keranjang Belanja
					      		<button type="button" class="btn btn-primary pull-right" onclick="deleteAllitem()"><i class="fa fa-trash"> Delete All</i></button>
					      		</p>
					      		</caption>
								<thead>
								 	<tr>
									   	<th width="10px">No</th>
									   	<th width="100px">Kode Barang</th>
									   	<th width="100px">Nama Barang</th>
									   	<th width="100px">Harga</th>
									   	<th>Quantity</th>
									   	<th>Sub-Total</th>
									   	<th width="290px">Aksi</th>
								 	</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							</div>
							<p class="alert alert-danger">Notice: Barang yang sudah dibeli atau  dijual tidak dapat dikembalikan 
					      	</fieldset>
				      	</div>
				      	<div class="col-md-3 form-horizontal">
				      		<fieldset>
						  		<legend class="alert alert-info">Kalkulator</legend>
						  		<div class="form-group">
							      <label for="total" class="besar">Total (Rp) :</label>
							      	<input type="text" class="form-control input-lg" 
						        	name="total" id="total" placeholder="0"
						        	readonly="readonly"  value="<?= number_format( 
			                    	$this->cart->total(), 0 , '' , '.' ); ?>">
							    </div>
							    <div class="form-group">
							      <label for="bayar" class="besar">Bayar (Rp) :</label>
							        <input type="text" class="form-control input-lg uang" 
							        	name="bayar" placeholder="0" autocomplete="off"
							        	id="bayar" onkeyup="showKembali(this.value)">
							    </div>
							    <div class="form-group">
							      <label for="kembali" class="besar">Kembali (Rp) :</label>
							      	<input type="text" class="form-control input-lg" 
						        	name="kembali" id="kembali" placeholder="0"
						        	readonly="readonly">
							    </div>
							    <div class="form-group">
							    	<button type="button" class=" btn btn-primary btn-lg" id="selesai" disabled="disabled" >Selesai <i class="fa fa-angle-double-right"></i></button>
							    </div>
						  	</fieldset>
				      	</div>
				      </div>	
			      	</div>	
				</div>
			</div>
	</div>
</div>
	<link href="<?=base_url();?>/assets/keyboard/keyboard-dark.css" rel="stylesheet">
  	<script src="<?=base_url();?>/assets/keyboard/jquery.keyboard.js"></script>
  <!-- keyboard extensions (optional) -->
  	<script src="<?=base_url();?>/assets/keyboard/jquery.mousewheel.js"></script>
  	<script src="<?=base_url();?>/assets/keyboard/jquery.keyboard.extension-all.js"></script>
  <!-- 	<script src="<?=base_url();?>/assets/keyboard/jquery.keyboard.extension-autocomplete.js"></script>
  	<script src="<?=base_url();?>/assets/keyboard/jquery.keyboard.extension-caret.js"></script> -->
 <script type="text/javascript">
 function showBarang(str) 
	{

	    if (str == "") {
	        $('#nama_barang').val('');
	        $('#harga_barang').val('');
	        $('#qty').val('');
	        $('#sub_total').val('');
	        $('#reset').hide();
	        return;
	    } else { 
	      if (window.XMLHttpRequest) {
	          // code for IE7+, Firefox, Chrome, Opera, Safari
	           xmlhttp = new XMLHttpRequest();
	      } else {
	          // code for IE6, IE5
	          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	      }
	      xmlhttp.onreadystatechange = function() {
	           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	              document.getElementById("barang").innerHTML = 
	              xmlhttp.responseText;
	          }
	      }
	      xmlhttp.open("GET", "<?= base_url('kasir/getbarang') ?>/"+str,true);
	      xmlhttp.send();
	    }
	}

	function subTotal(qty)
	{

        var stockbarang = $('#reset').attr('stok');
		var harga = $('#harga_barang').val().replace(".", "").replace(".", "");
		$('#sub_total').val(convertToRupiah(harga*qty));
      	 if(qty >= 0){
				$('#cekstock').html('<label>Notice Please Input Quantity'+ 
					'is low from label info stok</label');
			}
		
	}

	function convertToRupiah(angka)
	{

	    var rupiah = '';    
	    var angkarev = angka.toString().split('').reverse().join('');
	    
	    for(var i = 0; i < angkarev.length; i++) 
	      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	    
	    return rupiah.split('',rupiah.length-1).reverse().join('');
	
	}

	var table;
    $(document).ready(function() {

      showKembali($('#bayar').val());

      table = $('#table_transaksi').DataTable({ 
        paging: false,
        "info": false,
        "autowidth":true,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' 
        // server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= site_url('kasir/ajax_list_transaksi')?>",
            "type": "GET"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,1,2,3,4,5,6 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });

      $('#table_modal').DataTable({
        // server-side processing mode.
      	"ajax": {
            "url": "<?= site_url('kasir/getbarangmodal')?>",
            "type": "GET"
        }
        //Set column definition initialisation properties.
       
      });

      $('#table_modal_pelanggan').DataTable({
        // server-side processing mode.
      	"ajax": {
            "url": "<?= site_url('kasir/ajax_list_pelanggan')?>",
            "type": "GET"
        }
        //Set column definition initialisation properties.
       
      });

      $('#kd_barang').keyup(function() {
			   konfirmsend();
	   });

       // keyboard on screen 
       $('#bayar').keyboard({
			layout: 'num',
			restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
			preventPaste : true,  // prevent ctrl-v and right click
			autoAccept : true
		});

       $('#selesai').on('click',function(){

       		window.setTimeout(savetransaksi(),1000);
       });

       $('#close').on('click',function(){
       	 $('#modal-printnota').modal('hide');
       	 window.location.reload();
       });

    });

    function reload_table()
    {

      table.ajax.reload(null,false); //reload datatable ajax 
    
    }

    function savetransaksi(){
    	var kode_transaksi = $('#kode_transaksi').val();
    	var total          = $('#total').val();
    	var bayar 		   = $('#bayar').val();
    	var uangk		   = $('#kembali').val();
    	var kode_pelanggan = $('#kode_pelanggan').val();
 	    $.ajax({
				 url : "<?= site_url('kasir/selesaitransaksi')?>",
				 type: "POST",
				 dataType: "JSON",
				 data:$('#form_transaksi').serialize(),
				  success: function(data)
					            {
					               reload_table();
					               $('#notice').html(
					               	' <div class="alert alert-info alert-dismissible">'+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
					               	+'<p class="alert alert-success">'+
					               		'Kode Transaksi '+kode_transaksi+' Berhasil di lakukan ' 
									 +'</p>'+
								    '</div>');

					               cetaknota(kode_transaksi,total,bayar,uangk);

					            },
					            error: function (jqXHR, textStatus, errorThrown)
					            {
					                alert(errorThrown);
					            }
					        });

	          			//mereset semua value setelah selesai  ditekan
	          			//window.location.reload();
	          			$('#total').val('');
	          			$('.reset').val('');
	          			showKembali($('#bayar').val(''));
	          			$('#cekstock').hide();
	          			resetform();
    }

    function cetaknota(nota,total,bayar,uangk){
    	$('#modal-printnota').modal();
	
    		$.ajax({
				url : "<?= site_url('kasir/preview_struck')?>/"+nota+'/'+total+'/'+bayar+'/'+uangk,
				type: "GET",
				dataType: "html",
				success: function(data)
				{
				$('#previewpdf').attr('src','<?= site_url('kasir/preview_struck')?>/'+nota+'/'+total+'/'+bayar+'/'+uangk);	 
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
				 alert(errorThrown);
				}
		});

		 
    }

    function addbarang_manual()
    {
        var id_barang = $('#id_barang').val();
        var qty = $('#qty').val();
        if (id_barang == '') {
	          $('#id_barang').focus();
	        }else if(qty == 0 ){
	          $('#qty').focus();
	        }else{
	        		$.ajax({
				            url : "<?= site_url('kasir/addbarang')?>",
				            type: "POST",
				            data: $('#form_transaksi').serialize(),
				            dataType: "JSON",
				            success: function(data)
				            {
				               //reload ajax table
				               reload_table();
				            },
				            error: function (jqXHR, textStatus, errorThrown)
				            {
				                alert('Error adding data');
				            }
			        	});

	        			showTotal();
	          			showKembali($('#bayar').val());
	          			//mereset semua value setelah btn tambah ditekan
	          			$('.reset').val('');
	          			$('#cekstock').hide();
	          			resetform();

	        		
	        }
    }



    function konfirmsend(){
    		setTimeout(function(){
    			 site_url = '<?=site_url()?>';
			   	 var id_barang = $("#kd_barang").val();

			   	 if (id_barang  == '') {
			      	var id = $("#id_barang").val();
			      }else{
				  	 var id = $("#kd_barang").val();
			      }

			      $.get(site_url+'/kasir/getaddbarang/'+id, function() {
			        /*optional stuff to do after success */
			        $("#kd_barang").val();
			        reload_table();
			        total();
			        $('.reset').val('');
			      });
			   },0);
    			
    }

    function total()
		{
		  site_url = '<?=site_url()?>';
		  $.get(site_url+'kasir/total', function(data) {
		   $('#total').val(data);
		  });
		}

    function deletebarang(id,sub_total)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?= site_url('kasir/deletebarang')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");

          $('#total').val(convertToRupiah(ttl-sub_total));

          showKembali($('#bayar').val());
    }

    function editbarang(id,qty,kode)
    {
        // ajax delete data to database
           
          $('#modal-editcart').modal();  
          $('#rowid').val(id);
		  $('#kd_barang_modal').val(kode);
		  $('#qty_modal').val(qty);
		  $('#nama_barang_modal').val('');
	      $('#harga_barang_modal').val('');

	      //alert(kode);

		  if (window.XMLHttpRequest) {
	          // code for IE7+, Firefox, Chrome, Opera, Safari
	           xmlhttp = new XMLHttpRequest();
	      } else {
	          // code for IE6, IE5
	          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	      }
	      xmlhttp.onreadystatechange = function() {
	           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	              document.getElementById("barang_modal").innerHTML = 
	              xmlhttp.responseText;
	          }
	      }
	      xmlhttp.open("GET", "<?= base_url('kasir/getbarangeditcart') ?>/"+kode,true);
	      xmlhttp.send();


    }


    function showTotal()
    {
    	
    	var total = $('#total').val().replace(".", "").replace(".", "");
    	var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");
    	$('#total').val(convertToRupiah((Number(total)+Number(sub_total))));
    	

  	}

  	//maskMoney
	$('.uang').maskMoney({
		thousands:'.', 
		decimal:',', 
		precision:0
	});

	function showKembali(str)
  	{
	    var total = $('#total').val().replace(".", "").replace(".", "");
	    //var bayar = str.replace(".", "").replace(".", "");

	    var bayar = str.replace(".", "").replace(".", "");
	    var kembali = bayar-total;

	    $('#kembali').val(convertToRupiah(kembali));

	    if (kembali >= 0) {
	      $('#selesai').removeAttr("disabled");
	    }else{
	      $('#selesai').attr("disabled","disabled");
	    };

	    if (total == '0') {
	      $('#selesai').attr("disabled","disabled");
	    };
  	}

  	function deleteAllitem()
		{
			site_url = '<?=site_url()?>';
			$.get(site_url+'kasir/hapuscart', function() {
				/*optional stuff to do after success */
				reload_table();
		        total();	
			});
		}

   function pilihBarang(id,kode){
   	  $('#id_barang').val(kode);
   	  $('#modal-cari-barang').modal('hide');
   	  showBarang(id);
   }

   function resetform(){
   	 $('#id_barang').val('');
   	 $('#nama_barang').val('');
	 $('#harga_barang').val('');
	 $('#qty').val('');
	 $('#sub_total').val('');
	 $('#reset').hide();
	 $('#images').hide();
	 $('#cekstock').hide();
	 $('#kode_pelanggan').val('');
   }

   function pilihmembers(member){
    $('#kode_pelanggan').val(member);
    $('#modal-cari-pelanggan').modal('hide');
   }
 </script>
</div>
</section>