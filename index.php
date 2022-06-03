<?php
session_start();

require 'db/database.php';
require 'partials/tabla_semana.php';

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
    <link rel="stylesheet" href="styles/acordeon.css">
    <link rel="stylesheet" href="styles/tarjeta.css">
    <link rel="stylesheet" href="styles/tabla_index.css">
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
                    }else if ($user['id_rol'] == '3'){
                        ?>
                        <li class="navbar-item"><a href="trabajador_empleado.php" class="navbar-link"><i class='fa-solid bx bx-notepad'></i> Pedidos</a></li>
                        <li class="navbar-item"><a href="login.php" class="navbar-link"><?= $user['user'] ?></a></li>
                        <li class="navbar-item"><a href="logout.php" class="navbar-exit"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    <?php
                    
                    }else {
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
        <div class="logos">
            <img src="https://i.ibb.co/txb8PZR/fondo-home-3.png" />
            <a href="#" class="btn_inf">Bienvenidos Plazita Alimetation System</a>
        </div>

        <h1>Echale un vistazo a nuestro delicioso menu</h1>

        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-item-header">
                    Menu
                </div>
                <div class="accordion-item-body">
                    <div class="accordion-item-body-content">
                        <section>
                        <scroll-container>
                        <div class="table-conntainer">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Dias</th>
                                            <th>Proteinico</th>
                                            <th>Arroces</th>
                                            <th>Asados</th>
                                            <th>Principios</th>
                                            <th>Energicos</th>
                                            <th>Jugos</th>
                                            <th>Acompañantes</th>
                                            <th>Sopas</th>
                                            <th>Ensaladas</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($tabla as $tabla) {
                                        ?>
                                            <tr>
                                                <td data-label="Dias"><?php echo $tabla['dia'] ?></td>
                                                <td data-label="Proteinico"><?php echo $tabla['proteinicos'] ?></td>
                                                <td data-label="Arroces"><?php echo $tabla['arroces'] ?></td>
                                                <td data-label="Asados"><?php echo $tabla['asados'] ?></td>
                                                <td data-label="Principios"><?php echo $tabla['principios'] ?></td>
                                                <td data-label="Energicos"><?php echo $tabla['energicos'] ?></td>
                                                <td data-label="Juegos"><?php echo $tabla['jugos'] ?></td>
                                                <td data-label="Acompañantes"><?php echo $tabla['acompañantes'] ?></td>
                                                <td data-label="Sopas"><?php echo $tabla['sopas'] ?></td>
                                                <td data-label="Ensaladas"><?php echo $tabla['ensaladas'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>


                        </section>

                                        </scroll-container>
                            
                    </div>
                </div>
            </div>

        </div>

        <div class="card2">
            <div class="horizontal">
                <a href="#"><img src="https://i.ibb.co/CPvjPbh/plaza.jpg"></a>
            </div>
            <div class="texto">
                <i><p>Nuestros platos han sido creados por expertos en alimentación para que nuestros 
                    estudiantes tenga el mejor rendimiento despues de consumir nuestros manjares.</p></i>
            </div>
        </div>

        <h1>Mira nuestras diferentes presentaciones</h1>

        <div class="cards">

            <div class="card-body">
                <img src="img/descarga.jpg" class="card-img-top" alt="">
                <h5>Almuerzo Estudiantil</h5>
                <p>Precio: $6500</p><br>
                <a href="compras.php" class="pedir">Pedir</a>
            </div>

            <div class="card-body">
                <img src="https://i.ibb.co/mHFZjCV/seco.jpg" class="card-img-top" alt="">
                <h5>Almuerzo Seco Ejecutivo</h5>
                <p>Precio: $7500</p><br>
                <a href="compras.php" class="pedir">Pedir</a>
            </div>

            <div class="card-body">
                <img src="img/completo.jpg" class="card-img-top" alt="">
                <h5>Almuerzo Completo Ejecutivo</h5>
                <p>Precio: $8500</p><br>
                <a href="compras.php" class="pedir">Pedir</a>
            </div>

            <div class="card-body">
                <img src="img/especial_grande.jpg" class="card-img-top" alt="">
                <h5>Almuerzo Especial Grande</h5>
                <p>Precio: $10500</p><br>
                <a href="compras.php" class="pedir">Pedir</a>
            </div>

            <div class="card-body">
                <img src="img/especial_pequeña.jpg" class="card-img-top" alt="">
                <h5>Almuerzo Especial Pequeño</h5>
                <p>Precio: $9000</p><br>
                <a href="compras.php" class="pedir">Pedir</a>
            </div>
        </div>

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
                        <a href="#"><img src="https://i.ibb.co/Fz6dkJC/LOGO-EN-BLANCO-Y-NEGRO-02.png" /></a>
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