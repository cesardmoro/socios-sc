<div class="row">
    <h2>PAQUETES</h2> 
    <div class="row">
	<div class="col s12 m4">
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE FULL (único disponible)</span>
				<p>
					Acreditación, recepción con servicio de catering y cerveza especialmente elaborada para el festival del día viernes 12,
					que se realizará en el Predio de “La Nave Creativa” perteneciente a la Nave Uncuyo ( https://g.page/naveuncuyo?share ).
					Ingreso a los espacios de conferencias y talleres prácticos, acceso al sector de Stands de productos para la industria cervecera y afines,
					 entrada libre al Encuentro de Camaradería y a la premiación del Cervecero del Año los días sábado 13 y domingo 14,
					  los mismos se realizarán en La Nave Creativa y en 23 Ríos respectivamente.

				        
				 </p>
			</div>

			 <div class="card-action">
                    <b>PACK FULL SOCIOS $11000</b><br>
					<b>PACK FULL NO SOCIOS $13000</b><br>
            </div>
		</div>
	</div>
</div>



<h6>*Los cupos para los talleres seran definidos por numero de orden de compra, teniendo prioridad los que compraron PAQUETE PREVENTA!!  </h6>
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
 	      <option value="1" >PACK FULL</option>
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
