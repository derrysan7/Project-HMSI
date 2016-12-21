<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.kegiatan.php';

$crud = new crud($DB_con);
?>
<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="styleberita.css" type="text/css">
<link href="bootstrap/css/navbar-fixed-side.css" rel="stylesheet" />
<div class="clearfix"></div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
      <nav class="navbar navbar-default navbar-fixed-side">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="crud_berita_utama.php">Beranda</a>
                  </li>
                  <li class="active">
                    <a href="crud_kegiatan_utama.php">Kegiatan</a>
                  </li>
                  <li>
                    <a href="edit-visimisi.php?edit_id=1">Visi dan Misi</a>
                  </li>
                  <li>
                    <a href="crud_struktur_utama.php">Struktur Organisasi</a>
                  </li>
                  <li>
                    <a href="listfooter.php">Footer</a>
                  </li>
                </ul>
      </nav>
    </div>
    <div class="col-sm-9 col-lg-10">
          <div class="container">
          <h2>Daftar Kegiatan</h2>
          <a href="add-kegiatan.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
               <table class='table table-bordered table-responsive'>
               <tr>
               <th class="col-sm-1">#</th>
               <th class="col-sm-2">Tanggal Dibuat</th>
               <th class="col-sm-5">Judul</th>
               <th class="col-sm-2">Nama Penulis</th>
               <th colspan="2" align="center" class="col-sm-1">Actions</th>
               </tr>
               <?php
            $query = "SELECT * FROM kegiatan ORDER BY tanggaldib DESC";       
            $records_per_page=5;
            $newquery = $crud->paging($query,$records_per_page);
            $crud->dataview($newquery);
            ?>
              <tr>
                  <td colspan="6" align="center">
              <div class="pagination-wrap">
                      <?php $crud->paginglink($query,$records_per_page); ?>
                   </div>
                  </td>
              </tr>
           
          </table>                
          </div>


    </div>
  </div>
</div>



<?php include_once 'footer.php'; ?>