<?php

@include 'db.php';

$id = $_GET['edit'];

if(isset($_POST['update_pet'])){

   $pet_name = $_POST['name'];
   $pet_description = $_POST['descript'];
   $pet_image = $_FILES['pet_image']['name'];
   $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
   $pet_image_folder = 'uploaded_img/'.$pet_image;


   if(empty($pet_name) || empty($pet_description) || empty($pet_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE pet SET name='$pet_name', description='$pet_description', image='$pet_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
         header('location:admin.php');
      }else{
         $$message[] = 'please fill out all!'; 
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
   <link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM pet WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the Pet</h3>
      <input type="text" class="box" name="name" value="<?php echo $row['name']; ?>" placeholder="enter the pet name">
      <input type="text" class="box" name="descript" value="<?php echo $row['description']; ?>" placeholder="enter the pet price">
      <input type="file" class="box" name="pet_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="update pet" name="update_pet" class="btn">
      <a href="admin_page.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>