<?php ob_start(); ?> 
<!doctype html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Anasayfa</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">

  <?php
    $GLOBALS["formonay"] = "";
    $GLOBALS["emailonay"] = "";
    $GLOBALS['hata'] = "";
    $GLOBALS['giris'] = 0;
    $GLOBALS["username"] = "";
    $giris=0;

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
        $giris = 1;
        $GLOBALS['giris'] = 1;
        $GLOBALS["username"] = $_SESSION['kullanici'];
		  }
      else
      {
        $giris = 0;
        $GLOBALS['giris'] = 0;
        $GLOBALS["formonay"] = "disabled";
      }
	  }
    else{$GLOBALS["formonay"] = "disabled";}

    if($giris == 1)
    {
      include("./php/sqlBaglanti.php");
      $sorgu = mysqli_query($sql,"SELECT * FROM `uyeler` WHERE `kullanici`= '".$_SESSION["kullanici"]."' AND `sifre`='".$_SESSION["sifre"]."'") or die(mysqli_error($sql));
      $row = mysqli_fetch_array($sorgu);

      if($row["email_onay"] == "0")
      {
        //rastgele link verecek
        $GLOBALS["emailonay"] = "disabled";
      }
    }



    if(isset($_POST['submit']))
    {
      if($_POST['url'] != "")
      {
          $sorgu = mysqli_query($sql,"SELECT `id`,`kisalt` FROM `linkler` WHERE 1 ORDER BY `linkler`.`id` DESC");
          $satir = mysqli_fetch_array($sorgu);
          $satirSayi = mysqli_num_rows($sorgu);

          $numara = 0;
          $link = "";

          /*if($satirSayi == 0){
            $numara = 1;
          }
          else{
            $numara = $satir['id'] + 1;
          }

          if($GLOBALS["emailonay"] == "disabled"){
            $link = $numara;
          }
          else{
            if($_POST['kisalt'] != ""){
              $sorgu2 = mysqli_query($sql,"SELECT `kisalt` FROM `linkler` WHERE `kisalt`='".$_POST['kisalt']."'");
              $satirSayi2 = mysqli_num_rows($sorgu2);
              
              if($satirSayi2 > 0){
                $GLOBALS['hata'] = "Bu kısaltma alınmış!";
              }
              else{
                $link = $_POST['kisalt'];
              }
            }
            else{
              $link = $numara;
            }*/
            $index = mysqli_query($sql,"SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'url_kisaltici' AND TABLE_NAME = 'linkler'");
            $numara = mysqli_fetch_array($index)['AUTO_INCREMENT'] + 1;
            
            if($GLOBALS["emailonay"] == "disabled")
            {
              $link = $numara;
            }
            if(isset($_POST['kisalt'])){
              if($_POST['kisalt'] != "")
                {
                  $sorgu2 = mysqli_query($sql,"SELECT `kisalt` FROM `linkler` WHERE `kisalt`='".$_POST['kisalt']."'");
                  $satirSayi2 = mysqli_num_rows($sorgu2);
                  
                  if($satirSayi2 > 0){
                    $GLOBALS['hata'] = "Bu kısaltma alınmış!";
                  }
                  else{
                    if($_POST['kisalt'] != "js" && $_POST['kisalt'] != "css" && $_POST['kisalt'] != "php" && $_POST['kisalt'] != "assets")
                      $link = $_POST['kisalt'];
                  }
                }
                else
                {
                  $link = $numara;
                }
            }
            else
            {
              $link = $numara;
            }
           

          }
          if($GLOBALS['hata'] == "")
          {
            if(mkdir("./".$link."/" , 0777 ,true))
            {
              $sayfa = fopen("./".$link."/index.html","w");
              $yazi = '<meta http-equiv="refresh" content="0;../yonlendir.php?id='.$link.'">';
              fwrite($sayfa,$yazi);
              fclose($sayfa);

              $uye_id = kullanici_id($sql,$_SESSION['kullanici']);
              $url = $_POST['url'];
              
              $klasor = $link;
              $link = "http://link.bariscangungor.com.tr/".$link;

              $sorgu3 = mysqli_query($sql,"INSERT INTO `linkler`( `uye_id`, `link`, `kisalt`,klasor) VALUES ('$uye_id','$url','$link','$klasor')");

              $GLOBALS['hata'] = "başarıyla eklenmiştir";
            }
          }
        }
    

  ?>

<nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Link paylaşma sitesi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
      <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayarlar.php">Ayarlar</a>
          </li>
        </ul>

        <?php 
          if($GLOBALS['giris'] == 1)
          {
              echo ' <ul class="navbar-nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link active" href="profil.php">'.$GLOBALS["username"].'</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="php/cikisyap.php">Çıkış yap</a>
              </li>
            </ul>';
          }
          else
          {
              echo '<ul class="navbar-nav justify-content-end">
              <li class="nav-item">
                  <a class="nav-link" href="kaydol.php">Üye ol</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="giris.php">Giriş yap</a>
                </li>
              </ul>';
          }
        
        ?>
        

       

      </div>
    </div>
  </nav>

<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Link Ekleme formu</h2>
      <p class="lead">Link kısalt</p>
    </div>

    <div class="row g-5">
      
      <div class="col-md-7 col-lg-12">
        <h4 class="mb-3">Form</h4>
        <form class="needs-validation" method="post" action="" novalidate>


            <div class="col-12">
              <label for="kullanici" class="form-label"  >Link</label>
              <div class="input-group has-validation">
                <span class="input-group-text" >URL</span>
                <input type="url" class="form-control" name="url" id="kullanici" placeholder="http:// olmak zorunda" required <?php echo $GLOBALS["formonay"]; ?>>
              <div class="invalid-feedback">
                  geçerli URL girmen gerekiyor.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Yeni kısaltılmış link <span class="text-muted">(İsteğe bağlı)</span></label>
              <input type="email" class="form-control" name="kisalt" id="email" placeholder="(boş bırakırsanız rastgele atanacak)" <?php if($GLOBALS["formonay"] == "disabled" ||
    $GLOBALS["emailonay"] == "disabled") echo "disabled"; ?>>
              <div class="invalid-feedback">
                
              </div>
            </div>

            

            


          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit" value="1" <?php echo $GLOBALS["formonay"]; ?>>Tamamla</button>
        </form>
        <?php echo $GLOBALS['hata']; ?>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Barışcan Güngör</p>

  </footer>
</div>


    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?> 