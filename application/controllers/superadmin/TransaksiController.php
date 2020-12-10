<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiController extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_Transaksi');
		$this->load->model('superadmin/m_detailtransaksi');
		$this->load->model('superadmin/m_Pelanggan');
		$this->load->model('superadmin/m_Layanan');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='1'){
			$data['query'] = $this->m_Transaksi->tampil_data();

			$this->load->view('header', $data);
			$this->load->view('content/transaksi/transaksi', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
		}
	}

	public function add() {
		$idTransaksi = $this->input->post('idTransaksi');

		if(empty($idTransaksi)) $this->m_Transaksi->tambah_data();
		else $this->m_Transaksi->ubah_data($idTransaksi);
	}

	public function delete() {
		$idTransaksi = $this->input->post('idTransaksi2');
		
		$this->m_Transaksi->hapus_data($idTransaksi);
	}

	public function updateHarga() {
        $idTransaksi = $this->input->post('idTransaksi');
        $bayarAwal = $this->input->post('bayarAwal');
        $kembalian = $this->input->post('kembalian');

        if($bayarAwal>0){
            if(empty($idTransaksi)) $this->index();
            else $this->m_Transaksi->ubah_harga($idTransaksi);
        }else{
            $this->m_Transaksi->cetak($idTransaksi);
        }
    }

	public function updateKet() {
		$idTransaksi = $this->input->post('idTransaksi3');
		
		if(empty($idTransaksi)) $this->index();
		else $this->m_Transaksi->ubah_ket($idTransaksi);
	}
}
