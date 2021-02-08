
<?php
require 'dbconfig/config.php';
?>
<DOCTYPE html>
    <html>
        <head>
          <link rel = "stylesheet" href= "css/style.css">
     </head>

     <body>
     <h1> Reset your password</h1>
         <div class= "reset">

<p>enter your email and click submit then check your inbox for instructions on  how to reset your password</p>
<form action ="password-reset-logic.php" method ="POST">
<input type ="email" name = "email" placeholder = "enter your email address" required />
<button type= "submit" name="reset-request-submit">submit request</button>
      </form>
    </div>
   </body> 
</html> 
