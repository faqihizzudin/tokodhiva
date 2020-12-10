

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data Pelanggan</b></h4>
            <div style="width: 100%; text-align: right; margin-bottom: 10px;">
                <a href="#" class="on-default edit-row btn btn-success" data-toggle="modal" data-target="#add-modal" onclick="ResetInput()"><i class="fa fa-plus"></i></a>
            </div>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                foreach($query->result() as $pel){ 
                echo "<tr>
                        <td>" .$no. "</td>
                        <td>" .$pel->namaPelanggan. "</td>
                        <td>" .$pel->alamatPelanggan. "</td>
                        <td>" .$pel->noHpPelanggan. "</td>
                        <td><a href='#' class='on-default edit-row btn btn-primary' data-toggle='modal' data-target='#add-modal' onclick=\"SetInput('".$pel->idPelanggan."', '".$pel->namaPelanggan."', '".$pel->alamatPelanggan."', '".$pel->noHpPelanggan."')\"><i class='fa fa-pencil'></i></a>
                            <a href='#' class='on-default delete-row btn btn-danger' data-toggle='modal' data-target='#hapus-modal' onclick=\"SetInputs('".$pel->idPelanggan."', '".$pel->namaPelanggan."', '".$pel->alamatPelanggan."', '".$pel->noHpPelanggan."')\"><i class='fa fa-trash'></i></a>
                        </td>
                    </tr>";
                    $no++;
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Data Pelanggan</h4>
            </div>
            <form action="<?php echo base_url('superadmin/pelanggancontroller/add'); ?>" method="post" class="form-horizontal" role="form"> 
                <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idPelanggan" name="idPelanggan">
                        <label class="col-md-3 control-label">Nama Pelanggan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" required>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="alamatPelanggan" name="alamatPelanggan" required>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">No HP</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="noHpPelanggan" name="noHpPelanggan" required>
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

<div id="hapus-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Konfirmasi Hapus</h4>
            </div>
            <form action="<?php echo base_url('superadmin/pelanggancontroller/delete'); ?>" method="post" class="form-horizontal" role="form">
                <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus ?<p>
                    <div class="form-group">
                        <input type="hidden" id="idPelanggan2" name="idPelanggan2">
                    </div>     
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Iya</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function SetInput(idPelanggan, namaPelanggan, alamatPelanggan, noHpPelanggan) {
        document.getElementById('idPelanggan').value = idPelanggan;
        document.getElementById('namaPelanggan').value = namaPelanggan;
        document.getElementById('alamatPelanggan').value = alamatPelanggan;
        document.getElementById('noHpPelanggan').value = noHpPelanggan;
    }

    function SetInputs(idPelanggan, namaPelanggan, alamatPelanggan, noHpPelanggan) {
        document.getElementById('idPelanggan2').value = idPelanggan;
        document.getElementById('namaPelanggan2').value = namaPelanggan;
        document.getElementById('alamatPelanggan2').value = alamatPelanggan;
        document.getElementById('noHpPelanggan2').value = noHpPelanggan;
    }

    function ResetInput(idPelanggan, namaPelanggan, alamatPelanggan, noHpPelanggan) {
        document.getElementById('idPelanggan').value = "";
        document.getElementById('namaPelanggan').value = "";
        document.getElementById('alamatPelanggan').value = "";
        document.getElementById('noHpPelanggan').value = "";
    }
</script>