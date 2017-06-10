<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();
$userIdloggedin = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
$stmt->execute(array(":userId"=>$userIdloggedin));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'dbconfigcrud.php';
include_once 'class.crud.kegiatan.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-save']))
{
    $buserid = $_POST['txt_userid'];
    $bjudul = htmlspecialchars($_POST['txt_judul']);
    $bdeskripsi = $_POST['txt_deskripsi'];
    $bnamapen = $_POST['txt_namapen'];
    $name = htmlspecialchars($_POST['txt_name']);
    $startdate = $_POST['dt_start'];
    $enddate = $_POST['dt_end'];
    $starttime = $_POST['tm_start'];
    $endtime = $_POST['tm_end'];
    $color = $_POST['label_color'];

    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if (!empty($imgFile)) {

        $upload_dir = 'user_images_kegiatan/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
        // rename uploading image using random generator
        $userpic = uniqid('', true).".".$imgExt;
            
        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){           
            // Check file size '1MB'
            if($imgSize < 1048576)              {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else{
                $errMSG = "Sorry, your file is too large it should be less then 1MB";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
        }
        
    }else{
        $userpic = placeholder.".".png;
    }


    if(!isset($errMSG))
    {
        if($crud->create($buserid,$bjudul,$bdeskripsi,$userpic,$bnamapen,$name,$startdate,$enddate,$starttime,$endtime,$color,$url))
        {
            $autoid = $crud->lastID(); 
            $genurl = "detailkegiatan?detail_id=" . $autoid;
            $crud->updateurlkegiatan($autoid,$genurl);

        header("Location: add-kegiatan.php?inserted");
        }
        else
        {
        header("Location: add-kegiatan.php?failure");
        }
    }  
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
 ?>
    <div class="container">
 <div class="alert alert-info">
    <strong>SUCCESS!</strong>Record was inserted successfully <a href="listkegiatan.php">HOME</a>!
 </div>
 </div>
    <?php
}
else if(isset($_GET['failure']))
{
 ?>
    <div class="container">
 <div class="alert alert-warning">
    <strong>FAILED!</strong> ERROR while inserting record !
 </div>
 </div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">
    <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    ?>
  
    <form method="post" enctype="multipart/form-data">
        <div class="col-md-8">
          <label>Nama Kegiatan di Kalender</label>
          <input type='text' name='txt_name' class='form-control' maxlength="30" required>
        </div>

        <div class="col-md-12">
          <div class="col-md-4">
            <label>Date Start</label>
            <input type='date' name='dt_start' class='form-control' required>
          </div>
          <div class="col-md-4">
            <label>Date End</label>
            <input type='date' name='dt_end' class='form-control' required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="col-md-4">
            <label>Time Start</label>
            <input type='time' name='tm_start' class='form-control' required>
          </div>
          <div class="col-md-4">
            <label>Time End</label>
            <input type='time' name='tm_end' class='form-control' required>
          </div>
        </div>

        <div class="col-md-8">
          <label>Select label color </label>
          <input class="input-group" type="color" name="label_color" value="#ff0000" />
        </div>

        <div class="col-md-8">
            <label>Gambar (JPEG, JPG, PNG, GIF) *Optional</label>          
            <input class="input-group" type="file" name="user_image" accept="image/*" />
        </div>

        <div class="col-md-8">
            <label>Judul Kegiatan</label>          
            <input type='text' name='txt_judul' class='form-control' maxlength="80" required>
        </div>

        <div class="col-md-8">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="40"  wrap="hard" cols="80" name="txt_deskripsi" id="deskripsi" name="txt_deskripsi" required></textarea>
        </div>
        
        <div class="col-md-8">
            <br>
            <input type='hidden' name='txt_userid' class='form-control' value='<?php echo $userRow['userId'] ?>' readonly>
        </div>

        <div class="col-md-8">
            <br>
            <input type='hidden' name='txt_namapen' class='form-control' value='<?php echo $userRow['fullname'] ?>' readonly>
        </div>
        <br>

        <div class="col-md-8">
            <button type="submit" class="btn btn-primary" name="btn-save">
                <span class="glyphicon glyphicon-plus"></span> Create New Record
            </button>  
            <a href="listkegiatan.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
        </div>

    </form>
     
     
</div>

<?php include_once 'footer.php'; ?>