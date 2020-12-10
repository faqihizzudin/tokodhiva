<?php 
 
class M_Transaksi extends CI_Model{
	function tampil_data() {
		$this->db->select('*');
		$this->db->order_by('idTransaksi','desc');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.idPelanggan = transaksi.idPelanggan');
		$this->db->join('pegawai', 'pegawai.idPegawai = transaksi.idPegawai');
		$query=$this->db->get();
		return $query;
	}
	
	function nota($idTransaksi) {
		$this->db->select('*');
		$this->db->where('idTransaksi =', $idTransaksi);
		$this->db->order_by('idTransaksi','desc');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.idPelanggan = transaksi.idPelanggan');
		$this->db->join('pegawai', 'pegawai.idPegawai = transaksi.idPegawai');
		$query=$this->db->get();
		return $query;
    }
    
    function tambah_data() {
		$data = array(
			'idPelanggan' => $this->input->post('idPelanggan'),
			'idPegawai' => $this->session->userdata('id'),
			'tanggalMasuk' => date('Y-m-d 00:00:00', strtotime($this->input->post('tanggalMasuk'))),
			'tanggalSelesai' => date('Y-m-d 00:00:00', strtotime($this->input->post('tanggalSelesai'))),
			'layananAntar' => $this->input->post('layananAntar'),
			'bayarAwal' => $this->input->post('bayarAwal'),
			'bayarAkhir' => $this->input->post('bayarAkhir')
			);
        $this->db->insert('Transaksi', $data);
		redirect('../superadmin/Transaksicontroller');
    }

    function hapus_data($idTransaksi) {
		$this->db->where(array('idTransaksi' => $idTransaksi));
        $this->db->delete(array('detailtransaksi', 'Transaksi'));
		redirect('../superadmin/Transaksicontroller');
	}
	
	function ubah_harga($idTransaksi) {
		$data = array(
			'bayarAwal' => $this->input->post('total'),
			'bayarAkhir' => $this->input->post('kembalian')
			);
        $this->db->where(array('idTransaksi' => $idTransaksi));
		$this->db->update('transaksi', $data);
		
		
		$this->db->select('*');
		$this->db->where('idTransaksi =', $idTransaksi);
		$this->db->order_by('idTransaksi','desc');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.idPelanggan = transaksi.idPelanggan');
		$this->db->join('pegawai', 'pegawai.idPegawai = transaksi.idPegawai');
		$transaksi['query'] = $this->db->get();

		$this->db->select('*');
		$this->db->where('transaksi.idTransaksi =', $idTransaksi);
        $this->db->from('detailtransaksi');
		$this->db->join('layanan', 'layanan.idLayanan = detailtransaksi.idLayanan');
		$this->db->join('transaksi', 'transaksi.idTransaksi = detailtransaksi.idTransaksi');
		$this->db->where(array('transaksi.idTransaksi'=> $idTransaksi));
		$detailTransaksi['query2'] = $this->db->get();

		foreach($transaksi['query']->result() as $row)
		
		
		//Mulai cetak
		$this->load->library('escpos');

		$connector = new Escpos\PrintConnectors\WindowsPrintConnector("EPSON TM-U220 Receipt");

		$printer = new Escpos\Printer($connector);

		function buatBaris3Kolom($kolom1, $kolom2, $kolom3) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 1;
            $lebar_kolom_3 = 22;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ");
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

		function buatBaris3Kolom2($kolom1, $kolom2, $kolom3) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 13;
            $lebar_kolom_2 = 12;
            $lebar_kolom_3 = 13;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ", STR_PAD_BOTH);
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_BOTH);
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_BOTH);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

		function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 3;
            $lebar_kolom_3 = 14;
            $lebar_kolom_4 = 8;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
 
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
		}
		
		function buatBaris4Kolom2($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 6;
            $lebar_kolom_3 = 10;
            $lebar_kolom_4 = 9;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_BOTH);
 
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }
 
        // Membuat judul
        $printer->initialize();
		$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
		$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_WIDTH);
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		$printer->text("LAUNDRY\n");
		$printer->text("BERLIAN\n");
		$printer->initialize();
		$printer->text("****************************************\n");
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		$printer->text("Profesional Laundry On Kilo's\n");
		$printer->text("****************************************\n");
		$printer->initialize();
		$printer->text(buatBaris3Kolom("Alamat", ":", "Jl. Sumber Karya 17A Madiun"));
		$printer->text(buatBaris3Kolom("No. Telp", ":", "082 245 780 844"));
        $printer->text("\n\n");
 
		$jam = time() + (60 * 60 * 7);
        $jam2 = gmdate('H:i:s', $jam);
		$no = sprintf('%04d', $idTransaksi);
        // Data transaksi
		$printer->initialize();
		$printer->text("========================================\n");
		$printer->text(buatBaris3Kolom("No. Nota", ":", $no));
		$printer->text(buatBaris3Kolom("Tgl. Masuk", ":", date('d-m-Y', strtotime($row->tanggalMasuk))." ".$jam2));
		$printer->text(buatBaris3Kolom("Tgl. Selesai", ":", date('d-m-Y', strtotime($row->tanggalSelesai))." "));
		$printer->text("========================================\n");
		$printer->text(buatBaris3Kolom("Nama", ":", $row->namaPelanggan));
		$printer->text(buatBaris3Kolom("Alamat", ":", $row->alamatPelanggan));
		$printer->text(buatBaris3Kolom("Telp./Hp", ":", $row->noHpPelanggan));
		$printer->text("========================================\n");
		$printer->text("\n\n");
 
        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom2("Layanan", "Kg/Pot", "Harga", "Subtotal"));
		$printer->text("----------------------------------------\n");

		$sum = 0;
		foreach($detailTransaksi['query2']->result() as $row2){
		$sum += str_replace(",", "", $row2->subTotal);
		$printer->text(buatBaris4Kolom2($row2->namaLayanan, $row2->jumlah, number_format($row2->biaya, 0, ',', '.'), number_format($row2->subTotal, 0, ',', '.')));
		}
		$printer->text("----------------------------------------\n");

		$total = number_format($sum, 0, ',', '.');
		$bayarAwal = $this->input->post('bayarAwal');
		$kembalian = $bayarAwal - $sum;
        $printer->text(buatBaris4Kolom2('', '', "Total", $total));
            $printer->text(buatBaris4Kolom2('', '', "Bayar", number_format($bayarAwal, 0, ',', '.')));
            $printer->text("----------------------------------------\n");
            $printer->text(buatBaris4Kolom2('', '', "Kembalian", number_format($kembalian, 0, ',', '.')));
            $printer->text("\n");
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->setJustification(Escpos\Printer::JUSTIFY_RIGHT);
            $printer->text("LUNAS\n\n");

 
         // Pesan penutup
		 $printer->initialize();
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("| Penerima  |", "|   Cuci   |", "|   Jemur   |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text("========================================\n");
		 $printer->text(buatBaris3Kolom2("|  Ngentas  |", "| Setrika  |", "|  Packing  |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text("\n");
 
        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
        //Selesai cetak

	}

	function cetak($idTransaksi){
		$this->db->select('*');
		$this->db->where('idTransaksi =', $idTransaksi);
		$this->db->order_by('idTransaksi','desc');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.idPelanggan = transaksi.idPelanggan');
		$this->db->join('pegawai', 'pegawai.idPegawai = transaksi.idPegawai');
		$transaksi['query'] = $this->db->get();

		$this->db->select('*');
		$this->db->where('transaksi.idTransaksi =', $idTransaksi);
        $this->db->from('detailtransaksi');
		$this->db->join('layanan', 'layanan.idLayanan = detailtransaksi.idLayanan');
		$this->db->join('transaksi', 'transaksi.idTransaksi = detailtransaksi.idTransaksi');
		$this->db->where(array('transaksi.idTransaksi'=> $idTransaksi));
		$detailTransaksi['query2'] = $this->db->get();

		foreach($transaksi['query']->result() as $row)
		
		
		//Mulai cetak
		$this->load->library('escpos');

		$connector = new Escpos\PrintConnectors\WindowsPrintConnector("EPSON TM-U220 Receipt");

		$printer = new Escpos\Printer($connector);

		function buatBaris3Kolom($kolom1, $kolom2, $kolom3) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 1;
            $lebar_kolom_3 = 22;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ");
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

		function buatBaris3Kolom2($kolom1, $kolom2, $kolom3) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 13;
            $lebar_kolom_2 = 12;
            $lebar_kolom_3 = 13;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ", STR_PAD_BOTH);
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_BOTH);
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_BOTH);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

		function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 3;
            $lebar_kolom_3 = 14;
            $lebar_kolom_4 = 8;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
 
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
		}
		
		function buatBaris4Kolom2($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 6;
            $lebar_kolom_3 = 10;
            $lebar_kolom_4 = 9;
 
            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
 
            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);
 
            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
 
            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();
 
            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
 
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_BOTH);
 
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
 
                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }
 
            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }
 
        // Membuat judul
        $printer->initialize();
		$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
		$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_WIDTH);
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		$printer->text("LAUNDRY\n");
		$printer->text("BERLIAN\n");
		$printer->initialize();
		$printer->text("****************************************\n");
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		$printer->text("Profesional Laundry On Kilo's\n");
		$printer->text("****************************************\n");
		$printer->initialize();
		$printer->text(buatBaris3Kolom("Alamat", ":", "Jl. Sumber Karya 17A Madiun"));
		$printer->text(buatBaris3Kolom("No. Telp", ":", "082 245 780 844"));
        $printer->text("\n\n");
 
		$jam = time() + (60 * 60 * 7);
        $jam2 = gmdate('H:i:s', $jam);
		$no = sprintf('%04d', $idTransaksi);
        // Data transaksi
		$printer->initialize();
		$printer->text("========================================\n");
		$printer->text(buatBaris3Kolom("No. Nota", ":", $no));
		$printer->text(buatBaris3Kolom("Tgl. Masuk", ":", date('d-m-Y', strtotime($row->tanggalMasuk))." ".$jam2));
		$printer->text(buatBaris3Kolom("Tgl. Selesai", ":", date('d-m-Y', strtotime($row->tanggalSelesai))." "));
		$printer->text("========================================\n");
		$printer->text(buatBaris3Kolom("Nama", ":", $row->namaPelanggan));
		$printer->text(buatBaris3Kolom("Alamat", ":", $row->alamatPelanggan));
		$printer->text(buatBaris3Kolom("Telp./Hp", ":", $row->noHpPelanggan));
		$printer->text("========================================\n");
		$printer->text("\n\n");
 
        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom2("Layanan", "Kg/Pot", "Harga", "Subtotal"));
		$printer->text("----------------------------------------\n");

		$sum = 0;
		foreach($detailTransaksi['query2']->result() as $row2){
		$sum += str_replace(",", "", $row2->subTotal);
		$printer->text(buatBaris4Kolom2($row2->namaLayanan, $row2->jumlah, number_format($row2->biaya, 0, ',', '.'), number_format($row2->subTotal, 0, ',', '.')));
		}
		$printer->text("----------------------------------------\n");

		$total = number_format($sum, 0, ',', '.');
        $printer->text(buatBaris4Kolom2('', '', "Total", $total));
            $printer->text(buatBaris4Kolom2('', '', "Bayar", 0));
            $printer->text("----------------------------------------\n");
            $printer->text(buatBaris4Kolom2('', '', "Kembalian", 0));
            $printer->text("\n");
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->setJustification(Escpos\Printer::JUSTIFY_RIGHT);
            $printer->text("BELUM LUNAS\n\n");

 
         // Pesan penutup
		 $printer->initialize();
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("| Penerima  |", "|   Cuci   |", "|   Jemur   |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text("========================================\n");
		 $printer->text(buatBaris3Kolom2("|  Ngentas  |", "| Setrika  |", "|  Packing  |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text(buatBaris3Kolom2("|           |", "|          |", "|           |"));
		 $printer->text("----------------------------------------\n");
		 $printer->text("\n");
 
        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
        //Selesai cetak
		redirect('../superadmin/Transaksicontroller');
	}
	
	function jumlah(){
		$tanggalAwal = date('Y-m-01 00:00:00');
		$tanggalAkhir = date('Y-m-31 00:00:00');
		$this->db->select_sum('bayarAwal');
		$this->db->where('tanggalSelesai >=', $tanggalAwal);
		$this->db->where('tanggalSelesai <=', $tanggalAkhir);
		$query=$this->db->get('transaksi')->row();
		return $query->bayarAwal;	
	}

	function jumlah2(){
		$tanggalAwal = date('Y-m-d 00:00:00');
		$tanggalAkhir = date('Y-m-d 00:00:00');
		$this->db->select('COUNT(idTransaksi) as total');
		$this->db->where('tanggalMasuk >=', $tanggalAwal);
		$this->db->where('tanggalMasuk <=', $tanggalAkhir);
		$query=$this->db->get('transaksi');
		return $query;	
	}

	function ubah_ket($idTransaksi) {
		$data = array(
			'keterangan' => $this->input->post('keterangan')
			);
        $this->db->where(array('idTransaksi' => $idTransaksi));
        $this->db->update('transaksi', $data);
		redirect('../superadmin/transaksicontroller');
	}
}