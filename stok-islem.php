<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php

$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_sube =?");
$sorgu->execute(array($_GET['sube']));


?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php switch ($_GET['sube']) {
							case "1":?>
							OTOSANSİTTEN AKTARIM
							<?php  
							break;
							case "2":?>
							DUAÇINARINDAN AKTARIM
							<?php  
							break;

							case '3':?>
							YALOVADAN AKTARIM
							<?php  
							break;

							case '4':?>
							BEŞYOLDAN AKTARIM
							<?php  
							break;
							
							default:
								# code...
							break;
						} ?></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Ürün Adı</th>
									<th>Amper</th>
									<th>Adet</th>
									<th>Tip</th>
									<th>Kaç Adet</th>
									<th>Nereye</th>
									<th>Gönderim</th>

								</tr>
							</thead>
							<tbody>
								<?php  
								while($uruncek=$sorgu->fetch(PDO::FETCH_ASSOC)){?>
									<tr>
										<td><?php echo $uruncek['urun_ad'] ?></td>
										<td><?php echo $uruncek['urun_amper'] ?></td>
										<td><?php echo $uruncek['urun_adet'] ?></td>
										<td><?php echo $uruncek['urun_tip'] ?></td>
										<td>
											<form action="netting/islem.php" method="POST" >
												<div class="form-group">		
													<select  name="aktarim_aku_adet" class="form-control">
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
													</select>
												</div>
											</td>
											<td>
												<div class="form-group">		
													<select name="aktarilan_aku_sube" class="form-control">
														<?php switch ($_GET['sube']) {
															case 1:?>
															<option value="2">Duaçınarı</option>
															<option value="3">Yalova</option>
															<option value="4">Beşyol</option>
															<?php	break;
															case 2:?>
															<option value="1">Otosansit</option>
															<option value="3">Yalova</option>
															<option value="4">Beşyol</option>
															<?php	break;
															case 3:?>
															<option value="1">Otosansit</option>
															<option value="2">Duaçınarı</option>
															<option value="4">Beşyol</option>
															<?php	break;
															case 4:?>
															<option value="1">Otosansit</option>
															<option value="2">Duaçınarı</option>
															<option value="3">Yalova</option>
															<?php	break;
															
															default:
																# code...
															break;
														} 
														?>
														

													</select>
												</div>
											</td>
											<td><button type="submit" name="aku_aktar_guncelle" style="width: %100px; font-size: 12px;" class="btn btn-primary">AKTAR</button></td>

											<input type="hidden" name="mevcut_urun_id" value="<?php echo $uruncek['urun_id'] ?>">
											<input type="hidden" name="mevcut_aku_maliyet" value="<?php echo $uruncek['urun_maliyet'] ?>">
											<input type="hidden" name="mevcut_aku_adet" value="<?php echo $uruncek['urun_adet'] ?>">
											<input type="hidden" name="mevcut_aku_tip" value="<?php echo $uruncek['urun_tip'] ?>">

											<input type="hidden" name="mevcut_aku_ad" value="<?php echo $uruncek['urun_ad'] ?>">
											<input type="hidden" name="mevcut_aku_amper" value="<?php echo $uruncek['urun_amper'] ?>">
											<input type="hidden" name="mevcut_aku_sube" value="<?php echo $uruncek['urun_sube'] ?>">

											</tr>
										</form>
									<?php } ?>
								





							</tbody>

						</table>
					</div>
					<!-- /.box-body -->
				</div>

				
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