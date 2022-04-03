<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=events', 'root', '');  //Establishieng connection with database
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //if connection fails show this error


?>