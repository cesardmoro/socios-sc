 <div class="row container">
  <div class="col m3"></div>
  <div class="col m6 s12"><h4>Verifica cuota al día</h4>
  Ingresa número de socio y dni</div>
  <div class="col m6 s12"></div>
</div>
<div class="row container">
 	<div class="col m3"></div>
    <form method="post" class="col m6 s12" >
    <div class="input-field col s12">
      <i class="material-icons prefix">assignment_ind</i>
      <input class="form-control" id="dni" name="dni" value="<?php echo $dni?>" required type="number">
      <label for="dni">DNI</label>
    </div>		  
    <div class="input-field col s12">
      <i class="material-icons prefix">subtitles</i>
      <input class="form-control" id="numero" name="numero" value="<?php echo $numero?>" required type="number">
      <label for="numero">Número de socio</label>
    </div>

     <div class="col s12 right-align">
  		<button type="submit" class="btn waves-effect light-blue">Verificar cuota</button>
	</div>


16 matches across 5 files


Searching 1122 files for "Couta"
  </form>
 	<div class="col m3"></div>
</div>
