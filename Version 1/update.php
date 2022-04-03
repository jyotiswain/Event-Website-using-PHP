<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=events', 'root', '');  //Establishieng connection with database
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //if connection fails show this error

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
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];


if(!$title){
    $errors[]= 'Event Title is required!';
}

if(!$price){
    $errors[]= 'Event Registration Fee is required!';
}

if(!is_dir('images')){
    mkdir('images');
}

if(empty($errors)){

    $image = $_FILES['image'] ?? null;
    $imagePath =$event['image'];


    if($image && $image['tmp_name'] ){

        if($event['image']){
            unlink($event['image']);
        }
        

        $imagePath = 'images/'.randomString(8).'/'.$image['name']; 
        mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
    }

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

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Events</title>
</head>
<body>

<p>
   <a href="index.php"> Go back to Events</a> 
</p>
    <header>
        <nav>
</nav>
<h1>Update Event <b><?php echo $event['title']?></b><h1>
</header>

<?php if(!empty($errors)): ?>
<div>
    <?php foreach ($errors as $error): ?>
        <?php echo $error ?>
        <?php endforeach; ?>
</div>
<?php endif; ?>


<section>
    <form action="" method="post" enctype="multipart/form-data">

    <?php if($event['image']): ?>
        <img src="<?php echo $event['image'] ?>" class="update-image">
<?php endif ?>

        <div>
        <label>Event Poster</label>
        <div><input type="file" name="image"></div>
</div>
<div>
        <label>Event Title</label>
        <div><input type="text" name="title" value="<?php echo $title ?>"></div>
</div>
<div>
        <label>Event Details</label>
        <div><textarea name="description" value="<?php echo $description ?>"></textarea></div>
</div>
<div>
        <label>Event Registration Fee</label>
        <div><input type="number" step=".01" name="price" value="<?php echo $price ?>"></div>
</div>
<div>
    <input type="submit" name="submit">
    </div>
    </form>
    <section>


    
</body>
</html>