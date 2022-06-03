<?php
session_start();

require 'db/database.php';


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


$id_u = $user['id'];
$con_h = $conn->prepare("SELECT T.nombre_comida 'tipo', C.id_compra 'codigo', C.estado 'estado',C.fecha_compra 'fecha'
FROM plazautb.compras C 
inner join plazautb.tiposcomida T on T.id_comida=C.id_comida
where C.id=$id_u
order by estado;");
$con_h->execute();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/hacker.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/registe.css">
    <link rel="stylesheet" href="styles/navp.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/tabla_historial.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">



    <title>Plaza</title>
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
        <h1>Historial de Usuario</h1>

        <div class="table-conntainer">
        <table class="table">
            <thead>
                <tr>
                <td>Presentacion</td>
                <td>Codigo</td>
                <td>Estado</td>
                <td>Dia de compra</td>

                </tr>
                
            </thead>
            <tbody>
                <?php foreach($con_h as $con_h){?>
                <tr>
                <td data-label="Presentacion"><?php echo $con_h['tipo']?></td>
                <td data-label="Codigo"><?php echo $con_h['codigo']?></td>
                <td data-label="Estado"><?php echo $con_h['estado']?></td>
                <td data-label="Dia"><?php echo $con_h['fecha']?></td>
                </tr>
                
                <?php  } ?>
            </tbody>
        </table>
        </div>

        <br>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col">
                        <h4>Conocenos</h4>
                        <ul>
                            <li><a href="#">Sobre nosotros</a></li>
                            <li><a href="#">nuestros servicios</a></li>
                            <li><a href="#">política de privacidad</a></li>
                            <li><a href="#">programa de afiliados</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Obtener ayuda</h4>
                        <ul>
                            <li><a href="#">PREGUNTAS MÁS FRECUENTES</a></li>
                            <li><a href="#">naviero</a></li>
                            <li><a href="#">Devuelve</a></li>
                            <li><a href="#">estado del pedido</a></li>
                            <li><a href="#">opciones de pago</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Servicios web</h4>
                        <ul>
                            <li><a href="#">Banner</a></li>
                            <li><a href="#">Savio</a></li>
                            <li><a href="#">Trabaja con nosotros</a></li>
                            <li><a href="#">Portal 365</a></li>
                            <li><a href="#">Come DoReTIC</a></li>
                            <li><a href="#">Calidad Online</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>síguenos</h4>
                        <a href="#"><img src="img/LOGO EN BLANCO Y NEGRO-02.png" /></a>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



    </main>
    <script src="assets/acordion.js"></script>
    <script src="assets/nav.js"></script>
    <script src="https://kit.fontawesome.com/1642ce9338.js" crossorigin="anonymous"></script>
</body>

</html>