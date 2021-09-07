<?php ob_start(); ?> 
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
            <a class="nav-link" aria-current="page" href="index.php">Ana Sayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayarlar.php">Ayarlar</a>
          </li>
        </ul>
        
        <?php 
           $GLOBALS['giris'] = 0;
           $GLOBALS['username'] = "";
           if(!isset($_SESSION)) 
           { 
             session_start(); 
           } 
           if(isset($_SESSION['kullanici']) && isset($_SESSION['sifre']))
           {
             include("./php/sqlBaglanti.php");
             include("./php/girisIslemleri.php");
             $giris = giris($sql,$_SESSION['kullanici'],$_SESSION['sifre']);
             if($giris == 0)
             {
              // header("location:index.php");
             }
             else{$GLOBALS['giris'] = 1; $GLOBALS['username'] = $_SESSION['kullanici'];}
           }
           else{
            // header("location:index.php");
           }


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
        <h4 class="mb-3">5 saniye içinde siteye gideceksiniz.</h4>
        <form class="needs-validation" method="post" action="" novalidate>
        <div class="text-center">
            <img class="d-block mx-auto mb-4" src="./assets/brand/1.png" alt="" width="300" height="250">
            <h4 class="mb-2">opsiyonel reklam</h4>
             </div>

            </div>

            <?php
                if(isset($_GET['id']))
                {   
                    include("./php/sqlBaglanti.php");
                    $id = $_GET['id'];
                    $sorgu = mysqli_query($sql,"SELECT `link` FROM `linkler` WHERE `klasor`='$id'");
                    $satir = mysqli_fetch_array($sorgu);
                    
                    $link = $satir['link'];
                    echo '<meta http-equiv="refresh" content="5;URL='.$link.'">';
                }
            ?>

          <hr class="my-4">
        </form>
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