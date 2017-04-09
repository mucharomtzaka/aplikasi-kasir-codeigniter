<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class M_pelanggan extends CI_Model
{
	public $primary_key = 'idlist';
	public $table_data = 'pelanggan';
	
	function __construct()
	{
		# code...
	}

	public function getdata(){
		return $this->db->get($this->table_data)->result();
	}

	public function getdata_by_id($id){
		return $this->db->get_where($this->table_data,array($this->primary_key=>$id))->row();
	}

	public function getinsert($data){
		return $this->db->insert($this->table_data,$data);
	}

	public function getupdate($data,$id){
		return $this->db->update($this->table_data,$data,array($this->primary_key=>$id));
	}

	public function getdelete($id){
		$this->db->where($this->primary_key, $id);
		return $this->db->delete($this->table_data);
	}

	public function kode_pelanggan(){
		$sql = "SELECT MAX(RIGHT($this->primary_key,5)) as kode_auto FROM $this->table_data";
		$kode = $this->db->query($sql)->result();
		foreach($kode as $kode){
			$kode_auto = $kode->kode_auto+1;
			$auto_number = 'P0000'.$kode_auto;
		}

		return $auto_number;
	}
}