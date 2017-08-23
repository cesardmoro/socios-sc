Hola <?php echo ucfirst($socio->firstname)?>!<br>
<br>
Te confirmamos que se libero un lugar y ya estás inscripto en la capacitación <?php echo $capacitacion->titulo?> el día <?php echo date('d/m/Y', strtotime($capacitacion->fecha))?> de <?php echo $capacitacion->horario?> en <?php echo $capacitacion->lugar?> En caso de que no puedas asistir te solicitamos que por favor canceles tu inscripción para que otro socio pueda utilizar el cupo disponible, para eso pulsa el siguiente link: <br>
<a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>

<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
