<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pengaturan extends CI_Model{
	public $table_name = 'pengaturan';
	public function __construct()
	{
	
		parent::__construct();
	
	}

	function getadata(){
		return $this->db->get($this->table_name)->row();
	}

	function save($data){
		$this->db->set($data);
		$this->db->update($this->table_name);
	}
}