<div class="row">
	<h3>Concursos</h3>
<table class="bordered">
	<thead>
		<tr>
			<th>Nombre del concurso:</th>
			<th></th>
		<tr>
	</thead>
	
<?php foreach($concursos as $c){?>
	<tr>
		<td>
			<?php echo $c->competition_name ?>
		</td>

		<td>
			<a href="devoluciones/<?php echo $c->id?>">Ver devoluciones</a>
		</td>
	</tr>
<?php } ?>

</table>
</div>
