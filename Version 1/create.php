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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Events</title>
</head>
<body>
    <header>
    <!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"> Go Back <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Login</a>
          <a class="dropdown-item" href="#">Sign Up</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
    
<br>

<h1>Create New Event<h1>
</header>

<?php if(!empty($errors)): ?>
<div>
    <?php foreach ($errors as $error): ?>
        <?php echo $error ?>
        <?php endforeach; ?>
</div>
<?php endif; ?>


<section class="card">
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label>Event Poster</label>
        <div><input type="file" name="image"></div>
</div>
<div class="form-group">
        <label>Event Title</label>
        <input type="text" name="title" class="form-control"  value="<?php echo $title ?>">
</div class="form-group">
<div class="form-group">
        <label>Event Details</label>
        <textarea name="description" class="form-control" aria-describedby="emailHelp" value="<?php echo $description ?>"></textarea>
</div class="form-group">
<div class="form-group">
        <label>Event Registration Fee</label>
        <input type="number" step=".01" name="price" class="form-control"  aria-describedby="emailHelp" value="<?php echo $price ?>">
</div>
<div>
<button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Create</button>
    </div>
    </form>
    </div>
    <section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>