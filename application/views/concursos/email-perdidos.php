Hola <?php echo ucfirst($entrant->name)?>!<br>
<br>
Presentaste muestras en el concurso: <?php echo $contest->competition_name?> y las siguientes no se etiquetaron, porque no se recibieron las botellas o no fueron dadas de baja en reggie. Si tenes alguna duda contactate lo antes posible a concursos@somoscerveceros.com.ar
<br><br><br> 

<table border=1>
<thead> 
		<tr>
			<th>Nombre de la entrada</th>
			<th>Estilo</th>
			<th>Subestilo</th>
			<th>N° de entrada</th>
			<th>Estado</th>
		<tr>
	</thead>
	
<?php foreach($entrant->entries as $e){?>
	<tr>
		<td>
			<?php echo $e->entry_name ?>
		</td>
		<td>
			<?php echo $e->style ?>
		</td>
		<td>
			<?php echo $e->substyle_name ?>
		</td>
		<td>
			<?php echo $e->entry ?>
		</td>
		</td>
		<td>
			No se recibieron botellas
		</td>

	</tr>
<?php } ?>
	
</table>
<br>
<br>
Ademas si sos socio, podes visualizarlas desde el portal de socios: <a href="http://www.somoscerveceros.com/socios">http://somoscerveceros.com/socios</a>
<br>
<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
