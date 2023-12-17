<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLS PETBLOG</title>
    <link rel="icon" href="icon/Logo.ico" type="image/icon type">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<?php require 'layout/header.php';?>

<?php require 'layout/home.php';?>

<?php require 'layout/about.php';?>

<?php require 'layout/review.php';?>

<?php require 'layout/footer.php';?>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

    AOS.init({
        delay: 250,
      duration: 650,
      once: true
    });
</script>
</html>