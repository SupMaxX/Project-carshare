<?php require "header.php" ; ?>
<?php require "../config.php"; ?>
<?php
    if(!isset($_SESSION['adminname'])){
        header("location: login-admins.php");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = $conn->query("SELECT * FROM cars WHERE id='$id'");
        $query->execute();

        $fetch_image = $query->fetch(PDO::FETCH_OBJ);
        
		if(!empty($fetch_image->image) && file_exists($fetch_image->image)) unlink("images/" . $fetch_image->image);

        $delete_car = $conn->query("DELETE FROM cars WHERE id='$id'");
        $delete_car->execute();

        $images = $conn->query("SELECT * FROM related_images WHERE cars_id='$id'");
        $images->execute();
        $delete_images = $images->fetchAll(PDO::FETCH_OBJ);

       
        $delete_related_images = $conn->query("DELETE FROM related_images WHERE cars_id='$id'");
        $delete_related_images->execute();

        header("location: show-cars.php");
    }