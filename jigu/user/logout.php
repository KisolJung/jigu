<?php
  session_start();
  echo("
       <script>
          location.href = '../main/index.php';
         </script>
       ");
  session_unset();
?>
