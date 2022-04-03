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
        <img src="../<?php echo $event['image'] ?>" class="update-image">
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
