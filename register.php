<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      input{
         text-align: center;
         
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container" style="background-image: url(logo.png); background-repeat: no-repeat;background-size: contain;">

   <form action="" method="post" style="background-image: url(logoo.png);">
   <img src="logoo.png" alt="logo" width="70px">
      <h2 style='color:#dd0000;'>GIZMO STORE</h2><br>
      <h3>Create a New Account</h3>
      <input type="text" name="name" required placeholder="User Name" class="box" style='border-radius: 15px'>
      <input type="email" name="email" required placeholder="E-mail" class="box" style='border-radius: 15px'>
      <input type="password" name="password" required placeholder="Password" class="box" style='border-radius: 15px'>
      <input type="password" name="cpassword" required placeholder="Confirm Password" class="box" style='border-radius: 15px'>
      <input type="submit" name="submit" class="btn" value="Create" style='border-radius: 15px'>
      <br><br><br>
      <a href="login.php" style='color: #0000aa;'>Sign in</a>
   </form>

</div>

</body>
</html>