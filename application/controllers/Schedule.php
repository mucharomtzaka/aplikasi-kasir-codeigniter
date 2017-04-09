<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
	}

	public function index(){
		$data['title'] = 'Schedule';
		$data['message'] = $this->session->flashdata('message');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['tanggal'] = date('Y-m-d');
		$this->template->render($data,'jadwal');
	}

	public function new(){
		$data['title'] = 'New Schedule';
		$data['tanggal'] = date('Y-m-d');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$this->template->render($data,'addjadwal');
	}

	public function ajax_list_jadwal(){
		$datajadwal = $this->M_jadwal->getjadwal();
		$start = 0;
		$data = array();
		foreach ($datajadwal as $key => $value) {
			# code...
			$row = array();
			$row[]= "<td>".++$start."</td>";
			$row[]= "<td'>".$value->operator."</td>";
			$row[]= "<td'>".$value->tanggal."</td>";
			if($value->shift1 =='1'){
				$td ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$td ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] =$td;
			if($value->shift2 =='1'){
				$td1 ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$td1 ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] = $td1;

			if($value->shift3 =='1'){
				$ro ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$ro ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] = $ro;
			 $row[]= '<td><a 
				href="#" class="btn btn-warning" onclick="editjadwal('
					."'".$value->id_shift."'".')"> <i class="fa fa-edit">Edit</i></a>
					'.anchor(base_url("schedule/deletejadwal/".$value->id_shift.""),'delete','onclick="javasciprt: return confirm(\'Are You Sure  to Delete Schedule '.$value->operator.' ?\')" class="btn btn-danger"><i class="fa fa-trash"></i').'
					 </td>';
			 $data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function addnew(){
		$postdata = $this->input->post(null,true);
		$data = array('operator'=>$postdata['name_operator'],
					 'tanggal'=>$postdata['tgl'],
					 'shift1'=>isset($postdata['shift1'])?$postdata['shift1']:'0',
					 'shift2'=>isset($postdata['shift2'])?$postdata['shift2']:'0',
					 'shift3'=>isset($postdata['shift3'])?$postdata['shift3']:'0'
					);
		$this->M_jadwal->insert($data);
		$this->session->set_flashdata('message','New Schedule is create success');
		redirect('schedule','refresh');
	}

	public function update(){
		$postdata = $this->input->post(null,true);
		$data = array('operator'=>$postdata['name_operator'],
					 'tanggal'=>$postdata['tgl'],
					 'shift1'=>isset($postdata['shift1'])?$postdata['shift1']:'0',
					 'shift2'=>isset($postdata['shift2'])?$postdata['shift2']:'0',
					 'shift3'=>isset($postdata['shift3'])?$postdata['shift3']:'0'
					);
		$this->M_jadwal->update($data,$postdata['id']);
		$this->session->set_flashdata('message','Schedule is update success');
		redirect('schedule','refresh');
	}

	public function deletejadwal($id){
		$this->M_jadwal->delete($id);
		$this->session->set_flashdata('message','Schedule is Delete success');
		redirect('schedule','refresh');
	}

	public function ajax_form_edit($id){
		$datajadwal = $this->M_jadwal->getwhere($id);
		echo '		
				<input type="hidden" class="form-control" name="id" id="id" value="'.$datajadwal->id_shift.'">
					<div class="form-group">
                      <label class="col-md-2 control-label"> Name Operator</label>
                      <div class="col-md-7">
                        <input type="text" name="name_operator" class="form-control" id="name_operator" readonly value="'.$datajadwal->operator.'">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label"> Date</label>
                      <div class="col-md-3">
                        <input type="text" name="tgl" class="form-control" id="tgl" readonly
                        value="'.$datajadwal->tanggal.'">
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-2 control-label"> Choose Shift</label>
                        <div class="col-md-3">
			';
					if($datajadwal->shift1 =='1'){
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" checked name="shift1" value="1">Shift 1 </label>
                        </div>
							';
					}else{
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" name="shift1" value="1">Shift 1 </label>
                        </div>
							';
					}

					if($datajadwal->shift2 =='1'){
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" checked name="shift2" value="1">Shift 2 </label>
                        </div>
							';
					}else{
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" name="shift2" value="1">Shift 2 </label>
                        </div>
							';
					}

					if($datajadwal->shift3 =='1'){
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" checked name="shift3" value="1">Shift 3 </label>
                        </div>
							';
					}else{
						echo '
						<div class="checkbox">
                          <label><input type="checkbox" name="shift3" value="1">Shift 3 </label>
                        </div>
							';
					}			
					echo '</div>';
	}
}