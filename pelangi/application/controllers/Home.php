<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{	$data['css'] = $this->load->view('include/css', NULL, TRUE);
		$data['menu']= $this->load->view('include/menu', $data, TRUE);
		$this->load->view('halaman/home',$data);
	}
}
