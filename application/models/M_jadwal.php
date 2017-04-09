<?php
/**
* 
*/
class M_jadwal extends CI_Model
{
	public $table = 'shift_operator';
    public $id 	  = 'id_shift';
    public $order = 'DESC';
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	function getjadwal(){
		return $this->db->get($this->table)->result();
	}

	function insert($data){
		return $this->db->insert($this->table,$data);
	}

	function delete($id){
		$this->db->where($this->id,$id);
		$this->db->delete($this->table);
	}

	function update($data,$id){
		return $this->db->update($this->table,$data,array($this->id=>$id));
	}

	function getwhere($id){
		return $this->db->get_where($this->table,array($this->id => $id))->row();
	}

}
