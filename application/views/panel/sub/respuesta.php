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
          
              <div class="grid">
                <div class="row">
                    <div class="span5">
                                  <h2>Mensaje</h2>
                                <hr>
                                <?php echo form_open('ejecutar/valid', array("id" => "send_msm")); ?>
                                    <h4>1.Numero de telefono</h4>
                                    <div class="input-control textarea">
                                       <input name="numbers" id="numbers" value="<?php echo $tel; ?>" >
                                                                          
                                    </div>
                                    <h4>2 .Agregar mensaje <small class="on-right">(max 160 caracteres)</small></h4>
                                    <div class="input-control textarea">
                                        <textarea name="mensaje" id="mensaje" class="contador" ></textarea>
                                    </div>
                                    <div id="longitud_textarea" style=" margin-bottom: 10px;"></div>                
                                    <?php //var_dump($array); ?>
                                    <button class="inverse " id="sendmsj" style="float: left" >Enviar mensaje</button>
                                <?php echo form_close(); ?>
                    </div>
                    <div class="span8">
                                      <h2>Historial</h2>
                                      <hr>
                                      <table class="table">
                                                          <thead>
                                                                  <tr>
                                                                          <th class="text-left" width="30">Telefono</th>
                                                                          <th class="text-left">Mensaje</th>
                                                                          <th class="text-left" width="200">Fecha</th>
                                                                  </tr>
                                                          </thead>
                                                          <?php if($historial): ?>
                                                          <tbody>
                                                              <?php foreach($historial as $row): ?>
                                                                    <tr>
                                                                        <td><?php echo $row['telefono'] ?></td>
                                                                        <td style="max-width:430px !important; word-wrap: break-word; text-align: justify;"><?php echo $row['mensaje'] ?></td>
                                                                        <td><?php echo date("d-m-Y h:i:s", strtotime($row['fecha'])); ?></td>
                                                                    </tr>
                                                              <?php endforeach; ?>
                                                            <?php endif; ?>
                                                          </tbody>
                                      </table>
                    </div>
                </div>
            </div>


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
      $("#sendmsj").click(function(e){
         var longitud = $("#mensaje").val().length;
         var numeros = $("#numbers").val().length;
          if (longitud == 0 || longitud>160 || numeros == 0) {
             alert("Campo de envio de mensajes o de numeros se encuentra vacio");
             
          }else{
               //var isGood= confirm('¿Esta seguro que desea enviar este mensaje?');
           if (block == false) {
              $.ajax({
                     url: $("#send_msm").attr("action"),
                     type: $("#send_msm").attr("method"),
                     data: $("#send_msm").serialize(),
                     success:function(data){
                       block = false;
                       alert("Mensaje enviado correctamente");
                       window.location.reload();
                        }
                });
                $("#sendmsj").html('Enviando...');
                $("#mensaje").val("");
                block = true;
           }
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
          allowSpace         : false,
          allowNumeric       : true,
          allowLatin         : false
       });
    });
</script>

