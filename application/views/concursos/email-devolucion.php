Hola <?php echo ucfirst($entrant->name)?>!<br>
<br>
Se encuentran cargadas tus devoluciones para el concurso: <?php echo $contest->competition_name?>
<br><br><br>

<table border=1>
<thead> 
		<tr>
			<th>Nombre de la entrada</th>
			<th>Estilo</th>
			<th>Subestilo</th>
			<th>N° de entrada</th>
			<th>Devolucion</th>
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

		<td>
			<?php if($e->entry_file != "") {?> 
			<a target="_blank" href="<?php echo base_url()?><?php echo str_replace(FCPATH, '', $e->entry_file)?>">Ver devolucion</a>
			<?php }else{?>
				Devolucion no cargada aun
				<?php } ?>
		</td>
	</tr>
<?php } ?>
	
</table>
<br>
<br>
Ademas si sos socio, podes visualizarlas desde el portal de socios: http://somoscerveceros.com/socios
<br>
<br>
<br>
Asociación Civil<br>
Somos Cerveceros<br>
<br>
<a href="http://www.somoscerveceros.com">www.somoscerveceros.com</a><br>
<br>
Soy Feliz, Hago mi Propia Cerveza
