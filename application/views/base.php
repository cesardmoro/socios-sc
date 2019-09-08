<!DOCTYPE html>
<html>
<head>
<title>Somos Cerveceros</title>

    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0,user-scalable=0">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
          
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"> 
  


</head>
<body>
<div id="wrapper">
   <div class="container center-align">
  <img src="<?php echo base_url()?>assets/img/logo.svg" width="400">
  </div>
   <?php if($this->session->flashdata('message')){ ?>
     <div class="row">
       <div class="col m4"></div> 
       <div class="col m4">
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
       <div class="col m4"></div> 
       <div class="col m4">
       <div class=" card red darken-4">
                <div class="card-content white-text">
                  <p><?php echo $this->session->flashdata('error'); ?></p>
                </div>
        </div>
      </div>
      </div> 

    <?php } ?>
    
    <?php print $view; ?> 
    </div>
</body>
</html>