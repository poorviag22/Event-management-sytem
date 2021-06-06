<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include 'link.php' ?>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <title>Admin Login</title>
</head>
<div class="login">
<body>
<center>
<br>
<h1> <b>Admin Login</b></h1><br>
    <form class="contact-form" method="post">
    
    <input  type="password" class="contact-form-text" name="pass" placeholder="Admin Password" size="20" value="" required/>
    <button  class="contact-form-btn" name="submit">Login</button>
    </form>
    <input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
    
    
    
</center>

<?php
if(isset($_POST['submit']))
{
    $pwd=$_POST['pass'];
    if($pwd=='2207')
    {
        ?>
        <script>
        location.replace("admin.php");
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
        alert("Incorrect Password!!");
        </script>
        <?php
    }
}?>
</div>
</body>
</html>