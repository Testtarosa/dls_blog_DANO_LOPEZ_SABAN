<?php
 require 'db.php';

 session_start();

 if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = "SELECT * FROM reg_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);
  
        if($row['user_type'] == 'admin'){
  
           $_SESSION['admin_name'] = $row['name'];
           header('location:admin.php');
  
        }elseif($row['user_type'] == 'user'){
  
           $_SESSION['user_name'] = $row['name'];
           header('location:user.php');
  
        }   
     }else{
        $error[] = 'incorrect email or password!';
     }
  
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>
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
            <div class="row justify-content-center">
               <div class="col-md-12 text-center">
                  <div class="logo-and-title">
                     <img src="images/Logo.png" alt="Logo" class="logo-image">
                     <h2 class="heading-section">DLS PETBLOG</h2>
                  </div>
                  <hr>
               </div>
            </div>
            <div class="row justify-content-center animate__animated animate__pulse">
               <div class="col-md-6 col-lg-4">
                  <div class="login-wrap">
                     <form action="" method="post">
                        <?php
                        if(isset($error)){
                           foreach($error as $error){
                              echo '<span class="error-msg">'.$error.'</span>';
                           };
                        };
                        ?>
                        <div class="form-group">
                           <input id="email" type="email" class="form-control" name="email" placeholder="Enter your email" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                           <input id="password" type="password" class="form-control" name="password" placeholder="Enter your password" required>
                           <span toggle="#password-field" id="sideicon" name="sideicon" class="fa fa-fw fa-eye-slash field-icon toggle-password" onclick="myFunction()"></span>
                           <script>
                              function myFunction() {
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
                           <button type="submit" name="submit" value="login now" class="form-control submit px-3 btn-primary btn shadow">Sign In</button>
                        </div>
                        <p class="text-center">don't have an account? <a href="reg.php" class="reg">register now</a></p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>