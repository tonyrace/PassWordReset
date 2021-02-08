
<?php
  session_start();
  require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" href= "css/style.css">
</head>
<body>
<h1>Home page</h1>

<div id="homepage">


<h3> Welcome 
<?php echo $_SESSION['username']?></br></br>
<?php echo 'its',"&nbsp".date('d/m/y'),"&nbsp".date('l'),"&nbsp".'today!';?>
</h3>
 
<img src ="imgs/tt.png" class ="tt" />
<form  class ="myform" action = "" method = "POST">
<button type = "submit" name="logout-btn" value = "Logout">logout</button>
</form>


<?php
if(isset($_post["logout-btn"]))
{
  //session_destroy();
header('location:../index.php');
}

?>
</div>
</body>
</html>