

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data User</b></h4><br>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Nama User</th>
                    <th>Level</th>
                    <th>statusUser</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                foreach($query->result() as $us){
                echo "<tr>
                        <td>" .$no. "</td>
                        <td>" .$us->namaPegawai. "</td>
                        <td>" .$us->namaUser. "</td>"; ?>
                      
                        <td align="center">
                            <?php if($us->level=="superadmin"){
                                echo "<a href='#' class='on-default delete-row btn btn-success'>" .$us->level. "</a>"; 
                            }else if($us->level=="admin"){
                                echo "<a href='#' class='on-default delete-row btn btn-primary'>" .$us->level. "</a>";
                            }else{
                                echo "";
                            }?>
                        </td>

                        <td align="center">
                            <?php if($us->statusUser=="aktif"){
                                echo "<a href='#' class='on-default delete-row btn btn-danger'>" .$us->statusUser. "</a>"; 
                            }else if($us->statusUser=="tidak aktif"){
                                echo "<a href='#' class='on-default delete-row btn btn-inverse'>" .$us->statusUser. "</a>";
                            }else{
                                echo "";
                            }?>
                        </td>
                
                <?php echo "<td><a href='#' class='on-default edit-row btn btn-primary' data-toggle='modal' data-target='#add-modal' onclick=\"SetInput('".$us->idPegawai."', '".$us->namaPegawai."', '".$us->namaUser."', '".$us->passUser."', '".$us->level."', '".$us->statusUser."')\"><i class='fa fa-pencil'></i></a>
                                <a href='#' class='on-default delete-row btn btn-danger' data-toggle='modal' data-target='#hapus-modal' onclick=\"SetInputs('".$us->idPegawai."')\"><i class='fa fa-trash'></i></a>
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
                <h4 class="modal-title" id="custom-width-modalLabel">Data User</h4>
            </div>
            <form action="<?php echo base_url('superadmin/Usercontroller/add'); ?>" method="post" class="form-horizontal" role="form"> 
                <div class="modal-body">                                   
                    <div class="form-group">
                        <input type="hidden" id="idPegawai" name="idPegawai">
                        <label class="col-md-3 control-label">Nama Pegawai</label>
                        <div class="col-md-9">
                            <select class="form-control" id="namaPegawai" name="namaPegawai" required>
                                <?php 
                                    $query = $this->m_user->tampil_data();
                                    foreach ($query->result() as $row) {
                                        echo "<option value='".$row->namaPegawai."'>".$row->namaPegawai."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama User</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namaUser" name="namaUser" required>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kata Sandi</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="passUser" name="passUser">
                            <p>Kosongkan password jika anda tidak ingin mengubah password.</p>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Level</label>
                        <div class="col-md-3">
                            <select class="form-control" id="level" name="level" data-style="btn-white">
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>                                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-3">
                            <select class="form-control" id="statusUser" name="statusUser" data-style="btn-white">
                                <option value="aktif">Aktif</option>
                                <option value="tidakaktif">Tidak Aktif</option>
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
            <form action="<?php echo base_url('superadmin/Usercontroller/delete'); ?>" method="post" class="form-horizontal" role="form">
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
    function SetInput(idPegawai, namaPegawai, namaUser, passUser, level, statusUser) {
        document.getElementById('idPegawai').value = idPegawai;
        document.getElementById('namaPegawai').value = namaPegawai;
        document.getElementById('namaUser').value = namaUser;
        document.getElementById('passUser').value = "";
        document.getElementById('level').value = level;
        document.getElementById('statusUser').value = statusUser;
    }

    function SetInputs(idPegawai) {
        document.getElementById('idPegawai2').value = idPegawai;
    }

    function ResetInput(idPegawai, namaPegawai, namaUser, passUser, level, statusUser) {
        document.getElementById('idPegawai').value = "";
        document.getElementById('namaPegawai').value = "";
        document.getElementById('namaUser').value = "";
        document.getElementById('passUser').value = "";
        document.getElementById('level').value = "";
        document.getElementById('statusUser').value = "";
    }
</script>