<?php
  require_once("sessionview.php");
?>

<?php $page=1; include_once 'header2.php'; ?>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>

    <div class="clearfix"></div>
    	
<div id="divbackground">    
<div class="container-fluid">
	
    <div class="container">
    <br>

        <div class="col-md-8">

        	<?php
              $query = "SELECT * FROM berita ORDER BY tanggaldib DESC";
              $records_per_page=5;
              $newquery = $crud->paging($query,$records_per_page);
              $crud->dataviewhomeberita($newquery);
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
        <div class="col-md-4">
          <?php
              $query = "SELECT * FROM berita_sidelink";
              $crud->dataviewhomesidelink($query);
          ?>
        </div>

    </div>

</div>
</div>

<?php include_once 'footer2.php'; ?>