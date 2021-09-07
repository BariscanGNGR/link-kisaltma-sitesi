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
    <title>Hesap sil</title>

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
        <h4 class="mb-3">Hesabımı sil</h4>
        <form class="needs-validation" action="" method="post" novalidate>


            <div class="col-12">

              <label for="sifre" class="form-label">Hesabınızı silmek için şifre onayı gerekmektedir.</label>
              <div class="input-group has-validation">
                <span class="input-group-text">Şifreniz</span>
                <input type="password" class="form-control" id="sifre" name="sifre" placeholder="" required>
              <div class="invalid-feedback">
                  
                </div>
              </div>
            </div>

            <div class="col-12">
                  
                </div>
              </div>
            </div>
            <br><button class="w-100 btn btn-primary btn-lg" name="submit" type="submit">SİL!!!</button>

            <br><br><br>
            
            <?php
                //include("./php/sqlBaglanti.php");
                //include("./php/girisIslemleri.php");

                if(isset($_POST['submit']))
                {
                    if($_POST['sifre'] != "")
                    {
                        $sifre = $_POST['sifre'];
                        $giris = giris($sql,$_SESSION['kullanici'],$sifre);

                        if($giris == 1)
                        {
                            $idSorgu = mysqli_query($sql,"SELECT `id` FROM `uyeler` WHERE `kullanici`='".$_SESSION['kullanici']."'") or die(mysqli_error($sql));
                            $id = mysqli_fetch_array($idSorgu)['id'];
                            $sorgu = mysqli_query($sql,"SELECT * FROM `linkler` WHERE `uye_id`='".$id."'") or die(mysqli_error($sql));
                            $satirSayi = mysqli_num_rows($sorgu);

                            for($i = 0 ; $i <= $satirSayi ; $i++)
                            {
                                $satir = mysqli_fetch_array($sorgu);
                                unlink("./".$satir['klasor']."/index.html");
                                rmdir("./".$satir['klasor']."/");
                            }
                            
                            $sorgu2 = mysqli_query($sql,"DELETE FROM `linkler` WHERE `uye_id`='$id'") or die(mysqli_error($sql));
                            $sorgu3 = mysqli_query($sql,"DELETE FROM `uyeler` WHERE `uyeler`.`id` ='$id'") or die(mysqli_error($sql));

                            echo '<meta http-equiv="refresh" content="0;./php/cikisyap.php">';

                        }
                        else{
                            echo "Şifreniz doğru değil!";
                        }
                    }
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