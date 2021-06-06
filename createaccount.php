<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Event Management System: Sign Up Page</title>
    <?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
</head>
<body>
<div class="create">
    <br>
    <h2><b> Create Account<b> </h2><br>
<form  method="POST">
       <center>
       <input type="text" name="userid" class="create-form-text" value="" placeholder="User ID" required/>
        <input type="text" name="firstname" class="create-form-text" value="" placeholder="First Name"required/>
        <input type="text" name="lastname" class="create-form-text" value="" placeholder="Last Name" required/>   
        <input type="tel" name="contactno"class="create-form-text" value="" placeholder="Contact" required/>        
        <input type="email" name="email" class="create-form-text" value="" placeholder="Email" required/>        
        <input type="password" name="password" class="create-form-text" value=""placeholder="Password" required/>       
        <input type="submit" name="submit" class="create-form-btn" value="Done"/>
</center>

</form>
</div>
</body>
</html>
<?php
include'connection.php';
if(isset($_POST['submit']))
{
    $userid=mysqli_real_escape_string($con,$_POST['userid']);
    $firstname=mysqli_real_escape_string($con,$_POST['firstname']);
    $lastname=mysqli_real_escape_string($con,$_POST['lastname']);
    $contactno=mysqli_real_escape_string($con,$_POST['contactno']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $pwd=password_hash($password, PASSWORD_BCRYPT);
    

    $insertquery= "INSERT INTO signup VALUES ('$userid','$firstname','$lastname',
    '$contactno','$email')";
    $insert="INSERT INTO login VALUES('$userid','$pwd')";

   
   $emailquery="select * from signup where Email='$email'";
   $userquery="select * from signup where UserID='$userid'";
   $uqry=mysqli_query($con,$userquery);
   $ucount=mysqli_num_rows($uqry);
   $qry=mysqli_query($con,$emailquery);
   $emailcount=mysqli_num_rows($qry);
   if($ucount>0)
   {
       ?>
       <script>alert("User ID Already Exist!! Write Different ID");
       </script>
<?php
   }
   else
   {
   if($emailcount>0)
   {
       ?>
     <script>
     alert("Email Already Exists");
     </script>
     <?php
   }
   else{
    $res = mysqli_query($con,$insertquery);
   $ress= mysqli_query($con,$insert);
   if($res)
   {
       ?>
       <script>
   alert('Data Inserted!!');
    location.replace("login.php");
   </script>
       <?php
   }else{
       ?>
    <script>
    alert('Data not inserted!!');
    </script>
    <?php
   }
}}}
?>