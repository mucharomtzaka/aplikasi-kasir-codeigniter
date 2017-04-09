<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Members extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
	}

	public function index(){
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['message'] = $this->session->flashdata('message');
		$data['title'] = 'List Data Members';
		$data['kode_pelanggan'] = $this->M_pelanggan->kode_pelanggan();
		$data['tgl_register'] = date('Y-m-d H:i:s');
		$this->template->render($data,'members');
	}


	public function addnew(){
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['kode_pelanggan'] = $this->M_pelanggan->kode_pelanggan();
		$data['tgl_register'] = date('Y-m-d H:i:s');
		$data['title'] = 'Add New Data Members';
		$this->template->render($data,'new_members');
	}

	public function ajax_list_data(){
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
				href="#" class="btn btn-warning" onclick="editmembers('
					."'".$value->idlist."'".')"> <i class="fa fa-edit">Edit</i></a>
					'.anchor(base_url("members/deletemembers/".$value->idlist.""),'delete','onclick="javasciprt: return confirm(\'Are You Sure  to Delete Data Members '.$value->nama_pelanggan.' ?\')" class="btn btn-danger"><i class="fa fa-trash"></i').'
					 </td>';
			$data[] = $row;
		}

		$output = array('data'=>$data);
		echo json_encode($output);
	}


	public function deletemembers($id=''){
		$delete = $this->M_pelanggan->getdelete($id);
		$this->session->set_flashdata('message','Members is Deleted Success!');
		redirect('members','refresh');
	}

  	public function save(){
  		$cek = $this->input->post(null,true);
  		$data = array('kode_pelanggan'=>$cek['kode_pelanggan'],
  						'nama_pelanggan'=>$cek['nama_pelanggan'],
  						'tgl_register'=>$cek['tgl_register'],
  						'jenis_kelamin'=>$cek['jk'],
  						'tgl_lahir'=>$cek['tgl_lahir'],
  						'no_contact'=>$cek['kontak'],
  						'email'=>isset($cek['email'])?$cek['email']:'-',
  						'alamat'=>$cek['alamat']
  					);
  		$insert = $this->M_pelanggan->getinsert($data);
  		$this->session->set_flashdata('message','Members is Insert Success!');
		redirect('members','refresh');
  	}

  	public function update(){
  		$cek = $this->input->post(null,true);
  		$cekdata = array('kode_pelanggan'=>$cek['kode_pelanggan'],
  						'nama_pelanggan'=>$cek['nama_pelanggan'],
  						'tgl_register'=>$cek['tgl_register'],
  						'jenis_kelamin'=>$cek['jk'],
  						'tgl_lahir'=>$cek['tgl_lahir'],
  						'no_contact'=>$cek['kontak'],
  						'email'=>$cek['email'],
  						'alamat'=>$cek['alamat']
  					);
  		$update = $this->M_pelanggan->getupdate($cekdata,$cek['id']);
  		$this->session->set_flashdata('message','Members is Update Success!');
		redirect('members','refresh');
  	}

  	public function ajax_form_edit($id){
  		$edit = $this->M_pelanggan->getdata_by_id($id);
  		if($edit){
  			echo '<div class="form-group">
                 	 <label class="col-md-2 control-label">Kode Pelanggan</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kode_pelanggan" class="form-control" value="'.$edit->kode_pelanggan.'" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Nama Pelanggan</label>
                 	 <div class="col-md-7">
                 	 	<input type="text" name="nama_pelanggan" class="form-control" value="'.$edit->nama_pelanggan.'" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Pendaftaran</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_register" class="form-control" value="'.$edit->tgl_register.'" readonly>
                 	 </div>
                  </div>
                   <div class="form-group">
                 	 <label class="col-md-2 control-label">Tanggal Lahir</label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="tgl_lahir" class="form-control" id="tgl" value="'.$edit->tgl_lahir.'" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Email</label>
                 	 <div class="col-md-7">
                 	 	<input type="email" name="email"  value="'.$edit->email.'" class="form-control" required="required">
                 	 </div>
                  </div>
                  ';

        echo '
        			 <div class="form-group">
                 	 <label class="col-md-2 control-label">jenis Kelamin</label>
                 	 <div class="col-md-4">
                 	 	<select name="jk" class="form-control" required="required">
                 	 	'; 
               if($edit->jenis_kelamin =='Laki-laki'){
               		echo '<option value="Laki-laki" selected>Laki-laki</option>  ';
               }else{
               	    echo '<option value="Perempuan" selected>Perempuan</option>  ';
               }         	 		
       echo '  		<option value=""> Pilih Jenis Kelamin</option> 
       				<option value="Laki-laki"> Laki - laki </option>
                 	<option value="Perempuan"> Perempuan </option>     	 
       				</select>
                 	 </div>
                  </div>
        	 ';
        echo '<div class="form-group">
                 	 <label class="col-md-2 control-label">Kontak </label>
                 	 <div class="col-md-4">
                 	 	<input type="text" name="kontak" id="kontak" value="'.$edit->no_contact.'" class="form-control" required="required">
                 	 </div>
                  </div>
                  <div class="form-group">
                 	 <label class="col-md-2 control-label">Alamat</label>
                 	 <div class="col-md-7">
                 	 	<textarea name="alamat" class="form-control" required="required">
                 	 	'.$edit->alamat.'
                 	 	</textarea>
                 	 </div>
                  </div>';

  		}
  	}
}