<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_user');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='1'){
			$data['query'] = $this->m_user->tampil_data();

			$this->load->view('header', $data);
			$this->load->view('content/master_data/User', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
		}
	}

	public function add() {
		$idPegawai = $this->input->post('idPegawai');

		if(empty($idPegawai)) $this->m_user->tambah_data();
		else $this->m_user->ubah_data($idPegawai);
	}

	public function delete() {
		$idPegawai = $this->input->post('idPegawai2');
		
		$this->m_user->hapus_data($idPegawai);
	}
}
