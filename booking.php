<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Booking page</title>
    <?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
      
</head>
<body>
<div class="booking-section">
<div class="button-container">
<ul>
<center>
 <li><a href="index.php"><b>Home</b></a></li>
 <li><a href="contactus.php"><b>Contact Us</b></a></li>
 <li><a href="aboutus.php"><b>About Us</b></a></li>
 <li><a href="viewbookings.php"><b>View Booking</a></li>
 <li><a href="logout.php"><b>Log Out</a></li>
</center>
 </ul>
</div>
<center>
    <h2> <b>Welcome <?php  echo $_SESSION['n'];?></b></h2><br><br>
    
    <form class="booking-section-form"action="" method="POST">
     <b>EVENT LOCATION: </b>
     <select  class="booking-section-form-text" name="location"required>
         <option value="">--Select Location--</option>
         <?php include'connection.php';
         $event=mysqli_query($con,"SELECT location FROM eventlocation");
         while($data=mysqli_fetch_array($event))
         {
            echo "<option value='". $data['location'] ."'>" .$data['location'] ."</option>";
         }   
?>
    </select>
    
     <b>EVENT TYPE: </b>
        <select class="booking-section-form-text" name="type"required>
         <option value="">--Select Event--</option>
         <?php include'connection.php';
         $event=mysqli_query($con,"SELECT event FROM eventtype");
         while($data=mysqli_fetch_array($event))
         {
            echo "<option value='". $data['event'] ."'>" .$data['event'] ."</option>";
         }   
?>
        </select>

       <label  for="datein"><b>FROM: </b></label>
       <input  class="booking-section-form-text" type="date" name="datein" value="" required/> 
       <label   for="dateout"><b>TO: </b></label>
       <input  class="booking-section-form-text" type="date" name="dateout" value="" required/> <br><br>
       <button  type="submit" class="booking-btn" name="submit" >Check</button>
    </form> 
    </center>
<br> 
<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $place=$_POST['location'];
    $event=$_POST['type'];
    $_SESSION['loc']=$place;
    $din=date('Y-m-d',strtotime($_POST['datein']));
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    
    if($_POST['datein']<$date)
    {
        ?>
        <script>
        alert("Choose Correct Date");
        </script>
        <?php
    }
    else
    {
    $_SESSION['in']=$din;
    $dout=date('Y-m-d',strtotime($_POST['dateout']));
    if($dout<$din)
    {
        ?>
        <script>
        alert("Choose Correct Date");
        </script>
        <?php
    }
    else{
    $_SESSION['out']=$dout;
  
   /* $query="select eventlocation.cost,eventlocation.location from eventlocation,venuestatus where (eventlocation.elid=venuestatus.elid)AND (eventlocation.location='$place')
    AND (('$din'< datein AND '$dout'<datein)OR('$din'>dateout AND '$dout'>dateout)OR(dateout is NULL AND dateout is NULL)) order by datein,dateout"; */
    $query="select eventlocation.cost,eventlocation.location from eventlocation,venuestatus where (eventlocation.elid=venuestatus.elid)AND (eventlocation.location='$place')AND
    (('$din'>=datein AND '$din'<=dateout)OR ('$dout'>=datein AND '$dout'<=dateout)OR('$din'<=datein AND '$dout'<=dateout AND '$dout'>=dateout)OR('$din'<=datein AND '$dout'>=dateout)) OR (datein is NULL AND dateout is NULL)";
    $check = mysqli_query($con,$query);
    $count = mysqli_num_rows($check);
    
    $diff = abs(strtotime($din) - strtotime($dout));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    
   /* $set1="update venuestatus set datein='$din' where location='$place'";
    mysqli_query($con,$set1);
    $set2="update venuestatus set dateout='$dout' where location='$place'";
    mysqli_query($con,$set2);*/
   
if($count==0)
{
    $q="SELECT elid,cost,eventlocation.location from eventlocation where eventlocation.location='$place'";
    $c=mysqli_query($con,$q);
       ?>
       <center>
           
<form action=""  method="POST"><br>
  <h1>Details: </h1><br>
   <label for="location"><b>Location: </b></label>
   <?php
   
   while($row=$c->fetch_assoc())
   {
    $res=$row['location'];
    $r=$row['cost'];
    $id=$row['elid'];
    $_SESSION['userid']=$id;
   }

    ?>
         <input class="booking-section-form-text" value='<?php echo $res?>' size="15"readonly/> 
         <label for="cost"><b>Cost Per Day:</b></label>
         <input class="booking-section-form-text" value='<?php echo $r?>' size="10" readonly/> 
         <label for="guests"><b>No. Of Days: </b></label>
         <?php
         if($days==0)
         {
                $_SESSION['day']=1;
             ?>
              <input name="days" value="1" size="5" readonly />
            <?php
         }
         else{
            $_SESSION['day']=$days;
             ?>
             <input class="booking-section-form-text" name="days" value='<?php echo $days?>' size="5" readonly  />
             <?php
         }
         ?>
         <label for="cost"><b>Total Amount: </b></label>
         <?php
         if($days==0)
         {   
             $_SESSION['amount']=$r;
             ?>
             <input class="booking-section-form-text" name="cost" value='<?php echo $r?>' size="10" readonly />
             <?php
         }
         else{
             $total=$days*$r;
             $_SESSION['amount']=$total;
             ?>
             <input  class="booking-section-form-text" name="cost" value='<?php echo $total?>' size="10" readonly /><br>
          <?php
         }
         ?>
         <br>
         <button type="submit" class="booking-btn-btn" name="pay" >Payment</button> 
        
               
</form>
 </center>

<?php
}
if($count>0)
{
    ?>
    <br>
    <center><p><b>SORRY, VENUE IS NOT AVAILABLE ON SELECTED DATE. PLEASE TRY OTHER DATE OR VENUE!!</b></p></center>
    <?php
}
}
}
}

?>
 <?php
         if(isset($_POST['pay']))
         {
             ?>
             <script>
             location.replace("payment.php");
             </script>
             <?php
         }
 
         ?>
     </div>   
               
</body>
</html>