<?php if(!empty($capacitaciones)) {?>
	<?php foreach($capacitaciones as $capacitacion){?>

		<div class="row">
	        <div class="col s12 s12">
	          <div class="card">

	            <div class="card-content ">

	              <span class="card-title">
	              <a href="<?php echo base_url()?>capacitaciones/capacitacion/<?php echo $capacitacion->id; ?>"><?php echo $capacitacion->titulo; ?></a> </span>

	              	<div class="row">
	              	<?php if($capacitacion->foto){?> 
	              			<div class="col s3">
			            	<a href="<?php echo base_url()?>capacitaciones/capacitacion/<?php echo $capacitacion->id; ?>"><img style="width:100%;" src="<?php echo base_url()?>assets/uploads/eventos/<?php echo $capacitacion->foto?>"></a>
			            	</div>
		              <?php } ?> 
		              <div class="col s9">
		              <?php echo $capacitacion->descripcion; ?>
		              </div>
		              <div class="col s12">
		             &nbsp;
		              </div>
		             <?php if($capacitacion->fecha){?> 
		              <div class="col s12">
		              <strong>Fecha:</strong><span>     <?php echo date('d/m/y' , strtotime($capacitacion->fecha)); ?></span>
		              </div>
	              	<?php }?>
		             <?php if($capacitacion->lugar){?> 
		              <div class="col s12">
		              <strong>Lugar:</strong><span>     <?php echo $capacitacion->lugar; ?></span>
		              </div>
	              	<?php }?>
		             <?php if($capacitacion->horario){?> 
			              <div class="col s12">
			              <strong>Horario:</strong><span>     <?php echo $capacitacion->horario; ?></span>
			              </div>
		              <?php }?>
		              <?php if($capacitacion->oradores){?>
			              <div class="col s12">
			              <strong>Oradores:</strong><span>     <?php echo $capacitacion->oradores; ?></span>
			              </div>
		              <?php } ?> 
	             	  <?php if($capacitacion->valor_socio){?> 
			              <div class="col s12">
			              <strong>Valor socio:</strong><span>     <?php echo $capacitacion->valor_socio; ?></span>
			              </div>
		              <?php }?>
		              <?php if($capacitacion->valor_no_socio){?> 
			              <div class="col s12">
			              <strong>Valor no socio:</strong><span>   $  <?php echo $capacitacion->valor_no_socio; ?></span>
			              </div> 
		              <?php }?>
		               <?php if($capacitacion->vacantes<=0){?>
							<div class="col s12">
			              	<h5>** Cupos completos **</h5>
			              </div>
					 <?php }?>
			              
	            	</div>
	            </div>
	            <div class="card-action">
	            
					<?php if($capacitacion->inscripcion){?>
	              		<a  class="btn red" href="<?php echo base_url()?>capacitaciones/desinscribirse/<?php echo $capacitacion->id; ?>">Cancelar Inscripción</a>
	              	<?php } else {?>
	             	 	<a class="btn green" href="<?php echo base_url()?>capacitaciones/inscribirse/<?php echo $capacitacion->id; ?>">Inscribirse
						<?php if($capacitacion->vacantes<=0){?>
							en lista de espera
						 <?php }?>
	             	 	</a>
	             	 <?php }?>
	             	 	<a class="btn " href="<?php echo base_url()?>capacitaciones/capacitacion/<?php echo $capacitacion->id; ?>">Ver mas</a>
	   
	            </div>
	          </div>
	        </div>
	 	</div>

	<?php } ?>
<?php }else{
	?>
		<h4>No hay capacitaciones proximas con inscripción habilitada</h4>
	<?php
} ?>