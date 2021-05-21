<?php 

ob_start();
session_start();
include 'baglan.php';


if(isset($_POST['loggin'])){

	$admin_kadi =  $_POST['admin_kadi'] ;
	$admin_sifre = $_POST['admin_sifre'] ;

	if($admin_kadi && $admin_sifre){


		$adminsor=$db->prepare("SELECT * FROM admin WHERE admin_kadi=:kadi AND admin_password=:password");
		$adminsor->execute(array(
			'kadi'=>$admin_kadi,
			'password'=>$admin_sifre
		));

		$say=$adminsor->rowCount();
		if($say>0){

			$_SESSION ['admin_kadi'] = $admin_kadi;
			$_SESSION ['admin_sifre'] = $admin_sifre;
			header('Location:../index.php');	

		}

		else {

			header('Location:../login.php?durum=no');	

		}
	}
	
}



if (isset($_POST['aku_sat'])) {

	$satilan_aku_sube = $_POST['mevcut_aku_sube'];

	if($_POST['mevcut_aku_adet']>0){

		$date = date('Y-m-d');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));

		$sorgu=$db->prepare("INSERT INTO urun_satis (satis_aku_adi, satis_aku_amper,satis_aku_tip, satis_aku_adet,satis_aku_sube,urun_maliyet,urun_odeme_tip,urun_odeme_miktar,urun_eski_aku_amper,urun_eski_aku_adet,satis_aku_aktif_mi,satis_aku_tarih)
			VALUES (:adi, :amperi,:tipi, :adeti,:subesi,:maliyeti,:odemetipi,:miktari,:eskiaku_amperi,:eskiaku_adeti,:aktifmi,:tarihi)");

		switch ($satilan_aku_sube) {
			case 1:
			$dukkan_adi="Otosansit";
			break;
			case 2:
			$dukkan_adi="Duaçınar";
			break;
			case 3:
			$dukkan_adi="Yalova";
			break;
			case 4:
			$dukkan_adi="Beşyol";
			break;

			default:
			# code...
			break;
		}

		$insert=$sorgu->execute(array(
			":adi"=>$_POST['mevcut_aku_ad'],
			":amperi"=>$_POST['mevcut_aku_amper'],
			":tipi"=>$_POST['mevcut_aku_tip'],
			":adeti"=>$_POST['satilan_aku_adet'],
			":subesi"=>$dukkan_adi,
			":maliyeti"=>$_POST['mevcut_aku_maliyet'],
			":odemetipi"=>$_POST['odeme_tip'],
			":miktari"=>$_POST['miktar'],
			":eskiaku_amperi"=>$_POST['eski_aku_amper'],
			":eskiaku_adeti"=>$_POST['eski_aku_adet'],
			":aktifmi"=>0,
			":tarihi"=>$prev_date
		));

		if($insert){

			Header("Location:../satis-islem.php?durum=ok&sube=$satilan_aku_sube");

		}
		else
		{

			Header("Location:../satis-islem.php?durum=no");

		}
	}

	
}



if (isset($_POST['satis_guncelle'])) {
	$satis_id = $_POST['mevcut_satis_id'];	

	$urunkaydet=$db->prepare("UPDATE urun_satis SET 
		satis_aku_adet=:satis_adet,
		urun_odeme_tip=:odeme_tip,
		urun_odeme_miktar=:odeme_miktar,
		urun_eski_aku_amper=:eski_aku_amper,
		urun_eski_aku_adet=:eski_aku_adet,
		satis_aku_tarih=:tarihi
		WHERE satis_id=$satis_id");


	$update = $urunkaydet->execute(array(
		'satis_adet'=> $_POST['aku_adet'],
		'odeme_tip'=> $_POST['aku_odeme_tip'],
		'odeme_miktar'=> $_POST['aku_odeme_miktar'],
		'eski_aku_amper'=> $_POST['aku_eski_aku_amper'],
		'eski_aku_adet'=> $_POST['aku_eski_aku_adet'],
		'tarihi'=> $_POST['aku_satis_tarih']
	));
	
	if($update){	

		Header("Location:../onay-satis.php?durum=ok");

	}

	
	else{

		Header("Location:../onay-satis.php?durum=no");

	}
	
}


if(isset($_POST['satis_onay'])){

	$satis_id=$_POST['mevcut_aku_id'];
	
	$urunsatiskaydet=$db->prepare("UPDATE urun_satis SET 
		satis_aku_aktif_mi=:aktifmi
		WHERE satis_id=$satis_id");


	$update = $urunsatiskaydet->execute(array(
		'aktifmi'=> 1
	));

	switch ($_POST['mevcut_aku_sube']) {
		case "Otosansit":
		$mevcut_aku_sube = 1;
		break;
		case "Duaçınar":
		$mevcut_aku_sube = 2;		
		break;
		case "Yalova":
		$mevcut_aku_sube = 3;
		break;
		case "Beşyol":
		$mevcut_aku_sube = 4;
		break;
		default:
			# code...
		break;
	}

	$mevcut_aku_ad = $_POST['mevcut_aku_ad'];
	$mevcut_aku_amper=$_POST['mevcut_aku_amper'];
	$mevcut_aku_tip=$_POST['mevcut_aku_tip'];
    $satilan_adet = $_POST['mevcut_aku_adet'];	



	$sql="UPDATE stok_urunler SET urun_adet=urun_adet-$satilan_adet WHERE urun_ad = ? and urun_amper=? and urun_tip=? and urun_sube=?";

	$db->prepare($sql)->execute([$mevcut_aku_ad,$mevcut_aku_amper,$mevcut_aku_tip,$mevcut_aku_sube]);	


	if($db){	
		Header("Location:../onay-satis.php?durum=ok");
	}else{
		Header("Location:../onay-satis.php?durum=no");
	}


}




if (isset($_GET['onay_sil'])) {
	
	$sil=$db->prepare("DELETE FROM urun_satis WHERE satis_id=:satis_id");
	$kontrol=$sil->execute(array(
		'satis_id'=>$_GET['satis_id']	
	));

	if($kontrol){	
		Header("Location:../onay-satis.php?durum=ok");
	}else{
		Header("Location:../onay-satis.php?durum=no");
	}
}


if (isset($_POST['aku_satis_guncelle'])) {
	
	$urun_id=$_POST['mevcut_urun_id'];
	$satilan_aku_sube = $_POST['mevcut_aku_sube'];
	$yeni_adet = $_POST['mevcut_aku_adet'] - $_POST['satilan_aku_adet'];

	if($_POST['mevcut_aku_adet']>0){
		$urunadetkaydet=$db->prepare("UPDATE stok_urunler SET 
			urun_adet=:urun_adet
			WHERE urun_id=$urun_id");


		$update = $urunadetkaydet->execute(array(
			'urun_adet'=> $yeni_adet
		));

		$date = date('Y-m-d');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));

		$sorgu=$db->prepare("INSERT INTO urun_satis (satis_aku_adi, satis_aku_amper,satis_aku_tip, satis_aku_adet,satis_aku_sube,urun_maliyet,urun_odeme_tip,urun_odeme_miktar,urun_eski_aku_amper,urun_eski_aku_adet,satis_aku_tarih)
			VALUES (:adi, :amperi,:tipi, :adeti,:subesi,:maliyeti,:odemetipi,:miktari,:eskiaku_amperi,:eskiaku_adeti,:tarihi)");

		switch ($satilan_aku_sube) {
			case 1:
			$dukkan_adi="Otosansit";
			break;
			case 2:
			$dukkan_adi="Duaçınar";
			break;
			case 3:
			$dukkan_adi="Yalova";
			break;
			case 4:
			$dukkan_adi="Beşyol";
			break;

			default:
			# code...
			break;
		}

		$insert=$sorgu->execute(array(
			":adi"=>$_POST['mevcut_aku_ad'],
			":amperi"=>$_POST['mevcut_aku_amper'],
			":tipi"=>$_POST['mevcut_aku_tip'],
			":adeti"=>$_POST['satilan_aku_adet'],
			":subesi"=>$dukkan_adi,
			":maliyeti"=>$_POST['mevcut_aku_maliyet'],
			":odemetipi"=>$_POST['odeme_tip'],
			":miktari"=>$_POST['miktar'],
			":eskiaku_amperi"=>$_POST['eski_aku_amper'],
			":eskiaku_adeti"=>$_POST['eski_aku_adet'],
			":tarihi"=>$prev_date
		));

		if($insert){

		Header("Location:../satis-islem.php?durum=ok&sube=$satilan_aku_sube");

		}
		else
		{

		Header("Location:../satis-islem.php?durum=no");

		}
	}

	
}





if (isset($_POST['aku_garanti_guncelle'])) {
	
	$urun_id=$_POST['mevcut_urun_id'];
	$satilan_aku_sube = $_POST['mevcut_aku_sube'];
	$yeni_adet = $_POST['mevcut_aku_adet'] - 1;

	if($_POST['mevcut_aku_adet']>0){
		$urunadetkaydet=$db->prepare("UPDATE stok_urunler SET 
			urun_adet=:urun_adet
			WHERE urun_id=$urun_id");


		$update = $urunadetkaydet->execute(array(
			'urun_adet'=> $yeni_adet
		));

		$date = date('Y-m-d');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));

		$sorgu=$db->prepare("INSERT INTO stok_hareketleri (stok_aku_ad,stok_aku_amper, stok_aku_tip, stok_aku_adet ,stok_aku_nereden,stok_aku_nereye ,stok_aku_aciklama,stok_aku_date)
		VALUES (:ad,:amper, :tip, :adet ,:nereden,:nereye,:aciklama,:tarihi)");


		$sonuc=$sorgu->execute(array(
			":ad"=>$_POST['mevcut_aku_ad'],
			":amper"=>$_POST['mevcut_aku_amper'],
			":tip"=>$_POST['mevcut_aku_tip'],
			":adet"=>1 ,
			":nereden"=>$_POST['mevcut_aku_sube'],
			":nereye"=>" ",
			":aciklama"=>"Garantiden kapsamında müşterinin aküsünün değişilmesi",
			":tarihi"=>$prev_date
		));

		if($sonuc){

		Header("Location:../garanti-islem.php?durum=ok&sube=$satilan_aku_sube");

		}
		else
		{

		Header("Location:../garanti-islem.php?durum=no");

		}
	}

	
}






if(isset($_POST['urun_ekle'])){
	
	$eklenen_aku_sube = $_POST['mevcut_aku_sube'];
	$sorgu=$db->prepare("INSERT INTO stok_urunler (urun_ad,urun_amper, urun_tip, urun_adet,urun_maliyet ,urun_sube)
		VALUES (:ad,:amper, :tip, :adet ,:maliyeti,:sube)");

	$sonuc=$sorgu->execute(array(
		":ad"=>$_POST['aku_ad'],
		":amper"=>$_POST['aku_amper'],
		":tip"=>$_POST['aku_tip'],
		":adet"=>$_POST['aku_adet'],
		":maliyeti"=>$_POST['aku_maliyet'],
		":sube"=>$eklenen_aku_sube
	));

	if($sonuc){	

		Header("Location:../urun-ekle.php?durum=ok&sube=$eklenen_aku_sube");

	}else{

		Header("Location:../urun-ekle.php?durum=no&sube=$eklenen_aku_sube");

	}
	
}


if (isset($_POST['urun_guncelle'])) {
	$urun_id = $_POST['mevcut_urun_id'];
	$eklenen_aku_sube = $_POST['mevcut_aku_sube'];	

	$urunkaydet=$db->prepare("UPDATE stok_urunler SET 
		urun_ad=:urun_ad,
		urun_amper=:urun_amper,
		urun_tip=:urun_tip,
		urun_adet=:urun_adet,
		urun_maliyet=:maliyeti
		WHERE urun_id=$urun_id");


	$update = $urunkaydet->execute(array(
		'urun_ad'=> $_POST['aku_ad'],
		'urun_amper'=> $_POST['aku_amper'],
		'urun_tip'=> $_POST['aku_tip'],
		'urun_adet'=> $_POST['aku_adet'],
		'maliyeti'=> $_POST['aku_maliyet']
	));
	
	if($update){	

		Header("Location:../urun-ekle.php?durum=ok&sube=$eklenen_aku_sube");

	}

	
	else{

		Header("Location:../urun-ekle.php?durum=no");

	}
	
}



if (isset($_GET['urun_sil'])) {
	$sube = $_GET['sube'];
	$sil=$db->prepare("DELETE FROM stok_urunler WHERE urun_id=:urun_id");
	$kontrol=$sil->execute(array(
		'urun_id'=>$_GET['urun_id']	
	));

	if($kontrol){	
		Header("Location:../urun-ekle.php?durum=ok&sube=$sube");
	}else{
		Header("Location:../urun-ekle.php?durum=no");
	}
}




if (isset($_POST['aku_aktar_guncelle'])) {
	if($_POST['mevcut_aku_adet'] >= $_POST['aktarim_aku_adet']){
		$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_ad = :urun_adi and urun_amper =:urun_amperi and urun_tip=:urun_tipi and urun_sube=:urun_sube");
		$sorgu->execute(array(
			'urun_adi'=>$_POST['mevcut_aku_ad'],
			'urun_amperi'=>$_POST['mevcut_aku_amper'],
			'urun_tipi'=>$_POST['mevcut_aku_tip'],
			'urun_sube'=>$_POST['aktarilan_aku_sube']
		));
		$say=$sorgu->rowCount();
		$mevcut_aku_sube=$_POST['mevcut_aku_sube'];
		if($say==0){

			$sorgu=$db->prepare("INSERT INTO stok_urunler (urun_ad, urun_amper,urun_tip, urun_adet,urun_maliyet,urun_sube)
				VALUES (:adi, :amperi,:tipi, :adeti,:maliyeti,:subesi)");

			$insert=$sorgu->execute(array(
				":adi"=>$_POST['mevcut_aku_ad'],
				":amperi"=>$_POST['mevcut_aku_amper'],
				":tipi"=>$_POST['mevcut_aku_tip'],
				":adeti"=>$_POST['aktarim_aku_adet'],
				":maliyeti"=>$_POST['mevcut_aku_maliyet'],
				":subesi"=>$_POST['aktarilan_aku_sube']
			));

		}
		
		
		else{

			$cek=$sorgu->fetch(PDO::FETCH_ASSOC);
			$aktarilacak_yerdeki_aku_adet = $cek['urun_adet'];
			$aktarilan_aku_adet=$_POST['aktarim_aku_adet'];
			$yeni_aku_adet = $aktarilacak_yerdeki_aku_adet + $aktarilan_aku_adet;

			$mevcut_aku_ad = $_POST['mevcut_aku_ad'];
			$aktarilan_aku_sube=$_POST['aktarilan_aku_sube'];
			$mevcut_aku_amper=$_POST['mevcut_aku_amper'];
			$mevcut_aku_tip=$_POST['mevcut_aku_tip'];
			
			$sql="UPDATE stok_urunler SET urun_adet=? WHERE urun_ad = ? and urun_amper=? and urun_tip=? and urun_sube=?";

			$db->prepare($sql)->execute([$yeni_aku_adet,$mevcut_aku_ad,$mevcut_aku_amper,$mevcut_aku_tip,$aktarilan_aku_sube]);	

		}

			
		$urun_id = $_POST['mevcut_urun_id'];
		$yeni_aku_adet = $_POST['mevcut_aku_adet'] - $_POST['aktarim_aku_adet'];
		$urun_adet_kaydet=$db->prepare("UPDATE stok_urunler SET 
			urun_adet=:urun_adet
			WHERE urun_id=$urun_id");


		$update = $urun_adet_kaydet->execute(array(
			'urun_adet'=> $yeni_aku_adet
		));
		$date = date('Y-m-d');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
		$sorgu=$db->prepare("INSERT INTO stok_hareketleri (stok_aku_ad,stok_aku_amper, stok_aku_tip, stok_aku_adet, stok_aku_nereden,stok_aku_nereye,stok_aku_aciklama,stok_aku_date)
		VALUES (:ad,:amper, :tip, :adet ,:nereden,:nereye,:aciklama,:tarihi)");

		$sonuc=$sorgu->execute(array(
			":ad"=>$_POST['mevcut_aku_ad'],
			":amper"=>$_POST['mevcut_aku_amper'],
			":tip"=>$_POST['mevcut_aku_tip'],
			":adet"=>$_POST['aktarim_aku_adet'],
			":nereden"=>$_POST['mevcut_aku_sube'],
			":nereye"=>$_POST['aktarilan_aku_sube'],
			":aciklama"=>"Şubeler arası akü transferi",
			":tarihi"=>$prev_date
		));

		if($sonuc){

			Header("Location:../stok-islem.php?durum=ok&sube=$mevcut_aku_sube");

		}else{

			Header("Location:../stok-islem.php?durum=no");

		}

		
	}
	else
	{
		Header("Location:../stok-islem.php?durum=no");
	}
	

}








if (isset($_POST['fabrika_urun_ekle'])) {
	

		$sorgu=$db->prepare("SELECT * FROM stok_urunler WHERE urun_ad = :urun_adi and urun_amper =:urun_amperi and urun_tip=:urun_tipi and urun_sube=:urun_sube");
		$sorgu->execute(array(
			'urun_adi'=>$_POST['aku_ad'],
			'urun_amperi'=>$_POST['aku_amper'],
			'urun_tipi'=>$_POST['aku_tip'],
			'urun_sube'=>$_POST['aku_sube']
		));
		$say=$sorgu->rowCount();
		$aktarilan_aku_sube = $_POST['aku_sube'];
		if($say==0){

			$sorgu=$db->prepare("INSERT INTO stok_urunler (urun_ad, urun_amper,urun_tip, urun_adet,urun_maliyet,urun_sube)
				VALUES (:adi, :amperi,:tipi, :adeti,:maliyeti,:subesi)");

			$insert=$sorgu->execute(array(
				":adi"=>$_POST['aku_ad'],
				":amperi"=>$_POST['aku_amper'],
				":tipi"=>$_POST['aku_tip'],
				":adeti"=>$_POST['aku_adet'],
				":maliyeti"=>$_POST['aku_maliyet'],
				":subesi"=>$_POST['aku_sube']
			));

		}
		
		
		else{

			$cek=$sorgu->fetch(PDO::FETCH_ASSOC);
			$aktarilacak_yerdeki_aku_adet = $cek['urun_adet'];
			$aktarilan_aku_adet=$_POST['aku_adet'];
			$yeni_aku_adet = $aktarilacak_yerdeki_aku_adet + $aktarilan_aku_adet;

			$mevcut_aku_ad = $_POST['aku_ad'];
			$aktarilan_aku_sube=$_POST['aku_sube'];
			$mevcut_aku_amper=$_POST['aku_amper'];
			$mevcut_aku_tip=$_POST['aku_tip'];
			
			$sql="UPDATE stok_urunler SET urun_adet=? WHERE urun_ad = ? and urun_amper=? and urun_tip=? and urun_sube=?";

			$db->prepare($sql)->execute([$yeni_aku_adet,$mevcut_aku_ad,$mevcut_aku_amper,$mevcut_aku_tip,$aktarilan_aku_sube]);	

		}

	
		$date = date('Y-m-d');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
		$sorgu=$db->prepare("INSERT INTO stok_hareketleri (stok_aku_ad,stok_aku_amper, stok_aku_tip, stok_aku_adet, stok_aku_nereden,stok_aku_nereye,stok_aku_aciklama,stok_aku_date)
		VALUES (:ad,:amper, :tip, :adet ,:nereden,:nereye,:aciklama,:tarihi)");

		$sonuc=$sorgu->execute(array(
			":ad"=>$_POST['aku_ad'],
			":amper"=>$_POST['aku_amper'],
			":tip"=>$_POST['aku_tip'],
			":adet"=>$_POST['aku_adet'],
			":nereden"=>0,
			":nereye"=>$_POST['aku_sube'],
			":aciklama"=>$_POST['aku_aciklama'],	
			":tarihi"=>$prev_date
		));

		if($sonuc){

			Header("Location:../fabrikadan-gelen.php?durum=ok&sube=$aktarilan_aku_sube");

		}else{

		}
	}








?>