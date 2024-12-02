
<!-- Footer -->
<footer class="page-footer font-small bg-dark text-light pt-4">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold"><u>OnlineLearnal</u></h6>
        <p>This, Educational Website is developed by OnlineLearnal Teams . The distribution and selling the content is not allowed.</p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-light">
        <h6 class="text-uppercase mb-4 font-weight-bold"><u>Links</u></h6>
        <p>
          <a href="privacypolicy.php"class="text-light">Privacy Policy</a>
        </p>
        <p>
          <a href="#!"class="text-light">Disclaimer</a>
        </p>
        <p>
          <a href="#!"class="text-light">Terms and Condition</a>
        </p>
        <!--<p>-->
        <!--  <a href="aboutus.php"class="text-light">About US</a>-->
        <!--</p>-->
        <!--<p>-->
        <!--  <a href="contactus.php"class="text-light">Contact US</a>-->
        <!--</p>-->

      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold"><u>Course links</u></h6>
         <?php
                    global $ConnectingDb;
                    $sql="SELECT * FROM subjects ORDER BY id asc";
                    $stmt=$ConnectingDb->query($sql);
                    while ($DataRows=$stmt->fetch()) {
  # code...
                      $SubjectId=$DataRows["id"];
                      $SubjectName=$DataRows["title"];


                      ?>
        <p>
          <a href="lessons.php?subject=<?php echo $SubjectName;?>"class="text-light"><?php echo $SubjectName;?></a>
        </p>
      <?php }?>
        
      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

     

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left">© 2021 Copyright:
          <a href="https://onlineLearnal.com/">
            <strong> Onlinelearnal.com</strong>
          </a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-google-plus-g"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>


<script src="js/custom.js"></script>
<script>
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
});
}
</script>

</body>

</html>