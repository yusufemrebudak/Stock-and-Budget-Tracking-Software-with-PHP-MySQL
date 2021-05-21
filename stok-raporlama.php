<?php 
include 'header.php'; 
include 'sidebar.php' ;


?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			
			<form action="" method="GET">
				<div class="form-group">
					<div class="col-md-6">
						<label>Başlangıç Tarihi</label>
						<input type="date" name="first_date" class="form-control">
					</div>
					<div class="col-md-6">
						<label>Bitiş Tarihi</label>
						<input type="date" name="end_date" class="form-control">
					</div>

					<br>
					
					<div class="col-md-9">
						<button type="submit" class="btn btn-info">Sorgula</button>
					</div>
				</div>
			</form>

			<?php  
			
			if(isset($_GET['first_date']) and isset($_GET['end_date'])){
				$first_date = $_GET['first_date'];
				$end_date = $_GET['end_date'];

				$sorgu=$db->prepare("SELECT * FROM stok_hareketleri WHERE stok_aku_date BETWEEN ? and ? ");
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
							<h3 class="box-title"><?php echo $_GET['first_date'] ?> ve <?php echo $_GET['end_date'] ?> ARASI STOK HAREKETLERİ</h3>
						<?php  }?>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Tarih</th>
									<th>Ürün Adı</th>
									<th>Amper</th>
									<th>Ürün Tip</th>
									<th>Adet</th>
									<th>Nereden</th>
									<th>Nereye</th>
									<th>Açıklama</th>

									
								</tr>

							</thead>
							<tbody>
								<?php  
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
											case 0:?>
												FABRİKADAN
											<?php break;

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
											
											default:?>
												
											<?php break;
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
										<td><?php echo $stok_sorgu_cek['stok_aku_aciklama'] ?></td>

									</tr>

								<?php  }?>

								

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