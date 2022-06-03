<?php
session_start();

require 'db/database.php';
require 'partials/valor_ran.php';



$message = "";

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare("SELECT id,user,email,id_rol FROM users WHERE id=:id");
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if (count($results) > 0) {
        $user = $results;
    }
}

if ($conn) {
    $tipos_c = $conn->prepare("SELECT * FROM tiposcomida");
    $tipos_c->execute();





    //$re_tipos = $tipos_c->fetch(PDO::FETCH_ASSOC);

    //$valor = $re_tipos;
    




    $consulta = "SELECT email FROM users WHERE email=:email";
    $stmt = $conn->prepare($consulta);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    if (!empty($_POST['producto_m']) && !empty($_POST['email']) && !empty($_POST['precio']) && !empty($_POST['fecha'])) {
        if ($stmt->rowCount() == 1) { //Se verifica si estos campos eestan 
            $cons = "INSERT INTO compras (id_compra,email,id_comida,id,estado,fecha_compra) VALUES (:id_compra, :email, :producto, :user, 'Activo', :fecha)";
            $stmt = $conn->prepare($cons); //prepare es para ejecutar una consulta SQL
            $stmt->bindParam(':producto', $_POST['producto_m']); // bindParam esto es para vinvular parametros
            $stmt->bindParam(':user',$user['id']);
            $stmt->bindParam(':id_compra', $_POST['id_compra']);
            $stmt->bindParam(':fecha', $_POST['fecha']);
            $stmt->bindParam(':email', $_POST['email']);
            //$stmt->bindParam(':total', $_POST['total']);

            if ($_POST['email'] == $results['email']) {
                $stmt->execute();
                $message = "Successfully created new user";
            } else {
                $message = "Error";
            }
        } else {
            $message = "Unos de los campos estan vacios";
        }
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

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="styles/registe.css">
    <link rel="stylesheet" href="styles/navp.css">  
    <!--
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/buttons.css">
    <link rel="stylesheet" href="styles/acordeon.css">
    <link rel="stylesheet" href="styles/carrusel.css">
    -->
    <link rel="stylesheet" href="styles/compras.css">

    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">



    <title>Plaza | Compras</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <?php require 'partials/header.php' ?>
            <button class="navbar-button" id="toggle-button"> <i class="bx bx-menu" id="toggle-icon"></i> </button>
            <ul class="navbar-list">
                
                <li class="navbar-item"><a href="index.php" class="navbar-link"><i class="fa-solid fa-house"></i> Home</a></li>
                <li class="navbar-item"> <a href="compras.php" class="navbar-link"><i class="fa-solid fa-wallet"></i> Compras</a></li>
                <li class="navbar-item"> <a href="historial_cliente.php" class="navbar-link"><i class='fa-solid bx bx-history'></i> Historial</a></li>


                <?php if (!empty($user)) {
                    if ($user['id_rol'] == '2') {
                ?>
                        <li class="navbar-item"><a href="admin.php" class="navbar-link"><i class="fa-solid fa-hammer"></i> Admin</a></li>
                        <li class="navbar-item"><a href="login.php" class="navbar-link"><?= $user['user'] ?></a></li>
                        <li class="navbar-item"><a href="logout.php" class="navbar-exit"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    <?php
                    } else {
                    ?>
                        <li class="navbar-item"><a href="login.php" class="navbar-link"><?= $user['user'] ?></a></li>
                        <li class="navbar-item"><a href="logout.php" class="navbar-exit"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="navbar-item"><a href="login.php" class="navbar-link navbar-contact"><i class="fa-solid fa-user"></i> Login</a></li>
                    <!--<li class="navbar-item"><a href="signup.php" class="navbar-link">Signup</a></li>-->
                <?php
                } ?>
            </ul>
        </nav>
    </header>
    <main>
    <br>  
        <form method="post" class="container">
            <div class="c_titulo">
                <a class="titulo">
                    <div class="brand-title"><i class='bx bx-money-withdraw'></i>Plaza Tiquete</div>
                </a>
            </div>

            <?php require 'partials/form_compras.php';?>
            <?php $producto = NULL; $va_t = 0;?>
            <button type="submit" name="submit" class="custom-btn btn-15"><b>Enviar</b></button>
            
            <?php if (!empty($message)) : ?>
                <p style="color: red;"><?= $message ?></p>
            <?php endif; ?>
        </form>

        


    </main>
    <script src="assets/operacion.js"></script>
    <script src="assets/acordion.js"></script>
    <script src="assets/nav.js"></script>
    <script src="https://kit.fontawesome.com/1642ce9338.js" crossorigin="anonymous"></script>
</body>

</html>