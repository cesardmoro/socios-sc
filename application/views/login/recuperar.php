
 <div class="row container">
 
 	<div class="col m3"></div>
    <form method="post" class="col m6 s12" >
		
     <div class="input-field col s12">
      <i class="material-icons prefix">assignment_ind</i>
      <input class="form-control" id="numero" name="numero" required type="number">
      <label for="numero">Numero de socio</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input class="form-control " id="email" name="email" required type="text">
      <label for="email">Email</label>
	</div> 

     <div class="col s12 right-align">

  		<button type="submit" class="btn waves-effect light-blue">Recuperar contraseña</button>
	</div>

  <div class="col s12 ">
    <h6>Si no tenes usuario <a href="<?php echo base_url()?>login/nuevo">Generaló aca</a></h6>
  </div>

  </form>

</div>
