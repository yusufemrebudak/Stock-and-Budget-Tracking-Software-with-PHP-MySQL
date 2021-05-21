<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php

$sorgu=$db->prepare("SELECT * FROM urun_satis WHERE satis_id =?");
$sorgu->execute(array($_GET['satis_id']));
$satiscek=$sorgu->fetch(PDO::FETCH_ASSOC);

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
											<input name="aku_ad" value="<?php echo $satiscek['satis_aku_adi'] ?>" type="text" class="form-control" disabled placeholder="Adı:">
										</div>

										<div class="form-group">
											<label >Akü Amper</label>
											<input  name="aku_amper" type="number" value="<?php echo $satiscek['satis_aku_amper'] ?>" class="form-control" disabled placeholder="Akü Amper:">
										</div>

										<div class="form-group">
											<label >Akü Tip</label>
											<input value="<?php echo $satiscek['satis_aku_tip'] ?>" name="aku_tip" type="text" class="form-control" disabled placeholder="Akü Tip:">
										</div>

										<div class="form-group">
											<label >Akü Adet</label>
											<input value="<?php echo $satiscek['satis_aku_adet'] ?>" name="aku_adet" type="number" class="form-control"  >
										</div>

										
										<div class="form-group">
											<label>Ürün Ödeme Tip</label>		
											<select name="aku_odeme_tip" class="form-control">
												<option value="Nakit">Nakit</option>
												<option value="Kart">Kredi-Kart</option>
												<option value="MailOrder">MailOrder</option>
												<option value="Eft">Eft</option>
												<option value="Trendyol">Trendyol</option>
												<option value="Veresiye">Veresiye</option>

											</select>
										</div>



										<div class="form-group">
											<label >Miktar</label>
											<input  name="aku_odeme_miktar" type="number" value="<?php echo $satiscek['urun_odeme_miktar'] ?>" class="form-control"  >
										</div>

										<div class="form-group">
											<label >Eski Akü Amper</label>
											<input  name="aku_eski_aku_amper" type="number" value="<?php echo $satiscek['urun_eski_aku_amper'] ?>" class="form-control"  >
										</div>

										<div class="form-group">
											<label >Eski Akü Adet</label>
											<input  name="aku_eski_aku_adet" type="number" value="<?php echo $satiscek['urun_eski_aku_adet'] ?>" class="form-control"  placeholder="Akü Maliyet:">
										</div>

										<div class="form-group">
												<label> Tarihi</label>
												<input  type="date" name="aku_satis_tarih" class="form-control">
										</div>




									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button name="satis_guncelle" type="submit" class="btn btn-primary">SATIŞI GÜNCELLE</button>
									</div>
									<input type="hidden" name="mevcut_satis_id" value="<?php echo $_GET['satis_id'] ?>">
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