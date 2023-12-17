<?php

@include 'db.php';

if(isset($_POST['add_pet'])){

   $pet_name = $_POST['name'];
   $pet_description = $_POST['descript'];
   $pet_image = $_FILES['pet_image']['name'];
   $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
   $pet_image_folder = 'uploaded_img/'.$pet_image;

   if(empty($pet_name) || empty($pet_description) || empty($pet_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO pet (name, description, image) VALUES('$pet_name', '$pet_description', '$pet_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
         $message[] = 'new pet added successfully';
      }else{
         $message[] = 'could not add the pet]';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM pet WHERE id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new Pet</h3>
         <input type="text" placeholder="enter pet name" name="name" class="box">
         <input type="text" placeholder="enter pet description" name="descript" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="pet_image" class="box">
         <input type="submit" class="btn" name="add_pet" value="add pet">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM pet");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Pet image</th>
            <th>Pet name</th>
            <th>Pet description</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>