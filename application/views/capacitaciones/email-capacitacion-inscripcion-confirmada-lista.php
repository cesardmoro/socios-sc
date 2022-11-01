Hola <?php echo ucfirst($nombre)?>!<br>
<br>
Al momento de inscribirte a la capacitación <?php echo $capacitacion->titulo?> el día <?php echo date('d/m/Y', strtotime($capacitacion->fecha))?> de <?php echo $capacitacion->horario?> en <?php echo $capacitacion->lugar?> no habia mas vacantes para el curso por lo cual tu inscripción entra en lista de espera. Si se libera alguna vacante te avisaremos por email.

Si no podes asistir entonces te pedimos por favor canceles la inscripción para que otra persona pueda asistir en tu lugar. para hacerlo utiliza el siguiente link: <a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>
<br> 
<?php echo $capacitacion->email_lista_espera?>
<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
