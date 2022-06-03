<?php
$proteinicos = "proteinicos";
$arroces ="arroces";
$asados ="asados";
$principios ="principios";
$energicos ="energicos";
$jugos ="jugos";
$acompañantes ="acompañantes";
$sopas="sopas";
$ensaladas = "ensaladas";

$proteinico = "proteinico";
$ensalada = "ensalda";
$arroce ="arroz";
$asado ="asado";
$principio ="pricipio";
$energico ="energico";
$jugo ="jugo";
$acompañante ="acompañante"; 
$sopa="sopa";
$id = $_GET['id'];
//$p=array("proteinico,arroces,asados,principios,energicos,jugos,acompañantes,Sopas");
function producto($prod, $pro)
{
    $p="id_$pro";
    require 'db/database.php';
    $producto = $conn->prepare("SELECT $p as id, nombre FROM $prod");
    $producto->execute(); 
    ?>
        <select name="<?php echo $pro ?>"class="controls">
        <?php foreach ($producto as $producto) {?>
            <option value="<?php echo $producto['id'] ?>"><?php echo $producto['nombre'] ?></option>
            <?php }?>
        </select>
    <?php   
}
?>