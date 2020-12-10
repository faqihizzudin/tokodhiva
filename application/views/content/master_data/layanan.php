

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data Layanan</b></h4>
            <div style="width: 100%; text-align: right; margin-bottom: 10px;">
                <a href="#" class="on-default edit-row btn btn-success" data-toggle="modal" data-target="#add-modal" onclick="ResetInput()"><i class="fa fa-plus"></i></a>
            </div>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Layanan</th>
                    <th>Biaya (Rp.)</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                foreach($query->result() as $lay){ 
                echo "<tr>
                        <td>" .$no. "</td>
                        <td>" .$lay->namaLayanan. "</td>
                        <td>" .number_format($lay->biaya, 0, ',', '.'). "</td>
                        <td>" .$lay->keterangan. "</td>
                        <td><a href='#' class='on-default edit-row btn btn-primary' data-toggle='modal' data-target='#add-modal' onclick=\"SetInput('".$lay->idLayanan."', '".$lay->namaLayanan."', '".$lay->biaya."', '".$lay->keterangan."')\"><i class='fa fa-pencil'></i></a>
                            <a href='#' class='on-default delete-row btn btn-danger' data-toggle='modal' data-target='#hapus-modal' onclick=\"SetInputs('".$lay->idLayanan."', '".$lay->namaLayanan."', '".$lay->biaya."', '".$lay->keterangan."')\"><i class='fa fa-trash'></i></a>
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
                <h4 class="modal-title" id="custom-width-modalLabel">Data Layanan</h4>
            </div>
            <form action="<?php echo base_url('superadmin/Layanancontroller/add'); ?>" method="post" class="form-horizontal" role="form"> 
                <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idLayanan" name="idLayanan">
                        <label class="col-md-3 control-label">Nama Layanan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namaLayanan" name="namaLayanan" required>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Biaya</label>
                        <div class="col-md-3">
                            <input type="number" min="0" class="form-control" style="text-align: right;" id="biaya" name="biaya" required>
                        </div>
                        <label class="col-md-1 control-label" style="text-align: center;">/</label>
                        <div class="col-md-2">
                        <select class="form-control" id="keterangan" name="keterangan" data-style="btn-white">
                                <option value="Kg">Kg</option>
                                <option value="Biji">Biji</option>
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

<div id="hapus-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Konfirmasi Hapus</h4>
            </div>
            <form action="<?php echo base_url('superadmin/Layanancontroller/delete'); ?>" method="post" class="form-horizontal" role="form">
                <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus ?<p>
                    <div class="form-group">
                        <input type="hidden" id="idLayanan2" name="idLayanan2">
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
    function SetInput(idLayanan, namaLayanan, biaya, keterangan) {
        document.getElementById('idLayanan').value = idLayanan;
        document.getElementById('namaLayanan').value = namaLayanan;
        document.getElementById('biaya').value = biaya;
        document.getElementById('keterangan').value = keterangan;
    }

    function SetInputs(idLayanan, namaLayanan, biaya, keterangan) {
        document.getElementById('idLayanan2').value = idLayanan;
        document.getElementById('namaLayanan2').value = namaLayanan;
        document.getElementById('biaya2').value = biaya;
        document.getElementById('keterangan2').value = keterangan;
    }

    function ResetInput(idLayanan, namaLayanan, biaya, keterangan) {
        document.getElementById('idLayanan').value = "";
        document.getElementById('namaLayanan').value = "";
        document.getElementById('biaya').value = "";
        document.getElementById('keterangan').value = "";
    }
</script>