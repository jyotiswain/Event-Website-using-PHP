<?php

// $title = $event['title'];
// $price = $event['price'];
// $description = $event['description'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$imagePath = '';


if(!$title){
    $errors[]= 'Event Title is required!';
}

if(!$price){ 
    $errors[]= 'Event Registration Fee is required!';
}

if(!is_dir(__DIR__.'/public/images')){
    mkdir(__DIR__.'/public/images');
}

if(empty($errors)){

    $image = $_FILES['image'] ?? null;
    $imagePath =$event['image'];


    if($image && $image['tmp_name'] ){

        if($event['image']){
            unlink(__DIR__.'/public/'.$event['image']);
        }
        

        $imagePath = 'images/'.randomString(8).'/'.$image['name']; 
        mkdir(dirname(__DIR__.'/public/'.$imagePath));

        move_uploaded_file($image['tmp_name'], __DIR__.'/public/'.$imagePath);
    }

}
}

?>