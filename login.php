<?php 
    session_start();

    if (isset($_SESSION['user_id'])){
        header('Location: index.php');
    }
    
    require "db/database.php";

    if(!empty($_POST['email']) && !empty($_POST['pass'])){
        $records = $conn->prepare('SELECT id, email, pass, id_rol FROM users WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT email FROM users WHERE email=:email");
        $stmt->bindParam(':email',$_POST['email']);
        $stmt->execute();

        $messeger = "";
        if($stmt->rowCount() > 0){
            if(count($results) > 0 && password_verify($_POST['pass'], $results['pass'])){
                $_SESSION['user_id'] = $results['id'];
                $_SESSION['user_rol']= $results['id_rol'];
                if($_SESSION['user_rol'] == '2'){
                    header('Location: admin.php');
                }
                else if($_SESSION['user_rol'] == '3'){
                    header('Location: trabajador_empleado.php');
                }
    
                else if($_SESSION['user_rol'] == '1'){
                    header('Location: index.php');
                }
                
            }else{
                $messeger="contraseña o/e email incorrecto";
            }
        }else{
                $messeger="contraseña o/e email incorrecto";
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
    <link rel="stylesheet" href="styles/login.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Login | Plaza</title>
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
            <div class="brand-logo"></div>
            <div class="brand-title">INGRESAR</div>
            <div class="inputs">
                
            <form action="login.php" method="post" class="formm">
            <label>correo electronico</label>
            <input class="control" type="email" name="email" id="email" placeholder="prueba@fsw.co">
            <label>contraseña</label>
            <input class="control" type="password" name="pass" id="pass" placeholder="minimo 6 caracteres">
            <button type="submit" name="submit">Enviar</button>
            <?php if (!empty($messeger)) : ?>
                <p style="color: red;"><?= $messeger ?></p>
            <?php endif; ?>
        </form>
            </div>

        </div>








    </main>
    <script src="https://kit.fontawesome.com/1642ce9338.js" crossorigin="anonymous"></script>
    <script src="assets/nav.js"></script>
</body>

</html>