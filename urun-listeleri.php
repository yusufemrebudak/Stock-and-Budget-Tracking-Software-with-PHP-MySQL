<?php include 'header.php' ?>
<?php include 'sidebar.php' 


?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			
			<form action="" method="GET">
				<div class="form-group">
					
					<br>

					<div class="col-md-2">

						<select name="listele_aku_sube" class="form-control">
							<option value="">Tümü</option>
							<option value="1">Otosansit</option>
							<option value="2">Duaçınarı</option>
							<option value="3">Yalova</option>
							<option value="4">Beşyol</option>
						</select>
					</div>
					
					<div class="col-md-2">
						<select name="listele_aku_amper" class="form-control">
							<option value="">Tümü</option>
							<option value="36">36</option>
							<option value="42">42</option>
							<option value="45">45</option>
							<option value="55">55</option>
							<option value="60">60</option>
							<option value="62">62</option>
							<option value="66">66</option>
							<option value="70">70</option>
							<option value="72">72</option>
							<option value="74">74</option>
							<option value="80">80</option>
							<option value="90">90</option>
							<option value="95">95</option>
							<option value="100">100</option>
							<option value="105">105</option>
							<option value="110">110</option>
							<option value="120">120</option>
							<option value="135">135</option>
							<option value="150">150</option>
							<option value="180">180</option>
							<option value="200">200</option>
							<option value="225">225</option>
							<option value="240">240</option>
						</select>
					</div>

					<div class="col-md-2">
						<select name="listele_aku_marka" class="form-control">
							<option value="">Tümü</option>
							<option value="inci">İnci</option>
							<option value="Mutlu">Mutlu</option>
							<option value="Varta">Varta</option>
							<option value="Çelik">Çelik</option>
							<option value="Hugel">Hugel</option>
							<option value="Mega">Mega</option>
							<option value="Turbo">Turbo</option>

						</select>
					</div>
					

					<div class="col-md-2">
						<button type="submit" class="btn btn-info">Sorgula</button>
					</div>
				</div>
			</form>

			<?php  
			



			if($_GET['listele_aku_sube']!="" and $_GET['listele_aku_amper']!="" and $_GET['listele_aku_marka']!="" ){

				$aku_sube = $_GET['listele_aku_sube'];
				$aku_amper = $_GET['listele_aku_amper'];
				$aku_marka = $_GET['listele_aku_marka'];


				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_sube=:sube and urun_amper=:amper and urun_ad=:marka");
				$sorgu->execute(array(
					"sube"=>$aku_sube,
					"amper"=>$aku_amper,
					"marka"=>$aku_marka
				));
				

			}

			
			else if($_GET['listele_aku_sube']!="" and $_GET['listele_aku_amper']!="" ){

				$aku_sube = $_GET['listele_aku_sube'];
				$aku_amper = $_GET['listele_aku_amper'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_sube=:sube and urun_amper=:amper ");
				$sorgu->execute(array(
					"sube"=>$aku_sube,
					"amper"=>$aku_amper
				));
				

			}
			

			else if($_GET['listele_aku_sube']!="" and $_GET['listele_aku_marka']!="" ){

				$aku_sube = $_GET['listele_aku_sube'];
				$aku_marka = $_GET['listele_aku_marka'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_sube=:sube and urun_ad=:marka");
				$sorgu->execute(array(
					"sube"=>$aku_sube,
					"marka"=>$aku_marka
				));
				

			}

			else if($_GET['listele_aku_marka']!="" and $_GET['listele_aku_amper']!="" ){

				$aku_amper = $_GET['listele_aku_amper'];
				$aku_marka = $_GET['listele_aku_marka'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_amper=:amper and urun_ad=:marka");
				$sorgu->execute(array(
					"marka"=>$aku_marka,
					"amper"=>$aku_amper
				));
				

			}

			else if($_GET['listele_aku_marka']!="" ){

				$aku_marka = $_GET['listele_aku_marka'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE  urun_ad=:marka");
				$sorgu->execute(array(
					"marka"=>$aku_marka
				));
				

			}

			else if($_GET['listele_aku_sube']!="" ){

				$aku_sube = $_GET['listele_aku_sube'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_sube=:sube ");
				$sorgu->execute(array(
					"sube"=>$aku_sube
				));
			}

			else if($_GET['listele_aku_amper']!="" ){

				$aku_amper = $_GET['listele_aku_amper'];

				$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_amper=:amper ");
				$sorgu->execute(array(
					"amper"=>$aku_amper
				));
			}


			?>


			<div class="col-xs-12">
				<br>
				<div class="box">

					<div class="box-header">

						<h3 class="box-title">RAPOR LİSTESİ </h3>
						<br>
						
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Ürün Adı</th>
									<th>Amper</th>
									<th>Ürün Tip</th>
									<th> Adet</th>
									<th>Maliyet</th>
									<th>Sube</th>
									
								</tr>

							</thead>
							<tbody>
								<?php  
								while($urun_liste_cek=$sorgu->fetch(PDO::FETCH_ASSOC)){ ?>
									<tr>
										<td><?php echo $urun_liste_cek['urun_ad'] ?></td>
										<td><?php echo $urun_liste_cek['urun_amper'] ?></td>
										<td><?php echo $urun_liste_cek['urun_tip'] ?></td>
										<td><?php echo $urun_liste_cek['urun_adet'] ?></td>
										<td><?php echo $urun_liste_cek['urun_maliyet'] ?></td>
										<td>
											<?php switch ($urun_liste_cek['urun_sube']) {
												case 1:?>
													OTOSANSİT
												<?php 	break;
												case 2:?>
													DUAÇINARI
												<?php 	break;
												case 3:?>
													YALOVA
												<?php 	break;
												case 4:?>
													BEŞYOL
												<?php 	break;		
												
												default:
													# code...
													break;
											} ?>

										</td>
										<?php $adet+=$urun_liste_cek['urun_adet']; ?>
                                        <?php 
                                        if($urun_liste_cek['urun_adet']>0){
                                        $urun_maliyet+=$urun_liste_cek['urun_maliyet']*$urun_liste_cek['urun_adet']; 
                                        }
                                        ?>
									</tr>

								<?php  }?>

								<p  style="font-size: 16px">Adet: <?php echo $adet ?></p>
									<p  style="font-size: 16px">Mal Karşılığı: <?php echo $urun_maliyet ?> TL</p>

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