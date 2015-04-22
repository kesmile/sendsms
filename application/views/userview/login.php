<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Send messenger</title>
        <link rel="stylesheet" href="<? echo base_url();?>/asset/css/metro-bootstrap.min.css">
        <link rel="stylesheet" href="<? echo base_url();?>/asset/css/metro-bootstrap-responsive.min.css">
        <script src="<? echo base_url();?>/asset/js/jquery-1.11.1.min.js"></script>
        <script src="<? echo base_url();?>/asset/js/jquery.widget.min.js"></script>
        <script src="<? echo base_url();?>/asset/js/jquery.mousewheel.js"></script>
        <script src="<? echo base_url();?>/asset/js/metro.min.js"></script>
    <style>
      @font-face{
        font-family:'iconFont';
        src:url('<? echo base_url();?>asset/fonts/iconFont.eot');
        src:url('<? echo base_url();?>asset/fonts/iconFont.eot?#iefix') format('embedded-opentype'),url('<? echo base_url();?>asset/fonts/iconFont.woff') format('woff'),url('<? echo base_url();?>asset/fonts/iconFont.ttf') format('truetype'),url('<? echo base_url();?>asset/fonts/iconFont.svg#iconFont') format('svg');
        font-weight:normal;
        font-style:normal;
      }
      h4 small{
           color: #222222;
           font-weight: 400;
           font-size: 10pt !important;
       }
       .metro .example {
           padding: 20px;
           
       }
       .metro .example:before {
           content: "";
       }
       #login{
           margin: 0 auto;
           width: 80%;
           background: #fff !important;
           margin-top: 5%;
           
       }
       #login label{
           font-size: 1.3rem;
       }
       #login button{
           margin-top: 8px;
       }
    </style>
    <link rel="stylesheet" href="<? echo base_url();?>/asset/css/iconFont.min.css">
  </head>
  
  <body class="metro">
    <div class="container">
        <div class="grid">
                <div class="row">
                    <div class="span6 offset4" >
                        <h2 style="text-align: center"><span class="icon-rocket"></span> Send messenger <sup>1.6</sup></h2>
                        <div class="example" id="login">
                                <?php echo form_open('login'); ?>
                                        <label>Usuario</label>
                                        <div class="input-control text">
                                                <input name="username" type="text" value="<?php echo set_value('username'); ?>" placeholder=""/>
                                        </div>
                                        <label>Contraseña</label>
                                        <div class="input-control text">
                                                <input name="pass" type="password" value="<?php echo set_value('pass'); ?>" placeholder=""/>
                                        </div>
                                        
                                                      <?php if (validation_errors('<div>','</div>') != ""){
                                                              $mensaje = validation_errors('<div>','</div>');
                                                            }
                                                          if(isset($mensaje) && $mensaje != ""){?>
                                                          <div class="notice marker-on-top bg-red fg-white">
                                                                  <?php echo $mensaje; ?>
                                                          </div>
                                                       <?php } ?>
                                        
                                        
                                        <button type="submit" class="primary large">Entrar</button>
                                <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>
