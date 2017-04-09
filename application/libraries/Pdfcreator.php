<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
class Pdfcreator
{
	public function __construct()
	{
		
		$pdf = new DOMPDF();
		$CI =& get_instance();
		$CI->dompdf = $pdf;
	}

}