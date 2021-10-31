<?php
if($_SERVER["REQUEST_METHOD"] === "POST" ){ 
    $errors=[];

    $uploadDir = 'photos/';

    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

    $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

    $extensions_ok = ['jpg','webp','png'];

    $maxFileSize = 1000000;
    
    $user = array_map('trim', $_POST);


    if( (!in_array($extension, $extensions_ok ))){

        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Webp ou Png !';

      }

    if( file_exists($_FILES['photo']['tmp_name']) && filesize($_FILES['photo']['tmp_name']) > $maxFileSize)

    {

    $errors[] = "Votre fichier doit faire moins de 1M !";


    if(empty($user['lastname'])) {
        $errors[] = 'le nom est obligatoire';
    }

    if(empty($user['firstname'])) {
    $errors[] = 'le prénom est obligatoire';

    }

    if(empty($user['age'])) {
    $errors[] = 'l\'age est obligatoire';
    
    }
}

    if(empty($errors)) {

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            echo '<img src="'.$uploadFile.'" alt="Homer"> <br>';
            echo  $user['lastname'] . ' ' . $user['firstname'] . ' ' . $user['age'] . " ans";
        };

    } else {
        echo implode('<br>',$errors);
    }


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">

        <label for="imageUpload">Ajouter la foto</label>
        <input type="file" name="photo" id="imageUpload" required/>
        
        <label for = "lastname">Nom</label>
        <input type ="text" name="lastname" id="lastname" required>


        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="age">Age</label>
        <input type="number" name="age" id="age">



        <button name="send">Envoyer</button>

    </form>
</body>

</html>