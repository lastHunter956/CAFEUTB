<?php
session_start();

require 'db/database.php';
require 'partials/tabla_semana.php';

if (!($_SESSION['user_rol']) == '2') {
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
}

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

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles/tabla.css">

    <title>Admin | Plaza</title>
</head>

<body>

    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <!--<img src="assets/img/perfil.jpg" alt="" class="header__img">-->

                <a href="admin.php" class="header__logo nav__link">Plaza</a>



                <!--<div class="header__search">
                    <input type="search" placeholder="Search" class="header__input">
                    <i class='bx bx-search header__icon'></i>
                </div>-->

                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="index.php" class="nav__link nav__logo">
                        <i class='bx bxs-hard-hat nav__icon'></i>
                        <span class="nav__logo-name">Plaza</span>
                    </a>

                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Analisis</h3>

                            <a href="admin.php" class="nav__link ">
                                <i class='bx bxs-briefcase-alt-2 nav__icon'></i>
                                <span class="nav__name">Proceso</span>
                            </a>

                            <div class="nav__dropdown">
                                <a href="editar_menu.php" class="nav__link active">
                                    <i class='bx bxs-food-menu nav__icon'></i>
                                    <span class="nav__name">Menu</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="editar_menu.php" class="nav__dropdown-item">Editar Menu</a>
                                        <a href="#" class="nav__dropdown-item">Historial</a>
                                        <a href="#" class="nav__dropdown-item">New</a>
                                    </div>
                                </div>
                            </div>
                            <!--

                            <a href="reporte.php" class="nav__link">
                                <i class='bx bxs-report nav__icon'></i>
                                <span class="nav__name">Reporte</span>
                            </a>
                            -->
                        </div>

                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>

                            <!--<div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bx-bell nav__icon' ></i>
                                    <span class="nav__name">Notifications</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="#" class="nav__dropdown-item">Blocked</a>
                                        <a href="#" class="nav__dropdown-item">Silenced</a>
                                        <a href="#" class="nav__dropdown-item">Publish</a>
                                        <a href="#" class="nav__dropdown-item">Program</a>
                                    </div>
                                </div>

                            </div>-->

                            <a href="index.php" class="nav__link">
                                <i class='bx bxs-home-alt-2 nav__icon'></i>
                                <span class="nav__name">Home</span>
                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-bookmark nav__icon'></i>
                                <span class="nav__name">Saved</span>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="logout.php" class="nav__linkl nav__logout">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">Cerrar Sesión</span>
                </a>
            </nav>
        </div>
    
        <!--========== CONTENTS ==========-->
        <main>
            <section>
                <div class="table-conntainer">
                    <h1 class="heading">EDITAR MENU - SEMANA</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                <th>Editar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($tabla as $tabla) {
                            ?>
                                <tr>
                                    <td data-label = "ID"><?php echo $tabla['id_menu'] ?></td>
                                    <td data-label = "Dias"><?php echo $tabla['dia'] ?></td>
                                    <td data-label = "Proteinico"><?php echo $tabla['proteinicos'] ?></td>
                                    <td data-label = "Arroces"><?php echo $tabla['arroces'] ?></td>
                                    <td data-label = "Asados"><?php echo $tabla['asados'] ?></td>
                                    <td data-label = "Principios"><?php echo $tabla['principios'] ?></td>
                                    <td data-label = "Energicos"><?php echo $tabla['energicos'] ?></td>
                                    <td data-label = "Juegos"><?php echo $tabla['jugos'] ?></td>
                                    <td data-label = "Acompañantes"><?php echo $tabla['acompañantes'] ?></td>
                                    <td data-label = "Sopas"><?php echo $tabla['sopas'] ?></td>
                                    <td data-label = "Ensaladas"><?php echo $tabla['ensaladas'] ?></td>
                                    <td data-label = "Editar"><a href="editar.php?id=<?php echo $tabla['id_menu'] ?>" class="btn">Editar</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>


            </section>
        </main>
        <script src="assets/js/main.js"></script>
    </body>

</html>