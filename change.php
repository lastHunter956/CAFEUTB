<?php
    require 'db/database.php';
    if(isset($_GET['codigo'])){
        $id=$_GET['codigo'];

        $query = $conn->prepare("UPDATE compras SET estado='Desactivado' WHERE id_compra=$id");
        if($query->execute()){
            header("Location: trabajador_empleado.php");
        }
        
    }
?>