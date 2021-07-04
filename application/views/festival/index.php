<div class="row">
    <h2>PAQUETES</h2> 
    <div class="row">
	<div class="col s12 m4">
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE FULL (único disponible)</span>
				<p> Acreditación, recepción con servicio de catering y cerveza especialmente elaborada para el festival del día viernes 13, en un bar exclusivo reservado para el evento en el centro de la ciudad de Salta.
Ingreso a los espacios de conferencias y talleres prácticos, acceso al sector de Stands de productos para la industria cervecera y afines, entrada libre al Encuentro de Camaradería y a la premiación del Cervecero del Año los días sábado 14 y domingo 15, en la Finca Hostal Castellanos.
				        
				 </p>
			</div>

			 <div class="card-action">
          		Preventa 6500 hasta el 18 de junio inclusive y venta 7900 a partir de ese día. solo para socios
            </div>
		</div>
	</div>
</div>



<h6>*Los cupos para los talleres seran definidos por numero de orden de compra, teniendo prioridad los que compraron PAQUETE PREVENTA!!  </h6>
<h5>Formulario inscripción</h5>
<h6>Validez de Reserva 7 días para realizar el pago</h6>
	<?php if(isset($nro_socio)){ ?>
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
      <input class="form-control" id="nro_socio" ng-message="" value="<?php echo $nro_socio?> " name="nro_socio" disabled type="text">
      <label for="nro_socio">N° SOCIO</label>
	</div>

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
	<?php } ?>

<br>
<br>
<br>
<script>

	$(document).ready(function() {
		$('select').material_select();
	});

</script>
