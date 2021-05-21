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
							OTOSANSİT ÜRÜN LİSTESİ
							<?php  
							break;
							case "2":?>
							DUAÇINARI ÜRÜN LİSTESİ
							<?php  
							break;

							case '3':?>
							YALOVA ÜRÜN LİSTESİ
							<?php  
							break;

							case '4':?>
							BEŞYOL ÜRÜN LİSTESİ
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
									<th>Maliyet</th>
									<th>Düzenle</th>
									<th>Sil</th>

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
										<td><?php echo $uruncek['urun_maliyet'] ?></td>
										<td>  					
											<a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>  
											Düzenle</button></a>
										</td>
										<td>  					
											<a href="netting/islem.php?urun_sil=ok&urun_id=<?php echo $uruncek['urun_id'] ?>&sube=<?php echo $_GET['sube']  ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i>  
											Sil</button></a>
										</td>
									<?php } ?>
								</tr>





							</tbody>

						</table>
					</div>
					<!-- /.box-body -->
				</div>

				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">ÜRÜN EKLE</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form action="netting/islem.php" role="form" method="post">
									<div class="box-body">
										<div class="form-group">
											<label >Akü Adı</label>
											<input name="aku_ad" type="text" class="form-control"  placeholder="Adı:">
										</div>

										
										<div class="form-group">
											<label >Akü Amper</label>
											<input  name="aku_amper" type="number" class="form-control"  placeholder="Akü Amper:">
										</div>


										<div class="form-group">
											<label >Akü Tip</label>
											<input  name="aku_tip" type="text" class="form-control"  placeholder="Akü Tip:">
										</div>

										<div class="form-group">
											<label >Akü Adet</label>
											<input  name="aku_adet" type="number" class="form-control"  placeholder="Akü Adet:">
										</div>

										<div class="form-group">
											<label >Akü Maliyet</label>
											<input  name="aku_maliyet" type="number" class="form-control"  placeholder="Akü Maliyet:">
										</div>




									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button name="urun_ekle" type="submit" class="btn btn-primary">ÜRÜN EKLE</button>
									</div>
									<input type="hidden" name="mevcut_aku_sube" value="<?php echo $_GET['sube'] ?>">
								</form>



							</div>

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