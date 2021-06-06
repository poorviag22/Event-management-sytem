<?php
session_start();
include 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Payment</title>
    <?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/pay.css' />
    <link rel='stylesheet' type='text/css' href='css/style.css' />
   
</head>

    <div class="container">
        <center><h1> Payment</h1></center><br>
<form method="post">
<?php
     $user=$_SESSION['id'];
      $query="select UserID,FirstName,LastName,Contact,Email from signup where UserID='$user'";
      $pay=mysqli_query($con,$query);
      while($row=$pay->fetch_assoc())
      {
       $id=$row['UserID'];
       $_SESSION['idd']=$id;
       $fname=$row['FirstName'];
       $_SESSION['name1']=$fname;
       $lname=$row['LastName'];
       $_SESSION['name2']=$lname;
       $contact=$row['Contact'];
       $_SESSION['no']=$contact;
       $email=$row['Email'];
       $_SESSION['mail']=$email;
      }
      
?>
<div class="user-details">
    <div class="input">
      <label  type="text" class="details" ><b>User ID</b></label>
      <input  value='<?php echo $id?>'size="15" readonly/>
      </div>
      <div class="input">
      <label class="details" for="fname"><b>First Name</b></label>
      <input  value='<?php echo $fname?>'size="15" readonly/>
      </div>
      <div class="input">
      <label type="text" class="details" for="lname"><b>Last Name</b></label>
      <input value='<?php echo $lname?>'size="15" readonly/>
      </div>
      <div class="input">
      <label class="details" for="no"><b>Contact No.</b></label>
      <input value='<?php echo $contact?>'size="15" readonly/>
      </div>
      <div class="input">
      <label  class="details" for="mail"><b>Email</b></label>
      <input value='<?php echo $email?>'size="20" readonly/>
      </div>
      <div class="input">
      <label  class="details" for="location"><b>Event Location</b></label>
      <input value='<?php echo $_SESSION['loc']?>'readonly/>
      </div>
      <div class="input">
      <label class="details" for="date"><b>Date in</b></label>
      <input value='<?php echo $_SESSION['in']?>'readonly/>
      </div>
      <div class="input">
      <label  class="details" for="date"><b>Date out</b></label>
      <input value='<?php echo $_SESSION['out']?>'readonly/>
      </div>
      <div class="input">
      <label   class="details" for="text"><b>Total Amount To Be Paid</b></label>
      <input value='<?php echo $_SESSION['amount']?>'readonly/>
      </div>
      <div class="input">
      <label   class="details" for="text"><b>Enter Card Number</b></label>
      <input type="text" placeholder="Card Number" value="" required/>
      </div>
      <div class="input">
      <label   class="details" for="text"><b>CVV</b></label>
      <input type="password" placeholder="CVV" value="" required/>
      </div>
      <div class="input">
      <label  class="details" for="text"><b>Expiry Date</b></label>
      <input type="text" placeholder="MM/YYYY" value=""  size="10" required/><br><br>
      </div>
      </div>
      <center><button type="submit" class="container-btn" name="submit" >Pay</button></center>
    
      <input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
</form>

<body>


<?php
$location=$_SESSION['loc'];
$to=$_SESSION['in'];
$from=$_SESSION['out'];
$total=$_SESSION['amount'];
$days=$_SESSION['day'];
$locid= $_SESSION['userid'];
if(isset($_POST["submit"]))
{
    $query1="insert into bookinginfo(UserID,location,dateto,datefrom,cost,days)values('$id','$location','$to','$from'
    ,'$total','$days')";
    $set=mysqli_query($con,$query1);

    $query2="insert into venuestatus(elid,location,datein,dateout)values('$locid','$location','$to','$from')";
    $set2=mysqli_query($con,$query2);
    $qid="SELECT MAX(bookingid) FROM bookinginfo WHERE userID='$id'";
    $bid=mysqli_query($con,$qid);
    while($row=$bid->fetch_assoc())
    {
    $res=$row['MAX(bookingid)']; 
    $_SESSION['bookid']=$res;
    } 
    $idd=$_SESSION['bookid'];
echo "<script type='text/javascript'>alert('Booking ID is: {$idd}');</script>";
?>
<script>
location.replace("viewbookings.php");
</script>
    <?php
}
?>
</div>
</body>
</html>

