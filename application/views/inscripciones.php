<script type='text/javascript'>


	var unique_hash = '062877d532d9d621b8f7906685ff15e2';

	var displaying_paging_string = "Mostrando _START_ a _END_ de _TOTAL_ registros";
	var filtered_from_string 	= "(filtrando de _MAX_ total registros)";
	var show_entries_string 	= "Mostrar _MENU_ registros";
	var search_string 			= "Buscar";
	var list_no_items 			= "No hay registros para mostrar";
	var list_zero_entries 			= "Mostrando 0 a 0 de 0 registros";

	var list_loading 			= "Cargando...";

	var paging_first 	= "Primero";
	var paging_previous = "Anterior";
	var paging_next 	= "Siguiente";
	var paging_last 	= "Último";

	var message_alert_delete = "¿Esta seguro que quiere eliminar este registro?";

	var default_per_page = 10;

	var unset_export = false;
	var unset_print = false;

	var export_text = 'Exportar';
	var print_text = 'Imprimir';

	
	var datatables_aaSorting = [[ 0, "asc" ]];

</script>
<h3>Inscripciones</h3> 
<h5><?php echo $capacitacion->titulo ?></h5>
<div class="row">

	<div class="col ">Cupos: <?php echo $capacitacion->cupos?></div>
	<div class="col ">Vacantes:<?php echo $capacitacion->vacantes ?></div>

	<div class="col ">Reservados:<?php echo $capacitacion->reservados ?></div>
	<div class="col ">Inscriptos:<?php echo count($participantes) ?></div>

</div>
<?php if($participantes) {?>
<table cellpadding="0" cellspacing="0" border="0" class="responsive-table striped display "  id="062877d532d9d621b8f7906685ff15e2">
	<thead>
		<tr>
							<th>Socio numero</th> 
							<th>Fecha Inscripcion</th> 
							<th>Apellido</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Vencimiento Couta</th>
					</tr>
	</thead>
	<tbody>
			<?php 

			foreach($participantes as $participante){?>
			<tr class="<?php echo $participante->estado_couta?>" >
				<td><?php echo $participante->id_socio?></td>
				<td><?php echo $participante->fecha_inscripcion?></td>
				<td><?php echo $participante->lastname?></td>
				<td><?php echo $participante->firstname?></td>
				<td><?php echo $participante->email?></td>
				<td><?php echo $participante->phone_mobile?></td>
				<td><?php echo ucfirst($participante->estado_couta)?></td>				
			</tr>
			<?php }?>
	</tbody>
	<tfoot>
		<tr>
					</tr>
	</tfoot>
</table>
<?php 
}else{?>
	Este curso no tiene ningun participante inscripto
	<?php } ?> 
