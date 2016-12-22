<?php
  require_once("sessionview.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.view.php';

$page=4; include_once 'header2.php';

if(isset($_GET['visimisi_id']))
{
 $id = $_GET['visimisi_id'];
 extract($crud->getID_visimisi($id)); 
}

?>
<link rel="stylesheet" href="css/homeberita.css" type="text/css"/>

<div class="clearfix"></div><br />

<div style="height:auto;background-color:white;margin-top:-22px;">    
<div class="container">
    <div class ="col-md-offset-2 col-md-8 col-md-offset-2" style="margin-bottom:50px;margin-top:70px;">
        <h2 style="text-align: center;">Deskripsi</h2>
        <hr>
        <?php echo $deskripsi ?>
        <br>
        <br>
        <h2 style="text-align: center;">Tugas dan Wewenang</h2>
        <hr>
        <?php echo $tugas ?>
        <br>
        <br>
        <h2 style="text-align: center;">Visi</h2>
        <hr>
        <?php echo $visi ?>
        <br>
        <br>
        <h2 style="text-align: center;">Misi</h2>
        <hr>
        <?php echo $misi ?>
        <br>

    </div>
  
</div>

<?php include_once 'footer2.php'; ?>