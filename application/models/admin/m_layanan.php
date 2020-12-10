<?php 
 
class M_Layanan extends CI_Model{
	function tampil_data() {
		$this->db->order_by('namaLayanan', 'asc');
		return $this->db->get('layanan');
    }
    
    function tambah_data() {
		$data = array(
			'namaLayanan' => $this->input->post('namaLayanan'),
			'biaya' => $this->input->post('biaya'),
			'keterangan' => $this->input->post('keterangan')
			);
        $this->db->insert('Layanan', $data);
		redirect('../adminadmin/Layanancontroller');
    }

    function ubah_data($idLayanan) {
		$data = array(
			'namaLayanan' => $this->input->post('namaLayanan'),
			'biaya' => $this->input->post('biaya'),
			'keterangan' => $this->input->post('keterangan')
			);
        $this->db->where(array('idLayanan' => $idLayanan));
        $this->db->update('Layanan', $data);
		redirect('../adminadmin/Layanancontroller');
    }

    function hapus_data($idLayanan) {
		$this->db->where(array('idLayanan' => $idLayanan));
        $this->db->delete('Layanan');
		redirect('../adminadmin/Layanancontroller');
    }
}