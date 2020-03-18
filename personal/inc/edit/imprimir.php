<br />
<form method="post" action="personal/inc/ficha_personal.php" target="_blank" name='formimp'>
  <div class='imprimir'>
    <input id='du' name='du' type="text" value=<?php echo '"'.$du.'"';?> readonly="readonly" /><br />

    <input type="checkbox" name="checkhlab" id="checkhlab" checked>
    HISTORIAL LABORAL<br />

    <input type="checkbox" name="checkgre" id="checkgre" checked>
    ESTADO GREMIAL<br />

    <input type="checkbox" name="checkcom" id="checkcom" checked>
    HISTORIAL PASES EN COMISION<br />

    <input type="checkbox" name="checkirr" id="checkirr" checked>
    HISTORIAL IRREGULARIDADES<br />

    <input type="checkbox" name="checkcond" id="checkcond" checked>
    CERTIFICADOS DE CONDUNCION<br />

    <input type="checkbox" name="checkcorr" id="checkcorr" checked>
    HISTORIAL CORREO<br />

    <input type="checkbox" name="checkper" id="checkper" checked>
    PLANTILLA DE PERSONAL<br />

    <input type="checkbox" name="checkcony" id="checkcony" checked>
    PLANTILLA CONYUGE<br />

    <input type="checkbox" name="checkhijo" id="checkhijo" checked>
    PLANTILLA HIJOS<br />

    <input type="checkbox" name="checkmed" id="checkmed" checked>
    ESTADO MEDICO<br />

    <input type="checkbox" name="checktlt" id="checktlt" checked>
    HISTORIAL TAREAS LIVIANAS<br />

    <input type="checkbox" name="checkenf" id="checkenf" checked>
    HISTORIAL ENFERMEDADES<br />

    <input type="checkbox" name="checkart" id="checkart" checked>
    HISTORIAL ART<br />

    <input type="checkbox" name="checklic" id="checklic" checked>
    LICENCIAS PENDIENTES<br />

    <input type="checkbox" name="checkhlic" id="checkhlic" checked>
    HISTORIAL LICENCIAS<br />

    <input type="checkbox" name="checkemb" id="checkemb" checked>
    PLANTILLA EMBARGOS<br />

    <input type="checkbox" name="checksan" id="checksan" checked>
    *PLANTILLA SANCIONES<br />

    <input type="checkbox" name="checkmen" id="checkmen" checked>
    *PLANTILLA MENCIONES</div>
<br /><div id="enlaces_seleccion">
<span onclick="seleccionar_todo()">Marcar todos</span> |
<span onclick="deseleccionar_todo()">Marcar ninguno</span> 
</div><br />
<div class='imprimir'><input type="submit" name="log" id="log" value="Generar" /></div>
</form>