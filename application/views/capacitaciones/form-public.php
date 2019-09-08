<?php if(!$cap) {?>
<div class="row"> 
<form action="" method="post">
	<div class="input-field col s12">
      <input class="form-control " id="nombre" name="nombre" required type="text">
      <label for="nombre">Nombre y Apellido</label>
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
</div> 
<?php } else{
	?>
		Se ha registrado a este evento. Si tiene algun inconveniente envie un email a consultas@somoscerveceros.com.ar
	<?php
	}?>