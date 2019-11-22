<h3>Reporte estilos</h3>
<a class="btn btn-green green" href="<?php echo site_url("admin/reporte_estilos_csv/".$id_contest )?>">Exportar</a>
<table class="bordered">
	<tr>
		<th>Estilo</th>
		<th>Nombre Subestilo</th>
		<th>Cantidad</th>
	</tr>

<?php foreach($estilos as $e){?>
	<tr class="">
		<td class=""><?php echo $e->style;?></td>
		<td class=""><?php echo $e->substyle_name;?></td>
		<td class=""><?php echo $e->qty;?></td>

	</tr>
<?php }?>
</table>
