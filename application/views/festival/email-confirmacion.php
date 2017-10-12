Hola, <?php echo $inscripcion->nombre?><br>
<br>
Te confirmamos la inscripción al festival somos cerveceros 2017 con el PACK: <?php echo $packs[$inscripcion->id_paquete];?>.<br>
Código de reserva: <?php echo str_pad($inscripcion->id, 5, 0, STR_PAD_LEFT);?><br>
<br>
Saludos<br>
<br>
<b>----------------------</b><br> 
Comision Organizadora Festival Somos Cerveceros<br> 
www.somoscerveceros.com.ar<br> 
