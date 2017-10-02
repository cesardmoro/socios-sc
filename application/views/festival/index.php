<div class="row">
    <h2>PAQUETES</h2> 
    <div class="col s4">
    	<div class="card">
            <div class="card-content">
				<span class="card-title">PACK COMPLETO </span> 
				<p> Incluye, Bienvenida, Acreditacion, Conferencias, Traslados, Fiesta Camaraderia Cervecera, Fiesta 10° Festival Somos Cerveceros
				        
				 <p>
			</div>
			 <div class="card-action">
          		Socios $ 3400.   
                <span class="right">No Socios $ 4200.</span>
            </div>
		</div>
	</div>
	<div class="col s4">
    	<div class="card">
            <div class="card-content">
				<span class="card-title">PACK ACOMPAÑANTE </span> 
				<p> Incluye, Bienvenida, Acreditacion, Traslados, Fiesta Camaraderia Cervecera, Fiesta 10° Festival Somos Cerveceros
				 <p>
			</div>
			 <div class="card-action">
          		Socios $ 1600.   
                <span class="right">No Socios $ 2000.</span>
            </div>
		</div>
	</div>
	<div class="col s4">
    	<div class="card">
            <div class="card-content">
				<span class="card-title">FIESTA de CIERRE</span> 
				<p> Fiesta 10° Festival Somos Cerveceros (incluye consumisión)<br><br>
				 <p>
			</div>
			 <div class="card-action">
          		 General $ 300.
            </div>
		</div>
	</div>
</div>
<h5>Formulario inscripción</h5>
<form action="" method="post">
	<div class="input-field col s12">
      <input class="form-control " id="nombre" name="nombre" required type="text">
      <label for="nombre">Nombre</label>
	</div>
	<div class="input-field col s12">
      <input class="form-control " id="apellido" name="apellido" required type="text">
      <label for="apellido">Apellido</label>
	</div>
	<div class="input-field col s12">
      <input class="form-control  " id="nro_socio" value="<?php echo $nro_socio?> " name="nro_socio" disabled type="text">
      <label for="nro_socio">N° SOCIO</label>
	</div>
	<div class="input-field col s12">
	    <select name="id_paquete" required disabled>
	      <option value="" disabled selected>Seleccione PACK</option>
	      <option value="1" selected>PACK COMPLETO</option>
	      <option value="2">PACK ACOMPAÑANTE</option>
	      <option value="3">FIESTA de CIERRE</option> 
	    </select>
    	<label for="id_paquete">Paquete</label>
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