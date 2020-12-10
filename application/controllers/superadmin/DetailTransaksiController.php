<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailTransaksiController extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('superadmin/m_Transaksi');
		$this->load->model('superadmin/m_Layanan');
		$this->load->model('superadmin/m_DetailTransaksi');
		$this->load->helper('url');
	}

	public function index() {
		if($this->session->userdata('akses')=='1'){
			$data = $this->m_DetailTransaksi->get_data_detail($this->input->get('id'));
			$data['query'] = $this->m_DetailTransaksi->tampil_data($data['idTransaksi']);

			$this->load->view('header', $data);
			$this->load->view('content/transaksi/detailTransaksi', $data);
			$this->load->view('footer', $data);
		}else if($this->session->userdata('akses')==null){
			$this->load->view('content/errorLogin');
		}
		else{
			$this->load->view('content/error');
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

	public function cetak() {
		$this->load->library('escpos');

		$connector = new Escpos\PrintConnectors\WindowsPrintConnector("EPSON TM-U220 Receipt");

		$printer = new Escpos\Printer($connector);

		$printer->initialize();
		$printer->feed(4);
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
		$printer->text("Alhamdulillah bisa jalan :)\n");
		$printer->feed(4);
		$printer->close();
	}
}
?>