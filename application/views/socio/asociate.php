<h3>Formulario de asociacion</h3>
<div class="row">
<div class="input-field col s12 m6">
    <input type="text" id="apellido_nombre" />
    <label for="apellido_nombre">Apellido y Nombre</label>
  </div>
  <div class="input-field col s12 m6">
    <input type="text" id="fecha_nacimiento" class="datepicker"/>
    <label for="fecha_nacimiento">Fecha de nacimiento</label>
  </div>
</div>

<div class="row">
<h6>Documento</h6>
  <div class="input-field col s12 m6"> 
    <select id="tipo_documento">
      <option value="" disabled selected>Seleccione</option>
      <option value="DNI">DNI</option>
      <option value="LE">LE</option>
      <option value="LC">LC</option>
    </select>
    <label for="tipo_documento">Tipo de documento</label>
  </div>
  <div class="input-field col s12 m6">
    <input type="number" id="numero_documento" />
    <label for="numero_documento">Número de documento</label>
  </div>
</div>

<div class="row"> 
  <div class="input-field col s12 m3">
    <input type="text" id="sexo" />
    <label for="sexo">Sexo</label>
  </div>
  <div class="input-field col s12 m3">
    <input type="text" id="nacionalidad" />
    <label for="nacionalidad">Nacionalidad</label>
  </div>
  <div class="input-field col s12 m3">
    <input type="text" id="profesion" />
    <label for="profesion">Profesión</label>
  </div>
  <div class="input-field col s12 m3">
    <input type="text" id="estado_civil" />
    <label for="estado_civil">Estado civil</label>
  </div>
</div>

<div class="row">
<h6>Dirección</h6>

  <div class="input-field col s12 m6">
    <input type="text" id="calle" />
    <label for="calle">Calle</label>
  </div>
  <div class="input-field col s12 m3">
    <input type="text" id="numero" />
    <label for="numero">Número</label>
  </div>
  <div class="input-field col s12 m3">
    <input type="text" id="piso_depto" />
    <label for="piso_depto">Piso / Depto</label>
  </div>
  <div class="input-field col s12 m6">
    <input type="text" id="localidad" />
    <label for="localidad">Localidad</label>
  </div>
  <div class="input-field col s12 m4">
    <input type="text" id="provincia" />
    <label for="provincia">Provincia</label> 
  </div>
  <div class="input-field col s12 m2">
    <input type="text" id="codigo_postal" />
    <label for="codigo_postal">C.P.</label>
  </div>
</div>
<h6>Contacto</h6>

<div class="row">
  <div class="input-field col s12 m6">
    <input type="tel" id="telefono" />
    <label for="telefono">Teléfono</label>
  </div>
  <div class="input-field col s12 m6">
  <input id="email" type="email" class="validate">
          <label for="email">Email</label>
  </div>
  <div>

  <script>
  
  $(document).ready(function() {
    $('select').material_select();
  });
 
   
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 200, // Creates a dropdown of 15 years to control year,
    today: 'Hoy', 
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false
  }); 
  
  </script>