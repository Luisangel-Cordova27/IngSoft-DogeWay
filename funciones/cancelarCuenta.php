<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();

$con = conecta();
$userid = $_SESSION["Admin"]; 
