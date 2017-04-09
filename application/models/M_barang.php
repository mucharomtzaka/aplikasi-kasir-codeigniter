<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_barang extends CI_Model{

	public $primary_key = 'id';
	public $table_name	= 'barang';

	public function __construct()
	{
	
		parent::__construct();
	
	}

	// ambil data stock yang masih tersedia
	public function get() 
	{
	  	
	  	 $sql = "SELECT  `id`,`kd_barang`, `nama_barang`, `stok_barang`, `harga_barang`,`gambar_barang` FROM `barang` WHERE `stok_barang`<> 0  ";
		return $this->db->query($sql)->result();
	
	}

	public function getall(){
		return $this->db->get($this->table_name)->result();
	}

	// kode barang product otomatis generate

	public function kode_barang(){
		$sql = "SELECT MAX(RIGHT(`id`,5)) as kode_auto FROM $this->table_name";
		$kode = $this->db->query($sql)->result();
		foreach($kode as $kode){
			$kode_auto = $kode->kode_auto+1;
			$auto_number = 'B0000'.$kode_auto;
		}

		return $auto_number;
	}

	// ambil semua data barang
	public function getdatabarang(){
		 $sql = "SELECT  `id`,`kd_barang`, `nama_barang`, `stok_barang`, `harga_barang`,`gambar_barang` FROM `barang` WHERE `stok_barang` > 0  ";
		return $this->db->query($sql)->result();
	}

	//ambil data stock habis
	public function stock_barang_habis(){
		return $this->db->get_where($this->table_name,array('stok_barang'=>0))->result();
	}

	//ambil data stock habis by id
	public function get_idstock_barang_habis($id){
	 	return $this->db->get_where($this->table_name,
	 								 array('stok_barang'=>0,
	 								 $this->primary_key=>$id
	 								 ))->row();
	}

	public function get_by_id($id)
	{
	  	
	  	return $this->db->get_where($this->table_name,array($this->primary_key=>$id))->row();
	
	}

	public function get_by_kode($id)
	{
	  	
	  	return $this->db->get_where($this->table_name,array('kd_barang'=>$id))->row();
	
	}

	public function get_by_id_result($id)
	{
	  	
	  	return $this->db->get_where($this->table_name,array('kd_barang'=>$id))->result();
	
	}

	public function update_batch($data){
		return $this->db->update_batch($this->table_name,$data,$this->primary_key);
	}

	public function update($data,$id){
		return $this->db->update($this->table_name,$data,array($this->primary_key=>$id));
	}

	// delete data
	public function delete($id)  {
	    $this->db->where($this->primary_key, $id);
	   return $this->db->delete($this->table_name);
     }

     // insert data
    public function insert($data) {
    	return $this->db->insert($this->table_name, $data);
    }




}