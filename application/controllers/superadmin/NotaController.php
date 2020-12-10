<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotaController extends CI_Controller {
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

	public function Nota() {
        if($this->session->userdata('akses')=='1'){
			$this->load->helper('printer_helper');
        }else{
            echo "Halaman tidak ditemukan";
        }
    }
}
