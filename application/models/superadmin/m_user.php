<?php 
 
class M_User extends CI_Model{
	function tampil_data() {
		return $this->db->get('Pegawai');
    }
    
    function tambah_data() {
		$data = array(
			'namaUser' => $this->input->post('namaUser'),
			'passUser' => MD5($this->input->post('passUser')),
			'level' => $this->input->post('level'),
			'statusUser' => $this->input->post('statusUser')
			);
		$this->db->where('namaPegawai =', $namaPegawai);
        $this->db->update('Pegawai', $data);
		redirect('../superadmin/Usercontroller');
    }

    function ubah_data($idPegawai) {
		if($this->input->post('passUser') != null) {
			$data = array(
				'namaUser' => $this->input->post('namaUser'),
				'passUser' => MD5($this->input->post('passUser')),
				'level' => $this->input->post('level'),
				'statusUser' => $this->input->post('statusUser')
				);
		} else {
			$data = array(
				'namaUser' => $this->input->post('namaUser'),
				'level' => $this->input->post('level'),
				'statusUser' => $this->input->post('statusUser')
				);
		}
        $this->db->where(array('idPegawai' => $idPegawai));
        $this->db->update('Pegawai', $data);
		redirect('../superadmin/Usercontroller');
    }

    function hapus_data($idPegawai) {
		$data = array(
			'namaUser' => "",
			'passUser' => "",
			'level' => "",
			'statusUser' => ""
			);
		$this->db->where(array('idPegawai' => $idPegawai));
        $this->db->update('Pegawai', $data);
		redirect('../superadmin/Usercontroller');
    }
}