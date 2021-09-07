<?php ob_start(); ?> 
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icon.png">
	  <!--meta http-equiv="refresh" content="900;url=otomatikcikis.php" /-->

    <title>BB Photography</title>

    <link href="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="http://bariscangungor.com.tr/webprojesi/giris.css?v=1" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>

  <body class="text-center">
	  <?php	  
	  $GLOBALS['hata'] = " ";
	  
	  if(!isset($_SESSION)) 
      { 
        session_start(); 
      } 
	  if(isset($_SESSION['kullanici']) && isset($_SESSION['sifre']))
	  {
		  include("./php/sqlBaglanti.php");
		  include("./php/girisIslemleri.php");
		  $giris = giris($sql,$_SESSION['kullanici'],$_SESSION['sifre']);
		  if($giris == 1)
		  {
			  header("location:index.php");
		  }

	  }

		  if(isset($_POST["kaydol"]))
		  {
		  $email = $_POST['email'];
		  $kullanici = $_POST['kullanici'];
		  $sifre = $_POST['sifre'];
		  $sifre2 = $_POST['sifretekrar'];
		  
		  $h = 0;
		  
		  if($sifre != $sifre2)
		  {
			  $GLOBALS["hata"] = $GLOBALS["hata"]."Şifreniz ve tekrarı aynı değil!\n";
			  $h = 1;	
		  }
		  
		  if(strlen($sifre) < 7)
		  {
			  $GLOBALS["hata"] = $GLOBALS["hata"]."Şifreniz 8 hanenin altında olamaz\n";
			  $h = 1;		
		  }
		  
		  if($h == 0)
		  {		
			  include("./php/sqlBaglanti.php");
		  	  include("./php/girisIslemleri.php");
		  
			  $kaydol=kaydol($sql,$kullanici,$sifre,$email);
			  if($kaydol == 1)
			  {		  
				  $_SESSION["kullanici"] = $kullanici;
				  $_SESSION["sifre"] = $sifre;
				  
				  header("location:index.php");
			  }
			  else
			  {		
				  $GLOBALS["hata"] = "Hata!!";
			  }
		  }
	  }
	  
	  
	  ?>
	  
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Üye Olma Formu</h1>
	  <label for="emailgiris" class="sr-only">E Posta</label>
      <input type="email" name="email" class="form-control" placeholder="Email " required autofocus>
      <label for="KullaniciGiris" class="sr-only">Kullanıcı Adı</label>
      <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
      <label for="inputsifreword" class="sr-only">Şifre</label>
      <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
	  <label for="inputsifreword2" class="sr-only">Şifre Tekrar</label>
      <input type="password" name="sifretekrar" class="form-control" placeholder="Şifrenizi Tekrar giriniz" required>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="kaydol" value="ok">Kaydol</button>
	  <button class="btn btn-sm btn-secondary btn-block mt3" type="submit" name="btn" value="gonder" onClick="gonder()">Giriş Yap</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["hata"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
    </form>
	  <script>
		  function gonder() {
  			window.location = 'giris.php';
		  }
	  </script>
	  
  </body>
</html><?php ob_end_flush(); ?> 
