<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
  protected 	$ci;

	 function __construct()
	{
        $this->ci =& get_instance();
	}

	public function render($data=array(), $content)
	{
		$this->ci->load->view('template/header',$data);
		$this->ci->load->view('template/nav', $data);
		$this->ci->load->view($content, $data);
		$this->ci->load->view('template/footer', $data);
	}
}

/* End of file template.php */
/* Location: ./application/libraries/template.php */