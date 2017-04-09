<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report extends CI_Model{
	public function __construct()
	{
	
		parent::__construct();
	
	}

	public function ajax_rekap_all_transaksi(){
		return $this->db->get('penjualan')->result();
	}

	public function ajax_rekap_tgl($date){
		return $this->db->get_where('penjualan',array('tgl_transaksi'=>$date))->result();
	}

	public function total_pendapatan(){
		$sql = "SELECT SUM( `total_harga`) as total_pendapatan from penjualan";
		return $this->db->query($sql)->result();
	}

	public function total_tanggal_sekarang($date){
		$sql = "SELECT SUM( `total_harga`) as total_pendapatan from penjualan WHERE `tgl_transaksi`='".$date."'";
		return $this->db->query($sql)->result();
	}

	public function report_sale_bulanan($tahun){
		$sql = "
	SELECT IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=1) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Januari,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=2) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Februari,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=3) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Maret,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=4) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS April,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=5) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Mei,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=6) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Juni,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=7) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Juli,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=8) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Agustus,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=9) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS September,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=10) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Oktober,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=11) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS November,
		IFNULL((SELECT SUM(`jml`)FROM penjualan WHERE (MONTH(`tgl_transaksi`)=12) AND (YEAR(`tgl_transaksi`)='".$tahun."')),0) AS Desember
		FROM penjualan  GROUP BY YEAR(`tgl_transaksi`)
		";
		return $this->db->query($sql)->result();
	}

	public function getbarang($nama_barang){
		$sql = "SELECT nama_barang ,IFNULL((SELECT(`stok_barang`)from barang where nama_barang='".$nama_barang."'),0) as jum  from barang";
		return $this->db->query($sql)->result();
	}


}