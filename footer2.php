
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<footer class="text-center" style="background-color:white">
  <div class="container">
     <hr style="border-color:black">
    <p class="back-top">
      <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span></br>
        Kembali ke Atas
      </a>
    </p>
    <br>

    <?php
        $query = "SELECT * FROM footer";
        $crud->dataviewfooter($query);
    ?>

    <br/> <br/> <br/> 
  </div>
</footer>
</body>
</html>