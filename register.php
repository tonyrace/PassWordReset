<?php
require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
 <head>
   <title> Registration page</title>
   <link rel = "stylesheet" href= "css/style.css">
  </head>
  <body style="background-color:#7f8c8d">
   <div id = "main-wrapper">
   <h2 style= text-align:center>Registration Form</h2>
  <img src ="imgs/tt.png" class ="tt"/>


<form  class ="myform" action = "" method = "post">
<label><b>UserName:</b></label><br>
<input name= "username" type ="text" class="inputvalues" placeholder = "type username here" autocomplete ="off" required/><br>
<label><b>password:</b></label><br>
<input  name = "password" type = "password" class = "inputvalues" placeholder = "your password" autocomplete="off" required/>
<label><b> confirm password:</b></label><br>

<input  name= "cpassword" type = "password" class = "inputvalues" placeholder = "confirm password" autocomplete="off" required/>


<label><b>Email: </label></b><br><input type ="email" name="email" placeholder= "Enter email address" autocomplete="off">



<div class="reg">
<input name ="submit_btn" type = "submit" id = "sign-up"value = "sign-up"/>
<a href ="index.php"><input type = "button" id = "back-btn" value = "<<Back"/></a>
</div>
</form>
<?php
require 'dbconfig/config.php';

// register user
if(isset($_POST['submit_btn']))
{
	//echo '<script type ="text/javascript"> alert("sign up button clicked")</script>';

//receive all input values from the form.
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
// check to ensure the user credentials are valid by checking the database
	if($password == $cpassword)
	{
		$query = "SELECT * FROM reg WHERE username = '$username'";
		$query_run = mysqli_query($con,$query);
		
		//checking if the number of rows to be returned is greater than 0
			if(mysqli_num_rows($query_run)>0)
			{
				
		
				
			echo '<script type ="text/javascript"> alert("user already exists..,try another name")</script>';// if true, print user exists else go next step
				
		    }  
		    
	        else
	        {
		 
		$query = "INSERT INTO reg(username, email, password) VALUES('$username','$email','$password')";
		//var_dump($query);
			
		$query_run = mysqli_query($con,$query);
		var_dump($query_run);
			 
			 if ($query_run)
			 {
				echo '<script type ="text/javascript"> alert("user registered..go to login page")</script>'; 
			 }
			 
			 else
			    {
			 echo '<script type ="text/javascript"> alert("Error!")</script>';
				 
			    }
		
			
			
			}
	        
	
		
	    }
    }

	
      

	
 


?>


</div>

</body> 
</html>
