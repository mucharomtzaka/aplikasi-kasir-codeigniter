<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
	}

	public function index(){

	}

	public function data_transaksi(){
		$data['title'] = ' Report Transaction';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['pendapatan'] = $this->M_report->total_pendapatan();
		$this->template->render($data,'report_transaksi');
	}

	public function ajax_list_rekaptransaksi(){
		$datarekap = $this->M_report->ajax_rekap_all_transaksi();
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

	public function ajax_list_data_stock(){
		$data_stock_habis = $this->M_barang->stock_barang_habis();
		$data = array();
		 $start = 0;
		foreach ($data_stock_habis as $key => $value) {
			$rows = array();
			$rows[] = ++$start;
			$rows[] = '<img src="'.base_url("assets/images/product").'/'.$value->gambar_barang.'"
				      width="50px" height="50px" id="images">';
			$rows[] = $value->kd_barang;
			$rows[] = $value->nama_barang;
			$rows[] = '<p class="alert alert-warning">Sold Out</p>';
			$rows[] = '<a 
				href="javascript:void()" class="btn btn-warning" onclick="editStock('
					."'".$value->id."'".')" 
					><i class="fa fa-edit">Edit</i></a> 
					';
			$data[] = $rows;

		}

		$output = array("data" => $data);
		//output to json format
		echo json_encode($output);
	}

	public function data_stock(){
		$data['title'] = ' Report Stock Product Sold Out';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['message'] = $this->session->flashdata('message');
		$data['count_stock_tersedia'] = count($this->M_barang->getdatabarang());
		$this->template->render($data,'report_stok');
	}

	public function get_ajax_stock_by_id($id){
		$stockbarang = $this->M_barang->get_idstock_barang_habis($id);
		if($stockbarang){
			echo '
					<div class="form-group">
	                 <label class="control-label col-md-3" for="id_barang">Kode Barang :</label>
	                  <div class="col-md-5">
	                    <input type="text" class="form-control" 
	                    placeholder="ex:B0002" name="id_barang" id="kd_barang_modal" readonly="readonly" value="'.$stockbarang->kd_barang.'">
	                  </div>
              		</div>
					<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="'.$stockbarang->nama_barang.'"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
				        	value="'.number_format( $stockbarang->harga_barang, 0 ,
				        	 '' , '.' ).'" readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
	                    <label class="control-label col-md-3" for="qty_modal">Quantity :</label>
	                  <div class="col-md-4">
	                   <input type="number" class="form-control reset" 
	                      autocomplete="off"  id="qty_modal" min="0" 
	                     name="qty" placeholder="Isi qty..." value="'.$stockbarang->stok_barang.'">
	                  </div>
	               </div>
				    ';
		}
	}

	public function updatestock(){
		$data_var = $this->input->post(null,true);
		$data = array('stok_barang'=>$data_var['qty']);
		$this->M_barang->update($data,$data_var['id']);
		$this->session->set_flashdata('message','Update Stok is Success');
		redirect('report/data_stock','refresh');
	}


	public function exportpdf_transaksi_all(){
		$datarekap = $this->M_report->ajax_rekap_all_transaksi();
		$count = $this->M_report->total_pendapatan();
		$tanggal  ='';
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

	}


	public function exportpdf_transaksi_pertanggal($tanggal){
			$datarekap = $this->M_report->ajax_rekap_tgl($tanggal);
			$count = $this->M_report->total_tanggal_sekarang($tanggal);
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


	public function exportpdf_stock_habis(){
		$adata = $this->M_barang->stock_barang_habis();
		$start = 0;
		$html = '<center>Data Stok Sold Out Produk</center>';
		$html .='<table cellspacing="0" cellpadding="5" width="90%" align="center" border="0">';
		$html .='<tr style="color:red">
					 <th>No</th>
					 <th>Photo</th>
	                 <th>Kode Barang</th>
	                 <th>Nama Barang</th>
	                 <th>Harga Barang</th>	
				</tr>';
		foreach ($adata as $key => $value) {
			# code...
			$no = ++$start;
			$kode_barang = $value->kd_barang;
			$photo = '<img src="'.base_url("assets/images/product").'/'.$value->gambar_barang.'" width="100px" height="50px">';
			//$photo = $value->gambar_barang;
			$nama_barang = $value->nama_barang;
			$harga_barang = number_format( $value->harga_barang, 0 , '' , '.' );
			$qty = $value->stok_barang;
			$html .='<tr align="center">';
					$html .='<td>'.$no.'</td>';
					$html .='<td>'.$photo.'</td>';
					$html .='<td>'.$kode_barang.'</td>';
					$html .='<td>'.$nama_barang.'</td>';
					$html .='<td>Rp.'.$harga_barang.'</td>';
			$html .='</tr>';

		}
		
		$html .='</table>';
		
		$this->generatepdf($html,'report_produk.pdf');
	}


	public function generatepdf($html,$filename){

			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream($filename,array('Attachment'=>0));
	}

	public function generatepdf_from($file,$filename){
			$html = file_get_contents($file);
			$this->dompdf->load_html_file($html);
			$this->dompdf->render();
			$this->dompdf->stream($filename,array('Attachment'=>0));
	}
}