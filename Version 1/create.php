<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=events', 'root', '');  //Establishieng connection with database
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //if connection fails show this error

$errors=[];

$title='';
$price='';
$description ='';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$date = date('Y-m-d H:i:s');

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
    $imagePath ='';
    if($image && $image['tmp_name'] ){

        $imagePath = 'images/'.randomString(8).'/'.$image['name']; 
        mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
    }

$statement=$pdo->prepare("INSERT INTO eventlist (title, image, description, price, create_date)
VALUES (:title, :image, :description, :price, :date)");

$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':date', $date);
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
    <header>
        <nav>
</nav>
<h1>Create New Event<h1>
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