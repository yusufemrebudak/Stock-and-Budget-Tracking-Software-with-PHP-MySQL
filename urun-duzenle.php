<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php

$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_id =?");
$sorgu->execute(array($_GET['urun_id']));
$uruncek=$sorgu->fetch(PDO::FETCH_ASSOC);

?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				

				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">ÜRÜNÜ DÜZENLE</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form action="netting/islem.php" role="form" method="post">
									<div class="box-body">
										<div class="form-group">
											<label >Akü Adı</label>
											<input name="aku_ad" value="<?php echo $uruncek['urun_ad'] ?>" type="text" class="form-control"  placeholder="Adı:">
										</div>

										<div class="form-group">
											<label >Akü Amper</label>
											<input  name="aku_amper" type="number" value="<?php echo $uruncek['urun_amper'] ?>" class="form-control"  placeholder="Akü Amper:">
										</div>

										<div class="form-group">
											<label >Akü Tip</label>
											<input value="<?php echo $uruncek['urun_tip'] ?>" name="aku_tip" type="text" class="form-control"  placeholder="Akü Tip:">
										</div>

										<div class="form-group">
											<label >Akü Adet</label>
											<input value="<?php echo $uruncek['urun_adet'] ?>" name="aku_adet" type="number" class="form-control"  placeholder="Akü Adet:">
										</div>

										<div class="form-group">
											<label >Akü Maliyet</label>
											<input  name="aku_maliyet" type="number" value="<?php echo $uruncek['urun_maliyet'] ?>" class="form-control"  placeholder="Akü Maliyet:">
										</div>




									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button name="urun_guncelle" type="submit" class="btn btn-primary">ÜRÜNÜ GÜNCELLE</button>
									</div>
									<input type="hidden" name="mevcut_aku_sube" value="<?php echo $uruncek['urun_sube'] ?>">
									<input type="hidden" name="mevcut_urun_id" value="<?php echo $_GET['urun_id'] ?>">
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