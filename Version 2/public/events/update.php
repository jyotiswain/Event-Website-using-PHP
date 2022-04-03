<?php

/** @var $pdo \PDO */
require_once "../../database.php";
require_once "../../functions.php";

$id = $_GET['id'] ?? null;

if(!$id){
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM eventlist WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$event = $statement->fetch(PDO::FETCH_ASSOC);


$errors=[];

$title = $event['title'];
$price = $event['price'];
$description = $event['description'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once "../../validate_product.php";

if(empty($errors)){


$statement=$pdo->prepare("UPDATE eventlist SET title = :title, image = :image,
description = :description, price = :price WHERE id = :id");

$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':id', $id);
$statement->execute();
header('Location: index.php');
}
}


?>

<?php include_once "../../views/partials/header.php"; ?>


<p>
   <a href="index.php"> Go back to Events</a> 
</p>
    <header>
        <nav>
</nav>
<h1>Update Event <b><?php echo $event['title']?></b><h1>
</header>

<?php include_once "../../views/products/form.php"?>

    
</body>
</html>