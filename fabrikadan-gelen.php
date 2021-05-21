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
				

				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Fabrikadan Gelen Aküyü Tanımla</h3>
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
											<label >Akü amper</label>
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
											<label >Nereye</label>
											<select name="aku_sube" class="form-control">	
												<option value="1">Otosansit</option>
												<option value="2">Duaçınarı</option>
												<option value="3">Yalova</option>
												<option value="4">Beşyol</option>
											</select>
										</div>
										
										<div class="form-group">
											<label >Akü Maliyet</label>
											<input  name="aku_maliyet" type="number" class="form-control"  placeholder="Akü Maliyeti:">
										</div>


										<div class="form-group">
											<label >Açıklama</label>
											<input  name="aku_aciklama" type="text" class="form-control"  placeholder="Açıklama:">
										</div>


									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button name="fabrika_urun_ekle" type="submit" class="btn btn-primary">EKLE/TANIMLA</button>
									</div>
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