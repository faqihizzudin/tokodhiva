<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {
    function __construct() {
		parent::__construct();		
		$this->load->model('superadmin/m_Transaksi');
		$this->load->model('superadmin/m_detailtransaksi');
		$this->load->model('superadmin/m_Pelanggan');
		$this->load->model('superadmin/m_Pegawai');
		$this->load->model('superadmin/m_Layanan');
		$this->load->model('superadmin/m_Laporan');
		$this->load->helper('url');
    }
    
    public function index() {
		if($this->session->userdata('akses')=='1'){
			$this->load->view('header');
			$this->load->view('content/laporan');
			$this->load->view('footer');
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
		}
	}

	public function Laporan(){
        if($this->session->userdata('akses')=='1'){
			
			$namaPegawai = $this->input->post('namaPegawai');
            $data['query'] = $this->m_Laporan->tampil_data($namaPegawai);
            
            $this->load->library('pdf');
			if($namaPegawai == ""){
				$this->pdf->setPaper('A4', 'potrait');
				$this->pdf->filename = "laporan-berlian.pdf";
				$this->pdf->load_view('content/laporanPdf', $data);
			}else if($namaPegawai != ""){
				$this->pdf->setPaper('A4', 'potrait');
				$this->pdf->filename = "laporan-berlian.pdf";
				$this->pdf->load_view('content/laporanPdfPegawai', $data, $namaPegawai);
			}

        }else{
            echo "Halaman tidak ditemukan";
        }
    }
}
