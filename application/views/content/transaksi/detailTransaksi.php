<!-- Page-Title -->
<?php
$layanan = $this->m_Layanan->tampil_data();
echo "<script> var layanan = ".json_encode($layanan->result()).";</script>";
?>
<script type="text/javascript">
    function SetSubTotal(){
        var subTotal = ( $('#jumlah').val() * $('#biaya').val());
        $('#subTotal').val(subTotal);
    }

    function SetHargaLayanan(){
        var idLayanan = $('#idLayanan').val();
        for (var i = 0; i < layanan.length; i++) {
           if(idLayanan == layanan[i]['idLayanan']){
            $('#biaya').val(layanan[i]['biaya']);
           }
        }
       SetSubTotal();
    }

    function Bayar(){
        var kembalian = ( $('#bayarAwal').val() - $('#total').val());
        $('#kembalian').val(kembalian);
    }
</script>;

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title m-b-30"><b>Data Transaksi</b></h4>
            <div class="row" >
                <form action="<?php echo base_url('superadmin/DetailTransaksiController/add');?>" method="post" class="form-horizontal" role="form">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" id="idDetailTransaksi" name="idDetailTransaksi">
                            <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?php echo $idTransaksi; ?>">
                            <label  class="col-sm-3 control-label">Nama Layanan</label>
                            <div class="col-sm-9">
                                <select class="form-control" onchange="SetHargaLayanan()" id="idLayanan" name="idLayanan" required>
                                <option value=""></option>
                                <?php
                                $layanan = $this->m_Layanan->tampil_data();
                                foreach($layanan->result() as $row) {
                                    echo "<option value='".$row->idLayanan."'>".$row->namaLayanan."</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" step="0.01" class="form-control" onchange ="SetSubTotal()" id="jumlah" name="jumlah" placeholder="Jumlah Barang">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label class="col-sm-3 control-label">Biaya</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  id="biaya" name="biaya" placeholder="" readonly="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-3 control-label">Sub Total</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subTotal" name="subTotal" placeholder="" readonly="">
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                            <?php
                            $transaksi = $this->m_Transaksi->tampil_data();
                            $id = $this->input->get('id');
                            foreach($transaksi->result() as $row){
                                if($row->idTransaksi==$id && $row->bayarAwal==0){
                                    echo "<button type='submit' class='btn btn-info waves-effect waves-light'>Submit</button>";
                                }else if($row->idTransaksi==$id && $row->bayarAwal>0){
                                    echo "";
                                }
                            }?>
                            </div>
                        </div>
                    </div> 
                </form>  
            </div> 
        </div>
    <div class="card-box table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Jumlah</th>
                <th>Biaya</th>
                <th>Sub Total</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach($query->result() as $row) {
                    echo "<tr>
                        <td>".$no."</td>
                        <td>".$row->namaLayanan."</td>
                        <td>".number_format($row->jumlah, 2, ',', '.')."</td>
                        <td>".number_format($row->biaya, 0, ',', '.')."</td>
                        <td>".number_format($row->subTotal, 0, ',', '.')."</td>
                        <td>";
                            if($row->idTransaksi==$id && $row->bayarAwal==0){
                                echo "<a href ='#' class ='on-default remove-row btn btn-danger' data-toggle='modal' data-target='#delete-modal'onClick=\"SetInputs( '".$row->idDetailTransaksi."')\"><i class ='fa fa-trash'></i></a>";
                            }else if($row->idTransaksi==$id && $row->bayarAwal>0){
                                echo "";
                            }
                        echo "</td>
                    </tr>";
                    $no++;
                }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4">Total Biaya</th>
                <?php
                $sum = 0;
                foreach($query->result_array() as $row){
                    $sum += str_replace(",", "", $row['subTotal']);
                }
                $total = number_format($sum, 0, ',', '.');
                echo "<th colspan='2'>".$total."</th>";
                ?>
            </tr>
            </tfoot>
        </table>
        <div class="form-group m-b-0">
            <div style="text-align: right; margin-right: 150px;">
            <?php
                foreach($transaksi->result() as $row){
                    if($row->idTransaksi==$id && $row->bayarAwal==0){
                        echo "<a href='#' class='on-default edit-row btn btn-inverse' data-toggle='modal' data-target='#cetak-modal' onclick='SetInput(".$sum.")'>Selesai</a>";
                    }
                    else if($row->idTransaksi==$id && $row->bayarAwal>0){
                        echo "";
                    }
                }
            ?>
            </div>
        </div>       
    </div>
</div>
<!-- end row -->

<div id="cetak-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Detail Transaksi</h4>
            </div>
        <form action="<?php echo base_url('superadmin/transaksicontroller/updateHarga'); ?>" class="form-horizontal" method="post" role="form"> 
            <div class="modal-body">                             
                <div class="form-group">
                    <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?php echo $idTransaksi; ?>">
                    <label class="col-md-3 control-label">Total Biaya</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="total" name="total" placeholder="" readonly="" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Bayar</label>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="bayarAwal" name="bayarAwal" onchange="Bayar()">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Kembalian</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="kembalian" name="kembalian" readonly="">
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Selesai</button>
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
            <form action="<?php echo base_url(). 'superadmin/detailtransaksicontroller/delete'; ?>" method="post" class="form-horizontal" role="form">
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus?</p>
                    <div>
                        <input type="hidden" id="idDetailTransaksi2" name="idDetailTransaksi2">
                        <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?php echo $idTransaksi; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Ya</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<script type="text/javascript">
    function SetInput(total){
        document.getElementById('total').value = total;
    }

    function SetInputs(idDetailTransaksi){
        document.getElementById('idDetailTransaksi2').value = idDetailTransaksi;
    }
</script>