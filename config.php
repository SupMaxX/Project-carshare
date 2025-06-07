<?php   
try
{
    define("DBHOST", "localhost");
    define("DBNAME", "carshare");
    define("DBUSER", "root");
    define("DBPASS", "123456");
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";", DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("Imposibil de conectat la baza de date: " . $e->getMessage());
}