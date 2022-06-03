<?php
session_start();

require 'db/database.php';

if (($_SESSION['user_rol']) != '3') {
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
}

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare("SELECT id,user,email FROM users WHERE id=:id");
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
    <link rel="stylesheet" href="styles/forms.css">
    <link rel="stylesheet" href="styles/tabla_tra.css">


    <title>plazautb</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <?php require 'partials/header.php' ?>

            <button class="navbar-button" id="toggle-button"> <i class="bx bx-menu" id="toggle-icon"></i> </button>
            <ul class="navbar-list">
                <li class="navbar-item"><a href="index.php" class="navbar-link"><i class="fa-solid fa-house"></i> Home</a></li>
                <li class="navbar-item"><a href="trabajador_empleado.php" class="navbar-link"><i class='fa-solid bx bx-notepad'></i> Pedidos</a></li>
        

                <?php if (!empty($user)) {
                ?>
                    <li class="navbar-item"><a href="login.php" class="navbar-link"><?= $user['user'] ?></a></li>
                    <li class="navbar-item"><a href="logout.php" class="navbar-exit"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                <?php

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
            <img src="https://i.ibb.co/581K5D3/trabajador.jpg" />
            <a href="#" class="btn_inf">Bienvenidos Plazita Alimetation System</a>
            
        </div>
        <br>
        <form action="" method="get">
            <input type="text" name="busqueda">
            <input type="submit" name="enviar" value="Buscar">
        </form>
        </div>
            <?php
            if (isset($_GET['enviar'])) {
                $busqueda = $_GET['busqueda'];
                //$consulta = $conn->prepare("SELECT * FROM compras WHERE id_compra LIKE '%$busqueda%' AND estado='Activo'");
                $consulta = $conn->prepare("SELECT U.user 'nombre', U.apellido 'apellido', U.id 'id', C.id_compra 'id_compra', 
                concat('almuerzo ',T.nombre_comida) 'producto'
                FROM plazautb.compras C, plazautb.tiposcomida T, plazautb.users U 
                where id_compra LIKE '%$busqueda%'and C.id=U.id and C.id_comida=T.id_comida and estado='Activo'");
                $consulta->execute();
            ?>

                <div class="table-conntainer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Producto</th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($consulta as $consulta) { 
                                
                            ?>
                                <tr>
                                    <td data-label="Codigo"><?php echo $consulta['id_compra'] ?></td>
                                    <td data-label="ID"><?php echo $consulta['id']?></td>
                                    <td data-label="Nombre"><?php echo $consulta['nombre']?></td>
                                    <td data-label="Apellido"><?php echo $consulta['apellido']?></td>
                                    <td data-label="Producto"><?php echo $consulta['producto'] ?></td>
                                    <td><a href="change.php?codigo=<?php echo $consulta['id_compra']?>" class="btn">Listo</a></td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>


            <?php  } ?>
    </main>

    <script src="partials/nav.js"></script>
    <script src="https://kit.fontawesome.com/1642ce9338.js" crossorigin="anonymous"></script>
</body>
<footer></footer>

</html>