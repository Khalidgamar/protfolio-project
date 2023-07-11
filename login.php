<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

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
      <h3>Sign in</h3>
      <input type="email" name="email" required placeholder="E-mail" class="box" style='border-radius: 15px'>
      <input type="password" name="password" required placeholder="Password" class="box" style='border-radius: 15px'>
      <input type="submit" name="submit" class="btn" value="Sign in" style='border-radius: 15px'>
      
      <br><br><br>
      
      <a href="register.php" style='color: #0000aa;'>New Account</a>
   </form>
   </div>
</body>
</html>