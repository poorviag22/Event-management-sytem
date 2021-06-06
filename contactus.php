<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact Us</title>
</head>
<body>
<div class="contact-section">
    <br>
<h1> Contact Us</h1>
<div class="border"></div>
<form class="contact-form" method="post">
<input type="text" name="name" class="contact-form-text" placeholder="Your Name">
<input type="email" name="mail" class="contact-form-text" placeholder="Your Email">
<input type="text" name="number" class="contact-form-text" placeholder="Your Number">
<textarea name="msg" class="contact-form-text" placeholder="Your Message"></textarea>
<input type="submit" name="submit" class="contact-form-btn" value="Send">

<a href="https://www.facebook.com/login/web/" class="fa fa-facebook"></a>
<a href="https://twitter.com/login?lang=en-gb" class="fa fa-twitter"></a>
<a href="https://www.instagram.com/accounts/login/" class="fa fa-instagram"></a>

</form>
<input type="submit" class="contact-section-btn" onclick="location.href='index.php';" value="Home Page">
</div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['mail'];
    $number=$_POST['number'];
    $msg=$_POST['msg'];
    $q="INSERT INTO feedback VALUES('$name','$email','$number','$msg')";
    mysqli_query($con,$q);
}
?>