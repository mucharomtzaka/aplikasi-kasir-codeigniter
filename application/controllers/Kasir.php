<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Kasir extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if ($this->ion_auth->is_admin() || $this->ion_auth->is_superadmin() || $this->ion_auth->is_programmer())redirect('dashboard', 'refresh');
	}

	public function index()
	{
		$data['title'] = ' Panel e-Kasir ';
		$data['barang'] = $this->M_barang->get();
		$data['kode_transaksi'] = $this->kode_transaksi();
		$data['message'] = $this->session->flashdata('message');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['crsf']   = $this->security->get_csrf_hash();
		$data['token_name'] = $this->security->get_csrf_token_name();
		$this->template->render($data,'kasir');
	}

	public function getbarangmodal(){
		$databarang = $this->M_barang->get();
		$start = 0;
		$data = array();
		foreach ($databarang as $key => $value) {
			# code...
			$row = array();
			$row[]= "<td>".++$start."</td>";
			$row[]= "<img src=".base_url('assets/images/product/'.$value->gambar_barang)." 
						width='100px' height='50px'
					>";
			$row[]= "<td'>".$value->kd_barang."</td>";
			$row[]= "<td>".$value->nama_barang."</td>";
			$row[]= "<td>".$value->harga_barang."</td>";
			$row[]= '<td><a 
				href="#" class="btn btn-danger" onclick="pilihBarang('
					."'".$value->id."'".','."'".$value->kd_barang."'".')"> <i class="fa fa-eye">Pilih </i></a> </td>';
			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function getbarangeditcart($id){
		$barang = $this->M_barang->get_by_kode($id);
		if($barang){
			echo '
						<div class="row">
							<div class="col-md-2">
							 <div class="form-group col-md-2 ">
								 <img src="'.base_url("assets/images/product/".$barang->gambar_barang."").'"  width="200px" height="150px" id="images">
							 </div>
							</div>
							<div class="col-md-10 pull-right">
								<div class="form-group">
						      <label class="control-label col-md-4" 
						      	for="nama_barang">Nama Barang :</label>
						      <div class="col-md-8">
						        <input type="text" class="form-control reset" 
						        	name="nama_barang" id="nama_barang" 
						        	value="'.$barang->nama_barang.'"
						        	readonly="readonly">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-md-4" 
						      	for="harga_barang">Harga (Rp) :</label>
						      <div class="col-md-8">
						        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
						        	value="'.number_format( $barang->harga_barang, 0 ,
						        	 '' , '.' ).'" readonly="readonly">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-md-4" 
						      	for="nama_barang">Deskripsi :</label>
						      <div class="col-md-8">
						        <p class="alert alert-info">'.character_limiter($barang->keterangan_barang,300).'</p>
						      </div>
						    </div>
							</div>
						</div>
				    ';
		}
	}

	public function getbarang($id)
	{

		$barang = $this->M_barang->get_by_id($id);

		if ($barang) {

			if ($barang->stok_barang == '0') {
				$disabled = 'disabled';
				$tampil  =  'style="display:none;"';
				$info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #d9534f;">
					          stok habis</span>';
			}else{
				$disabled = '';
				$tampil   = '';
				$info_stok = '<span class="help-block badge" id="reset"
							  stok='.$barang->stok_barang.' 
					          style="background-color: #5cb85c;">stok : '
					          .$barang->stok_barang.'</span>';
			}

			echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="'.$barang->nama_barang.'"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
				        	value="'.number_format( $barang->harga_barang, 0 ,
				        	 '' , '.' ).'" readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Quantity :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	name="qty" placeholder="Isi qty..." autocomplete="off" 
				        	id="qty" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" min="0"  
				        	max="'.$barang->stok_barang.'" '.$disabled.'>
				      </div>'.$info_stok.' <br>
				      <img src="'.base_url("assets/images/product/".$barang->gambar_barang."").'"
				      width="100px" height="100px" '.$tampil.' id="images">
				    </div>';
	    }else{

	    	echo '<div class="form-group">
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
				    </div>';
	    }

	}

	public function ajax_list_transaksi()
	{

		$data = array();

		$no = 1; 
        
        foreach ($this->cart->contents() as $items){
        	
			$row = array();
			$rowid = $items['rowid'];
			$qty   = $items['qty'];
			$kode  = $items['id'];
			$name_barang = $items['name'];
			$row[] = $no;
			$row[] = $items["id"];
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'], 
                    0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];
			$row[] = 'Rp. ' . number_format( $items['subtotal'], 
					0 , '' , '.' ) . ',-';

			//add html for action

			
			$row[] = '
					<a 
				href="#" class="btn btn-danger" onclick="deletebarang('
					."'".$items["rowid"]."'".','."'".$items['subtotal'].
					"'".')"> <i class="fa fa-close">Delete</i></a> 
				<a 
				href="#" class="btn btn-warning" onclick="editbarang('."'".$rowid."'".','."'".$qty."'".','."'".$kode."'".')" 
					>
					 <i class="fa fa-edit">Edit</i></a> 
					';
		
			$data[] = $row;
			$no++;
        }

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function getaddbarang($id){
       
		$value = $this->M_barang->get_by_id($id);
				$data = array(
					'id' => $value->kd_barang,
					'name' =>$value->nama_barang,
					'price' => str_replace('.', '', $value->harga_barang),
					'qty' => 1
				);

		$insert = $this->cart->insert($data);
		echo json_encode(array("status" => TRUE));
	}

	public function total(){
		echo $this->cart->total();
	}
	

	public function addbarang()
	{
			$data = array(
					'id' => $this->input->post('id_barang',TRUE),
					'name' => $this->input->post('nama_barang',TRUE),
					'price' => str_replace('.', '', $this->input->post(
						'harga_barang',TRUE)),
					'qty' => $this->input->post('qty',TRUE)
				);
			$insert = $this->cart->insert($data);
			echo json_encode(array("status" => TRUE));
		
	}


	public function deletebarang($rowid) 
	{

		$this->cart->update(array(
				'rowid'=>$rowid,
				'qty'=>0,));
		echo json_encode(array("status" => TRUE));
	}


	public function updatecart(){
		$post_data = $this->input->post(NULL,TRUE);
		$filter_post = $this->security->xss_clean($post_data);
		$data = array(
						array('rowid'=>$filter_post['rowid'],
						   	   'qty'=>$filter_post['qty']
							)
						);
		$this->cart->update($data);
		$this->session->set_flashdata('message','Keranjang Belanja Telah Berhasil di Update');
		redirect('kasir','refresh');

	}

	public function hapuscart(){
		$this->cart->destroy();
		$this->session->set_flashdata('message','Keranjang Belanja Telah Berhasil di Kosongkan');
		redirect('kasir','refresh');
	}

	public function kode_transaksi(){
		return $this->M_transaksi->kode_transaksi();

	}

	public function selesaitransaksi(){
		$kode_transaksi = $this->input->post('kode_transaksi',TRUE);
		$kode_pelanggan = $this->input->post('kode_pelanggan',TRUE);
		$datestring = "%Y-%m-%d ";
		$waktu = mdate('%H:%i:%s');
		$tgl = mdate($datestring);
		$table = "penjualan";
    	$insert = $this->cart->contents();
    	foreach ($insert as $insert){
    		$total = $insert['price']*$insert['qty'];
    		$data = array(
    			'kode_transaksi'=>$kode_transaksi,
    			'kode_barang' => $insert['id'], 
    			 'nama_barang'=>$insert['name'],
    			'harga_barang'=>$insert['price'],
    			'jml' => $insert['qty'], 
    			'total_harga' => $total, 
    			'tgl_transaksi' => $tgl,
    			'operator'=>$this->session->userdata('username'),
    			'shift'=>$this->session->userdata('shift'),
    			'waktu'=> $waktu,
    			'kode_pelanggan'=>isset($kode_pelanggan)?$kode_pelanggan:'-'
    			);
    		
    		$this->M_transaksi->insert_table($table, $data); //input data penjualan 
	    	$wherebarang = $this->M_barang->get_by_id_result($insert['id']);
	    	$stock = intval($insert['qty']);
	    	foreach ($wherebarang as $key => $value) {
				$stok_barang = intval($value->stok_barang)-$stock;
				$id_barang  = $value->id;
				$updatebarang_jumlah[] = array('stok_barang'=>$stok_barang,'id'=>$id_barang);
			}
    		
		}
		$update_batch = $this->M_barang->update_batch($updatebarang_jumlah);
		$this->cart->destroy();
		echo json_encode(array('status'=>TRUE));
	}

	public function data_transaksi(){
		$data['title'] = ' Rekap Data Transaksi';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['pendapatan_tgl'] = $this->M_transaksi->total_tanggal_sekarang();
		$data['product_terlaris'] = $this->M_transaksi->product_terlaris();
		$data['tanggal'] = date('Y-m-d');
		$data['crsf']   = $this->security->get_csrf_hash();
		$data['token_name'] = $this->security->get_csrf_token_name();
		$this->template->render($data,'rekap_transaksi');
	}

	public function ajax_list_rekaptransaksi(){
		$datarekap = $this->M_transaksi->ajax_rekap_transaksi();
		$data = array();
		 $start = 0;
		foreach ($datarekap as $key => $value) {
			$rows = array();
			$rows[] = ++$start;
			$rows[] = $value->kode_transaksi;
			$rows[] = $value->tgl_transaksi.'&nbsp;'.$value->waktu;
			$rows[] = $value->kode_barang;
			$rows[] = $value->nama_barang;
			$rows[] = 'Rp. ' . number_format($value->harga_barang, 
                    0 , '' , '.' ) . ',-';
			$rows[] = $value->jml;
			$rows[] = 'Rp. ' . number_format($value->total_harga, 
                    0 , '' , '.' ) . ',-';
			$rows[] = $value->operator;
			$rows[] = $value->shift;
			$rows[] = $value->kode_pelanggan;
			$data[] = $rows;
		}

		$output = array("data" => $data);
		//output to json format
		echo json_encode($output);
	}


	public function exportpdf_transaksi_pertanggal($tanggal){
			$datarekap = $this->M_transaksi->ajax_rekap_tgl($tanggal);
			$count = $this->M_transaksi->total_tanggal_sekarang($tanggal);
			$start = 0;
		$html = '<center>Data Transaction '.$tanggal.'</center>';
		$html .='<table cellspacing="0" class="separate" cellpadding="1" width="90%" align="center" border="0">';
		$html .=' <thead> <tr>

					 <th>No</th>
					 <th>Kode Transaksi</th>
					 <th>Tanggal Transaksi</th>
					 <th>kode Barang </th>
					 <th>Nama Barang</th>
					 <th>Harga Barang</th>
					 <th>Qty</th>
					 <th>Sub Total </th>
					 <th>Operator</th>
					 <th>Shift</th>
					 <th>Pelanggan</th>
				</tr></thead>';

		if(count($datarekap) == '0'){
				$html .='<tr>
							<td colspan="10">No Record Data </td>
						</tr>';
		}else{
				foreach ($datarekap as $key => $value) {
				# code...
				$no = ++$start;
				$html .='<tr align="center">';
						$html .='<td>'.$no.'</td>';
						$html .='<td>'.$value->kode_transaksi.'</td>';
						$html .='<td>'.$value->tgl_transaksi.'&nbsp;'.$value->waktu.'</td>';
						$html .='<td>'.$value->kode_barang.'</td>';
						$html .='<td>'.$value->nama_barang.'</td>';
						$html .='<td>Rp.'.number_format( $value->harga_barang, 0 , '' , '.' ).'</td>';
						$html .='<td>'.$value->jml.'</td>';
						$html .='<td>'.$value->total_harga.'</td>';
						$html .='<td>'.$value->operator.'</td>';
						$html .='<td>'.$value->shift.'</td>';
						$html .='<td>'.$value->kode_pelanggan.'</td>';
				$html .='</tr>';


			}
		}
		
		$html .='</table>';
		$html .='==============================================================================';
		foreach ($count as $key => $value) {
			$html .='<p>Total Pendapatan Penjualan : Rp.'.number_format( $value->total_pendapatan, 0 , '' , '.' ).'</p>';
		}

		$html .='<style>
					body { font-family: verdana;} 
					table {
					  margin-top: 2em;
					}

					thead {
					  background-color: #eeeeee;
					}

					tbody {
					  background-color: #ffffee;
					}

					th,td {
					  padding: 3pt;
					}

					table.separate {
					  border-collapse: separate;
					  border-spacing: 5pt;
					  border: 3pt solid #33d;
					}

					table.separate td {
					  border: 2pt solid #33d;
					}

					table.collapse {
					  border-collapse: collapse;
					  border: 1pt solid black;  
					}

					table.collapse td {
					  border: 1pt solid black;
					}
					</style>';
		$this->generatepdf($html,'report_transaksi.pdf');

		//echo json_encode($datarekap);
	}

	public function generatepdf($html,$filename){
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream($filename,array('Attachment'=>0));
	}


	public function preview_struck($kode_transaksi='',$total='',$bayar='',$uangkembali=''){
		if(isset($kode_transaksi)?$kode_transaksi:'');
		if(isset($total)?$total:'0');
		if(isset($bayar)?$bayar:'0');
		if(isset($uangkembali)?$uangkembali:'0');
		$_pengaturan = $this->M_pengaturan->getadata();
		$transaksi = $this->M_transaksi->gettransaksi($kode_transaksi);
		//echo json_encode($transaksi);
		$datestring = "%Y-%m-%d ";
		$waktu = mdate('%H:%i:%s');
		$tgl = mdate($datestring);
		$start=0;
		$html  = '<h1>'.$_pengaturan->header.'</h1><br>';
		$html .= $_pengaturan->address.'<br>';
		$html .= $_pengaturan->email.'<br>';
		$html .= $_pengaturan->contact.'<br>';
		$html .= '<hr size="1">';
		$html .= '<center>Struk Nota Penjualan: &nbsp;'.$kode_transaksi.'<br> Operator: &nbsp;'.$this->session->userdata('username').'<br> Tanggal: &nbsp;'.$tgl.'</center>';
		$html .='<table cellspacing="0" class="separate" cellpadding="1" width="90%" align="center" border="0">';
		$html .=' <thead> <tr>
					 <th>No</th>
					 <th>kode</th>
					 <th>Nama Barang</th>
					 <th>Harga Barang</th>
					 <th>Qty</th>
					 <th>Sub Total </th>
				</tr></thead>';

		if(count($transaksi) == '0'){
				$html .='<tr>
							<td colspan="10">No Record Data </td>
						</tr>';
		}else{
				foreach ($transaksi as $key => $value) {
				# code...
				$no = ++$start;
				$html .='<tr align="center">';
						$html .='<td>'.$no.'</td>';
						$html .='<td>'.$value->kode_barang.'</td>';
						$html .='<td>'.$value->nama_barang.'</td>';
						$html .='<td>Rp.'.number_format( $value->harga_barang, 0 , '' , '.' ).'</td>';
						$html .='<td>'.$value->jml.'</td>';
						$html .='<td>'.$value->total_harga.'</td>';
				$html .='</tr>';


			}
		}
		$html .='</table>';
		$html .= '<hr size="1">';
		$html .='<p> Total:Rp.'.$total.'</p>';
		$html .='<p> Bayar:Rp.'.$bayar.'</p>';
		$html .='<p> Uang Kembali:Rp.'.$uangkembali.'</p>';
		$data['cetak'] = $this->generatepdf($html,'nota_transaksi.pdf');
		$this->load->view('printstruck',$data);

	}

	public function ajax_list_pelanggan(){
		$datamember = $this->M_pelanggan->getdata();
		$data = array();
		$start = 0;
		foreach ($datamember as $key => $value) {
			# code...
			$row = array();
			$row[] = '<td>'.++$start.'</td>';
			$row[] = '<td>'.$value->kode_pelanggan.'</td>';
			$row[] = '<td>'.$value->nama_pelanggan.'</td>';
			$row[] = '<td>'.$value->tgl_lahir.'</td>';
			$row[] = '<td>'.$value->jenis_kelamin.'</td>';
			$row[] = '<td>'.$value->email.'</td>';
			$row[] = '<td>'.$value->no_contact.'</td>';
			$row[] = '<td>'.$value->alamat.'</td>';
			$row[]= '<td><a 
				href="#" class="btn btn-warning" onclick="pilihmembers('
					."'".$value->kode_pelanggan."'".')"> <i class="fa fa-check">Pilih</i></a>
					 </td>';
			$data[] = $row;
		}

		$output = array('data'=>$data);
		echo json_encode($output);
	}


}