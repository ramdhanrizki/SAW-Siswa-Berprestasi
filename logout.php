<?php
    include "config/const.php";
    session_start();
    session_destroy();
    echo "<script>document.location.href='".BASE_URL."/login.php'</script>";
?>