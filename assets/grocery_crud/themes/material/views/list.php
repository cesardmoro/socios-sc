
<table cellpadding="0" cellspacing="0" border="0" class="groceryCrudTable responsive-table striped display " id="<?php echo uniqid(); ?>">
	<thead>
		<tr>
			<?php foreach($columns as $column){?>
				<th><?php echo $column->display_as; ?></th>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<th class='actions'><?php echo $this->l('list_actions'); ?></th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($list as $num_row => $row){ ?>
		<tr id='row-<?php echo $num_row?>'>
			<?php foreach($columns as $column){?>
				<td><?php echo $row->{$column->field_name}?></td>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td class='actions'>
				
				<?php if(!$unset_read){?>
					<a href="<?php echo $row->read_url?>" class="btn" role="button">
						<?php echo $this->l('list_view'); ?>
					</a>
				<?php }?>

				<?php if(!$unset_edit){?>
					<a href="<?php echo $row->edit_url?>" class="btn light-blue" role="button">
						<?php  //echo $this->l('list_edit'); ?>
						  <i class="material-icons">mode_edit</i>
					</a>
				<?php }?>
				<?php if(!$unset_delete){?>
					<a onclick = "javascript: return delete_row('<?php echo $row->delete_url?>', '<?php echo $num_row?>')"
						href="javascript:void(0)" class="btn red" role="button">
						<?php //echo $this->l('list_delete'); ?>
						 <i class="material-icons">delete</i>
					</a>
				<?php }?>
				<?php
				if(!empty($row->action_urls)){
					foreach($row->action_urls as $action_unique_id => $action_url){
						$action = $actions[$action_unique_id];
				?>
						<a href="<?php echo $action_url; ?>" class="btn <?php echo $action->css_class; ?> <?php echo $action_unique_id;?>" role="button"> 
							<?php echo $action->label?>
						</a>
				<?php }
				}
				?>
			</td>
			<?php }?>
		</tr>
		<?php }?>
	</tbody>
	<tfoot>
		<tr>
			<?php /*foreach($columns as $column){?>
				<th><input type="text" name="<?php echo $column->field_name; ?>" placeholder="<?php echo $this->l('list_search').' '.$column->display_as; ?>" class="search_<?php echo $column->field_name; ?>" /></th>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
				<th>

					<a href="javascript:void(0)" role="button" class="btn darken floatR"> 
						<?php echo $this->l('list_clear_filtering');?>
					</a>
				</th>
			<?php }*/?>
		</tr>
	</tfoot>
</table>
