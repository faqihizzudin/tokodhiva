<pre>
    <table width="100%">
    <tr align="center">
        <td align="center">
            <p style="font-size:150%;"><b>
            Laporan Keuangan<br>
            Toko Pakan Ternak Dhiva<br>
            <?php
            $tanggalAwal = date('d-m-Y', strtotime($_POST['start']));
            $tanggalAkhir = date('d-m-Y', strtotime($_POST['end']));
            echo "Periode ".$tanggalAwal." sampai ".$tanggalAkhir."</br>";
            ?>
            </b></p><br>
        </td>
    </tr>
    </table>
    <table style="width=100%;" border="1" align="center">
        <tr align="center">
            <th> No </th>
            <th> No Nota </th>
            <th> Nama Pegawai </th>
            <th> Nama Pelanggan </th>
            <th> Tanggal Selesai </th>
            <th> Total </th>
        </tr>
        <?php 
            $no = 1;
            foreach($query->result() as $row){
                echo "<tr>
                    <td>".$no."</td>
                    <td>".$row->idTransaksi."</td>
                    <td>".$row->namaPegawai."</td>
                    <td>".$row->namaPelanggan."</td>
                    <td>".$row->tanggalSelesai."</td>
                    <td>Rp ".$row->bayarAwal."</td>
                </tr>";
                $no++;
            } 
        ?>
        <tr>
            <th colspan="5" style="text-align: right;">Jumlah</th>
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