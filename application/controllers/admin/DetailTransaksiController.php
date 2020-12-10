<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailTransaksiController extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/m_Transaksi');
		$this->load->model('admin/m_Layanan');
		$this->load->model('admin/m_DetailTransaksi');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='2'){
			$data = $this->m_DetailTransaksi->get_data_detail($this->input->get('id'));
			$data['query'] = $this->m_DetailTransaksi->tampil_data($data['idTransaksi']);

			$this->load->view('headeradmin', $data);
			$this->load->view('content/transaksi/detailTransaksiadmin', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/errorAdmin');
		}
	}

	public function add(){
		$idDetailTransaksi = $this->input->post('idDetailTransaksi');
		$idTransaksi = $this->input->post('idTransaksi');
		
		if(empty($idDetailTransaksi)) $this->m_DetailTransaksi->tambah_data($idTransaksi);
		else $this->m_DetailTransaksi->ubah_data($idDetailTransaksi);
	}

	public function delete(){
		$idDetailTransaksi= $this->input->post('idDetailTransaksi2');
		$idTransaksi = $this->input->post('idTransaksi');

		$this->m_DetailTransaksi->hapus_data($idDetailTransaksi, $idTransaksi);
	}
}
?>