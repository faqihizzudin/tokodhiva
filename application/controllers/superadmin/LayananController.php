<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananController extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_Layanan');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='1'){
			$data['query'] = $this->m_Layanan->tampil_data();

			$this->load->view('header', $data);
			$this->load->view('content/master_data/Layanan', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
		}
	}

	public function add() {
		$idLayanan = $this->input->post('idLayanan');

		if(empty($idLayanan)) $this->m_Layanan->tambah_data();
		else $this->m_Layanan->ubah_data($idLayanan);
	}

	public function delete() {
		$idLayanan = $this->input->post('idLayanan2');
		
		$dataLayanan1 = $this->db->query('Select * FROM detailTransaksi where idLayanan='.$idLayanan.'');
		$dataLayanan2 = $dataLayanan1->num_rows();
		
		if($dataLayanan2 == 0){
			$this->m_Layanan->hapus_data($idLayanan);
		}else{
			echo "<script>alert('Error. Data tidak boleh dihapus.');</script>";
			echo "<script>window.location='".base_url('superadmin/layananController')."';</script>";
		}
	}
}
