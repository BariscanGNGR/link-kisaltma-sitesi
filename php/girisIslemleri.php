<?php
	function giris($sql,$kullanici,$sifre) //giriş yaparsa 1 yapmazsa 0
	{
		$sorgu = mysqli_query($sql,"SELECT `kullanici`, `sifre` FROM `uyeler` WHERE `kullanici`= '$kullanici' AND `sifre`='$sifre'") or die(mysqli_error($sql));
		$sayac=mysqli_num_rows($sorgu);
		
		if($sayac > 0)
			return 1;
		else
			return 0;
	}

	function kaydol($sql,$kullanici ,$sifre,$email) //kaydolursa 1 hata verirse 0
	{
		$sorgu =mysqli_query($sql,"INSERT INTO `uyeler`( `kullanici`, `sifre` ,`email`,`email_onay`) VALUES ('$kullanici','$sifre','$email','0')");// or die("kaydolma hatası");
		
		if (empty($sorgu))
			return 0;
		else
			return 1;
	}

	function sifreDegistir($sql,$eskisifre,$yenisifre,$yenisifre2)
	{
		
		if(!isset($_SESSION))
		{
					session_start();
		}		
		if(isset($_SESSION['kullanici']))
		{
		$sorgu = mysqli_query($sql,"SELECT `uyeler`, `sifre` FROM `users` WHERE `kullanici`= '".$_SESSION["kullanici"]."' AND `sifre`='$eskisifre'") or die(mysqli_error($sql));
		$sayac=mysqli_num_rows($sorgu);
		$satir=mysqli_fetch_array($sorgu);
		
		
		if($sayac>0)
		{
			if($satir['sifre'] == $eskisifre)
			{
				if($yenisifre == $yenisifre2)
				{
					$sorgu = mysqli_query($sql,"UPDATE `uyeler` SET `sifre`='".$yenisifre2."' WHERE `kullanici`='".$satir['kullanici']."';");
					if($sorgu)
					{
						return 1;
					}
					else
					{
						return "Şifre değişme başarısız!";
					}
				}
				else
				{
					return "Yeni şifreniz ve tekrarı uyuşmuyor!";
				}
			}
			else
			{
				return "Girdiğiniz şifre yanlış!";
			}
		}
		else
		{
			return "Kullanıcı bulanamadı...";
		}
		}
		else{return "Giriş yapılmadı";}
	}

	function kullanici_id($sql,$kullanici)
	{
		$sorgu = mysqli_query($sql,"SELECT `id` FROM `uyeler` WHERE `kullanici`='$kullanici'") or die(mysqli_error($sql));;
		$satir = mysqli_fetch_array($sorgu);
		return $satir['id'];
	}
?>