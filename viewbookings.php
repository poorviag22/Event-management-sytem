<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <title>All Bookings</title>
</head>
<div class="admin">
<body>
    <center><br>
    <h1> <b>Bookings</b></h1><br><br>
    <?php 
    $uid=$_SESSION['id'];
    $sql="select bookingid,location,dateto,datefrom,cost,days from bookinginfo where userid='$uid'";
    $exe=mysqli_query($con,$sql);
    ?>
    <table BORDER="7" CELLPADDING="20" CELLSPACING="3" style="width:100%">
<tr>
<th>Booking ID</th>

<th>Location</th>
<th>From Date</th>
<th>To Date</th>
<th>Total Cost</th>
<th>Total Days</th>
<th> Cancel Booking</th>
</tr>

<?php
while($rows=$exe->fetch_assoc())
{   
    $bid=$rows['bookingid'];
    ?>
    <tr>
    <td><?php echo $rows['bookingid'];?></td>
    <td><?php echo $rows['location'];?></td>
    <td><?php echo $rows['dateto'];?></td>
    <td><?php echo $rows['datefrom'];?></td>
    <td><?php echo $rows['cost'];?></td>
    <td><?php echo $rows['days'];?></td>
    <td> <input type="button" class="delete" onClick="deleteme(<?php echo $rows['bookingid'];?>)" name="Delete" value="Cancel"></td>
    </tr>
    <script language="javascript">
     function deleteme(bid)
     {
         if(confirm("Are You Sure?"))
         {
             window.location.href='delete.php?b_id=' +bid+'';
             return true;
         }
     }
    </script>
    <?php
}
 
?>
</table>

</div>
<input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
</center>
</body>
</html>

 
       


   
   
