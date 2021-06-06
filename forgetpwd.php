<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <title>Forget Password</title>
</head>
<body>
<div class="login">
    <br>
    <h1><b>Create New Password</b></h1>
    <center>
        <br>
       <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" class="contact-form" method="POST">
       
        <input type="text" name="uid" class="contact-form-text" value="" placeholder="User ID" required/><br>
        <input type="password" name="pwd" class="contact-form-text" value="" placeholder="Type New Password" required/><br>
       
        <input type="password" name="password" class="contact-form-text" value="" placeholder="Confirm Password" required/>

        <button  type="submit" class="contact-form-btn" name="submit" >Create</button><br><br>
        
       
        <input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
        
</center>
</form>
<?php
     
     if(isset($_POST['submit']))
     {   
         $id=$_POST['uid'];
         $npwd=$_POST['pwd'];
         $cpwd=$_POST['password'];
         if($npwd!=$cpwd)
         {
             ?>
             <script>
                 alert("Both Passwords Do Not Match!!");
                 </script>
                 <?php
         }
         else
         {   
            $password=mysqli_real_escape_string($con,$_POST['pwd']);
            $pwd=password_hash($password, PASSWORD_BCRYPT);
             $query="update login set Password='$pwd' where UserID='$id'";
             mysqli_query($con,$query);
             ?>
             <script>
                 alert("Password Updated Successfully!!");
                 location.replace("login.php");
                 </script>
                 <?php
         }

     }

?>
</div>
</body>
</html>