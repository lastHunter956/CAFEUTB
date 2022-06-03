<?php

    session_start();

    if (isset($_SESSION['user_id'])){
        header('Location: index.php');
    }
    require 'db/database.php';

    $message = "";
    $message_email = "";
    $message_pas ="";


    if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['apellido'])){ //Se verifica si estos campos eestan 
        if($_POST['pass'] == $_POST['cpass']){
            $consulta = "SELECT email FROM users WHERE email=:email";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':email',$_POST['email']);
            $stmt->execute();
            
            if(!$stmt->rowCount() > 0){
                $consulta = "INSERT INTO users (user, apellido, email, pass, id_rol) VALUES (:user, :apellido, :email, :pass, 1)";
                $stmt = $conn->prepare($consulta); //prepare es para ejecutar una consulta SQL
                $stmt->bindParam(':user',$_POST['user']); // bindParam esto es para vinvular parametros
                $stmt->bindParam(':email',$_POST['email']);
                $password = password_hash($_POST['pass'], PASSWORD_BCRYPT); //PARA INCRISTAR UNA CONTRASEÑA EN LA BASE DE DATO
                $stmt->bindParam(':pass',$password);
                $stmt->bindParam(':apellido',$_POST['apellido']);

                if($stmt->execute()){
                    $message = "usuario creado con exito";
                }else{
                    $message = "Error";
                }
            }else{
                $message_email = "el correo ya existe";
            }
        }else{
            $message_pas = "contraseñas no son iguales";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/hacker.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/crear.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Register | Plaza</title>
</head>

<body>



    <!--<ul>
        <?php //require 'partials/header.php'
        ?>
        <li><a href="index.php" >Home</a></li>
        <li><a href="login.php" class = "active">Login</a></li>
        <li><a href="signup.php">Signup</a></li>
    </ul>-->

    <main>
    <div class="container">
            <form method="post" class="formm">
            <div class="brand-title">REGISTRAR</div>
            
            <div class="inputs">
            <label>Nombre</label>
            <input type="text" name="user" id="user" placeholder="Colocar caracteres validos">
            <label>Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Colocar caracteres validos">
            <label>Correo electronico</label>
            <input type="email" name="email" id="email" placeholder="prueba@frsd.com">
            <?php if (!empty($message_email)) : ?>
                <p><?= $message_email ?></p>
            <?php endif; ?>
            <label>Contraseña</label>
            <input type="password" name="pass" id="pass" placeholder="minimo 6 caracters">
            <label>Repetir contraseña</label>
            <input type="password" name="cpass" id="cpass" placeholder="minimo 6 caracters">
            <?php if (!empty($message_pas)) : ?>
                <p><?= $message_pas ?></p>
            <?php endif; ?>
            <button type="submit" name="submit">Crear usuario</button>
            <?php if (!empty($message)) : ?>
                <p><?= $message ?></p>
            <?php endif; ?>
            <br>
            <p><a href="index.php" target="_blank">INICIO</a></p>
                
    

        </form>
            </div>

    </main>
    <script src="assets/nav.js"></script>
</body>

</html>