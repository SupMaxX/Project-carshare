<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Panou de administrare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MSIL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <?php if (isset($_SESSION['adminname'])) : ?>
                    <ul class="navbar-nav side-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" style="margin-left: 20px;" href="./">Acasă
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admins.php" style="margin-left: 20px;">Administratori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show-cars.php" style="margin-left: 20px;">Automobile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show-requests.php" style="margin-left: 20px;">Cereri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reports.php" style="margin-left: 20px;">Rapoarte</a>
                        </li>
                    </ul>
                <?php endif; ?>
                <ul class="navbar-nav ml-md-auto d-md-flex">
                    <?php if (!isset($_SESSION['adminname'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login-admins.php">Logare
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./">Acasă
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['adminname']; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="logout.php">Delogare</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">