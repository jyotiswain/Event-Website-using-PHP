<?php
/** @var $pdo \PDO */
require_once "../../database.php";

$search = $_GET['search'] ??  '';
if ($search){
$statement = $pdo->prepare('SELECT * FROM eventlist WHERE title LIKE :title ORDER BY create_date DESC');
$statement->bindValue(':title', "%$search%" );
}
else{
$statement = $pdo->prepare('SELECT * FROM eventlist ORDER BY create_date DESC');
}

$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch as associative array


?>

<?php include_once "../../views/partials/header.php"; ?>

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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Create New Event</a>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search"  placeholder="Search for Event" name="search" value="<?php echo $search?>" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</header>


<section>

<br>
<center>
    <div class="badge badge-warning">
<h3 class="card-body">
&#128640; Register
  <small class="text-muted">Now</small>
</h3>
</div>
</center>
<br>


    <table class="table">
        <thead class="bg-warning">
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
</thead>
<tbody>
    <?php foreach($events as $i => $event):?>
        <tr>
            <th scope="row"><?php echo $i + 1?></th>
            <td>
                <img src="../<?php echo $event['image']?>" class="thumb-image">
            </td>
        <td><?php echo $event['title']?></td>
        <td><?php echo $event['description']?></td>
        <td class="badge badge-pill badge-secondary"><?php echo $event['price']?></td>
        <td><?php echo $event['create_date']?></td>
        <td>
            <a href="rform.php?id=<?php echo $event['id'] ?>" class="btn btn-outline-success btn-sm" >Register</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    
</body>
</html>