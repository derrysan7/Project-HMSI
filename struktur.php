<?php
  require_once("sessionview.php");
?>

<?php $page=4; include_once 'header2.php'; ?>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>
<link rel="stylesheet" href="css/struktur.css">

    <div class="clearfix"></div>
    	
<div id="divbackground">
  <div class="container">
    <div class="col-md-12">
    <h1 align="center" class="marginh1">Bagan Organisasi</h1>
    <hr>
        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
            <?php
              $query = "SELECT * FROM bagan_org";
              $crud->dataviewbaganorg($query);
            ?>
        </div>
      <div class="col-md-12">
      <h1 align="center" class="marginh1">Struktur Organisasi</h1>
      <hr>
        <h2>Badan Pengurus Harian</h2>
        <hr class="hr-style">
        <div class="container container-org">
            <?php
                $query = "SELECT * FROM struktur WHERE divisi_ang = 'Badan Pengurus Harian' ORDER BY urutan";
                $crud->dataviewstrukturorg($query);
            ?>
        </div>
        <br>
        <br>
        <br>

        <h2>Sosial Kemahasiswaan</h2>
        <hr class="hr-style">
        <div class="container container-org">
            <?php
                $query = "SELECT * FROM struktur WHERE divisi_ang = 'Sosial Kemahasiswaan' ORDER BY urutan";
                $crud->dataviewstrukturorg($query);
            ?>
        </div>
        <br>
        <br>
        <br>

        <h2>Humas</h2>
        <hr class="hr-style">
        <div class="container container-org">
            <?php
                $query = "SELECT * FROM struktur WHERE divisi_ang = 'Humas' ORDER BY urutan";
                $crud->dataviewstrukturorg($query);
            ?>
        </div>
        <br>
        <br>
        <br>

        <h2>Riset dan Inovasi</h2>
        <hr class="hr-style">
        <div class="container container-org">
            <?php
                $query = "SELECT * FROM struktur WHERE divisi_ang = 'Riset dan Inovasi' ORDER BY urutan";
                $crud->dataviewstrukturorg($query);
            ?>
        </div>
        <br>
        <br>
        <br>

        <h2>Pendidikan</h2>
        <hr class="hr-style">
        <div class="container container-org">
            <?php
                $query = "SELECT * FROM struktur WHERE divisi_ang = 'Pendidikan' ORDER BY urutan";
                $crud->dataviewstrukturorg($query);
            ?>
        </div>
        <br>
        <br>
        <br>
        </div>
      </div>
    </div>

</div>

<?php include_once 'footer2.php'; ?>