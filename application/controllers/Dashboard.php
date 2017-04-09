<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		 parent::__construct();
		 if(!$this->ion_auth->logged_in())redirect('auth', 'refresh');
		 if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_programmer() && !$this->ion_auth->is_superadmin())redirect('kasir', 'refresh');
		 
	}

	public function index(){
		$data['title'] = ' Dashboard System ';
		$_pengaturan = $this->M_pengaturan->getadata();
		$tahun = date('Y');
		$data['title_bar'] = $_pengaturan->title_bar;
		$data['header'] = $_pengaturan->header; 
		$data['footer'] = $_pengaturan->footer;
		$data['address'] = $_pengaturan->address;
		$data['contact'] = $_pengaturan->contact;
		$data['email']	= $_pengaturan->email;
		$data['message'] = $this->session->flashdata('message');
		$data['agenda'] = count($this->M_jadwal->getjadwal());
		$data['pendapatan'] = $this->M_report->total_pendapatan();
		$data['pendapatan_tgl'] = $this->M_transaksi->total_tanggal_sekarang();
		$data['count_users'] = count($this->M_users->get_datauser());
		$data['count_product_tersedia'] = count($this->M_barang->getdatabarang());
		$data['count_product_habis']  = count($this->M_barang->stock_barang_habis());
		$data['count_member'] = count($this->M_pelanggan->getdata());
		$data['product_terlaris'] = $this->M_transaksi->product_terlaris();
		$chart = $this->chart_bulanan($tahun);
		foreach($chart as $list){
			$data['dt'][] = floatval($list->Januari);
			$data['dt'][] = floatval($list->Februari);
			$data['dt'][] = floatval($list->Maret);
			$data['dt'][] = floatval($list->Mei);
			$data['dt'][] = floatval($list->April);
			$data['dt'][] = floatval($list->Juni);
			$data['dt'][] = floatval($list->Juli);
			$data['dt'][] = floatval($list->Agustus);
			$data['dt'][] = floatval($list->September);
			$data['dt'][] = floatval($list->Oktober);
			$data['dt'][] = floatval($list->November);
			$data['dt'][] = floatval($list->Desember);
		}
		 
		$this->template->render($data,'dashboard');
	}

	public function chart_bulanan($tahun){
		
		return $this->M_report->report_sale_bulanan($tahun);	
	}

	
}