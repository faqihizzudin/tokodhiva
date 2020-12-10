<!-- CHECKBOX -->

<div class="row">
    <div class="col-md-12">
        <div class="">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Pembayaran</b></h4><br>

                            <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Jumlah</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Harga</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="harga" name="harga" required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Total</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="total" name="total" required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Uang Muka</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="uangMuka" name="uangMuka" required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Sisa</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="sisa" name="sisa" required><br>
                                </div>
                            </div>
                        </div>
                    </div>  
                <div class="v">
                    <button type="button" class="btn btn-default btn-rounded waves-effect waves-light" onclick="window.location.href = '<?php echo base_url('proses'); ?>' ">Cetak</button>
                </div>
            </div>
        </div>
    </div>

</div> <!-- end row -->


<style>
    .v {
        position: absolute;
        left: 250px;
        bottom: 70px;
    }

    .v1 {
        border: 1px solid;
        padding: 10px;
    }
</style>