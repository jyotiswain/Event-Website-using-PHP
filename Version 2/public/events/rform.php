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

    <header>
    <header>
    <!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Event</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"> Go Back <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Create New Event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="regsiter.php">Register for Event</a>
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
</header>

<br>
<h1> Register in <b class="badge badge-warning"><?php echo $event['title']?></b><h1>
</header>


<section class="card">
        <div class="card-body">
    <form action="rdata.php" method="post">

    <?php if($event['image']): ?>
        <img src="../<?php echo $event['image'] ?>" class="update-image">
<?php endif ?>

        
<div class="form-group">
        <label for="disabledTextInput">Event Title</label>
        <div><input type="text" name="title" id="disabledTextInput" class="form-control" value="<?php echo $title ?>" disabled></div>
</div>
<div class="form-group">
        <label>Your Full Name</label>
        <div><input type="number" step=".01" name="price" class="form-control"></div>
</div>
<div class="form-group">
        <label>Your Email</label>
        <div><input type="number" step=".01" name="price" class="form-control"></div>
</div>
<div class="form-group">
        <label>Your Phone Number</label>
        <div><input type="number" step=".01" name="price" class="form-control"></div>
</div>
<div class="form-group">
        <label>Your Age</label>
        <div><input type="number" step=".01" name="price" class="form-control"></div>
</div>
<div class="form-group">
        <label>Your University/College/School Name</label>
        <div><input type="number" step=".01" name="price" class="form-control"></div>
</div>
<div>
<button type="submit" name="submit" class="btn btn-success btn-lg">Register</button>
    </div>
    </form>
    </div>
    <section>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>