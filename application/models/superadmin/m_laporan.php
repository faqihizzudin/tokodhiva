<?php 
 
class M_Laporan extends CI_Model{
	function tampil_data($namaPegawai) {
    
    $tanggalAwal = date('Y-m-d 00:00:00', strtotime($this->input->post('start')));
    $tanggalAkhir = date('Y-m-d 00:00:00', strtotime($this->input->post('end')));
    $this->db->select('*');
    $this->db->where('tanggalSelesai >=', $tanggalAwal);
    $this->db->where('tanggalSelesai <=', $tanggalAkhir);
    
    if($namaPegawai != ""){
        $this->db->where('namaPegawai =', $namaPegawai);
    }
    
    $this->db->from('transaksi');
    $this->db->join('pelanggan', 'pelanggan.idPelanggan = transaksi.idPelanggan');
    $this->db->join('pegawai', 'pegawai.idPegawai = transaksi.idPegawai');
    $query=$this->db->get();
    return $query;
    }
}