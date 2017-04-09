<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 $this->load->library(array('ion_auth','form_validation','template'));
		 $this->load->helper(array('url','language'));
		 $this->load->model(array('ion_auth_model'));
		 $this->lang->load('auth');
	}

	public function index($message=''){
		$data['title'] = 'Authentification Login User ';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		if($this->ion_auth->logged_in())redirect('auth/dashboard/status', 'refresh');
		$data['has_notife'] = 'has-feedback';
		if($message =='error'? $message:''){
					$data['notif'] = $message;
				}else{
					$data['notif'] = '';
		}
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->load->view('login',$data);
	}

	public function logout($param=null,$notif=null)
	{
		$this->data['title'] = "Logout";
		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		if($param=='timeout'){
			$notif.='<div class="span4 offset4 alert 
			alert-warning text-center"><button type="button" class="close" data-dismiss="alert">
			<i class="fa fa-times"></i></button>Waktu Session Telah Habis Silahkan login kembali</div>';
			$this->session->set_flashdata('message',$notif);
			redirect('auth/index/login/timeout?user=logout&token='. md5($this->security->get_csrf_hash()).'', 'refresh');
		}else{
			$this->session->set_flashdata('message', $this->ion_auth->messages());
		}
		redirect('auth/index?user=logout&token='. md5($this->security->get_csrf_hash()).'', 'refresh');
	}

	public function postgetAuth(){
		$data['title'] = 'Authentification Login User ';
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember',TRUE);

			if ($this->ion_auth->login($this->input->post('identity',TRUE), $this->input->post('password',TRUE), $remember))
			{
				//if the login is successful
				//redirect them back to the home page

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->dashboard();
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/index/error?token='.md5($this->security->get_csrf_hash()).'', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);
			$data['has_notife'] = 'has-error';
			$data['notif'] ='';
			$this->load->view('login',$data);
		}
		
	}

	public function dashboard($param=''){
		
			if($this->ion_auth->is_admin() || $this->ion_auth->is_superadmin()){
				if($param =='status'){
					$notif='<div class="span4 offset4 alert 
				   alert-info text-center"><button type="button" class="close" data-dismiss="alert">
				   <i class="fa fa-times"></i></button>Your is login status</div>';
				}else{
					$notif='<div class="span4 offset4 alert 
				  alert-warning text-center"><button type="button" class="close" data-dismiss="alert">
				  <i class="fa fa-times"></i></button>successful your login</div>';
				} 
				$this->session->set_flashdata('message',$notif);
				redirect('dashboard?user_id='.md5($this->session->userdata('user_id')).'&mode=administrator&token='. md5($this->security->get_csrf_hash()).'', 'refresh');
			}elseif ($this->ion_auth->is_programmer()) {
				redirect('dashboard?user_id='.md5($this->session->userdata('user_id')).'&mode=programmerr&token='.md5($this->security->get_csrf_hash()).'', 'refresh');
			}else{
				if($param =='status'){
					$notif='<div class="span4 offset4 alert 
				   alert-info text-center"><button type="button" class="close" data-dismiss="alert">
				   <i class="fa fa-times"></i></button>Your is login status</div>';
				   $this->session->set_flashdata('message',$notif);
				}
				if(!$this->session->userdata('shift')){
					redirect('auth/redirect_shift_op?user_id='.md5($this->session->userdata('user_id')).'&mode=kasir&token='.md5($this->security->get_csrf_hash()).'', 'refresh');
				}else{
					redirect('kasir?user_id='.md5($this->session->userdata('user_id')).'&mode=kasir&shift='.md5($this->session->userdata('shift')).'token='.md5($this->security->get_csrf_hash()).'', 'refresh');
				}
			}	
	}

	public function redirect_shift_op($param =''){
		if(!$this->ion_auth->logged_in()){
			redirect('auth', 'refresh');
		}elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer()) {
			if($param == 'getsession'){
				$shiftpost = $this->input->post(null,true);
				$this->session->set_userdata(array('shift'=>$shiftpost['shift']));
				redirect('kasir?user_id='.md5($this->session->userdata('user_id')).'&mode=kasir&shift='.md5($this->session->userdata('shift')).'token='.md5($this->security->get_csrf_hash()).'', 'refresh');
			}else{
				$data['title'] = ' Choose Shift Operator';
				$data['aksi']  = 'auth/redirect_shift_op/getsession';
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('choose_shift',$data);
			}
		}
	}

	public function gantipass(){
		if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');

			$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
			$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

			$user = $this->ion_auth->user()->row();
			if ($this->form_validation->run() == false){
			$data['title'] = 'Change Password';
			$_pengaturan = $this->M_pengaturan->getadata();
			$data['title_bar'] = $_pengaturan->title_bar;
			$data['header'] = $_pengaturan->header; 
			$data['footer'] = $_pengaturan->footer;
			$data['address'] = $_pengaturan->address;
			$data['contact'] = $_pengaturan->contact;
			$data['email']	= $_pengaturan->email;
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
					'name' => 'old',
					'id'   => 'old',
					'type' => 'password',
					'class' =>'form-control',
					'size' =>'5'
				);
			$data['new_password'] = array(
					'name'    => 'new',
					'id'      => 'new',
					'type'    => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
					'class' =>'form-control',
					'size' =>'5'
				);
			$data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
					'class' =>'form-control',
					'size' =>'5'
				);
			$data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' =>  $user->id,
					'class' =>'form-control',
					'size' =>'5'
				);
				
			$this->template->render($data,'change_password');
		}else{
				$identity = $this->session->userdata('identity');

				$change = $this->ion_auth->change_password($identity, $this->input->post('old',TRUE), $this->input->post('new',TRUE));

				if ($change)
				{
					//if the password was successfully changed
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('auth/dashboard');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/gantipass', 'refresh');
				}
		}
	}

	public function ajax_agenda(){
		$dataop = $this->agenda_jadwal();
		$start =0;
		$data = array();
		foreach($dataop as $key => $jadwal){
			$row = array();
			$row[] = '<td>'.++$start.'</td>';
			$row[] = '<td>'.$jadwal->operator.'</td>';

			if($jadwal->shift1 =='1'){
				$td ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$td ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] =$td;
			if($jadwal->shift2 =='1'){
				$td1 ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$td1 ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] = $td1;

			if($jadwal->shift3 =='1'){
				$ro ='<td> <i class="fa fa-check"></i></td>';
			}else{
				$ro ='<td> <i class="fa fa-minus"></i></td>';
			}
			 $row[] = $ro;

			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	private function agenda_jadwal(){
		return $this->M_jadwal->getjadwal();
	}

}