
 <div class="row container">
 

  

 	<div class="col m3"></div>
    <form class="col m6 s12" method="post" >
      <div class="input-field col s12">
         Bienvenido <?php echo $socio->firstname?> <?php echo $socio->lastname?> estas apunto de generar tu clave unica para el portal web de <b>Somos Cerveceros </b>
      </div>
      <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input class="form-control" id="password" name="password" required type="password">
          <label for="password">Clave</label>
      </div>
      <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
           <input class="form-control" id="repassword" name="repassword" required type="password">
          <label for="repassword" data-error="Contraseñas no coinciden" data-success="">Vuelva a escribir la clave</label>
    	</div> 
         <div class="col s12 right-align">
      		<button type="submit" class="btn waves-effect light-blue">Iniciar sesión</button>
    	</div>
  </form> 
 	<div class="col m3"></div>
</div>

<script>
  $("#password").on("focusout", function (e) {
    if ($(this).val() != $("#repassword").val()) {
        $("#repassword").removeClass("valid").addClass("invalid");
    } else {
        $("#repassword").removeClass("invalid").addClass("valid");
    }
});

$("#repassword").on("keyup", function (e) {
    if ($("#password").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
}); 

</script>