<?php

class crud
{
 private $db; 
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 
 public function getID($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }

  public function getID_kegiatan($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM kegiatan WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function getID_carousel($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita_carousel WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }

 public function dataview_calender($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   $eventhmsi = array();
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        $eventhmsi[] = $row;
      }
      $jsontext='{"monthly":'.json_encode($eventhmsi,JSON_PRETTY_PRINT)."}";
      //write to json file
      $fp = fopen('events.json', 'w');
      // print_r( $eventhmsi);
      fwrite($fp, $jsontext);
      fclose($fp);
  }
 }
 
 public function getID_sidelink($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita_sidelink WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 
public function dataviewhomeberita($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
      $tanggalbaru = date_create($row['tanggaldib']);
    ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                    <a class="beritalinkcustom" href="detailberita.php?detail_id=<?php print($row['id']); ?>"><h3><?php print($row['judul']); ?></h3></a>
                    </div>
                    <h5 style="font-size: 16px;"> By <?php print($row['namapen']); ?></h5>
                    <h5 style="font-size: 16px;">Published <?php echo date_format($tanggalbaru,"d/m/Y H:i:s") ?></h5>
                </div>
                <div class="panel-body fixed-panel" >
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-3">
                                <img class="imgberitacustom" src="user_images/<?php echo ($row['gambar']) ?>" style="" />
                          </div>
                          <div class="col-md-9 module fadecustom"><p> <?php print($row['deskripsi']); ?></p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewhomesidelink($query)
 {
  $isFirst = true;
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   if ($isFirst == true){
    
    ?>

     <div class="btn btn-info w3-card-4">
          <a href="<?php echo ($row['url']) ?>" target="_blank">
          <img src="user_images_berita_sidelink/<?php echo ($row['gambar']) ?>" class="float-left"/>
          </a>
      </div>
      <br/><br/>
    <?php
    $isFirst = false;
    } else {        
    ?>
      <div class="btn btn-warning w3-card-4" >
          <a href="<?php echo ($row['url']) ?>" target="_blank">
          <img src="user_images_berita_sidelink/<?php echo ($row['gambar']) ?>" class="float-left"/>
          </a>
      </div>
      <br/><br/>
    <?php
    $isFirst = true;
    }
  }
  else
  {
    ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewhomecarousel($query)
 {
  $isFirst = true;
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
 
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    if ($isFirst == true){
    ?>
        <div class="item active" style="background-size: cover;">
        <img src="user_images_berita_carousel/<?php echo ($row['gambar']) ?>" alt="pic">
      </div>
    <?php
    $isFirst = false;
    } else {        
    ?>
       <div class="item" style="background-size: cover;">
        <img src="user_images_berita_carousel/<?php echo ($row['gambar']) ?>" alt="pic">
      </div>     
           
    <?php
    }

  }
  else
  {
    ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewkegiatanlistkegiatan($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
      $tanggalbaru = date_create($row['tanggaldib']);
    ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                    <a class="beritalinkcustom" href="detailkegiatan.php?detail_id=<?php print($row['id']); ?>"><h3><?php print($row['judul']); ?></h3></a>
                    </div>
                    <h5 style="font-size: 16px;"> By <?php print($row['namapen']); ?></h5>
                    <h5 style="font-size: 16px;">Published <?php echo date_format($tanggalbaru,"d/m/Y H:i:s") ?></h5>
                </div>
                <div class="panel-body fixed-panel" >
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-3">
                                <img class="imgberitacustom" src="user_images_kegiatan/<?php echo ($row['gambar']) ?>" style="" />
                          </div>
                          <div class="col-md-9 module fadecustom"><p> <?php print($row['deskripsi']); ?></p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

public function dataviewbaganorg($query){
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
       <img src="user_images_bagan/<?php echo ($row['gambar']) ?>" style="width:100%;" />
    <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }

}

public function getID_visimisi($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM visimisi WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $Row=$stmt->fetch(PDO::FETCH_ASSOC);
  return $Row;
 }

 public function dataviewstrukturorg($query){
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
            <div class="float-left" style="padding:10px 10px 10px 10px;text-align:center">
                <div class="w3-card-4 " style="padding:10px 10px 10px 10px;width:200px;height:300px;background-color:white;">
                    <img class="float responsive img-circle" src="user_images_struktur/<?php echo ($row['gambar']) ?>" style="width:150px;height:150px;" />
                    <div class="w3-container" style="text-align:center; margin:0px;">
                        <h4 style="height:43.2px;"><?php echo ($row['nama_ang']) ?></h4>
                        <hr>
                        <h6><?php echo ($row['jabatan_ang']) ?><h6>
                    </div>
                </div>
            </div>
    <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }

 }

 public function dataviewfooter($query){
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
            <a href="<?php echo ($row['url']) ?>" target="_blank">
              <img title="<?php echo ($row['nama']) ?>" class="img-circle" src="user_images_footer/<?php echo ($row['gambar']) ?>" alt="<?php echo ($row['nama']) ?>" width="50px">
            </a>
    <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }

 }

 
 public function paging($query,$records_per_page)
 {
  $starting_position=0;
  if(isset($_GET["page_no"]))
  {
   $starting_position=($_GET["page_no"]-1)*$records_per_page;
  }
  $query2=$query." limit $starting_position,$records_per_page";
  return $query2;
 }
 
 public function paginglink($query,$records_per_page)
 {
  
  $self = $_SERVER['PHP_SELF'];
  
  $stmt = $this->db->prepare($query);
  $stmt->execute();
  
  $total_no_of_records = $stmt->rowCount();
  
  if($total_no_of_records > 0)
  {
   ?><ul class="pagination"><?php
   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
   $current_page=1;
     if(isset($_GET["page_no"]))
     {
      $current_page=$_GET["page_no"];
     }
     if($current_page!=1)
     {
      $previous =$current_page-1;
      echo "<li><a href='".$self."?page_no=1'>First</a></li>";
      echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
     }
   for($i=1;$i<=$total_no_of_pages;$i++)
   {
      if($i==$current_page)
      {
       echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
      }
      else
      {
       echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
      }
   }
     if($current_page!=$total_no_of_pages)
     {
      $next=$current_page+1;
      echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
      echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
     }
   ?></ul><?php
  }
 }
 
 /* paging */
 
}