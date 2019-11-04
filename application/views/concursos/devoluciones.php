<div class="row">
	<h3>Devoluciones</h3>
<?php if(empty($entries)) {?>
	No tiene entradas en este concurso, o aun no estan cargadas.
<?php }else{?>
<table class="bordered">
	<thead>
		<tr>
			<th>Nombre de la entrada</th>
			<th>Estilo</th>
			<th>Subestilo</th>
			<th>N° de entrada</th>
			<th>Devolucion</th>
		<tr>
	</thead>
	
<?php foreach($entries as $e){?>
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
			<a target="_blank" href="/<?php echo str_replace(FCPATH, '', $e->entry_file)?>">Ver devolucion</a>
			<?php }else{?>
				Devolucion no cargada aun
				<?php } ?>
		</td>
	</tr>
<?php } ?>

</table>
</div>
			<?php }?>
