
<h3>Inscripciones</h3> 
<h5><?php echo $capacitacion->titulo ?></h5>
<div class="row">
	<div class="col ">Cupos: <?php echo $capacitacion->cupos?></div>
	<div class="col ">Vacantes:<?php echo $capacitacion->vacantes ?></div>
	<div class="col ">Reservados:<?php echo $capacitacion->reservados ?></div>
	<div class="col ">Inscriptos:<?php echo count($participantes) ?></div>

</div>
<?php if($participantes) {?>
<table cellpadding="0" cellspacing="0" border="0" class="groceryCrudTable responsive-table striped display " id="<?php echo uniqid(); ?>">
	<thead>
		<tr>
							<th>Número de inscripción</th> 
							<th>Socio numero</th> 
							<th>Fecha Inscripcion</th> 
							<th>Apellido</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Extra field 1</th>
							<th>Extra field 2</th>
							<th>Vencimiento Couta</th>
					</tr>
	</thead>
	<tbody> 
<?php $last = ($capacitacion->cupos-$capacitacion->reservados); ?>
			<?php 
			foreach($participantes as $key => $participante){?>
			<?php if($last == $key){ echo '<tr><td colspan="9"><h4>Lista de espera</h4></td></tr>';}?>
			<tr class="<?php echo $participante->estado_couta?>" >
				<td><?php echo $key+1?></td> 
				<td><?php echo $participante->id_socio?></td>
				<td><?php echo $participante->fecha_inscripcion?></td>
				<td><?php echo $participante->lastname?></td>
				<td><?php echo $participante->firstname?></td>
				<td><?php echo $participante->email?></td>
				<td><?php echo $participante->phone_mobile?></td>
				<td><?php echo $participante->extrafield_1?></td>
				<td><?php echo $participante->extrafield_2?></td>
				<td><?php echo ucfirst($participante->estado_couta)?></td>				
				<td><a onclick="return confirm('Esta seguro que desea eliminar esta inscripción')" class="btn red" href="<?php echo base_url().'admin/eliminar_inscripcion/'.$capacitacion->id.'/'.$participante->id?>">Eliminar</a></td>	  			
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
