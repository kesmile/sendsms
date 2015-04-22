<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sende messeger</title>
        <link rel="stylesheet" href="<? echo base_url();?>/asset/css/metro-bootstrap.min.css">
        <link rel="stylesheet" href="<? echo base_url();?>/asset/css/metro-bootstrap-responsive.min.css">
        <script src="<? echo base_url();?>/asset/js/jquery-1.11.1.min.js"></script>
        <script src="<? echo base_url();?>/asset/js/jquery.widget.min.js"></script>
        <script src="<? echo base_url();?>/asset/js/jquery.mousewheel.js"></script>
        <script src="<? echo base_url();?>/asset/js/metro.min.js"></script>
        <script src="<? echo base_url();?>/asset/js/alphanumeric.js"></script>
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
        .metro .example:before {
            content: "";
        }
      #notify{
        display: block;
        position: absolute;
        font-size: 10px;
        right: 10px;
        top: 10px;
       padding-top: 1px;
        padding-bottom: 1px;
        padding-left: 2px;
        padding-right: 2px;
        line-height: 12px;
        background: #FF0000;
      }
    </style>
    <link rel="stylesheet" href="<? echo base_url();?>/asset/css/iconFont.min.css">
  </head>
<body class="metro">
    <div class="navigation-bar">
    <div class="navigation-bar-content container">
        <a href="<?php echo site_url("panel/"); ?>" class="element"><span class="icon-rocket"></span> Send messenger <sup>1.6</sup></a>
 
        <span class="element-divider"></span>
        <ul class="element-menu">
            <li>
                <a class="dropdown-toggle" href="<?php echo site_url("/"); ?>">Acciones</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="<?php echo site_url("panel/"); ?>">Enviar mensajes</a></li>
                    <li><a href="<?php echo site_url("panel/tasks"); ?>">Mensajes programados</a></li>
                    <li><a href="<?php echo site_url("panel/report"); ?>">Ver Historial</a></li>
                    <?php if($user_id == 1): ?>
                    <li><a href="<?php echo site_url("users"); ?>">Administrar usuarios</a></li>
                    <li><a href="<?php echo site_url("users/report"); ?>">Total de mensajes</a></li>
                    <?php endif ?>
                    <li><a href="<?php echo site_url("panel/s"); ?>">Sugerencias</a></li>
                </ul>
            </li>
        </ul>
        
        
        <span class="element-divider place-right"></span>
        <a class="element place-right" href="<?php echo site_url("login/logout"); ?>"><span class="icon-locked-2"></span></a>
        <span class="element-divider place-right"></span>
        <a class="element place-right" href="<?php echo site_url("panel/notify"); ?>">
        <?php if($total_msj[0]->total): ?>
        <span id="notify"><?php echo $total_msj[0]->total; ?></span>
        <?php endif;?>
        <span class="icon-mail" style="font-size: 19px !important"></span></a>
        <span class="element-divider place-right"></span>
        <button class="element image-button image-left place-right">
            Usuario: <?php echo $user; ?>
        </button>
        <span class="element-divider place-right"></span>
        <div class="element place-right">Mensajes utilzados en <?php echo mes() ?>: <?php echo ($total)? $total[0]->total : "0"; ?></div>
        </div>
    </div>
<!-- FIN DE HEADER -->
<?php
  function mes(){
                               $meses =   array(0 => array('value' => 1, 'name' => 'Enero'),
				       1 => array('value' => 2, 'name' => 'Febrero'),
				       2 => array('value' => 3, 'name' => 'Marzo'),
				       3 => array('value' => 4, 'name' => 'Abril'),
				       4 => array('value' => 5, 'name' => 'Mayo'),
				       5 => array('value' => 6, 'name' => 'Junio'),
				       6 => array('value' => 7, 'name' => 'Julio'),
				       7 => array('value' => 8, 'name' => 'Agosto'),
				       8 => array('value' => 9, 'name' => 'Septiembre'),
				       9 => array('value' => 10, 'name' => 'Octubre'),
				       10 => array('value' => 11, 'name' => 'Noviembre'),
				       11 => array('value' => 12, 'name' => 'Diciembre'));
                               $mes = date('m');
                              foreach($meses as $row){
                                if($row['value'] == $mes){
                                  return $row['name'];
                                }
                              }
    
  }
?>
