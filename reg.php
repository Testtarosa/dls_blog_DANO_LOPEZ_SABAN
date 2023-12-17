<?php

require 'db.php';

session_start();

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select = " SELECT * FROM reg_form WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error[] = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error[] = 'password not matched!';
       }else{
          $insert = "INSERT INTO reg_form (name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
          mysqli_query($conn, $insert);
          header('location:login.php');
       }
    }
 
 };
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register form</title>
   <link rel="icon" href="icon/Logo.ico" type="image/icon type">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>
   <div class="form-container">
      <div class="ftco-section">
         <div class="container">
            <form action="" method="post">
               <div class="row justify-content-center animate__animated animate__pulse float-right">
                  <div class="float-right">
                     <div class="login-wrap">
                        <h2 class="heading-section">REGISTER ACCOUNT</h2>
                        <?php
                        if(isset($error)){
                           foreach($error as $error){
                              echo '<span class="error-msg">'.$error.'</span>';
                           };
                        };
                        ?>
                        <div class="form-group">
                              <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name" required autocomplete="name" autofocus>
                        </div>
                        <div class="form-group">
                              <input id="email" type="email" class="form-control" name="email" placeholder="Enter your email" required autocomplete="email">
                        </div>
                        <div class="form-group">
                           <input id="password" type="password" class="form-control" name="password" placeholder="Enter your password" required>
                           <span toggle="#password-field" id="sideicon" name="sideicon" class="fa fa-fw fa-eye-slash field-icon toggle-password" onclick="myFunction1()"></span>
                           <script>
                              function myFunction1() {
                                 var x = document.getElementById("password");
                                 if (x.type === "password") {
                                    x.type = "text";
                                    document.getElementById("sideicon").classList.add('fa-eye');
                                    document.getElementById("sideicon").classList.remove('fa-eye-slash');
                                 } else {
                                    x.type = "password";
                                    document.getElementById("sideicon").classList.remove('fa-eye');
                                    document.getElementById("sideicon").classList.add('fa-eye-slash');
                                 }
                              }
                           </script>
                        </div>
                        <div class="form-group">
                           <input id="cpassword" type="password" class="form-control" name="cpassword" placeholder="Confirm your password" required>
                           <span toggle="#cpassword-field" id="csideicon" name="csideicon" class="fa fa-fw fa-eye-slash field-icon toggle-password" onclick="myFunction2()"></span>
                           <script>
                              function myFunction2() {
                                 var x = document.getElementById("cpassword");
                                 if (x.type === "password") {
                                    x.type = "text";
                                    document.getElementById("csideicon").classList.add('fa-eye');
                                    document.getElementById("csideicon").classList.remove('fa-eye-slash');
                                 } 
                                 else {
                                    x.type = "password";
                                    document.getElementById("csideicon").classList.remove('fa-eye');
                                    document.getElementById("csideicon").classList.add('fa-eye-slash');
                                 }
                                 }
                           </script>
                        </div>
                        <div class="form-group sel" id="sel">
                           <select name="user_type" class="form-control">
                              <option value="user" class="option-style">user</option>
                              <option value="admin" class="option-style">admin</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <button type="submit" name="submit" value="register now" class="form-control submit px-3 btn-primary btn shadow">Sign In</button>
                        </div>
                        <p class="text-center">already have an account? <a href="login.php" class="reg">login now</a></p>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>