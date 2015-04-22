<style>
  .off{
    text-align: right;
    padding-right: 5px;
    line-height: 16px;
    color: #fff;
  }
  .on{
    text-align: left;
    padding-left: 5px;
    line-height: 15px;
    color: #fff;
  }
</style>
<div class="container">
        <h1>
            Envio de mensajes
        </h1>
        <div class="example">
            <h2>Configuracion de mensaje</h2>
            <hr>
             
             
             <?php echo form_open_multipart('panel/excel', array('id'=>"importar")); ?>
             
             <div class="grid">
                <div class="row">
                    <div class="span2">
                     Archivo de excel
                    </div>
                    <div class="span4">
                      <div class="input-control file">
                          <input id="myfile" type="file" name="userfile" size="300" />
                          <button class="btn-file"></button>
                      </div>
                    </div>
                    <div class="span2">
                      <button class="inverse button" id="send-import" >Importar</button>
                    </div>
                </div>
            </div>
             
                
            <?php echo form_close(); ?>
            
            
            <?php echo form_open('ejecutar/valid', array("id" => "send_msm")); ?>
                <h4>1. Agregar numeros de telefono</h4>
                <p class="text-muted">
                    Solo debes separar cada valor por una coma y cada usuario con un punto y coma ejemplo: 43748888,Nombre,Monto,Otro;
                    43748888,Nombre,Monto,Otro.
                </p>
                <div class="input-control textarea">
                   <textarea name="numbers" id="numbers" ><?php
                   
                                                          if($tarea){
                                                            echo $tarea[0]->numeros;
                                                            }    
                                                          if(isset($_GET['numero']))
                                                             echo $_GET['numero'];
                                                          ?></textarea>
                </div>
                <h4>2 .Agregar mensaje <small class="on-right">(max 160 caracteres)</small></h4>
                <p class="text-muted">
                    valores que se pueden utilizar {nombre}, {monto}, {otro} siempre debe escribirse dentro de llaves.
                </p>
                <div class="input-control textarea">
                    <textarea name="mensaje" id="mensaje" class="contador" ><?php if($tarea){
                                                            echo $tarea[0]->mensaje;
                                                            } ?></textarea>
                </div>
                <input type="hidden" name="edit_id" value="<?php echo ($tarea)? $tarea[0]->id : false ?>" />
                <div id="longitud_textarea" style=" margin-bottom: 10px;"></div>
                    <div class="input-control switch">
                       <label>
                           Envio programado 
                           <input type="checkbox" id="mycheck" name="mycheck" />
                           <span id="sw" class="check off">off</span>
                       </label>
                   </div>
                <div id="tareas" style="display: none">
                  <p>

                            <div class="input-control date" style="float: left; margin-right: 20px;" >
                             <label>Fecha</label>
                             <input type="date" id="fecha" name="fecha" value="<?php echo ($tarea)? $tarea[0]->fecha : false ?>" />
                                              <!--  <input id="fecha" name="fecha" value=" <?php echo ($tarea)? $tarea[0]->fecha : false ?> ?>" type="date" /> -->
                           </div>
                            <label>Hora</label>
                                <div class="input-control select" style="width: 200px">
                                    <select name="hora">
                                        <option>*Selecciona una hora</option>
                                        <?php if($horas):
                                              foreach($horas as $row):
                                         ?>
                                              
                                             <option value="<?php echo $row['value']; ?>" <?php if($tarea) { if($tarea[0]->hora == $row['value']) echo 'selected'; }?>><?php echo $row['hora']; ?></option>
                                         
                                         <? endforeach;
                                            endif;
                                            ?>
                                    </select>
                               </div>
                  </p>
                </div>
                <?php if (validation_errors('<div>','</div>') != ""){
                      $mensaje = validation_errors('<div>','</div>');
                       }
                       if(isset($mensaje) && $mensaje != ""){?>
                       <p>
                          <div class="notice marker-on-top bg-red fg-white" >
                           
                               <?php echo $mensaje; ?>
                           
                          </div>
                       </p>
                 <?php } ?>
                
                <div style="margin-bottom: 20px;"></div>
                <?php //var_dump($array); ?>
                <input type="submit" value="enviar" />
                <a href="#" class="inverse button" id="sendmsj" style="float: left" >Enviar mensaje</a>
                <a href="#" class="inverse button" id="savemsj" style="display: none; float: left" >Guardar mensaje</a>
            <?php echo form_close(); ?>
        </div>
 </div>

<script>
   $(document).ready(function(){
     var block = false;
      $(".contador").each(function(){
	var longitud = $(this).val().length;
			$('#longitud_textarea').html('<b>'+longitud+'</b> caracteres');
			$(this).keydown(function(e){ 
				var nueva_longitud = $(this).val().length;
				$('#longitud_textarea').html('<b>'+nueva_longitud+'</b> caracteres');
				if (nueva_longitud == "160") {
					$('#longitud_textarea').css('color', '#ff0000');
                                //        e.preventDefault();
				}
                                if (e.keyCode == 8) {
                                  if (nueva_longitud>0) {
                                   nueva_longitud--;
                                  }
                                  $('#longitud_textarea').html('<b>'+nueva_longitud+'</b> caracteres');
                                  $('#longitud_textarea').css('color', '#000');
                                }
                                
	   });
       }); 
      $("#send-import").on('click', function(e){
                    var formData = new FormData($("#importar")[0]);
                         
                        $.ajax({
                            url: $("#importar").attr("action"),
                            type: 'POST',
                            data: formData,
                            dataType: "json",
                            async: false,
                            success: function (data) {
                                if (data.status == 1) {
                                  $("#numbers").val(data.value);
                                  alert("Archivo cargado exitosamente!");
                                }else{
                                  alert(data.value);
                                }
                                //alert(data)
                                //$(".btn-close").trigger('click');
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    e.preventDefault();
                }); 
      $("#sendmsj").click(function(e){
         var longitud = $("#mensaje").val().length;
         var numeros = $("#numbers").val().length;
          if (longitud == 0 || longitud>160 || numeros == 0) {
             alert("Campo de envio de mensajes o de numeros se encuentra vacio");
             
          }else{
               var isGood= confirm('¿Esta seguro que desea enviar este mensaje?');
           if (isGood == true) {
             if(block == false){
             	$.ajax({
                     url: $("#send_msm").attr("action"),
                     type: $("#send_msm").attr("method"),
                     data: $("#send_msm").serialize(),
                     success:function(data){
                       block = false;
                       alert("Mensajes enviados correctamente");
                        }
                });
              
              	$("#myfile").val("");
                $("#mensaje").val("");
                $("#numbers").val("");
                block = true;
             }else{
           	alert('Servidor ocupado! no cierres ni recarges la pagina hasta ver el mensaje de envio correctamente');
           	}
           }
          }
          e.preventDefault();
       }); 
      
      $("#savemsj").click(function(e){
         var longitud = $("#mensaje").val().length;
         var numeros = $("#numbers").val().length;
          if (longitud == 0 || longitud>160 || numeros == 0) {
             alert("Campo de envio de mensajes o de numeros se encuentra vacio");
             
          }else{
              $.ajax({
                     url: $("#send_msm").attr("action"),
                     type: $("#send_msm").attr("method"),
                     data: $("#send_msm").serialize(),
                     success:function(data){
                         alert("Envio de mensajes guardado correctamente");
                         window.location.replace('<?php echo site_url('panel'); ?>');
                        }
                });
              
             // $("#myfile").val("");
             //   $("#mensaje").val("");
             //   $("#numbers").val("");
          }
          e.preventDefault();
       }); 
      
      
       $("#mensaje").alphanum({
          allow              : ':;,.{}*-+/',    // Allow extra characters
          allowLatin         : true,  // a-z A-Z
          allowOtherCharSets : false,
          maxLength          :  160,
       });
       $("#numbers").alphanum({
          allow              : ':;,.{}',    // Allow extra characters
          disallow           : ' ',
          allowSpace         : false,
          allowLatin         : true,  // a-z A-Z
          allowOtherCharSets : false,
          maxLength          :  160,
       });
       
       /*
        * Tareas programadas
        */
       <?php if($tarea): ?>
         $(window).load(function(){
           $('#mycheck').trigger('click');
          });
       <?php endif; ?>
       $('#mycheck').change(function() {
              if(this.checked) {
                 $('#tareas').fadeIn('slow');
                 $('#sw').removeClass('off').addClass('on').html('on');
                 $('#sendmsj').css('display','none');
                 $('#savemsj').css('display','block');
              }else{
               $('#sw').removeClass('on').addClass('off').html('off');
                 $('#tareas').fadeOut('slow');
                 $('#sendmsj').css('display','block');
                 $('#savemsj').css('display','none');
              }
          });
    });
</script>

