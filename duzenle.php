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
    <title>Düzenle</title>

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
  <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Link paylaşma sitesi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Ana Sayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="ayarlar.php">Ayarlar</a>
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
               header("location:index.php");
             }
             else{$GLOBALS['giris'] = 1; $GLOBALS['username'] = $_SESSION['kullanici'];}
           }
           else{
             header("location:index.php");
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
        <h4 class="mb-3">Düzenle</h4>
        <form class="needs-validation" action="" method="post" novalidate>


        <?php
            if(isset($_GET['id']))
            {
                $sorgu = mysqli_query($sql,"SELECT * FROM `linkler` WHERE `id`=".$_GET['id']);
                $satir = mysqli_fetch_array($sorgu);

                $link = $satir['link'];
                $kisalt = $satir['kisalt'];
                $klasor = $satir['klasor'];
            }
            else
            {
                header('location:profil.php');
            }
        ?>

            <div class="col-12">

              <label for="link" class="form-label">Link düzenleme sayfası</label>
              <div class="input-group has-validation">
                <span class="input-group-text">Link</span>
                <input type="url" class="form-control" id="link" name="link" placeholder="http:// olmak zorunda" value="<?php echo $link; ?>" placeholder="" required>
              <div class="invalid-feedback">
                  
                </div>
              </div>
            </div>

            <div class="col-12">

              <div class="input-group has-validation">
                <span class="input-group-text">Kısaltılmış url</span>
                <input type="text" class="form-control" id="kisalt" name="kisalt" value="<?php echo $klasor; ?>" placeholder="" required>
              <div class="invalid-feedback">
                  
                </div>
              </div>
            </div>

            <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">Şifremi değiş</button>
            <br><br>
            <?php
                if(isset($_POST['submit']))
                {
                    $link = $_POST['link'];
                    $kisalt = $_POST['kisalt'];
                    if($link != "" && $kisalt != "")
                    {
                        $sorgu = mysqli_query($sql,"SELECT * FROM `linkler` WHERE `id`='".$_GET['id']."'") or die(mysqli_error($sql));
                        $satir = mysqli_fetch_array($sorgu);
                        
                        unlink("./".$satir['klasor']."/index.html");
                        rmdir("./".$satir['klasor']."/");

                        if(mkdir("./".$kisalt."/" , 0777 ,true))
                        {
                            $sayfa = fopen("./".$kisalt."/index.html","w");
                            $yazi = '<meta http-equiv="refresh" content="0;../yonlendir.php?id='.$klasor.'">';
                            fwrite($sayfa,$yazi);
                            fclose($sayfa);

                            $klasor = $kisalt;
                            $kisalt = "http://link.bariscangungor.com.tr/".$klasor;

                            $sorgu3 = mysqli_query($sql,"UPDATE `linkler` SET `link`='$link',`kisalt`='$kisalt',`klasor`='$klasor' WHERE `id`=".$_GET['id']."");

                            echo "başarıyla düzenlenmiştir";
                            header("location:profil.php");
                        }
                        else{
                            echo 'hata';
                        }
                    }
                    else{
                        echo "Kutular boş olamaz";
                    }
                }
              ?>
            <br><br><br>

            
            <a href="hesabimiSil.php">Hesabımı sil</a>
            


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