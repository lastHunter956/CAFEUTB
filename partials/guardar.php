<?php
    if(isset($_POST['id'])){
        $guar = $conn->prepare("UPDATE menus SET id_proteinico=:proteinico,
        id_arroz=:arroz, id_sopa=:sopa, id_principio=:pricipio, id_asado=:asado,
        id_energico=:energico, id_jugo=:jugo, id_ensalada=:ensalada,
        id_acompañante=:acompanante
        WHERE id_menu=:id" );

        $guar->bindParam(':id', $_POST['id']); // bindParam esto es para vinvular parametros
        $guar->bindParam(':proteinico',$_POST['proteinico']);
        $guar->bindParam(':arroz', $_POST['arroz']);
        $guar->bindParam(':pricipio', $_POST['pricipio']);
        $guar->bindParam(':sopa', $_POST['sopa']);
        $guar->bindParam(':asado', $_POST['asado']);
        $guar->bindParam(':energico', $_POST['energico']);
        $guar->bindParam(':jugo', $_POST['jugo']);
        $guar->bindParam(':ensalada', $_POST['ensalda']);
        $guar->bindParam(':acompanante', $_POST['acompañante']);
        $guar->execute();
    }

?>
