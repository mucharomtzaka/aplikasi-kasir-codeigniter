<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		  if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
		 $this->load->dbutil();
	}

	public function index(){
		$data['title'] = ' Dashboard System ';
		$data['message'] = $this->session->flashdata('message');
		$pengaturan = $this->M_pengaturan->getadata();
		$data['title_bar'] = set_value('title_bar',$pengaturan->title_bar);
		$data['header'] = set_value('header',$pengaturan->header);
		$data['footer'] = set_value('footer',$pengaturan->footer);
		$data['email'] = set_value('email',$pengaturan->email);
		$data['address'] = set_value('address',$pengaturan->address);
		$data['contact'] = set_value('contact',$pengaturan->contact);
		$data['linkbutton'] = anchor(base_url('settings/download'),'Backup Database','class="btn btn-default"><i class="fa fa-download"></i') ;
		$this->template->render($data,'pengaturan');
	}

	function post(){
		$postdata = $this->input->post(null,true);
		$data = array('title_bar'=>$postdata['title_bar'],
						'header'=>$postdata['header'],
						'footer'=>$postdata['footer'],
						'email'=>$postdata['email'],
						'address'=>$postdata['address'],
						'contact'=>$postdata['contact']
				);
		$this->M_pengaturan->save($data);
		$this->session->set_flashdata('message','Setting is save success');
		redirect('settings','refresh');
	}

	public function download(){
		$nama_file  = 'trefast_kasir_database';
		$prefs = array(
                        'tables'      => array(),  // Array of tables to backup.
                        'ignore'      => array(),           // List of tables to omit from the backup
                        'format'      => 'txt',             // gzip, zip, txt
                        'filename'    => $nama_file.'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                        'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                        'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                        'newline'     => "\r\n" ,              // Newline character used in backup file
                        'foreign_key_checks'=>TRUE
                      );

                // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);
		//set premission folder backup , restore,archive 
		//chmod('database/backup',0777);
		$file = write_file('./database/backup/'.$nama_file.'.sql', $backup);
		$filesql = base_url('./database/backup/'.$nama_file.'.sql'); 
         if(file_exists($file)){
                  @unlink($file);
         }
                // Load the download helper and send the file to your desktop
                //$this->load->helper('download');

                $link_download  = $filesql;
                $download = '<a href="'.$link_download.'"> Silahkan Unduh File '.$nama_file.'.sql !</a>';
				$this->session->set_flashdata('message','success backup database '.$nama_file.' is create '.$download.' ');
	   redirect('settings?token='.md5($this->security->get_csrf_hash()).'','refresh');
	}

	public function upload(){
		      if($sql_file= $_FILES['sql']['name']!=''){
		      	      $direktori = './database/restore/'; //Folder penyimpanan file
					 //chmod($direktori,0777);
			         $nama_tmp  = $_FILES['sql']['tmp_name']; //Nama file sementara
			         $upload = $direktori . $sql_file;
			         move_uploaded_file($nama_tmp, $upload);
			         $path_file = './database/restore/'.$sql_file;
			         if(!file_exists($path_file)){
			             @unlink($path_file);
			         }
				 	$get_file  = file_get_contents($path_file);
				  	$string_query = rtrim($get_file,"\r\n;");
						         $array_sql = explode(";",$string_query);

						         $this->db->trans_start();

							         foreach ($array_sql as $query) {

							            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
							            $this->db->query($query);
							            $this->db->query('SET FOREIGN_KEY_CHECKS=1');
							           
							         }

						          $this->db->trans_complete();
						         	 if ($this->db->trans_status() === FALSE){
      										show_error('error restore database');
								   }else{
								   	 $this->session->set_flashdata('message','Succes restore database with files '.$sql_file.'');
								   	 $this->index();
								   }
				}else{
					 $this->session->set_flashdata('message','Error restore database ');
					redirect('restore?token='.md5($this->security->get_csrf_hash()),'refresh');
				}
		 }

}