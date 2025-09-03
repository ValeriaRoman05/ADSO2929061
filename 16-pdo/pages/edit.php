<?php
include '../config/app.php';
include '../config/database.php';
include '../config/security.php';

if($_GET){
    $pet=listPet($_GET['id'], $conx);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Edit</title>
    <link rel="stylesheet" href="<?= $css ?>stylee.css">
</head>
<body>
    <main class="edit">
        <header>
            <h2>Modificar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>
        <figure class="photo-preview">
            <img id="preview" src="../uploads/<?=$pet['photo']?>" alt="">
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nombre" value="<?php if(isset($pet['name'])) echo($pet['name'])?>">
            <div class="select">
                <select name="specie_id">
                    <option value="">Seleccione Raza...</option>
                    <?php $species = listSpecies($conx) ?>
                    <?php foreach($species as $specie): ?>
                    <option value="<?=$specie['id']?>" <?php if(isset($pet['specie_id']) && $pet['specie_id'] == $specie['id']) echo("selected")?>><?=$specie['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="select">
                <select name="breed_id">
                    <option value="">Seleccione Categoría...</option>
                    <?php $breeds = listBreeds($conx) ?>
                    <?php foreach($breeds as $breed): ?>
                    <option value="<?=$breed['id']?>" <?php if(isset($pet['breed_id']) && $pet['breed_id'] == $breed['id']) echo("selected")?>><?=$breed['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="button" class="upload">Subir Foto</button>
            <input type="file" name="photo" id="photo" accept="image/*" style="display: none;" value="<?=$pet['photo']?>">
            <div class="select">
                <select name="sex_id">
                    <option value="">Seleccione Genero...</option>
                    <?php $sexes = listSexes($conx) ?>
                    <?php foreach($sexes as $sex): ?>
                    <option value="<?=$sex['id']?>" <?php if(isset($pet['sex_id']) && $pet['sex_id'] == $sex['id']) echo("selected")?>><?=$sex['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button class="update">Modificar</button>
        </form>
        <?php
            if($_POST){
                $errors=0;
                
                // Comprobar si otros campos están vacíos
                if(empty($_POST['name']) || empty($_POST['specie_id']) || empty($_POST['breed_id']) || empty($_POST['sex_id'])){
                    $errors++;
                }

                if ($errors == 0){
                    $name=$_POST['name'];
                    $specie_id=$_POST['specie_id'];
                    $breed_id=$_POST['breed_id'];
                    $sex_id =$_POST['sex_id'];
                    $photo_to_update = $pet['photo']; // Asumir que no hay actualización de foto

                    // Comprobar si se subió una nueva foto
                    if (!empty($_FILES['photo']['name'])) {
                        $photo_to_update = time().'.'.pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/'.$photo_to_update);
                        // Eliminar la foto antigua
                        if (file_exists('../uploads/' . $pet['photo']) && !empty($pet['photo'])) {
                            unlink("../uploads/" . $pet['photo']);
                        }
                    }

                    if(updatePet($pet['id'], $name, $specie_id, $breed_id, $sex_id, $photo_to_update, $conx)){
                        $_SESSION['message']= "La mascota: $name fue actualizada con exito";
                        echo "<script> window.location.replace('dashboard.php') </script>";
                    } else {
                        $_SESSION['error'] = "Hubo un problema al actualizar la mascota.";
                    }

                }else{
                    $_SESSION['error']="Todos los campos son requeridos";
                }

                if(isset($_SESSION['error'])){
                    include('errors.php');
                    unset($_SESSION['error']);
                }
            }
        ?>
    </main>
    <script>
        const preview=document.querySelector('#preview')
        const upload=document.querySelector('.upload')
        const photo=document.querySelector('#photo')

        upload.addEventListener('click', function(e){
            photo.click()
        })

        photo.addEventListener('change', function(e){
            preview.src=window.URL.createObjectURL(this.files[0])
        })
    </script>
</body>
</html>