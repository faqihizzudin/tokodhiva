<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title m-b-30"><b>Data Transaksi</b></h4>

            <div style="width:100%; text-align:right; margin-bottom:10px;">
                <a href="#" class="on-default edit-row btn btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i></a>

            </div>
            

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                   
                    <th>Layanan Antar</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                    $no = 1;
                    foreach($query->result() as $row){
                        echo "<tr>
                            <td>".$no."</td>
                            <td>".$row->namaPelanggan."</td>
                            <td>".$row->alamatPelanggan."</td>
                            <td>".date('d-m-Y', strtotime($row->tanggalMasuk))."</td>
                            <td>".date('d-m-Y', strtotime($row->tanggalSelesai))."</td>";
                ?>
                            <td align="center">
                                <?php if($row->layananAntar=="ambil"){
                                    echo "<a href='#' class='on-default delete-row btn btn-default'>Ambil</a>"; 
                                }else{
                                    echo "<a href='#' class='on-default delete-row btn btn-warning'>Antar</a>";
                                }?>
                            </td>
                <?php
                        echo "<td>".$row->bayarAwal."</td>";
                ?>
                            <td align="center">
                                <?php if($row->keterangan=="belum"){
                                    echo "<a href='#' class='on-default delete-row btn btn-danger'>Belum</a>"; 
                                }else if($row->keterangan=="sudah diantar"){
                                    echo "<a href='#' class='on-default delete-row btn btn-success'>Sudah diantar</a>";
                                }else if($row->keterangan=="sudah diambil"){
                                    echo "<a href='#' class='on-default delete-row btn btn-purple'>Sudah diambil</a>";
                                }else{
                                    echo " ";
                                }?>
                            </td>
                <?php
                        echo "<td>";

                            if($row->keterangan=='belum'){
                                echo "<a href='#' class='on-default edit-row btn btn-primary' data-toggle='modal' data-target='#edit-modal' onclick=\"SetInput('".$row->idTransaksi."', '".$row->keterangan."')\"><i class='fa fa-pencil'></i></a>";
                            }else{
                                echo " ";
                            }

                        echo "<a href='".base_url('superadmin/DetailTransaksiController?id='.$row->idTransaksi)."' class='on-default edit-row btn btn-info' ><i class='fa fa-search'></i></a>";

                                if($row->bayarAwal==0){
                                    echo "<a href ='#' class ='on-default remove-row btn btn-danger' data-toggle='modal' data-target='#delete-modal'onClick=\"SetInputs( '".$row->idTransaksi."')\"><i class ='fa fa-trash'></i></a>";
                                }
                                else if($row->bayarAwal>0){
                                    echo " ";
                                }
                                echo "</td>
                            </tr>";
                        $no++;
                    } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Data Transaksi</h4>
            </div>
        <form action="<?php echo base_url('superadmin/TransaksiController/add');?>" method="post" class="form-horizontal" role="form">
            <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idTransaksi" name="idTransaksi">
                        <input type="hidden" id="bayarAwal" name="bayarAwal" value="0">
                        <input type="hidden" id="bayarAkhir" name="bayarAkhir" value="0">
                        <label class="col-md-3 control-label">Nama Pelanggan</label>
                        <div class="col-md-4">
                            <select class="form-control" data-live-search="true" data-style="btn-white" id="idPelanggan" name="idPelanggan" required>
                                <?php 
                                    $query = $this->m_Pelanggan->tampil_data();
                                    foreach ($query->result() as $row) {
                                        echo "<option value='".$row->idPelanggan."'>".$row->namaPelanggan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Masuk</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yy" id="tanggalMasuk" name="tanggalMasuk" required>
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>                               

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Selesai</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')); ?>" placeholder="mm/dd/yy" id="tanggalSelesai" name="tanggalSelesai" required>
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="col-md-3 control-label">Layanan Antar</label>
                        <div class="col-md-4">
                            <select class="form-control" id="layananAntar" name="layananAntar" data-style="btn-white">
                                <option value="antar">Antar</option>
                                <option value="ambil">Ambil</option>
                            </select>
                        </div>
                    </div>  
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Data Layanan</h4>
            </div>
        <form action="<?php echo base_url('superadmin/TransaksiController/updateKet');?>" method="post" class="form-horizontal" role="form">
            <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idTransaksi3" name="idTransaksi3">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-4">
                            <select class="form-control" data-live-search="true" data-style="btn-white" id="keterangan" name="keterangan" required>
                                <option value="belum">Belum</option>
                                <option value="sudah diantar">Sudah diantar</option>
                                <option value="sudah diambil">Sudah diambil</option>
                            </select>
                        </div>
                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Konfirmasi Hapus</h4>
            </div>
            <form action="<?php echo base_url(). 'superadmin/transaksicontroller/delete'; ?>" method="post" class="form-horizontal" role="form">
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus?</p>
                    <div>
                        <input type="hidden" id="idTransaksi2" name="idTransaksi2">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Ya</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->            
     



<script type="text/javascript">
    function SetInput(idTransaksi, keterangan){
        document.getElementById('idTransaksi3').value = idTransaksi;
        document.getElementById('keterangan').value = keterangan;
    }

    function SetInputs(idTransaksi){
        document.getElementById('idTransaksi2').value = idTransaksi;
    }

    function ResetInput(idTransaksi, namaPelanggan, tanggalMasuk, tanggalSelesai){
        document.getElementById('idTransaksi').value = "";
        document.getElementById('namaPelanggan').value = "";
        document.getElementById('tanggalMasuk').value = "";
        document.getElementById('tanggalSelesai').value = "";
    }
</script>