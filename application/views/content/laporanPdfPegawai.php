<pre>
    <table width="100%">
    <tr align="center">
        <td align="center">
            <p style="font-size:150%;"><b>
            Laporan Keuangan<br>
            Toko Pakan Ternak Dhiva<br>
            </b></p>
        </td>
    </tr>
    <tr align="center">
        <td align="center"><br>
        <?php
            $row = $query->row();
            if(isset($row)){
            echo $row->namaPegawai."<br>";
            $tanggalAwal = date('d-m-Y', strtotime($_POST['start']));
            $tanggalAkhir = date('d-m-Y', strtotime($_POST['end']));
            echo "Periode ".$tanggalAwal." sampai ".$tanggalAkhir."</br>";
            }
        ?>
        </td>
    </tr>
    </table>
    <table style="width=100%;" border="1" align="center">
        <tr align="center">
            <td> No </td>
            <td> No Nota </td>
            <td> Nama Pelanggan </td>
            <td> Tanggal Selesai </td>
            <td> Total </td>
        </tr>
        <?php 
            $no = 1;
            foreach($query->result() as $row){
                echo "<tr>
                    <td>".$no."</td>
                    <td>".$row->idTransaksi."</td>
                    <td>".$row->namaPelanggan."</td>
                    <td>".date('d-m-Y', strtotime($row->tanggalSelesai))."</td>
                    <td>Rp ".$row->bayarAwal."</td>
                </tr>";
                $no++;
            } 
        ?>
        <tr>
            <th colspan="4"  style="text-align: right;">Jumlah</th>
            <?php
                $sum = 0;
                foreach($query->result_array() as $row){
                    $sum += str_replace(",", "", $row['bayarAwal']);
                }
                $total = number_format($sum, 0, ',', '.');
                echo "<th>Rp ".$total."</th>";
            ?>
        </tr>
    </table>

</pre>