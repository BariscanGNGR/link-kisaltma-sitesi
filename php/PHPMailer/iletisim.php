<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Taş Baskı</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!--slick slider stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- slick slider -->

  <link rel="stylesheet" href="css/slick-theme.css" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="main_body_content">

    <div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              Taş Baskı <img src="images/logo.png" width="50" height="50"/>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                  <a class="nav-link" href="index.html">ANASAYFA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hakkinda.html">HAKKINDA</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="nasil.html">NASIL YAPILIR</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="neler.html">NELER YAPILIR</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="iletisim.html">İLETİŞİM</a>
                </li>
              </ul>
              
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
    </div>
</div>

	
	<?php
	
	if (isset($_POST["gonder"]))
		
	{
		include("baglanti.php");
		$sorgu=mysqli_query($baglan,"INSERT INTO `yorum`(`ad`, `soyad`, `email`, `yorum`) VALUES ('".$_POST['ad']."','".$_POST['soyad']."','".$_POST['email']."','".$_POST['yorum']."')");
	}
	
	
	?>
	
	
	
    <!-- contact section -->

    <section class="contact_section layout_padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-lg-4 offset-md-1 offset-lg-2">
            <div class="form_container">
              <div class="heading_container">
                <h2>
                  İletişim ve Yorum 
                </h2>
              </div>
				
              <form action="" method="post"> 
                <div>
                  <input type="text" name="ad" placeholder="Adınız " />
                </div>
                <div>
                  <input type="text" name="soyad" placeholder="Soyadınız" />
                </div>
                <div>
                  <input type="email" name="email" placeholder="Email" />
                </div>
                <div>
                  <input type="text" name="yorum" class="message-box" placeholder="Mesajınız" />
                </div>
                <div class="d-flex ">
                  <button name="gonder" value="1" type=submit >
                    Gönder
                  </button>
					
                </div>
				  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
				<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
				<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
<div class="row">
<div class="col-sm-12">
<h3>User Comment Example</h3>
</div><!-- /col-sm-12 -->
</div><!-- /row -->
<div class="row">


<div class="col-sm-5">
<div class="panel panel-default">
<div class="panel-heading">
<strong>myusername</strong>
</div>
<div class="panel-body">
Panel content
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div><!-- /col-sm-5 -->


              </form>
            </div>
          </div>
			
          
        </div>
		  
      </div>
    </section>

    <!-- end contact section -->


    <!-- info section -->
    <section class="info_section layout_padding2">
      <div class="container">
        <div class="row info_form_social_row">
          <div class="col-md-8 col-lg-9">
            <div class="info_form">
              <form action="">
                <input type="email" placeholder="E-postanızı giriniz">
                <button>
                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
              </form>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">

            <div class="social_box">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row info_main_row">
          <div class="col-md-6 col-lg-3">
            <div class="info_links">
              <h4>
                Menü
              </h4>
              <div class="info_links_menu">
                <a href="index.html">
                  Anasayfa
                </a>
                <a href="hakkinda.html">
                  Hakkında
                </a>
                <a href="nasil.html">
                  Nasıl Yapılır
                </a>
                <a href="neler.html">
                  Neler Yapılır
                </a>
                <a href="iletisim.html">
                  İletişim
                </a>
              </div>
            </div>
          </div>
          
            
             
          <div class="col-md-6 col-lg-3">
            <h4>
              İletişim
            </h4>
            <div class="info_contact">
              
              
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Telefon +905439282253
                </span>
              
              <a href="mailto:baskikalibi@gmail.com">
                <i class="fa fa-envelope"></i>
                <span>
                  baskikalibi@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end info_section -->

  

  <!-- footer section -->
  <footer class="container-fluid footer_section">
    <div class="container">
      <div class="col-md-11 col-lg-8 mx-auto">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script  src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script  src="js/bootstrap.js"></script>
  <!-- slick slider -->
  <script  src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
  <!-- custom js -->
  <script  src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>