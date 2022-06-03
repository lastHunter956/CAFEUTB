<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        *{
            padding: auto;
            margin: 10px;
        }
         
        table{
            background-color: #F2EBE9;
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }
        th, td{
            padding: 5px;
        }
        thead{
            background-color: #243A73;
            border-bottom: solid 6px #7C3E66; 
            color: white;
            font-size: 30px;
        }
        tr:nth-child(even){
            background-color: #A5BECC;
        }
    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reporte.css">
    <title>Reporte de ventas</title>


</head>

<body class="">
    <?php
    require 'db/database.php';
    require 'partials/estadistica.php';

    ?>
    
    <head>
        <h5 align="right">Generado el <?php echo Date("y-m-d")?></h5>
    </head>


    <main>
    <h1 align="center">Informe de  las ventas</h1>
    <h3>Se evidencias de las ventas actuales de la cafeteria <i>Placita</i></h3>
    

    <div class="table-wrapper">
    <table border="1px" align="center" class="fl-table">
        <thead>
            <tr>
                <td><b>Presentación de la comida</b></td>
                <td><b>Cantidad (udds)</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Almuerzo Estudiantil</td>
                <td><?php tipo(1) ?></td>
            </tr>
            <tr>
                <td>Almuerzo Seco Ejecutivo</td>
                <td><?php tipo(2) ?></td>
            </tr>
            <tr>
                <td>Almuerzo Completo Ejecutivo</td>
                <td><?php tipo(3) ?></td>
            </tr>
            <tr>
                <td>Almuerzo Especial Grande</td>
                <td><?php tipo(5) ?></td>
            </tr>
            <tr>
                <td>Almuerzo Especial Pequeño</td>
                <td><?php tipo(4) ?></td>
            </tr>
            <tr>
                <td><b>Ganancia del dia <?php echo Date("y-m-d")?><b></td>
                <td><?php ganacia_dia() ?></td>
            </tr>
            <tr>
                <td><b>Ganancia del mes <?php echo Date("y-m")?><b></td>
                <td><?php ganacia_mes() ?></td>
            </tr>
            <tr>
                <td><b>Ganancias Totales<b></td>
                <td><?php ganacia_to() ?></td>
            </tr>
        </tbody>
    </table>
    </div>
        
    
    </main>

</body>

</html>

<?php
$html = ob_get_clean();

require_once 'lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf;

$option = $dompdf->getOptions();
$option->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($option);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("Reporte.pdf", array("Attachment" => false));

?>