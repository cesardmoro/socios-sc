<div class="row">
    <h2>PAQUETES</h2> 
    <div class="row">
	<!--div class="col s4">
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE FULL PREVENTA: </span> 
				<p> Incluye Bienvenida, Acreditacion, Conferencias y talleres prácticos, Almuerzo de Camaradería,Tour cervecero, Fiesta 11° Festival Somos Cerveceros (Incluye consumisión).
				        
				 </p><br><br><br>
			</div>
			 <div class="card-action">
          		Socios $ 3000.

            </div>
		</div>
	</div-->
    <div class="col s4">
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE FULL VENTA: </span> 
				<p> Incluye Bienvenida, Acreditacion, Conferencias y talleres prácticos, Almuerzo de Camaradería, Fiesta 11° Festival Somos Cerveceros (Incluye consumisión).
				        
				 </p><br><br><br>
			</div>
			 <div class="card-action">
          		Socios $ 4000.   
                <span class="right">No Socios $ 5000.</span>

            </div>
		</div>
	</div>
	  <div class="col s4">	
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE CAMARADERIA: </span> 
				<p> Incluye Bienvenida, Acreditacion, Almuerzo de Camaradería, Fiesta 11° Festival Somos Cerveceros (Incluye consumisión)
				        
				 </p><br><br><br>
			</div>
			 <div class="card-action">
          		Socios $ 2000.   
                <span class="right">No Socios  $ 2500.</span>

            </div>
		</div>
	</div> 
	  <div class="col s4">	
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">FIESTA de CIERRE</span> 
				<p> Fiesta 11° Festival Somos Cerveceros (Incluye consumisión)
				 </p><br><br><br><br>
			</div>
			 <div class="card-action">
          		 General $ 200. 
            </div>
		</div>
	  </div>
	  
		</div>
 
</div>

<h6>*Los cupos para los talleres seársomno definidos por numero de orden de compra, teniendo prioridad los que compraron PAQUETE FULL PREVENTA!!  </h6> 
<h5>Formulario inscripción</h5>
<h6>Validez de Reserva 7 días para realizar el pago</h6> 
<form action="" method="post">
	<div class="input-field col s12">
      <input class="form-control " id="nombre" name="nombre" required type="text">
      <label for="nombre">Nombre</label>
	</div>
	<div class="input-field col s12">
      <input class="form-control " id="apellido" name="apellido" required type="text">
      <label for="apellido">Apellido</label>
	</div>
	<?php if(isset($nro_socio)){ ?>
	<div class="input-field col s12">
      <input class="form-control" id="nro_socio" ng-message="" value="<?php echo $nro_socio?> " name="nro_socio" disabled type="text">
      <label for="nro_socio">N° SOCIO</label>
	</div>
	<?php } else{?>
<div class="input-field col s12">
	<h5>Te estas inscribiendo como no socio, si sos socio <a class="text-link" href="<?php echo base_url();?>login">logueate</a>.</h5>
	<br>
</div>
	<?php } ?> 
	<div class="input-field col s12">
	    <select name="id_paquete" required>
	      <option value=""  selected>Seleccione PACK</option>
	      <option value="1" selected>PACK COMPLETO</option>
	      <option value="2">PACK CAMARADERIA</option>
	      <option value="3">FIESTA de CIERRE</option> 
	    </select> 
    	<label for="id_paquete">Paquete </label> 
  </div>
	<div class="input-field col s12">
      <input class="form-control" maxlength="8" id="dni" name="dni" required type="number">
      <label for="dni">DNI</label>
	</div>
	<div class="input-field col s12">
      <input class="form-control " id="email" name="email" required type="email">
      <label for="email">Mail</label>
    </div>
	<div class="input-field col s12">
      <input class="form-control " id="telefono" maxlength="15" name="telefono" required type="text">
      <label for="telefono">Celular</label>
	</div>
 	<button class="btn green" type="submit">Inscribirse</button>

</form>
<br>
<br>
<br>
<script>
	
	$(document).ready(function() {
		$('select').material_select();
	});

</script>