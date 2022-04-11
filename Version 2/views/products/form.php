<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
       <div> <?php echo $error ?> </div>
        <?php endforeach; ?>
</div>
<?php endif; ?>


<section class="card">
        <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">

    <?php if($event['image']): ?>
        <img src="../<?php echo $event['image'] ?>" class="update-image">
<?php endif ?>

        <div class="form-group">
        <label>Event Poster</label>
        <div><input type="file" name="image" ></div>
</div>
<div class="form-group">
        <label>Event Title</label>
        <div><input type="text" name="title" class="form-control" value="<?php echo $title ?>"></div>
</div>
<div class="form-group">
        <label>Event Details</label>
        <div><textarea name="description" class="form-control" value="<?php echo $description ?>"></textarea></div>
</div>
<div class="form-group">
        <label>Event Registration Fee</label>
        <div><input type="number" step=".01" name="price" class="form-control" value="<?php echo $price ?>"></div>
</div>
<div>
<button type="submit" name="submit" class="btn btn-success btn-lg">Create</button>
    </div>
    </form>
    </div>
    <section>
