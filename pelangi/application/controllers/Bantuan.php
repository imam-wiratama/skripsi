<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends CI_Controller {


	public function index()
	{	$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['menu']= $this->load->view('include/menu', $data, TRUE);
		$this->load->view('halaman/bantuan',$data);
	}
}
