<?php
  require_once("sessionview.php");
?>

<?php $page=2; include_once 'header2.php'; ?>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>

    <div class="clearfix"></div>
    	
<div style="height:auto;background-color:white;">  
<div class="container-fluid">
	
    <div class="container">
    
    <div class="col-md-offset-2 col-md-8 col-md-offset-2" style="padding-bottom:30px;">
    <h1 align="center" style="margin:50px 0px;">Kegiatan</h1>
    <hr>
      <div class="calendercustom">
            <?php 
                $querycal = "SELECT name,startdate,enddate,starttime,endtime,color,url FROM kegiatan";
                $crud->dataview_calender($querycal);
            ?>
          <div class="monthly" id="mycalendar"></div>
      </div>
    </div>

    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
    	<?php
          $query = "SELECT * FROM kegiatan ORDER BY tanggaldib DESC";
          $records_per_page=5;
          $newquery = $crud->paging($query,$records_per_page);
          $crud->dataviewkegiatanlistkegiatan($newquery);
      ?>


    	<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        </div>
    </div>

    
    </div>

</div>

<?php include_once 'footer2.php'; ?>