<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=events', 'root', '');  //Establishieng connection with database
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //if connection fails show this error

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
            <form>
            <input placeholder="Search for Event" name="search" value="<?php echo $search?>" >
            <button type="submit">Search</button>
</form>
        <button>
            <a  href="create.php">Create event</a>
</button>
</nav>
</header>


<section>
    <table>
        <caption>Events List</caption>
        <thead>
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
                <img src="<?php echo $event['image']?>" class="thumb-image">
            </td>
        <td><?php echo $event['title']?></td>
        <td></td>
        <td><?php echo $event['price']?></td>
        <td><?php echo $event['create_date']?></td>
        <td>
            <a href="update.php?id=<?php echo $event['id'] ?>">Edit</a>
            <form method="post" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $event['id'] ?>">
            <button type="submit">Delete</button>
    </form>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</section>



    
</body>
</html>