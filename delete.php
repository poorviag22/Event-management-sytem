<?php

include 'connection.php';
$q="DELETE FROM bookinginfo where bookingid='".$_GET['b_id']."'";
$qq="DELETE FROM venuestatus where bookingid='".$_GET['b_id']."'";
$data=mysqli_query($con,$q);
$dataa=mysqli_query($con,$qq);
header("Location: viewbookings.php");
?>