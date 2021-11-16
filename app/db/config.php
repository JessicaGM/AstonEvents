<?php
if(!isset($_SESSION)){
    session_start();
}

// connect to database
$servername = 'example';
$dbname = 'example';
$username = 'example';
$password = 'example';

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo("Failed to connect to the database");
    //echo($ex->getMessage());
    exit;
}
?>
