<div class="row">
    <h2>PAQUETES</h2> 
    <div class="row">
	<div class="col s12 m4">
    	<div class="card" >
            <div class="card-content">
				<span class="card-title">PAQUETE FULL (único disponible)</span>
				<p>
                    Acreditación, recepción con servicio de catering y cerveza elaborada especialmente para el festival del día viernes 18,
					 que se realizará en Casa Histórica - Museo Nacional de la Independencia (Congreso 151, San Miguel de Tucumán)
					 Ingreso a los espacios de conferencias y talleres prácticos, coffee break, acceso al sector de stands para la industria cervecera y afines,
					 almuerzos de todo el evento. Tours por fábricas y lugares de interés, entrada libre al Encuentro de Camaradería y la premiacion del Cervecero del Año, 
					 los días sábado 18 y domingo 20 en Hosteria Atahualpa Yupanqui ( Paysandu 2400, Tafi Viejo). Transporte ida y vuelta desde zona céntrica de San Miguel de Tucumán  
					 hacia los destinos de actividades incluido

				        
				 </p>
			</div>

			 <div class="card-action">
                    <b>PACK FULL SOCIOS $28000 / PACK NO FULL SOCIOS $38000 </b><br>
					
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
		<input type="hidden" name="id_paquete" value="0">
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
 