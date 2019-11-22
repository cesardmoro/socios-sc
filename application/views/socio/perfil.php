

<div class="row container">

<div class="row"> 
    <form method="post" class="col m6 s12" >
     <div class="row s12">
    <div class="input-field col s12">
      Nombre: <h5><?php echo $socio->firstname?> <?php echo $socio->lastname?> - N° <?php echo $socio->rowid?> </h5> 
    </div>

    <div class="input-field col s12">
      <h5>Datos personales: </h5> 
    </div>
    
      <div class="input-field col s6">
          <input name="cp" id="cp" type="text" value="<?php echo $socio->zip?>" class="validate">
          <label for="cp">Código postal</label>
      </div>
      <div class="input-field col s6">
          <input name="direccion" id="direccion" type="text" value="<?php echo $socio->address?>" class="validate">
          <label for="direccion">Dirección</label>
      </div>
      <div class="input-field col s6">
          <input name="ciudad" id="ciudad" type="text" value="<?php echo $socio->town?>" class="validate">
          <label for="ciudad">Ciudad</label>
      </div> 
     
   
    <button class="btn green" type="submit">Actualizar</button>

</form>
</div> 
</div> 

