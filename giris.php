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
	  $GLOBALS["hata"]="";
	  //include("cikis.php");
	  
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

	  if(isset($_POST["btn"]))
	  {
		  if(isset($_POST["kullanici"]) && isset($_POST["sifre"]))
		  {
			 $kullanici = $_POST["kullanici"];
			 $sifre = $_POST["sifre"];

			 include("./php/sqlBaglanti.php");
		 	 include("./php/girisIslemleri.php");

			 $giris = giris($sql,$kullanici,$sifre);
			 if($giris == 1)
			 {
				 $_SESSION["kullanici"] = $kullanici;
				 $_SESSION["sifre"] = $sifre;
				 header("location:index.php");
			 }
			 else{
				 $GLOBALS["hata"] = "Giriş başarısız!";
			 }
	  	  }
	  }
	  
	  ?>
	  
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Giriş Yapınız</h1>
      <label for="KullaniciGiris" class="sr-only">Kullanıcı Adı</label>
      <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
      <label for="inputpassword" class="sr-only">sifreword</label>
      <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="btn" value="ok">Giriş Yap</button>
	  <button class="btn btn-sm btn-secondary btn-block mt3" type="button" name="kaydol" value="kaydol" onClick="gonder()">Kaydol</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["hata"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
    </form>
	  
	  <script>
		  function gonder() {
  			window.location = 'kaydol.php';
		  }
	  </script>
	  
  </body>
</html>
<?php ob_end_flush(); ?> 
