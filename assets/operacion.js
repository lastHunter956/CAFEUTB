let boton = document.getElementById('costo');
let costo_t = document.getElementById('r_costo');

boton.addEventListener('click',hacercosto);



function hacercosto(){
    let cantidad = parseInt(document.getElementById('conta').value);
    let can_r = cantidad*6500;
    
    costo_t.innerHTML=`Costo: ${can_r}`;  
}


