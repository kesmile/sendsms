<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="<? echo base_url();?>/asset/css/foundation.min.css" />
    <link rel="stylesheet" href="<? echo base_url();?>/asset/css/style.css" />
    <script src="asset/js/vendor/modernizr.js"></script>
  </head>
  <body>
       <!-- Header and Nav -->
 <div class="row" style="margin-top: 50px">
<div class="small-5 large-centered columns">
  <h1 style="text-align: center; margin-bottom: 25px;"> Registro panel Click Tools</h1>
  <?php echo form_open('login/register'); ?>
    <fieldset>
        
      <label>Usuario
        <input name="username" type="text"  value="<?php echo set_value('username'); ?>">
      </label>
      <label>Password
        <input name="pass" type="password"  value="<?php echo set_value('pass'); ?>">
      </label>
      <label>Comfirmed Password
        <input name="pass2" type="password"  value="<?php echo set_value('pass'); ?>">
      </label>
        <?php echo validation_errors('<div>','</div>'); ?>
          
      <input type="submit" class="button [tiny small large]" value="Enviar"/>
      <?php
              if(isset($mensaje)){
                echo $mensaje;
              }
          ?>
    </fieldset>
  <?php echo form_close(); ?>
</div>
 </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
