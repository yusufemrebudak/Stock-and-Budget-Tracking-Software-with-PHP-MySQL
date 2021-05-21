<?php include 'header.php' ?>
<?php include 'sidebar.php' ;


?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<form action="" method="GET">
				<div class="form-group">
					<div class="col-md-2">
						<label>Başlangıç Tarihi</label>
						<input type="date" name="first_date" class="form-control">
					</div>
					<div class="col-md-2">
						<label>Bitiş Tarihi</label>
						<input type="date" name="end_date" class="form-control">
					</div>

					<br>
					<div class="col-md-2">
						<select name="satilan_aku_sube" class="form-control">
							<option value="">Tümü</option>
							<option value="Otosansit">Otosansit</option>
							<option value="Duaçınar">Duaçınarı</option>
							<option value="Yalova">Yalova</option>
							<option value="Beşyol">Beşyol</option>
						</select>
					</div>
					<div class="col-md-9">
						<button type="submit" class="btn btn-info">Sorgula</button>
					</div>
				</div>
			</form>

			<?php  
			
			if(isset($_GET['first_date']) and isset($_GET['end_date']) and $_GET['satilan_aku_sube']!="" ){

				$first_date = $_GET['first_date'];
				$end_date = $_GET['end_date'];

				$sorgu=$db->prepare("SELECT * FROM urun_satis WHERE satis_aku_tarih BETWEEN ? and ? AND satis_aku_sube =?");
				$sorgu->execute(array($first_date,$end_date,$_GET['satilan_aku_sube']));
				

			}
			else if(isset($_GET['first_date']) and isset($_GET['end_date'])){
				$first_date = $_GET['first_date'];
				$end_date = $_GET['end_date'];

				$sorgu=$db->prepare("SELECT * FROM urun_satis WHERE satis_aku_tarih BETWEEN ? and ? ");
				$sorgu->execute(array($first_date,$end_date));

			}
			?>


			<div class="col-xs-12">
				<br>
				<div class="box">

					<div class="box-header">

						<h3 class="box-title">RAPOR LİSTESİ </h3>
						<br>
						<?php  
						if(isset($_GET['first_date']) and isset($_GET['end_date']) ){?>
							<h3 class="box-title"><?php echo $_GET['first_date'] ?> ve <?php echo $_GET['end_date'] ?> ARASI SATILAN AKÜLER</h3>
						<?php  }?>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Tarih</th>
									<th>Sube</th>
									<th>Ürün Adı</th>
									<th>Amper</th>
									<th>Ürün Tip</th>
									<th>Satılan Adet</th>
									<th>Maliyet</th>
									<th>Ödeme Tipi</th>
									<th>Miktar</th>
									<th>Eski Akü Amper</th>
									<th>Eski Akü Adet</th>

									
								</tr>

							</thead>
							<tbody>
								<?php  
								while($tarih_sorgu_cek=$sorgu->fetch(PDO::FETCH_ASSOC)){ ?>
									<tr>
										<td><?php echo $tarih_sorgu_cek['satis_aku_tarih'] ?></td>
										<td><?php echo $tarih_sorgu_cek['satis_aku_sube'] ?></td>
										<td><?php echo $tarih_sorgu_cek['satis_aku_adi'] ?></td>
										<td><?php echo $tarih_sorgu_cek['satis_aku_amper'] ?></td>
										<td><?php echo $tarih_sorgu_cek['satis_aku_tip'] ?></td>
										<td><?php echo $tarih_sorgu_cek['satis_aku_adet'] ?></td>
										<td><?php echo $tarih_sorgu_cek['urun_maliyet'] ?></td>
										<td><?php echo $tarih_sorgu_cek['urun_odeme_tip'] ?></td>
										<td><?php echo $tarih_sorgu_cek['urun_odeme_miktar'] ?></td>
										<td><?php echo $tarih_sorgu_cek['urun_eski_aku_amper'] ?></td>
										<td><?php echo $tarih_sorgu_cek['urun_eski_aku_adet'] ?></td>
										<?php $satilan_adet+=$tarih_sorgu_cek['satis_aku_adet']; 
										$eski_aku_adet+=$tarih_sorgu_cek['urun_eski_aku_adet'];
										switch ($tarih_sorgu_cek['urun_odeme_tip'] ) {
											case 'Nakit':
											$nakit_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											if($tarih_sorgu_cek['urun_eski_aku_adet']>0){
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar']+(($tarih_sorgu_cek['urun_eski_aku_amper']*1.6)*$tarih_sorgu_cek['urun_eski_aku_adet']) - $tarih_sorgu_cek['urun_maliyet'] ;
											}
											else{
											    $toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - $tarih_sorgu_cek['urun_maliyet'] ;
											}


											break;
											case 'Kart':
											$kredi_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											if($tarih_sorgu_cek['urun_eski_aku_adet']>0){
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar']+(($tarih_sorgu_cek['urun_eski_aku_amper']*1.5)*$tarih_sorgu_cek['urun_eski_aku_adet']) - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }
                                            else{
                                                $toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }

											break;
											case 'MailOrder':
											$mailorder_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											if($tarih_sorgu_cek['urun_eski_aku_adet']>0){
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar']+(($tarih_sorgu_cek['urun_eski_aku_amper']*1.5)*$tarih_sorgu_cek['urun_eski_aku_adet']) - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }
                                            else{
                                                $toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }


											break;	
											case 'Eft':
											$eft_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											if($tarih_sorgu_cek['urun_eski_aku_adet']>0){
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar']+(($tarih_sorgu_cek['urun_eski_aku_amper']*1.5)*$tarih_sorgu_cek['urun_eski_aku_adet']) - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }
                                            else{
                                                $toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }


											break;
											case 'Trendyol':
											$trendyol_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											$trendyol_toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - ($tarih_sorgu_cek['urun_odeme_miktar']*0.12)- $tarih_sorgu_cek['urun_maliyet'] -24;
											$trendyol_toplam_satilan +=$tarih_sorgu_cek['satis_aku_adet'];
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - ($tarih_sorgu_cek['urun_odeme_miktar']*0.12)- $tarih_sorgu_cek['urun_maliyet'] -24;
                                            


											break;
											case 'Veresiye':
											$veresiye_toplam += $tarih_sorgu_cek['urun_odeme_miktar'];
											if($tarih_sorgu_cek['urun_eski_aku_adet']>0){
											$toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar']+(($tarih_sorgu_cek['urun_eski_aku_amper']*1.5)*$tarih_sorgu_cek['urun_eski_aku_adet']) - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }
                                            else{
                                                $toplam_kar += $tarih_sorgu_cek['urun_odeme_miktar'] - $tarih_sorgu_cek['urun_maliyet'] ;
                                            }

											break;
											
											default:
												# code...
											break;
										}
										?>
									</tr>

								<?php  }?>

								<p  style="font-size: 18px">Satılan Akü Adet : <strong><?php echo $satilan_adet ?></strong></p>
								<p  style="font-size: 18px">Toplam Kar : <strong><?php echo $toplam_kar ?> TL</strong></p>

								<p  style="font-size: 18px">Eski Akü Toplam Adet : <strong><?php echo $eski_aku_adet ?> </strong>
								<p  style="font-size: 18px">Nakit Toplam : <strong><?php echo $nakit_toplam ?> TL</strong></p>
								<p  style="font-size: 18px">Kredi-Kart Toplam : <strong><?php echo $kredi_toplam ?> TL</strong></p>
								<p  style="font-size: 18px">Mail-Order Toplam : <strong><?php echo $mailorder_toplam ?> TL</strong></p>
								<p  style="font-size: 18px">Eft Toplam : <strong><?php echo $eft_toplam ?> TL</strong></p>
								<p  style="font-size: 18px">Trendyol Toplam Cüro: <strong><?php echo $trendyol_toplam ?> TL</strong></p>
								<p  style="font-size: 18px">Trendyol Toplam Kar : <strong><?php echo $trendyol_toplam_kar ?> TL</strong></p>
								<p  style="font-size: 18px">Trendyol Toplam Satılan  : <strong><?php echo $trendyol_toplam_satilan ?> TL</strong></p>
								<p  style="font-size: 18px">Veresiye Toplam : <strong><?php echo $veresiye_toplam ?> TL</strong></p>



							</tbody>

						</table>
					</div>
					<!-- /.box-body -->
				</div>
				
				<!-- /.box -->
				<!-- /.row -->
			</section>
		</div>

		<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<!-- SlimScroll -->
		<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="bower_components/fastclick/lib/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="js/demo.js"></script>
		<!-- page script -->
		<script>
			$(function () {
				$('#example1').DataTable()
				$('#example2').DataTable({
					'paging'      : true,
					'lengthChange': false,
					'searching'   : false,
					'ordering'    : true,
					'info'        : true,
					'autoWidth'   : false
				})
			})
		</script>
	</body>
	</html>