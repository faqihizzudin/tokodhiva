<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProsesController extends CI_Controller {
	public function index()
	{
		if($this->session->userdata('akses')=='1'){
			$this->load->view('header');
			$this->load->view('content/proses');
			$this->load->view('footer');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
