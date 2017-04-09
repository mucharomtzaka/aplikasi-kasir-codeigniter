<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
		 $this->lang->load('auth');
	}

	public function index(){
		$data['title'] = ' Users';
		$data['message'] = $this->session->flashdata('message');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['users'] = $this->ajax_list_user();
		foreach ($data['users'] as $key => $value) {
			# code...
			$data['users'][$key]->groups = $this->ion_auth->get_users_groups($value->id)->result();
		}
		$this->template->render($data,'users');
	}

	public function deactivate($id){
		$this->ion_auth_model->deactivate($id);
		$this->session->set_flashdata('message','Account User Information is deactivate');
		redirect("users", 'refresh');
	}

	public function activate($id){
		$this->ion_auth_model->activate($id);
		$this->session->set_flashdata('message','Account User Information is activate');
		redirect("users", 'refresh');
	}

	public function ajax_list_user(){
		$datauser = $this->M_users->get_datauser();
		 return $datauser;
	}

	public function create_users()
    {
        $data['title'] = $this->lang->line('create_user_heading');
        $data['action'] = 'users/create_users';
        $_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_superadmin())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("users", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'class' =>'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                 'class' =>'form-control',
                 'placeholder'=>'Enter Email',
                'value' => $this->form_validation->set_value('identity'),
            );
            // $data['email'] = array(
            //     'name'  => 'email',
            //     'id'    => 'email',
            //     'type'  => 'text',
            //      'class' =>'form-control',
            //     'value' => $this->form_validation->set_value('email'),
            // );
            $data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('company'),
            );
            $data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('phone'),
            );
            $data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->template->render($data,'users_form');
        }
    }

    

	public function deleteusers($id){
		//delete user 
			$delete = $this->M_users->delete($id);
			if($delete)
				$this->session->set_flashdata('message','Account User Information is Deleted');
				redirect("users", 'refresh');
		}



	public function edit_users($id)
	{
		$data['title'] = $this->lang->line('edit_user_heading');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_superadmin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			/*// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			// update the password if it was posted
			if ($this->input->post('password',TRUE))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password',TRUE))
				{
					$data['password'] = $this->input->post('password',TRUE);
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_superadmin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups',TRUE);

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('users', 'refresh');
					}
					else
					{
						redirect('auth/index', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_superadmin())
					{
						redirect('users', 'refresh');
					}
					else
					{
						redirect('users/index', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$data['user'] = $user;
		$data['groups'] = $groups;
		$data['currentGroups'] = $currentGroups;

		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			 'class' =>'form-control',
		);
		$data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			 'class' =>'form-control',
		);

		$this->template->render($data,'edit_user');
	}

	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// create a new group
	public function create_group()
	{
		$data['title'] = $this->lang->line('create_group_title');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_superadmin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name',TRUE), $this->input->post('description',TRUE));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("users", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				 'class' =>'form-control',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				 'class' =>'form-control',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->template->render($data,'create_group');
		}
	}

	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$data['title'] = $this->lang->line('edit_group_title');
		$_pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_superadmin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', '<p class="alert alert-success">'.$this->lang->line('edit_group_saved').'</p>');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("users", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			 'class' =>'form-control',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->template->render($data,'edit_group');
	}

}