<?php
require 'dbconfig/config.php';

if(!isset($_GET["token"])){ // if thr parameter in our link is not set
	
	exit("cant find page");// exit cant find page

}


$token =$_GET["token"]; // if code is in the link,get the code
//var_dump($token);

$getEmailQuery = mysqli_query($con, "SELECT email FROM reset_table WHERE token = '$token'");// this gets the email



if(mysqli_num_rows($getEmailQuery)==0){ 
	exit("cant find the page");
	// if row not found
	
	}
if(isset($_POST["password"])){
	$pw = $_POST["password"];
    $pwd = md5($pw); //encrypting password
	
	$row = mysqli_fetch_array($getEmailQuery);//fetch data from getEmailQuery
	$email =$row["email"];
	
	$query = mysqli_query($con,"UPDATE reg SET password='$pw' WHERE email= '$email'"); //update password

	if($query){
	$query= mysqli_query($con,"DELETE FROM reset_table  WHERE token='$token'"); //delete the tocken after
		exit("password updated");
	}
	else{
		exit("something went wrong");
	}
}

?>
<form  method="POST">
		<h2>New password</h2>
		
	
			<label>New password:</label>
			<input type="password" name="password" placeholder="newpassword"><br>
			<label>Click to update:</label>
			<input type="submit" name="submit" value="update Password">
		
		
			
		
</form>
