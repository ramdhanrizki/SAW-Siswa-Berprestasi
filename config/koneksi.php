<?php
session_start();
$db = mysqli_connect('ramdhanrizki.net','root','code@labs','db_saw_akademik');
if (!$db)
{
    die("Database Connection: ".mysqli_connect_error());
}
?>