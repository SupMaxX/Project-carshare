<?php
require "config.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cars_id']) && isset($_POST['user_id'])) {
        $cars_id = $_POST['cars_id'];
        $user_id = $_POST['user_id'];

        $stmt = $conn->prepare("INSERT INTO favs (cars_id, user_id, created_at) VALUES (:cars_id, :user_id, NOW())");
        $stmt->bindParam(':cars_id', $cars_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Masina a fost adaugata la favorite cu succes!";

        } else {
            echo "Eroare la adaugarea masinii la favorite.";
        }
    } else {
        echo "Datele nu sunt corecte.";
    }
}
?>