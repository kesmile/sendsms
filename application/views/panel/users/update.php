<div class="container">
        <h1>
            Usuarios
        </h1>
        <div class="example">
            <h2>Editar</h2>
            <hr>
		<div class="grid">
			<div class="row">
			    <div class="span4 ">
				<?php echo form_open("users/update/" . $id, array("id" => "add_usuario")); ?>
					<label>Usuario</label>
					<div class='input-control text'>
						<input type='text' name='username' value="<?php 
							if($username){
								echo $username;
							}
						?>"/>
					</div>
					<label>Clave</label>
					<div class='input-control password'>
						<input type='password' name='pass'/>
					</div>
					<label>Repetir Clave</label>
					<div class='input-control text'>
						
						<input type='password' name='pass2' />
					</div>
					
					<div class="input-control checkbox">
						<label>
						    <input value="1" type="checkbox" name="estado" id="estado" <?php echo ($estado == 1) ? 'checked': false; ?> />
						    <span class="check"></span>
						    <span id="txtestado"><?php echo ($estado == 1) ? 'Usuario activo': 'Usuario inactivo'; ?></span>
						</label>
					</div>
					<div style="clear: both"></div>
					<button class='inverse snd' id='snd' style='float: left; margin-top: 10px;'>Aceptar</button>
					<a href="<?php echo site_url('users') ?>" class="inverse button" id="back" style='float: left; margin-top: 10px; margin-left: 10px' >Regresar</a> 
				<?php echo form_close(); ?>
				
			    </div>
			    <div class="span4 offset1" style="padding-top: 35px;">
				<?php 
				$mensaje = $msj;
				if (validation_errors('<div>','</div>') != ""){
                                                              $mensaje .= validation_errors('<div>','</div>');
                                                              
                                                            }
                                                            
                                                          if(isset($mensaje) && $mensaje != ""){?>
                                                          <div class="notice bg-red fg-white">
                                                                  <?php echo $mensaje; ?>
                                                          </div>
                                                       <?php } ?>
			    </div>
			</div>
		    </div>
        </div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		<?php if($ok): ?>
		$(window).load(function(){
			alert("Cambios realizados exitosamente");
			});
			
		<?php endif;?>
	$('#estado').change(function() {
              if(this.checked) {
                 $('#txtestado').html("Usuario activo");
              }else{
		 $('#txtestado').html("Usuario inactivo");
              }
          });
        });
</script>

