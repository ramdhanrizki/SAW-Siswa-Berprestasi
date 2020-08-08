<?php
session_start();

$db = mysqli_connect('localhost','root','','spk_saw');
if (!$db)
{
    die("Database Connection: ".mysqli_connect_error());
}
?>