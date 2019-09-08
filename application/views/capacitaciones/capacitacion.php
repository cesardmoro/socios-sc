
	<div class="row">
        <div class="col s12 s12">
          <div class="card">
            <div class="card-content "> 
              <span class="card-title"><?php echo $capacitacion->titulo; ?></span>
              	<div class="row">
	              <div class="col s12">

             		<?php if($capacitacion->foto){?> 
              			<div class="col s6">
		            		<img style="width:100%;" src="<?php echo base_url()?>assets/uploads/eventos/<?php echo $capacitacion->foto?>">
		            	</div>
	              <?php } ?> 
	               <div class="col s12">
	              <?php echo $capacitacion->descripcion; ?>
	              </div>
	      
				<div class="col s12">
	             &nbsp;
	              </div>
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
		              <strong>Valor socio:</strong><span>  $   <?php echo $capacitacion->valor_socio; ?></span>
		              </div>
	              <?php }?>
	              <?php if($capacitacion->valor_no_socio){?> 
		              <div class="col s12">
		              <strong>Valor no socio:</strong><span>  $   <?php echo $capacitacion->valor_no_socio; ?></span>
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
            <?php if($socio) {?>
				<?php if($capacitacion->inscripcion){?>
              		<a  href="<?php echo base_url()?>capacitaciones/desinscribirse/<?php echo $capacitacion->id; ?>">Cancelar Inscripción</a>
              	<?php } else {?>
             	 	<a href="<?php echo base_url()?>capacitaciones/inscribirse/<?php echo $capacitacion->id; ?>">Inscribirse
					<?php if($capacitacion->vacantes<=0){?>
						en lista de espera
					 <?php }?>
             	 	</a>
             	 <?php }?>
         	 <?php }else{?>
         	 <div class="row">Si sos socio <a class="text-link" href="<?php echo base_url();?>login">logueate</a>. Sino inscribite completando aca:</div>
         	 		<?php echo $form ?>
         	

         	 <?php } ?>
             	 
            </div>
          </div>
        </div>
 	</div>

