<?php

if ($_SESSION["acceso"]["usuarios"] != "6") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>
