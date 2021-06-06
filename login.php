<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Event Management System:Login Page</title>
    <?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
</head>
<body>
<div class="login">
    <br>
    <h1><b>Login Details</b></h1>
    <center>
        <br>
       <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" class="contact-form" method="POST">
       
        <input type="text" name="userid" class="contact-form-text" value="" placeholder="User ID" required/><br>
       
        <input type="password" name="password" class="contact-form-text" value="" placeholder="Password" required/>

        <button  type="submit" class="contact-form-btn" name="submit" >Login</button><br><br>
        
        <div class="acc">
         <h4><b>Do not have account?</b></h4> 
        <a href="http://localhost/event%20management%20system/createaccount.php"><b>Sign Up </b></a>
        </div>
        <a href="forgetpwd.php">Forget Password?</a><br><br>
        <input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
        
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

$password=mysqli_real_escape_string($con,$_POST['password']);

$userid_search="select * from login where UserID='$userid'";

$query=mysqli_query($con,$userid_search);
$usercount=mysqli_num_rows($query);
$q="select FirstName from signup where UserID='$userid'";
$uname=mysqli_query($con,$q);

if($usercount)
{
    $user_pass=mysqli_fetch_assoc($query);
    $db_pass=$user_pass['Password'];
    $_SESSION['id']=$user_pass['UserID'];
    
   while($row=$uname->fetch_assoc())
   {
      $fname=$row['FirstName'];
      
      $_SESSION['n']=$fname;
   }   
       
    if(password_verify($password, $db_pass))
    {
        ?>
        <script>
            location.replace("booking.php");
            </script>
            <?php
    } 
     else
    {
        ?>
            <script>
            alert("Invalid Password");

            </script>
         <?php
    }  
}else
{
    ?>
    <script>
            alert("Invalid Login!!");
            </script>
            <?php
}

}

?>


