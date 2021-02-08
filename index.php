<?php
 session_start();
 require 'dbconfig/config.php';
?>
<!DOCTYPE html>
 <html>
   <head>
   
   <link rel = "stylesheet" href= "css/style.css">
  </head>
	
 
 
  <h1>  WELCOME TO NEPSERV</h1>

  <div id = "main-wrapper">
  <h2 style= text-align:center>Login Form </h2>
  <img src ="imgs/tt.png" class ="tt" />



<form  class ="myform" action = "index.php" method = "post">
<label><b>UserName:</b></label></br>
<input  name = "username" type ="text" class="inputvalues" placeholder = "type username here "  autocomplete = "off" required/>
<label><b>password:</b></label></br>
<input name = "password" type = "password" class = "inputvalues" placeholder = "type password here"  autocomplete="off" required/>
<div class= "buttonz">
<input  name = "login" type = "submit" id = "login-btn" value = "login"/>
<a href="register.php"><input type = "button" id = "register-btn" value = "Register"/></a></br>
<span class="psw">Forgot <a href= "reset-passwd.php"> password?</a></span>
</div>
 </form>
</div>
</body> 
</html>
<?php

if (isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$query ="select * from reg WHERE username ='$username' AND password = '$password'";
	
	$query_run = mysqli_query($con,$query);
	 
	 if (mysqli_num_rows($query_run)>0)
	{
		$_SESSION['username'] = $username;
		header('location:homepage.php');
	}
	else
	{
		echo '<script type ="text/javascript"> alert("invalid credentials") </script>';
	}
	
}
 ?>


