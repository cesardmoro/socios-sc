
 <div class="row container">
 
 	<div class="col m3"></div>
    <form method="post" class="col m6 s12" >
		
    <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input class="form-control " id="email" name="email" required type="text">
      <label for="email">Email</label>
	</div>
    <div class="input-field col s12">
      <i class="material-icons prefix">lock</i>
      <input class="form-control " id="password" name="password" required type="password">
      <label for="password">Clave</label>
	</div>
     <div class="col s12 ">
     <h6> <a href="<?php echo base_url()?>login/recuperar">Olvide mi contraseña</a></h6>
     </div>
     <div class="col s12 right-align">

  		<button type="submit" class="btn waves-effect light-blue">Iniciar sesión</button>
	</div>

  <div class="col s12 ">
    <h6>Si no tenes usuario <a href="<?php echo base_url()?>login/nuevo">Generaló aca</a></h6>
  </div>
	<div class="col s12 ">
		<h6> Para verificar la couta al dia <a href="<?php echo base_url()?>couta">Haceló aca</a></h6>
	</div>
  </form>

</div>
