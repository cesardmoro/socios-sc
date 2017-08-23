Hola <?php echo ucfirst($nombre)?>!<br>
<br>
Para confirmar su asistencia a  <?php echo $capacitacion->titulo?> el día <?php echo date('d/m/Y', strtotime($capacitacion->fecha))?> de <?php echo $capacitacion->horario?> en <?php echo $capacitacion->lugar?> debe pulsar el siguiente link:
<a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>
<br>
<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
