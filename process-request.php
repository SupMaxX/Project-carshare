<?php 
require "header.php";
require "config.php";

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone'])) {
        echo "<script>alert('Datele sunt incomplete');</script>";
        echo "<script>window.location.href='./'</script>";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $cars_id = $_POST['cars_id'];
        $user_id = $_POST['user_id'];
        $author = $_POST['admin_name'];

        $insert = $conn->prepare("INSERT INTO requests (name, email, phone, cars_id, user_id, author) VALUES (:name, :email, :phone, :cars_id, :user_id, :author)");

        $insert->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':cars_id' => $cars_id,
            ':user_id' => $user_id,
            ':author' => $author,
        ]);

        echo "<script>alert('Mesaj trimis cu succes!');</script>";
        echo "<script>window.location.href='./car-details.php?id=$cars_id'</script>";
    }
}
?>