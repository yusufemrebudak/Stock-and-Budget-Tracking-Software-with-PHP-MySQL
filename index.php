
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php  
    $date = date('Y-m-d');
    $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
    ?>
    <section class="content-header">
        <h1>
            Günlük Akü Satışları
            <small><?php echo $prev_date ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12">
                <?php 
                
                $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(satis_aku_adet) as toplam
                    from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
                $satis_sorgu->execute(array(
                    "sube"=>"Otosansit",
                    "tarihi"=>$prev_date
                ));
                $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">OTOSANSİT</span>
                        <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam'] ?></span>

                    </div>
                </div>
            </div>
            


            <div class="col-md-2 col-sm-6 col-xs-12">
               <?php 
               $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(satis_aku_adet) as toplam
                from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
               $satis_sorgu->execute(array(
                "sube"=>"Duaçınar",
                "tarihi"=>$prev_date
            ));
               $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
               ?>
               <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">DUAÇINARI</span>
                    <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>




        <div class="col-md-2 col-sm-6 col-xs-12">
           <?php 
           $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(satis_aku_adet) as toplam
            from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
           $satis_sorgu->execute(array(
            "sube"=>"Yalova",
            "tarihi"=>$prev_date
        ));
           $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
           ?>
           <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">YALOVA</span>
                <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam']?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-2 col-sm-6 col-xs-12">
       <?php 
       $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(satis_aku_adet) as toplam
        from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
       $satis_sorgu->execute(array(
        "sube"=>"Beşyol",
        "tarihi"=>$prev_date
    ));
       $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
       ?>
       <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">BEŞYOL</span>
            <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam']?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>

<div class="col-md-2 col-sm-6 col-xs-12">
   <?php 
   $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(satis_aku_adet) as toplam
    from urun_satis WHERE satis_aku_tarih=:tarihi group by satis_aku_tarih");
   $satis_sorgu->execute(array(
    "tarihi"=>$prev_date
));
   $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
   ?>
   <div class="info-box">
    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">TOPLAM</span>
        <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam']?></span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-md-2 col-sm-6 col-xs-12">
   <?php 
   $satis_sorgu=$db->prepare("SELECT stok_aku_date,COUNT(*) as toplam
    from stok_hareketleri WHERE stok_aku_date=:tarihi group by stok_aku_date");
   $satis_sorgu->execute(array(
    "tarihi"=>$prev_date
));
   $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
   ?>
   <div class="info-box">
    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">STOK HAREKETİ</span>
        <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam']?></span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->











<?php// SELECT * FROM veriler WHERE eklenme_tarihi BETWEEN '01.01.2018 00:00' and '01.05.2018 23:59'?>



<section class="content-header">
    <h1>
     Günlük Kasa Verileri 
     <small><?php echo $prev_date ?></small>
 </h1>
 <ol class="breadcrumb">

 </ol>
</section>
<br>

<div class="col-md-3 col-sm-6 col-xs-12">
    <?php 
    
    $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(urun_odeme_miktar) as toplam
        from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
    $satis_sorgu->execute(array(
        "sube"=>"Otosansit",
        "tarihi"=>$prev_date
    ));
    $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">OTOSANSİT</span>
            <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam'] ?> TL</span>

        </div>
    </div>
</div>



<div class="col-md-3 col-sm-6 col-xs-12">
    <?php 
    
    $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(urun_odeme_miktar) as toplam
        from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
    $satis_sorgu->execute(array(
        "sube"=>"Duaçınar",
        "tarihi"=>$prev_date
    ));
    $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Duaçınar</span>
            <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam'] ?> TL</span>

        </div>
    </div>
</div>



<div class="col-md-3 col-sm-6 col-xs-12">
    <?php 
    
    $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(urun_odeme_miktar) as toplam
        from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
    $satis_sorgu->execute(array(
        "sube"=>"Yalova",
        "tarihi"=>$prev_date
    ));
    $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Yalova</span>
            <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam'] ?> TL</span>

        </div>
    </div>
</div>

<!-- /.col -->

<div class="col-md-3 col-sm-6 col-xs-12">
    <?php 
    
    $satis_sorgu=$db->prepare("SELECT satis_aku_tarih,satis_aku_sube,SUM(urun_odeme_miktar) as toplam
        from urun_satis WHERE satis_aku_sube=:sube and satis_aku_tarih=:tarihi group by satis_aku_tarih");
    $satis_sorgu->execute(array(
        "sube"=>"Beşyol",
        "tarihi"=>$prev_date
    ));
    $satis_sorgu_cek=$satis_sorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Beşyol</span>
            <span class="info-box-number"><?php echo $satis_sorgu_cek['toplam'] ?> TL</span>

        </div>
    </div>
</div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="box">


        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-8">


        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">En Son Stok Hareketleri</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Ürün Adı</th>
                                <th>Amper</th>
                                <th>Ürün Tip</th>
                                <th>Adet</th>
                                <th>Nereden</th>
                                <th>Nereye</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            $sorgu=$db->prepare("SELECT * FROM stok_hareketleri  ORDER BY stok_id DESC LIMIT 10 ");
                            $sorgu->execute();

                            while($stok_sorgu_cek=$sorgu->fetch(PDO::FETCH_ASSOC)){ ?>
                                <tr>
                                    <td><?php echo $stok_sorgu_cek['stok_aku_date'] ?></td>
                                    <td><?php echo $stok_sorgu_cek['stok_aku_ad'] ?></td>
                                    <td><?php echo $stok_sorgu_cek['stok_aku_amper'] ?></td>
                                    <td><?php echo $stok_sorgu_cek['stok_aku_tip'] ?></td>
                                    <td><?php echo $stok_sorgu_cek['stok_aku_adet'] ?></td>
                                    <td>
                                        <?php 
                                        switch ($stok_sorgu_cek['stok_aku_nereden']) {
                                            case 1:?>
                                            OTOSANSİT
                                            <?php break;
                                            case 2:?>
                                            DUAÇINARI
                                            <?php break;
                                            case 3:?>
                                            YALOVA
                                            <?php break;
                                            case 4:?>
                                            BEŞYOL
                                            <?php break;
                                            
                                            default:
                                                # code...
                                            break;
                                        }?>

                                    </td>

                                    <td>
                                        <?php 
                                        switch ($stok_sorgu_cek['stok_aku_nereye']) {
                                            case 1:?>
                                            OTOSANSİT
                                            <?php break;
                                            case 2:?>
                                            DUAÇINARI
                                            <?php break;
                                            case 3:?>
                                            YALOVA
                                            <?php break;
                                            case 4:?>
                                            BEŞYOL
                                            <?php break;
                                            
                                            default:
                                                # code...
                                            break;
                                        }?>

                                    </td>

                                </tr>
                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="stok-raporlama.php" class="btn btn-sm btn-info btn-flat pull-left">Detaylı Stok Hareketleri Gör</a>
                   
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->


        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>

<?php include 'control-sidebar.php' ?>


<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>

