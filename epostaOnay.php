<?php ob_start(); ?> 
<?php
	
if(!isset($_SESSION)) 
{ 
        session_start(); 
} 
if(isset($_SESSION['kullanici']) && isset($_SESSION['sifre']))
{
	include("./php/sqlBaglanti.php");
	include("./php/girisIslemleri.php");
	$giris = giris($sql,$_SESSION['kullanici'],$_SESSION['sifre']);
	if($giris == 0) {
		header("location:index.php");}
	else{
		$GLOBALS['giris'] = 1;
	}
}
else{
header("location:index.php");
}
include("./php/sqlBaglanti.php");

$sorguOnay = mysqli_query($sql,"SELECT `email_onay` FROM `uyeler` WHERE `kullanici`='".$_SESSION['kullanici']."'");
$sonucOnay = mysqli_fetch_array($sorguOnay);

if($sonucOnay['email_onay'] == 1)
{
	header("location:ayarlar.php");
}

else
{
	$GLOBALS['msg']='';

	$sorguEposta = mysqli_query($sql,"SELECT `email` FROM `uyeler` WHERE `kullanici`='".$_SESSION['kullanici']."'");
	$sonucEposta = mysqli_fetch_array($sorguEposta);

	$eposta = $sonucEposta['email']; //işte buraya eposta gelecek
	$random ;

	if(!isset($_SESSION['kod']))
	{	
		$random = strval(rand(100000,999999));
		$_SESSION['kod'] = $random;
	}
	else
	{
		if($_SESSION['kod'] == "-1")
		{
			$random = strval(rand(100000,999999));
			$_SESSION['kod'] = $random;
		}
	}
	include('./php/mail.php');
	epostaGonder($eposta,"Link kısaltma sitesi","Doğrulama kodunuz :".$_SESSION['kod']);

	if(isset($_POST['kaydol']))
	{
		$girdi = strval($_POST['bir']."".$_POST['iki']."".$_POST['uc']."".$_POST['dort']."".$_POST['bes']."".$_POST['alti']);
		
		if($girdi == $_SESSION['kod'])
		{
			$sorgu = mysqli_query($sql,"UPDATE `uyeler` SET `email_onay` = '1' WHERE `uyeler`.`kullanici` = '".$_SESSION['kullanici']."';");
			$_SESSION['kod'] = "-1";
			header("location:index.php");
		}
		else
		{
			echo "hatalı kod";
		}
	}
}

if(isset($_POST['vazgec']))
{
	header("location:index.php");
}
?>

<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icon.png">
    <title>BB Photography</title>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="giris.css?v=1" rel="stylesheet">
	 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/holder.min.js"></script>
	<script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
	<script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  </head>

  <body class="text-center"> 
	  <br><br><br><br>
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">E-Postana giden doğrulama kodunu buraya gir</h1>
    <div class="input-group d-flex  mx-auto" style="max-width: 50%;">
		<input type="text" size="1" maxlength="1" name="bir" class="form-control" placeholder="" required>
      	<input type="text" size="1" maxlength="1" name="iki" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="uc" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="dort" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="bes" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="alti" class="form-control" placeholder="" required>
	</div>  
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="kaydol" value="ok">Onayla</button>
	  <button class="btn btn-sm btn-secondary btn-block mt-2" type="reset" name="reset" value="res">Kutucukları sil</button>
	  <button class="btn btn-sm btn-secondary btn-block mt-2" type="yonlendir" name="yonlendir" value="yon">Vazgeç</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["msg"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
	  
    </form>
	  <script>
		  $(".form-control").keyup(function () {
    	  if (this.value.length == this.maxLength) {
      	  $(this).next('.form-control').focus();
    	     }
		  });
</script>
	  
  </body>
</html><?php ob_end_flush(); ?> 