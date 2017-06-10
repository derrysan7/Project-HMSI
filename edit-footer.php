<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.footer.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    extract($crud->getID_footer($id));
    $bnama = $_POST['txt_nama'];
    $burl = $_POST['txt_url'];
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if($imgFile)
    {
        $upload_dir = 'user_images_footer/'; // upload directory   
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = uniqid('', true).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {           
            if($imgSize < 512000)
            {
                unlink($upload_dir.$gambar);
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else
            {
                $errMSG = "Sorry, your file is too large it should be less then 500KB";
            }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
        }   
    }
    else
    {
        // if no image selected the old image remain as it is.
        $userpic = $gambar; // old image from database
    }    

 
    if(!isset($errMSG))
    {
         if($crud->update_footer($id,$bnama,$burl,$userpic))
         {
          $msg = "<div class='alert alert-info'>
            <strong>Success!</strong> Record was updated successfully <a href='listfooter.php'>HOME</a>!
            </div>";
         }
         else
         {
          $msg = "<div class='alert alert-warning'>
            <strong>Failed!</strong> ERROR while updating record !
            </div>";
         }
    }
}

if(isset($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 extract($crud->getID_footer($id)); 
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
 echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">

    <?php
    if(isset($errMSG)){
        ?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
    }
    ?>
  
     <form method="post" enctype="multipart/form-data"> 
            <div class="col-xs-8">
                <label>Gambar (JPEG, JPG, PNG, GIF)</label>
                <div class="col-xs-4">
                    <p><img src="user_images_footer/<?php echo $gambar; ?>" style="width: 100%;" class="img-circle"/></p> 
                </div>         
                <input class="input-group" type="file" name="user_image" accept="image/*" />
            </div>

            <div class="col-xs-8">
                <label>Nama</label>          
                <input type='text' name='txt_nama' class='form-control' value="<?php echo $nama ?>" maxlength="30" required>
            </div>

            <div class="col-xs-8">
                <label>URL</label>          
                <input type='text' name='txt_url' class='form-control' value="<?php echo $url ?>" maxlength="2083" required>
            </div>

            <br>
            <div class="col-xs-8">
                <button type="submit" class="btn btn-primary" name="btn-update">
                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                </button>
                <a href="listfooter.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
 
    </form>
     
     
</div>

<?php include_once 'footer.php'; ?>