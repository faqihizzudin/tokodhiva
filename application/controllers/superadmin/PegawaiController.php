<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiController extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_pegawai');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='1'){
			$data['query'] = $this->m_pegawai->tampil_data();

			$this->load->view('header', $data);
			$this->load->view('content/master_data/pegawai', $data);
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

		if(empty($idPegawai)) $this->m_pegawai->tambah_data();
		else $this->m_pegawai->ubah_data($idPegawai);
	}

	public function delete() {
		$idPegawai = $this->input->post('idPegawai2');
		
		$dataPegawai1 = $this->db->query('Select * FROM transaksi where idPegawai='.$idPegawai.'');
		$dataPegawai2 = $dataPegawai1->num_rows();
		
		if($dataPegawai2 == 0){
			$this->m_pegawai->hapus_data($idPegawai);
		}else{
			echo "<script>alert('Error. Data tidak boleh dihapus.');</script>";
			echo "<script>window.location='".base_url('superadmin/pegawaiController')."';</script>";
		}
	}
}
