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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/main.js"></script>



	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"> 
</head>
<body>
	<ul id="nav-mobile" class="side-nav">
    <li><div class="userView">
		   <div class="container center-align">
			  <img src="<?php echo base_url()?>assets/img/logo.svg" width="1">
			  </div>
      <a ><span class="name"><?php echo $this->session->userdata('socio')->firstname." ". $this->session->userdata('socio')->lastname?></span></a>
      <a ><span class=" email"><?php echo $this->session->userdata('socio')->email?></span></a>
    </div></li>
 	<li><div class="divider"></div></li>
   	<li><a class="subheader">Dashbord</a></li>
   	    <li>
   	    	<a href="<?php echo site_url('capacitaciones/')?>"><i class="material-icons tooltipped"  data-position="right" data-delay="20" data-tooltip="Capacitaciones">library_books</i>Capacitaciones</a>
   	    </li>

 	<?php if($this->session->userdata('role') == "ADMIN"){ ?>

	    <li>
	      	<a href="<?php echo site_url('festival/')?>"><i class="material-icons tooltipped"  data-position="right" data-delay="20" data-tooltip="Festival">local_activity</i>Festival</a>
	    </li>

	  <?php } ?> 
 	<?php if($this->session->userdata('role') == "ADMIN"){ ?>
	 	<li><div class="divider"></div></li>
	   	<li><a class="subheader">Admin</a></li>
   	    <li><a href="<?php echo site_url('admin/capacitaciones')?>"><i class="material-icons tooltipped"  data-position="right" data-delay="50" data-tooltip="Administrar Capacitaciones">library_books</i>Administrar Capacitaciones</a></li>
   	    <li><a href="<?php echo site_url('admin/festival')?>"><i class="material-icons tooltipped"  data-position="right" data-delay="50" data-tooltip="Administrar Festival">local_activity</i>Administrar Festival</a></li>
    
	<?php } ?>
	<li><div class="divider"></div></li>
    <li><a href='<?php echo site_url('dashboard/logout')?>'>Logout</a></li>
  </ul>
  <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tooltipped"  data-position="right" data-delay="50" data-tooltip="Menu">menu</i></a>
 	<main>
 
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
    	<footer>
		
        <div class="container">© 2008-2017 Somos Cerveceros<a class="right" href="https://github.com/cesardmoro">Desarrollado por Cesar Moro - Socio 977</a> </div>  
        </footer>

</body>
</html>
