<?php 
 
class M_pelanggan extends CI_Model{
	function tampil_data() {
		$this->db->order_by('namaPelanggan', 'asc');
		return $this->db->get('pelanggan');
    }
    
    function tambah_data() {
		$data = array(
			'namaPelanggan' => $this->input->post('namaPelanggan'),
			'alamatPelanggan' => $this->input->post('alamatPelanggan'),
			'noHpPelanggan' => $this->input->post('noHpPelanggan')
			);
        $this->db->insert('pelanggan', $data);
		redirect('../admin/pelanggancontroller');
    }

    function ubah_data($idPelanggan) {
		$data = array(
			'namaPelanggan' => $this->input->post('namaPelanggan'),
			'alamatPelanggan' => $this->input->post('alamatPelanggan'),
			'noHpPelanggan' => $this->input->post('noHpPelanggan')
			);
        $this->db->where(array('idPelanggan' => $idPelanggan));
        $this->db->update('pelanggan', $data);
		redirect('../admin/pelanggancontroller');
    }

    function hapus_data($idPelanggan) {
		$this->db->where(array('idPelanggan' => $idPelanggan));
        $this->db->delete('pelanggan');
		redirect('../admin/pelanggancontroller');
    }
}