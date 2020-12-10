<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelangganController extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('admin/m_pelanggan');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='2'){
			$data['query'] = $this->m_pelanggan->tampil_data();
	
			$this->load->view('headeradmin', $data);
			$this->load->view('content/master_data/pelangganadmin', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/errorAdmin');
		}
	}

	public function add() {
		$idPelanggan = $this->input->post('idPelanggan');

		if(empty($idPelanggan)) $this->m_pelanggan->tambah_data();
		else $this->m_pelanggan->ubah_data($idPelanggan);
	}

	public function delete() {
		$idPelanggan = $this->input->post('idPelanggan2');
		
		$dataPelanggan1 = $this->db->query('Select * FROM transaksi where idPelanggan='.$idPelanggan.'');
		$dataPelanggan2 = $dataPelanggan1->num_rows();
		
		if($dataPelanggan2 == 0){
			$this->m_pelanggan->hapus_data($idPelanggan);
		}else{
			echo "<script>alert('Error. Data tidak boleh dihapus.');</script>";
		}
		
		echo "<script>window.location='".base_url('admin/pelangganController')."';</script>";
	}
}
