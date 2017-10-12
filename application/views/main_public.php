<!DOCTYPE html>
<html>
<head>
<title>Somos Cerveceros</title>
  
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0,user-scalable=0">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<?php 
	if(isset($css_files)){
		foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; 
	}?>
	<?php
	if(isset($js_files)){
	 foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach;
	} ?> 
	<!-- Compiled and minified CSS -->

	<!-- Compiled and minified JavaScript -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">



	<!-- Compiled and minified CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/main.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"> 
</head>
<body>
	

 	<main class="public">

	<div style='height:20px;'></div>  
    <div class="container">
    	<?php if($this->session->flashdata('message')){ ?>
		     <div class="row"> 
		       <div class="col m12"></div> 
		       <div class="col m12">
		       <div class=" card light-green darken-4">
		                <div class="card-content white-text">
		                  <p><?php echo $this->session->flashdata('message'); ?></p>
		                </div>
		        </div>
		      </div>
		      </div> 

		    <?php } ?>
		    <?php if($this->session->flashdata('error')){ ?>
		     <div class="row">
		       <div class="col m12"></div> 
		       <div class="col m12">
		       <div class=" card red darken-4">
		                <div class="card-content white-text">
		                  <p><?php echo $this->session->flashdata('error'); ?></p>
		                </div>
		        </div>
		      </div>
		      </div> 

		    <?php } ?>
		<?php echo $output; ?>

    </div>
    </main> 
    	<footer class="public">
		
        <div class="container">© 2008-2017 Somos Cerveceros<a class="right" href="https://github.com/cesardmoro">Desarrollado por Cesar Moro - Socio 977</a> </div>  
        </footer>
</body>
</html>
