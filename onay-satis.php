<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php

$sorgu=$db->prepare("SELECT * FROM urun_satis WHERE satis_aku_aktif_mi =?");
$sorgu->execute(array(0));


?>
<!-- Main content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">ONAY BEKLEYEN SATIŞ LİSTESİ</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Ürün Adı</th>
									<th>Amper</th>
									<th>Tip</th>
									<th>Adet</th>
									<th>Şube</th>
									<th>Ödeme Tip</th>
									<th>Ödeme Miktarı</th>
									<th>Eski Akü Amper</th>
									<th>Eski Akü Adet</th>
									<th>Satış Tarih</th>
									<th>Sil</th>
									<th>Düzenle</th>
									<th>Onayla</th>


								</tr>
							</thead>
							<tbody>
								<?php  
								while($satiscek=$sorgu->fetch(PDO::FETCH_ASSOC)){?>
									<tr>
										<td><?php echo $satiscek['satis_aku_adi'] ?></td>
										<td><?php echo $satiscek['satis_aku_amper'] ?></td>
										<td><?php echo $satiscek['satis_aku_tip'] ?></td>
										<td><?php echo $satiscek['satis_aku_adet'] ?></td>
										<td><?php echo $satiscek['satis_aku_sube'] ?></td>
										<td><?php echo $satiscek['urun_odeme_tip'] ?></td>
										<td><?php echo $satiscek['urun_odeme_miktar'] ?></td>
										<td><?php echo $satiscek['urun_eski_aku_amper'] ?></td>
										<td><?php echo $satiscek['urun_eski_aku_adet'] ?></td>
										<td><?php echo $satiscek['satis_aku_tarih'] ?></td>
										
										<td>  					
											<a href="netting/islem.php?onay_sil=ok&satis_id=<?php echo $satiscek['satis_id'] ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i>  
											Sil</button></a>
										</td>

                                        <td>  					
											<a href="satis-duzenle.php?satis_id=<?php echo $satiscek['satis_id'] ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>  
											Düzenle</button></a>
										</td> <!-- eklendi -->
										<form action="netting/islem.php" role="form" method="post">
										<td><button type="submit" name="satis_onay" class="btn btn-success">Onayla</button></td>
                
											<input type="hidden" name="mevcut_aku_id" value="<?php echo $satiscek['satis_id'] ?>">
											<input type="hidden" name="mevcut_aku_adet" value="<?php echo $satiscek['satis_aku_adet'] ?>">

											<input type="hidden" name="mevcut_aku_tip" value="<?php echo $satiscek['satis_aku_tip'] ?>">

											<input type="hidden" name="mevcut_aku_ad" value="<?php echo $satiscek['satis_aku_adi'] ?>">
											<input type="hidden" name="mevcut_aku_amper" value="<?php echo $satiscek['satis_aku_amper'] ?>">
											<input type="hidden" name="mevcut_aku_sube" value="<?php echo $satiscek['satis_aku_sube'] ?>">
											</form>
											
									<?php } ?>
								</tr>





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