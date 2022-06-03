<?php
        $tabla = $conn->prepare("SELECT M.id_menu, M.dia, P.nombre proteinicos, A.nombre arroces, J.nombre jugos,
            ASA.nombre asados, PR.nombre principios, E.nombre energicos, EN.nombre ensaladas, S.nombre sopas, AC.nombre acompañantes
            FROM plazautb.menus M, plazautb.proteinicos P, plazautb.arroces A, plazautb.jugos J, plazautb.asados ASA, plazautb.principios PR, 
            plazautb.energicos E, plazautb.ensaladas EN, plazautb.sopas S, plazautb.acompañantes AC 
            WHERE 
             M.id_proteinico=P.id_proteinico AND M.id_energico=E.id_energico
            AND M.id_principio=PR.id_pricipio AND M.id_ensalada=EN.id_ensalda
            AND M.id_arroz=A.id_arroz AND M.id_sopa=S.id_sopa
            AND M.id_jugo=J.id_jugo AND M.id_acompañante=AC.id_acompañante
            AND M.id_asado=ASA.id_asado order by id_menu");
        $tabla->execute();

        ?>