<div class="row">
<div class="row">
	<!--div class="col c6">Cantidad entradas: </div>
	<div class="col c6">Cantidad anotados: </div>
	</div>
	<div class="row">
	<div class="col c6">Cantidad socios: </div>
	<div class="col c6">Cantidad no socios:</div-->
	<div class="col"><h4><?php echo $contest->competition_name?></h4></div>
</div>
<div class="col s6">
<form enctype="multipart/form-data" method="post" action="<?php echo base_url()?>admin/upload_entries_file/<?php echo $contest->id ?> ">
		<div class="file-field input-field">
		<div class="btn">
			<span>Archivo de entries</span>
			<input type="file" name="entries">
		</div>
		<div class="file-path-wrapper">
			<input class="file-path validate" type="text">
		</div>
		</div>

	<label for="replace">Remplazar:&nbsp;&nbsp;&nbsp; </label>
	<input type="checkbox" id="replace" name="replace" />
	<label for="replace">Si esta activo remplaza los archivos existentes por los nuevos</label>
	<br>  <br>  <br>
  <input class="btn green" type="submit" name="submit" value="Upload" />
</form>
</div>
<div class="col s6">
<div class="collection">
    <a  class="collection-item"><span class="badge"><?php echo $stats['entrants'] ?> </span>Cantidad de concursantes</a>
    <a  class="collection-item"><span class="badge"><?php echo $stats['entries'] ?> </span>Cantidad de entradas</a>
    <a  class="collection-item"><span class="badge"><?php echo $stats['confirmed_entries'] ?> </span>Cantidad de entradas confirmadas</a>
    <a  class="collection-item"><span class="badge"><?php echo $stats['confirmed_entries']-$stats['load_entries'] ?>  </span> Cantidad de entradas sin devolución</a>
    <a  class="collection-item"><span class="badge"><?php echo $stats['load_entries'] ?>  </span>Cantidad de entradas con devolución cargada</a>
    <a  class="collection-item"><span class="badge"><?php echo $stats['sent_entries'] ?> </span>Cantidad de entradas con devolución enviada</a>
	
</div>
 <!-- Dropdown Trigger -->
 <a class='dropdown-button btn' href='#' data-activates='enviar-email' style="width:50%">Enviar emails</a>

<!-- Dropdown Structure -->
<ul id='enviar-email' class='dropdown-content'>
  <li><a onclick="return confirm('¿Confirma que quieren enviar email de entradas perdidas?')" href="<?php echo base_url()?>admin/enviar_perdidas/<?php echo $contest->id ?>"><i class="material-icons">mail</i>Entradas Perdidas</a></li>
  <li><a  onclick="return confirm('¿Confirma que quieren enviar email de devoluciones?')" href="<?php echo base_url()?>admin/enviar_devolucion/<?php echo $contest->id ?>"><i class="material-icons">mail</i>Devoluciones</a></li>
</ul>

</div>
</div>

<h4>Entradas:</h4>
