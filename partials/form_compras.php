<?php
            

            if (empty($tipos_v)) {
            ?>
                <div class="select">
                    <select name="producto" id="lista1" >
                        <option>SELECCIONA</option>
                        <?php
                        foreach ($tipos_c as $tipos_c) {
                        ?>
                            <option value="<?php echo $tipos_c['id_comida'] ?>"><?php echo $tipos_c['nombre_comida'] ?></option>
                        <?php } ?>
                    </select>
                </div>

            <?php
            }
            
            if (!empty($_POST['producto'])) {

                $tipos_v = $conn->prepare("SELECT precio FROM tiposcomida WHERE id_comida=:producto");
                $tipos_v->bindParam(':producto', $_POST['producto']);
                $tipos_v->execute();
                $v_t = $tipos_v->fetch(PDO::FETCH_ASSOC);

                if (!empty($user)) {
                    $va_p = $user['email'];
                } else {
                    $va_p = "";
                }

                

                if (isset($v_t['precio'])) {
                    $va_t = $v_t['precio'];
                } else {
                    $va_t = NULL;
                }
                
                $producto = $_POST['producto'];
                
                echo("<label>Codigo</label>");
                echo ("<input type='text' name='id_compra' id='id_compra' placeholder='Codigo' value=".valor_random()." readonly>");

                echo("<label>Producto</label>");
                echo ("<input type='text' name='producto_m' id='producto_m' placeholder='Producto' value=".$producto." readonly>");

                echo("<label>correo electronico</label>");
                echo ("<input type='email' name='email' id='email' placeholder='Email' value=".$va_p ." readonly>");

                echo("<label>costo a pagar</label>");
                echo ("<input type='number' name='precio' id='precio' placeholder='Precio' value=" .$va_t ." readonly>");

                echo("<label>Fecha</label>");
                echo ("<input type='date' name='fecha' id='fecha' placeholder='Fecha' value=" .date("Y-m-d") ." readonly>");
            }
            ?>