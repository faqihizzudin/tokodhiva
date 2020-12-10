

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Laporan</b></h4>
            <br>
            <form action="<?php echo base_url('superadmin/LaporanController/Laporan');?>" target="_blank" method="post" class="form-horizontal" role="form">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date Range</label>
                        <div class="col-sm-8">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" id="start" name="start" />
                                <span class="input-group-addon bg-custom b-0 text-white">to</span>
                                <input type="text" class="form-control" id="end" name="end" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Pegawai</label>
                        <div class="col-md-4">
                            <select class="form-control" id="namaPegawai" name="namaPegawai">
                                <option value=""></option>
                                <?php 
                                    $query = $this->m_Pegawai->tampil_data();
                                    foreach ($query->result() as $row) {
                                        echo "<option value='".$row->namaPegawai."'>".$row->namaPegawai."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="float-right" style="margin: 10px 10px 10px 230px;">
                        <button type="submit" class="btn btn-success btn-sm">Tampilkan Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end row -->