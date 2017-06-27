<?php
  echo "Logout Successfully ";
  session_destroy();   // function that Destroys Session 
  echo "<script>window.location='index.php?page=home.php';</script>";
?>