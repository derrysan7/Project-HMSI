<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.visimisi.php';

$crud = new crud($DB_con);
if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $bdeskripsi = $_POST['txt_deskripsi'];
    $btugas = $_POST['txt_tugas'];
    $bvisi = $_POST['txt_visi'];
    $bmisi = $_POST['txt_misi'];
 
 if($crud->update($id,$bdeskripsi,$btugas,$bvisi,$bmisi))
 {
  $msg = "<div class='alert alert-info'>
    <strong>Success!</strong> Record was updated successfully!
    </div>";
 }
 else
 {
  $msg = "<div class='alert alert-warning'>
    <strong>Failed!</strong> ERROR while updating record !
    </div>";
 }
}

if(isset($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 extract($crud->getID($id)); 
}

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
                  <li>
                    <a href="crud_kegiatan_utama.php">Kegiatan</a>
                  </li>
                  <li class="active">
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
          <?php
          if(isset($msg))
          {
           echo $msg;
          }
          ?>
          </div>

          <div class="clearfix"></div><br />

          <div class="container" style="margin-top: -40px;">
            
               <form method='post'>
                      <div class="col-md-8">
                      <h2>Deskripsi</h2>
                      <textarea class="form-control" rows="15"  wrap="hard" cols="80" name="txt_deskripsi" id="deskripsi" name="txt_deskripsi" required><?php echo $deskripsi ?></textarea>
                      <h2>Tugas dan Wewenang</h2>
                      <textarea class="form-control" rows="15"  wrap="hard" cols="80" name="txt_tugas" id="deskripsi" name="txt_deskripsi" required><?php echo $tugas ?></textarea>
                      <h2>Visi</h2>
                      <textarea class="form-control" rows="15"  wrap="hard" cols="80" name="txt_visi" id="deskripsi" name="txt_deskripsi" required><?php echo $visi ?></textarea>
                      <h2>Misi</h2>
                      <textarea class="form-control" rows="15"  wrap="hard" cols="80" name="txt_misi" id="deskripsi" name="txt_deskripsi" required><?php echo $misi ?></textarea>
                      </div>

                      <br>
                      <div class="col-xs-8">
                          <button type="submit" class="btn btn-primary" name="btn-update">
                          <span class="glyphicon glyphicon-edit"></span>  Update this Record
                          </button>
                      </div>
           
                </form>             
          </div>

    </div>
  </div>
</div>





<?php include_once 'footer.php'; ?>