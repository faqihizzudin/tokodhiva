<?php
class M_login extends CI_Model{
	function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		
		$query=$this->db->query("SELECT * FROM pegawai WHERE namaUser='".$username."' AND passUser='".MD5($password)."'");
		foreach ($query->result() as $row) {
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('id',$row->idPegawai);
            $this->session->set_userdata('nama',$row->namaPegawai);
			if ($row->level=='superadmin') {
				$this->session->set_userdata('akses','1');
				redirect('superadmin/welcome');
			} else {
				$this->session->set_userdata('akses','2');
				redirect('admin/welcome/');
			}
		}
		echo $this->session->set_flashdata('msg','Username Atau Password Salah');
		redirect(base_url());

		//echo "<script>
		//	alert('Username Atau Password Salah');
		//	window.location.replace('".base_url()."');
		//</script>";
    }
}
