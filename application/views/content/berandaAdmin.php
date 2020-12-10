<!-- Page-Title -->
<div class="col-sm-12" style="text-align: center; padding-top: 70px;">
    <h1 style="font-size: 50px;"><b>Selamat Datang di Toko Pakan Ternak Dhiva</b></h1>
</div>

<div class="row" style="padding-top: 200px;">
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md md-attach-money text-info"></i>
            </div>
            <div class="text-right">
            <?php
            foreach($transaksi->result_array() as $row){
                $total = $row['total'];
            }
                echo "<h3 class='text-dark'><b class='counter'>".$total."</b></h3>
                <p class='text-muted'>Transaksi hari ini</p>";
            ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-success pull-left">
                <i class="fa fa-user text-success"></i>
            </div>
            <div class="text-right">
            <?php
                echo "<h3 class='text-dark'><b class='counter'>".$pegawai."</b></h3>";
            ?>
                <p class="text-muted">Pegawai</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated"> 
            <div class="bg-icon bg-icon-purple pull-left">
                <i class="fa fa-users text-purple"></i>
            </div>
            <div class="text-right">
            <?php
                echo "<h3 class='text-dark'><b class='counter'>".$pelanggan."</b></h3>";
            ?>
                <p class="text-muted">Pelanggan</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md md-shopping-cart text-pink"></i>
            </div>
            <div class="text-right">
            <?php
                echo "<h3 class='text-dark'><b class='counter'>".$layanan."</b></h3>";
            ?>
                <p class="text-muted">Layanan</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->