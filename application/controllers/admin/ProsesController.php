<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProsesController extends CI_Controller {
	public function index()
	{
		if($this->session->userdata('akses')=='2'){
			$this->load->view('headeradmin');
			$this->load->view('content/prosesadmin');
			$this->load->view('footer');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
