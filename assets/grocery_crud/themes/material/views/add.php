<?php
$this->set_css($this->default_theme_path.'/material/ui/assets/css/font-awesome.min.css');
    $this->set_css($this->default_theme_path.'/material/ui/css/custom-theme/jquery-ui-1.10.3.custom.css');
    $this->set_css($this->default_theme_path.'/material/ui/assets/css/docs.css');

	$this->set_css($this->default_theme_path.'/material/css/material.css');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/material/js/datatables-add.js');
	//$this->set_css($this->default_css_path.'/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	
?>
<div class='datatables'>
		<h4 class='floatL form-title-left'>
			<a href="#"><?php echo $this->l('form_add'); ?> <?php echo $subject?></a>
		</h4>
		<div class='clear'></div>
	
<div class='form-content form-div'>
	<?php echo form_open( $insert_url, 'method="post" id="crudForm" enctype="multipart/form-data"'); ?>
		<div>
			<?php
			$counter = 0;
			foreach($fields as $field)
			{
				$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
				$counter++;
				switch ($input_fields[$field->field_name]->crud_type) {
					case false:?>
						<div class="row">
							<div class="input-field col s6">
					          <?php echo $input_fields[$field->field_name]->input?>
					          <label for="<?php echo $field->field_name?>"><?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required) ? "*" : ""?></label>
					        </div>
					    </div>
						
					<?php break;					
					default: ?>
					<div class='form-field-box <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box">
						<div class='form-display-as-box' id="<?php echo $field->field_name; ?>_display_as_box">
							<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?> :
						</div>
						<div class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
							<?php echo $input_fields[$field->field_name]->input?>
						</div>
						<div class='clear'></div>
					</div>
				<?php 
					break;
				}?>
			
			
			<?php }?>
			<!-- Start of hidden inputs -->
				<?php
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
			<div class='line-1px'></div>
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>
		</div> 
				<input id="form-button-save" type='submit' value='<?php echo $this->l('form_save'); ?>' class='btn'/>
<?php 	if(!$this->unset_back_to_list) { ?>
				<input type='button' value='<?php echo $this->l('form_save_and_go_back'); ?>' class='btn' id="save-and-go-back-button"/>
				<input type='button' value='<?php echo $this->l('form_cancel'); ?>' class='btn red' id="cancel-button" />
<?php   } ?>
			<div class='small-loading' id='FormLoading'><?php echo $this->l('form_insert_loading'); ?></div>
			<div class='clear'></div>
		
	<?php echo form_close(); ?>
</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
	var message_insert_error = "<?php echo $this->l('insert_error')?>";
</script>