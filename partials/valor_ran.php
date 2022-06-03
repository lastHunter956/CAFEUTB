<?php 

function valor_random(){
    require 'db/database.php';
    $con_cod = $conn->prepare("SELECT id_compra FROM compras WHERE id_compra=:id_compra");
    $con_cod->bindParam(':id_compra', $d);
    $con_cod->execute();
    $d=rand(11111,99999);

    if(!$con_cod->rowCount() > 0){
        return $d;
    }else{
        valor_random();
    }
}

?>