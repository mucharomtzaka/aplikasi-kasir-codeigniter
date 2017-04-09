<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
	}

	public function index(){
		$data['title'] = ' Product';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['message'] = $this->session->flashdata('message');
		$data['count_stock_habis'] = count($this->M_barang->stock_barang_habis());
		$this->template->render($data,'product');
	}

	public function deleteproduct($id){
		$deleteproduct = $this->M_barang->delete($id);
		$this->session->set_flashdata('message','Product is Deleted Success!');
		redirect('product','refresh');
	}

	public function ajax_list_data(){
		$product = $this->M_barang->getdatabarang();
		$start = 0;
		$data = array();
		foreach ($product as $key => $value) {
			# code...
			$row = array();
			$row[]= "<td>".++$start."</td>";
			$row[]= "<img src=".base_url('assets/images/product/'.$value->gambar_barang)." 
						width='100px' height='50px'
					>";
			$row[]= "<td'>".$value->kd_barang."</td>";
			$row[]= "<td>".$value->nama_barang."</td>";
			$row[]= "<td>".$value->harga_barang."</td>";
			$row[]= "<td>".$value->stok_barang."</td>";
			$row[]= '<td><a 
				href="#" class="btn btn-warning" onclick="editproduct('
					."'".$value->id."'".','."'".$value->gambar_barang."'".')"> <i class="fa fa-edit">Edit</i></a>
					'.anchor(base_url("product/deleteproduct/".$value->id.""),'delete','onclick="javasciprt: return confirm(\'Are You Sure  to Delete Product '.$value->nama_barang.' ?\')" class="btn btn-danger"><i class="fa fa-trash"></i').'
					<a 
				href="#" class="btn btn-warning" onclick="printbarcode('
					."'".$value->kd_barang."'".','."'".$value->id."'".')"> <span class="fa fa-eye"></span> Print Barcode<i class="fa fa-barcode"></i></a>
					 </td>';
			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_form_add(){
		$kode_barang = $this->M_barang->kode_barang();
		echo '
					<div class="form-group">
	                 <label class="control-label col-md-3" for="id_barang">Kode Barang :</label>
	                  <div class="col-md-5">
	                    <input type="text" class="form-control" 
	                    placeholder="ex:B0002" name="kd_barang" id="kd_barang_modal" readonly="readonly" value="'.$kode_barang.'">
	                  </div>
              		</div>
					<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="" required="required" placeholder="Insert Name Product"
				        	">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
				        	value="" placeholder=" Insert nominal price , ex:1000" required="required">
				      </div>
				    </div>
				    <div class="form-group">
	                    <label class="control-label col-md-3" for="qty_modal">Quantity :</label>
	                  <div class="col-md-4">
	                   <input type="number" class="form-control reset" 
	                      autocomplete="off"  id="qty_modal" min="0" 
	                     name="qty" placeholder="Insert qty..." value="" required="required">
	                  </div>
	               </div>
	               <div class="form-group">
	                    <label class="control-label col-md-3" >Deskripsi :</label>
	                  <div class="col-md-8">
	                  	<textarea name="deskripsi" class="form-control" required></textarea>
	                  </div>
	               </div>
				    ';
	}

	public function formnewadd(){
		$data['title'] = ' Form New Product';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['message'] = $this->session->flashdata('message');
		$this->template->render($data,'product_add_ajax');
	}

	public function get_ajax_product_by_id($id){
		$editproduct = $this->M_barang->get_by_id($id);
		if($editproduct){
			echo '
							<div class="form-group">
					                 <label class="control-label col-md-3" for="id_barang">Kode Barang :</label>
					                  <div class="col-md-5">
					                    <input type="text" class="form-control" 
					                    placeholder="ex:B0002" name="kd_barang" id="kd_barang_modal" readonly="readonly" value="'.$editproduct->kd_barang.'">
					                  </div>
				              		</div>
				              		<div class="form-group">
								      <label class="control-label col-md-3" 
								      	for="nama_barang">Nama Barang :</label>
								      <div class="col-md-8">
								        <input type="text" class="form-control reset" 
								        	name="nama_barang" id="nama_barang" 
								        	value="'.$editproduct->nama_barang.'" required="required" placeholder="Insert Name Product"
								        	">
								      </div>
								    </div>
								    <div class="form-group">
								      <label class="control-label col-md-3" 
								      	for="harga_barang">Harga (Rp) :</label>
								      <div class="col-md-8">
								        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
								        	value="'.$editproduct->harga_barang.'" placeholder=" Insert nominal price , ex:1000" required="required">
								      </div>
								    </div>
								    <div class="form-group">
					                    <label class="control-label col-md-3" for="qty_modal">Quantity :</label>
					                  <div class="col-md-4">
					                   <input type="number" class="form-control reset" 
					                      autocomplete="off"  id="qty_modal" min="0" 
					                     name="qty" placeholder="Insert qty..." value="'.$editproduct->stok_barang.'" required="required">
					                  </div>
					               </div>
					               <div class="form-group">
					                    <label class="control-label col-md-3" >Deskripsi :</label>
					                  <div class="col-md-8">
					                  	<textarea name="deskripsi" class="form-control textarea text-left">
					                  	'.$editproduct->keterangan_barang.'
					                  	</textarea>
					                  </div>
					               </div>
	                       </div>
				';
		}
	}

	public function addnew(){
			$postdata = $this->input->post(null,true);
				$cekdata = array(
							'kd_barang'=>$postdata['kd_barang'],
							'nama_barang'=>$postdata['nama_barang'],
							'harga_barang'=>$postdata['harga_barang'],
							'stok_barang'=>$postdata['qty'],
							'keterangan_barang'=>$postdata['deskripsi']						
				     );	
		//upload file photo 
        			$logo = $_FILES['photo']['name'];
	                $direktori = './assets/images/product/'; //Folder penyimpanan file
	               // chmod($direktori,777);
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['photo']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 move_uploaded_file($nama_tmp, $upload);
	                $cekdata['gambar_barang'] =$logo;
	        $Insertdb = $this->M_barang->insert($cekdata);
	        $this->session->set_flashdata('message','New Product is Success Added');
	        redirect('product','refresh');
	}


	public function updateproduct(){
		$postdata = $this->input->post(null,true);
				   $cekdata = array(
							'kd_barang'=>$postdata['kd_barang'],
							'nama_barang'=>$postdata['nama_barang'],
							'harga_barang'=>$postdata['harga_barang'],
							'stok_barang'=>$postdata['qty'],
							'keterangan_barang'=>$postdata['deskripsi']						
				     );

        			if($_FILES['photo']['name']!=''){
        				$logo = $_FILES['photo']['name'];
		                $direktori = './assets/images/product/'; //Folder penyimpanan file
		               // chmod($direktori,777);
		                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
		                 $nama_file =  $logo ; //Nama file yang akan di Upload
		               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
		                 $nama_tmp  = $_FILES['photo']['tmp_name']; //Nama file sementara
		                 $upload = $direktori . $nama_file;
		                 move_uploaded_file($nama_tmp, $upload);
		                $cekdata['gambar_barang'] =$logo;
		             }
	        $updatedb = $this->M_barang->update($cekdata,$postdata['id']);
	        $this->session->set_flashdata('message','New Product is Success update');
	        redirect('product','refresh');
	}


	public function set_barcode($code)
	{
		$this->zend->load('Zend/Barcode');
		//generate barcode
	     Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		
	}

	public function ajax_print_barcode_all(){
		$data['product'] = $this->M_barang->getdatabarang();
		$this->load->view('barcode',$data);
	}

	public function ajax_print_barcode_by($id){
		$dta  = $this->M_barang->get_by_id($id);
		$data['kd_barang'] = $dta->kd_barang;
		$this->load->view('barcode_by_id',$data);
	}

	public function exportpdf(){
		$adata = $this->M_barang->getdatabarang();
		$start = 0;
		$html = '<center>Data Produk</center>';
		$html .='<table cellspacing="0" cellpadding="5" width="90%" align="center" border="0">';
		$html .='<tr style="color:red">
					 <th>No</th>
					 <th>Photo</th>
	                 <th>Kode Barang</th>
	                 <th>Nama Barang</th>
	                 <th>Harga Barang</th>
	                 <th>Stok</th>	
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
					$html .='<td>'.$qty.'</td>';
			$html .='</tr>';

		}
		
		$html .='</table>';
		
		$this->generatepdf($html,'data_produk.pdf');

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