<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_pelanggan');
		$this->load->model('superadmin/m_transaksi');
		$this->load->model('superadmin/m_layanan');
		$this->load->model('superadmin/m_pegawai');
		$this->load->helper('url');
	}

	public function index(){
		if($this->session->userdata('akses')=='1'){
			$data['pelanggan'] = $this->m_pelanggan->jumlah();
			$data['transaksi'] = $this->m_transaksi->jumlah();
			$data['layanan'] = $this->m_layanan->jumlah();
			$data['pegawai'] = $this->m_pegawai->jumlah();

			$this->load->view('header', $data);
			$this->load->view('content/beranda', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
		}
	}
}
