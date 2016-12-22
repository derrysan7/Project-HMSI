<?php
  require_once("sessionview.php");
?>

<?php $page=2; include_once 'header2.php'; ?>
<link rel="stylesheet" href="css/homeberita.css" type="text/css"/>

    <div class="clearfix"></div>
    	
<div style="height:auto;background-color:white;">  
<div class="container-fluid">
	
    <div class="container">
    <div class=" col-md-12" style="padding-bottom:30px;">
    <h1 align="center" style="margin:50px 0px;">Kegiatan</h1>
    <hr >
    </div>
    <div class="col-md-8">

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
    <div class="col-md-4" style="padding-bottom:30px;">
    
      <div class="calendercustom">
            <?php 
                $querycal = "SELECT name,startdate,enddate,starttime,endtime,color,url FROM kegiatan";
                $crud->dataview_calender($querycal);
            ?>
          <div class="monthly" id="mycalendar"></div>
      </div>
    </div>

    
    </div>

</div>

<?php include_once 'footer2.php'; ?>