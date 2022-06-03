<?php
function tipo($tipo)
{
    require 'db/database.php';
    $tip = $conn->prepare("SELECT count(*) 'tipo' FROM compras where id_comida=$tipo");
    $tip->execute(); 
    $t=$tip->fetch(PDO::FETCH_ASSOC);
    ?>
        <p><?php echo $t['tipo']?></p>
    <?php   
}

function ganacia_dia(){
    require 'db/database.php';
    $gan = $conn->prepare("SELECT sum(T.precio) 'dia' 
    FROM compras C 
    inner join tiposcomida T on (C.id_comida=T.id_comida)
    where day(fecha_compra)=day(curdate())");
    $gan->execute(); 
    $g=$gan->fetch(PDO::FETCH_ASSOC);

    ?>
        <a><?php echo number_format($g['dia'])?></a>
    <?php
}


function ganacia_mes(){
    require 'db/database.php';
    $gan = $conn->prepare("SELECT sum(T.precio) 'mes' 
    FROM compras C 
    inner join tiposcomida T on (C.id_comida=T.id_comida)
    where month(fecha_compra)=month(curdate())");
    $gan->execute(); 
    $g=$gan->fetch(PDO::FETCH_ASSOC);

    ?>
        <a><?php echo number_format($g['mes'])?></a>
    <?php
}

function ganacia_to(){
    require 'db/database.php';
    $gan = $conn->prepare("SELECT sum(T.precio) 'total'
    FROM compras C 
    inner join tiposcomida T on (C.id_comida=T.id_comida)");
    $gan->execute(); 
    $g=$gan->fetch(PDO::FETCH_ASSOC);

    ?>
        <a><?php echo number_format($g['total'])?></a>
    <?php
}


?>

