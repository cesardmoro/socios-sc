Hola <?php echo ucfirst($nombre)?>!<br>
<br>
Tu inscripción a la capacitación <?php echo $capacitacion->titulo?> el día <?php echo date('d/m/Y', strtotime($capacitacion->fecha))?> de <?php echo $capacitacion->horario?> en <?php echo $capacitacion->lugar?> se encuentra confirmada. Si por algún motivo no podes asistir entonces te pedimos por favor canceles la inscripción para que otra persona pueda asistir en tu lugar. para hacerlo utiliza el siguiente link: <a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>
<br>
<?php echo $capacitacion->email?> 
<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
