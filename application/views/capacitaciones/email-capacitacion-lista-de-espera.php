Hola <?php echo ucfirst($socio->firstname)?>!<br>
<br>
Estás en lista de espera para la capacitación <?php echo $capacitacion->titulo?> el día <?php echo date('d/m/Y', strtotime($capacitacion->fecha))?> de <?php echo $capacitacion->horario?> en <?php echo $capacitacion->lugar?> Te notificaremos en caso de que se abra un cupo para que puedas asistir.<br>
<br>
<?php echo $capacitacion->email?> 
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
