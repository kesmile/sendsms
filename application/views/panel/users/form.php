<div class="container">
        <h1>
            Usuarios
        </h1>
        <div class="example">
            <h2>Agregar nuevo</h2>
            <hr>
		<div class="grid">
			<div class="row">
			    <div class="span4 ">
				<?php echo form_open("users/add", array("id" => "add_usuario")); ?>
					<label>Usuario</label>
					<div class='input-control text'>
						<input type='text' name='username' value="<?php 
							if($username){
								echo $username;
							}
						?>"/>
					</div>
					<label>Clave</label>
					<div class='input-control text'>
						<input type='password' name='pass'/>
					</div>
					<label>Repetir Clave</label>
					<div class='input-control text'>
						
						<input type='password' name='pass2' />
					</div>
					
					<div style="clear: both"></div>
					<button class='inverse snd' id='snd' style='float: left; margin-top: 10px;'>Aceptar</button>
					<a href="<?php echo site_url('users') ?>" class="inverse button" id="back" style='float: left; margin-top: 10px; margin-left: 10px' >Regresar</a> 
				<?php echo form_close(); ?>
				
			    </div>
			    <div class="span4 offset1" style="padding-top: 35px;">
				<?php if(validation_errors()): ?>
					<div class="notice marker-on-left bg-red fg-white">
						<?php echo validation_errors(); ?>	
					
					</div>
					<?php endif; ?>
			    </div>
			</div>
		    </div>
        </div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){

		
        });
</script>

