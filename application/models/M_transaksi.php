<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_transaksi extends CI_Model{
	public function __construct()
	{
	
		parent::__construct();
	
	}

	public function total_tanggal_sekarang($tanggal=''){
		if($tanggal !=''){
		 $sql = "SELECT SUM( `total_harga`) as total_pendapatan from penjualan WHERE `tgl_transaksi`='".$tanggal."'";	
		}else{
			$sql = "SELECT SUM( `total_harga`) as total_pendapatan from penjualan WHERE `tgl_transaksi`='".mdate('%Y-%m-%d')."'";
		}
		
		return $this->db->query($sql)->result();
	}


	public function product_terlaris(){
		$sql = "SELECT `nama_barang` as product,`jml` FROM penjualan WHERE `tgl_transaksi`='".mdate('%Y-%m-%d')."' AND jml= (SELECT MAX(`jml`) AS jml FROM penjualan)  ORDER BY `penjualan`.`nama_barang` DESC  LIMIT 5";
		return $this->db->query($sql)->result();
	}

	public function kode_transaksi(){
		$sql = "SELECT MAX(RIGHT(`id_penjualan`,6)) as kode_auto FROM `penjualan`";
		$kode = $this->db->query($sql)->result();
		foreach($kode as $kode){
			$kode_auto = $kode->kode_auto+1;
			$auto_number = 'TRANS0'.$kode_auto;
		}

		return $auto_number;
	}

	public function ajax_rekap_transaksi(){
		return $this->db->get_where('penjualan',array('tgl_transaksi'=>mdate('%Y-%m-%d')))->result();
	}

	public function insert_table($table,$data){
		return  $this->db->insert($table,$data);
	}

	public function ajax_rekap_tgl($date){
		return $this->db->get_where('penjualan',array('tgl_transaksi'=>$date))->result();
	}

	public function gettransaksi($kode_transaksi){
		return $this->db->get_where('penjualan',array('kode_transaksi'=>$kode_transaksi,'tgl_transaksi'=>mdate('%Y-%m-%d')))->result();
	}
	

}