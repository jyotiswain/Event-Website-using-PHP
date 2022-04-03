<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=events', 'root', '');  //Establishieng connection with database
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //if connection fails show this error

$id = $_POST['id'] ?? null;

if(!$id){
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM eventlist WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header("Location: index.php");
?>