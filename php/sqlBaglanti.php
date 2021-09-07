<?php
	$sql = mysqli_connect("localhost","bariscan_link-kisaltma","Sifre1234");//kullanici adi sifre
	mysqli_select_db($sql,"bariscan_link-kisaltma");//veritabani adi
	mysqli_set_charset($sql,"utf8");
?>
