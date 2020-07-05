<?php
session_start();
$db = mysqli_connect('localhost','root','','db_spk_saw_siswa_prestasi');
if (!$db)
{
    die("Database Connection: ".mysqli_connect_error());
}
?>