<?php
class M_DetailTransaksi extends CI_Model{
	function get_data_detail($idTransaksi) {
		$arr = array('idTransaksi', 'idPegawai', 'idPelanggan', 'tanggalMasuk', 'tanggalSelesai', 'layananAntar', 'bayarAwal', 'bayarAkhir', 'totalBiaya');
		foreach($arr as $key => $val) $data[$val] = null;

		$this->db->where(array('idTransaksi'=> $idTransaksi));
		$this->db->from('transaksi');
		$query = $this->db->get();
		foreach($query->result() as $row) {
			foreach($arr as $key => $val) $data[$val] = $row->$val;
		}

		return $data;
	}

	function tampil_data($idTransaksi){
        $this->db->select('*');
        $this->db->from('detailtransaksi');
		$this->db->join('layanan', 'layanan.idLayanan = detailtransaksi.idLayanan');
		$this->db->join('transaksi', 'transaksi.idTransaksi = detailtransaksi.idTransaksi');
		$this->db->where(array('transaksi.idTransaksi'=> $idTransaksi));
		return $this->db->get();
	}

	function nota($idTransaksi){
		$this->db->select('*');
		$this->db->where('transaksi.idTransaksi =', $idTransaksi);
        $this->db->from('detailtransaksi');
		$this->db->join('layanan', 'layanan.idLayanan = detailtransaksi.idLayanan');
		$this->db->join('transaksi', 'transaksi.idTransaksi = detailtransaksi.idTransaksi');
		$this->db->where(array('transaksi.idTransaksi'=> $idTransaksi));
		return $this->db->get();
	}

	function tambah_data($idTransaksi){
		$data = array(
			'idTransaksi' => $idTransaksi,
			'idLayanan' => $this->input->post('idLayanan'),
			'jumlah' => $this->input->post('jumlah'),
			'subTotal' => $this->input->post('subTotal'),
			'biaya' => $this->input->post('biaya'),
		);
		$this->db->insert('DetailTransaksi', $data);
		redirect('../superadmin/DetailTransaksiController?id='.$idTransaksi.'');
	}

	function ubah_data ($idDetailTransaksi){
		$data = array(
			'idLayanan' => $this->input->post('idLayanan'),
			'idTransaksi' => $this->input->post('idTransaksi'),
			'jumlah' => $this->input->post('jumlah'),
			'subTotal' => $this->input->post('subTotal'),
			'biaya' => $this->input->post('biaya'),
		);
		$this->db->where(array('idDetailTransaksi'=> $idDetailTransaksi));
		$this->db->update('DetailTransaksi',$data);
		redirect('../superadmin/DetailTransaksiController');
	}

	function hapus_data($idDetailTransaksi, $idTransaksi){
		$this->db->where(array('idDetailTransaksi'=> $idDetailTransaksi));
		$this->db->delete('DetailTransaksi');
		redirect('../superadmin/DetailTransaksiController?id='.$idTransaksi.'');
	}

	function total_biaya(){
		$this->db->select('SUM(subTotal) as total');
		$this->db->from('detailtransaksi');
		return $this->db->get()->row()->total;
	}
}
?>