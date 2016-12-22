<?php
  require_once("session.php");
  require_once("permvaliduser.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();

  $userIdloggedin = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
  $stmt->execute(array(":userId"=>$userIdloggedin));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'dbconfigcrud.php';
include_once 'class.crud.php';

$crud = new crud($DB_con);
if(isset($_POST['btn-update']))
{
 $userId = $_GET['edit_id'];
  if ($userRow['userId'] != $userId){

      if(isset($_GET['edit_id']))
        {
         $userId = $_GET['edit_id'];
         extract($crud->getID($userId)); 
        }

      $uname = strip_tags($_POST['userName']);
      $umail = strip_tags($_POST['userEmail']);
      $ufullname = strip_tags($_POST['fullname']);
      $uperm = strip_tags($_POST['permission']);


        if(strlen(trim($uname)) == 0)  {
        $error[] = "provide username !"; 
        $msg = "<div class='alert alert-warning'>
                    provide username !
                    </div>";  
        }
        else if($umail=="") {
            $error[] = "provide email id !";
            $msg = "<div class='alert alert-warning'>
                    provide email id !
                    </div>";   
        }
        else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
            $msg = "<div class='alert alert-warning'>
                    Please enter a valid email address !
                    </div>";
        }
        else if(strlen(trim($ufullname)) == 0) {
            $error[] = "provide fullname !";
            $msg = "<div class='alert alert-warning'>
                    provide fullname !
                    </div>";    
        }

        else
        {
            try
            {
                $user = new USER();
                $stmt2 = $user->runQuery("SELECT userName, userEmail FROM users WHERE userName=:uname OR userEmail=:umail");
                $stmt2->execute(array(':uname'=>$uname, ':umail'=>$umail));
                $row2=$stmt2->fetch(PDO::FETCH_ASSOC);
                    
                if($row2['userName'] == $uname && $uname != $userName) {
                    $msg = "<div class='alert alert-warning'>
                    Sorry username already taken !
                    </div>";
                }
                else if($row2['userEmail'] == $umail && $umail != $userEmail) {
                    $msg = "<div class='alert alert-warning'>
                    Sorry email id already taken !
                    </div>";
                }
                else
                {
                    if($crud->update($userId,$uname,$umail,$ufullname,$uperm))
                     {
                      $msg = "<div class='alert alert-info'>
                        <strong>SUCCESS!</strong> Record was updated successfully <a href='listuser.php'>HOME</a>!
                        </div>";
                     }
                     else
                     {
                      $msg = "<div class='alert alert-warning'>
                        <strong>SORRY!</strong> ERROR while updating record !
                        </div>";
                     }
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   
   
     
    }else {
        exit("Edit Error! User is logged in");
    }
}

if(isset($_POST['btn-resend']))
{
    $uname2 = strip_tags($_POST['userName']);
    $umail2 = strip_tags($_POST['userEmail']);
    $code2 = bin2hex(openssl_random_pseudo_bytes(16));

    $stmt = $auth_user->runQuery("UPDATE users SET tokenCode=:token WHERE userEmail=:umail");
    $stmt->execute(array(":token"=>$code2,"umail"=>$umail2));

    $autoid2 = $_GET['edit_id'];    
    $key2 = base64_encode($autoid2);
    $autoid2 = $key2;
    
    $message2 = "          
          Hello $uname2,
          <br /><br />
          Welcome to HMSI<br/>
          To complete your registration  please , just click the following link<br/>
          <br /><br />
          <a href='https://hmsi.fti.ukdw.ac.id/verify.php?id=$autoid2&code=$code2'>Click HERE to Activate</a>
          <br /><br />
          Thanks,";
          
    $subject2 = "Confirm Registration";
          
    $crud->send_mail($umail2,$message2,$subject2); 

    $msg = "<div class='alert alert-info'>
      Activation Email Resend Success, <a href='listuser.php'>HOME</a>!
      </div>";
}

if(isset($_GET['edit_id']))
{
 $userId = $_GET['edit_id'];
 extract($crud->getID($userId)); 
}

?>
<?php include_once 'header.php'; ?>

<?php
if ($kodePermission == 1){
    $namaPermission = "Super Admin";
} else {
    $namaPermission = "Author";
}
?>
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
  
     <form method='post'>
 
    <table class='table table-bordered'>
        
        <tr>
            <td>Username</td>
            <td><input type='text' name='userName' class='form-control' value="<?php echo $userName; ?>" maxlength="30" required></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='userEmail' class='form-control' value="<?php echo $userEmail; ?>" maxlength="60" required></td>
        </tr>

        <tr>
            <td>Full Name</td>
            <td><input type='text' name='fullname' class='form-control' value="<?php echo $fullname; ?>" maxlength="50" required></td>
        </tr>
 
        <tr>
            <td>Permission</td>
            <td><select class="form-control" name="permission" required>
              <option value="Super Admin" <?php if($namaPermission=="Super Admin") echo 'selected="selected"'; ?>>Super Admin</option>
              <option value="Author" <?php if($namaPermission=="Author") echo 'selected="selected"'; ?>>Author</option>
             </select></td>
        </tr>

        <tr>
            <td>Activation Email</td>
            <td><button type="submit" class="btn btn-warning" name="btn-resend">Resend Activation Email</td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
       <span class="glyphicon glyphicon-edit"></span>  Update this Record
    </button>
                <a href="listuser.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>