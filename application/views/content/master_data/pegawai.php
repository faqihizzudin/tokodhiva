

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data Pegawai</b></h4>
            <div style="width: 100%; text-align: right; margin-bottom: 10px;">
                <a href="#" class="on-default edit-row btn btn-success" data-toggle="modal" data-target="#add-modal" onclick="ResetInput()"><i class="fa fa-plus"></i></a>
                <a href="<?php echo base_url('superadmin/pegawaicontroller/cetak'); ?>" class="on-default edit-row btn btn-success"><i class="fa fa-pencil"></i></a>
            </div>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                foreach($query->result() as $peg){ 
                echo "<tr>
                        <td>" .$no. "</td>
                        <td>" .$peg->namaPegawai. "</td>
                        <td>" .$peg->alamatPegawai. "</td>
                        <td>" .$peg->noHpPegawai. "</td>
                        <td><a href='#' class='on-default edit-row btn btn-primary' data-toggle='modal' data-target='#add-modal' onclick=\"SetInput('".$peg->idPegawai."', '".$peg->namaPegawai."', '".$peg->alamatPegawai."', '".$peg->noHpPegawai."')\"><i class='fa fa-pencil'></i></a>
                            <a href='#' class='on-default delete-row btn btn-danger' data-toggle='modal' data-target='#hapus-modal' onclick=\"SetInputs('".$peg->idPegawai."')\"><i class='fa fa-trash'></i></a>
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
                <h4 class="modal-title" id="custom-width-modalLabel">Data Pegawai</h4>
            </div>
            <form action="<?php echo base_url('superadmin/pegawaicontroller/add'); ?>" method="post" class="form-horizontal" role="form"> 
                <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idPegawai" name="idPegawai">
                        <label class="col-md-3 control-label">Nama Pegawai</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" required>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="alamatPegawai" name="alamatPegawai" required>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">No HP</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="noHpPegawai" name="noHpPegawai" required>
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
            <form action="<?php echo base_url('superadmin/pegawaicontroller/delete'); ?>" method="post" class="form-horizontal" role="form">
                <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus ?<p>
                    <div class="form-group">
                        <input type="hidden" id="idPegawai2" name="idPegawai2">
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
    function SetInput(idPegawai, namaPegawai, alamatPegawai, noHpPegawai) {
        document.getElementById('idPegawai').value = idPegawai;
        document.getElementById('namaPegawai').value = namaPegawai;
        document.getElementById('alamatPegawai').value = alamatPegawai;
        document.getElementById('noHpPegawai').value = noHpPegawai;
    }

    function SetInputs(idPegawai) {
        document.getElementById('idPegawai2').value = idPegawai;
    }

    function ResetInput(idPegawai, namaPegawai, alamatPegawai, noHpPegawai) {
        document.getElementById('idPegawai').value = "";
        document.getElementById('namaPegawai').value = "";
        document.getElementById('alamatPegawai').value = "";
        document.getElementById('noHpPegawai').value = "";
    }
</script>