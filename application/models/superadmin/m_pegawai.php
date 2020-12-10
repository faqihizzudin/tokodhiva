<?php 
 
class M_pegawai extends CI_Model{
	function tampil_data() {
		$this->db->order_by('namaPegawai', 'asc');
		return $this->db->get('pegawai');
    }
    
    function tambah_data() {
		$data = array(
			'namaPegawai' => $this->input->post('namaPegawai'),
			'alamatPegawai' => $this->input->post('alamatPegawai'),
			'noHpPegawai' => $this->input->post('noHpPegawai')
			);
        $this->db->insert('pegawai', $data);
		redirect('../superadmin/pegawaicontroller');
    }

    function ubah_data($idPegawai) {
		$data = array(
			'namaPegawai' => $this->input->post('namaPegawai'),
			'alamatPegawai' => $this->input->post('alamatPegawai'),
			'noHpPegawai' => $this->input->post('noHpPegawai')
			);
        $this->db->where(array('idPegawai' => $idPegawai));
        $this->db->update('pegawai', $data);
		redirect('../superadmin/pegawaicontroller');
    }

    function hapus_data($idPegawai) {
		$this->db->where(array('idPegawai' => $idPegawai));
        $this->db->delete('pegawai');
		redirect('../superadmin/pegawaicontroller');
	}
	
	function jumlah(){
		return $this->db->count_all_results('pegawai');
	}
}