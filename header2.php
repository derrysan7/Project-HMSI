<?php
	require_once("class.user.php");
	$auth_user = new USER();

  include_once 'dbconfigcrud.php';
  include_once 'class.crud.view.php';

  $crud = new crud($DB_con);

  error_reporting(0);

  if ($_SESSION['user_session']!=""){
      $userId = $_SESSION['user_session'];
      
      $stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
      $stmt->execute(array(":userId"=>$userId));
      
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
      $viewcrudLabel=$auth_user->crudLabel($userRow['kodePermission']);
      $crudLink=$auth_user->crudLink($userRow['kodePermission']);
      $userinfo="yes";
      $signinbutton="none";
  } else{
      $userinfo="none";
      $signinbutton="yes";
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>HMSI UKDW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link href="css/font-face.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <!-- Carousel -->
    <link rel="stylesheet" href="css/carousel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <link rel="stylesheet" href="css/monthly.css">
    <link rel="stylesheet" href="css/style.css" type="text/css"  />

    <!-- JS -->
    <script>
    $(document).ready(function(){    
      // Add smooth scrolling to all links in navbar + footer link
      $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();
        // Store hash
        var hash = this.hash;
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
          }, 900, function(){
          // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
      } // End if
      });
    })
    </script>

    <script type="text/javascript">
      $(document).ready(function($){
      var nav = $('#mainNav');
          $(window).scroll(function () {
              if ($(this).scrollTop() > 258) {
                  nav.addClass("f-nav");
              } else {
                  nav.removeClass("f-nav");
              }
          });
      });
      $("#myCarousel").carousel();
    </script>
    <style>
      body,
      html {
        height: 100%;
      }
      
      .f-nav {
        z-index: 9999;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
      }
      
      a:hover {
        text-decoration: none;
      }
    </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar">

        <div class="w3-container">
          <a href="index.php">
            <img src="imagenav/logoHMSI.png" class="img-responsive img-hmsi" alt="logoHMSI"  >
            <div style="color:black;font-weight:bold">
              <h1>Himpunan Mahasiswa Sistem Informasi</h1>
              <h4>Universitas Kristen Duta Wacana</h4>
            </div>
          </a>

        </div>

<div id="mainNav">
    <nav class="navbar navbar-inverse" style="border-radius:0; text-align: center; margin-bottom:0px;">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
    </button>
      <div class="container-fluid navbar-collapse collapse" id="navbar">
        
        <!--EMPTY-->
        <div class="col-md-2">
          &nbsp;
        </div>
        
        <!--HOME-->
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="<?php if ($page == '1'){ echo 'active'; } ?>"><a href="index.php">BERANDA</a></li>
        </div>
        
        <!--KEGIATAN-->
        <ul class="nav navbar-nav  col-md-2">
          <li class="dropdown <?php if ($page == '2'){ echo 'active'; } ?>">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">KEGIATAN<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="kegiatan.php">ARTIKEL</a></li>
                <li><a href="https://drive.google.com/drive/folders/0B4by36dVVfYWRkxYVF9CZnRSUDQ" target="_blank">GALERI</a></li>
              </ul>
            </li>
        </ul>
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="dropdown <?php if ($page == '4'){ echo 'active'; } ?>">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">TENTANG<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="visimisi.php?visimisi_id=1">VISI & MISI</a></li>
                <li><a href="struktur.php">STRUKTUR ORGANISASI</a></li>
              </ul>
            </li>
        </div>
        
        <!--CONTACT-->
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="<?php if ($page == '5'){ echo 'active'; } ?>"><a href="kontak.php">KONTAK KAMI</a></li>
          </ul>
        </div>
        
        <!--ADMIN-->
         <div class="col-md-2">
           <ul class="nav navbar-nav navbar-right" style="display:<?php echo $userinfo ?>;">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                  <?php echo $userRow['userEmail']; ?>
                  <span class="glyphicon glyphicon-cog">
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $crudLink ?>"><?php echo $viewcrudLabel ?></a></li>
                <li><a href="logout.php?logout=true">LOG OUT</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
