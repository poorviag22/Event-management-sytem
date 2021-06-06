<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel='stylesheet' type='text/css' href='css/style.css' />
    <title>Admin</title>
</head>
<div class="admin">
<body>
<h1> <b><center>Booking Details</center></b></h1><br><br>
<?php
$sql="select * from bookinginfo";
$c=mysqli_query($con,$sql);
?>
<center>
<table BORDER="5" CELLPADDING="0" CELLSPACING="3" style="width:100%">
<tr>
<th><b>Booking ID</b></th>
<th>User ID</th>
<th>Location</th>
<th>From Date</th>
<th>To Date</th>
<th>Total Cost</th>
<th>Total Days</th>
</tr>
<?php
while($rows=$c->fetch_assoc())
{
    ?>
    <tr>
    <td><?php echo $rows['bookingid'];?></td>
    <td><?php echo $rows['UserID'];?></td>
    <td><?php echo $rows['location'];?></td>
    <td><?php echo $rows['dateto'];?></td>
    <td><?php echo $rows['datefrom'];?></td>
    <td><?php echo $rows['cost'];?></td>
    <td><?php echo $rows['days'];?></td>
    </tr>
    <?php
}
?>
</table>
</center>
<input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
</div>
</body>
</html>