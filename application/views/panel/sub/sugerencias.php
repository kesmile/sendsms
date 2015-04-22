<style>
        .seach{
                display: inline-block;
                float: left;
                margin-right: 10px;
        }
        .popup{
                padding: 15px;
        }
</style>


<div class="container">
        <h1>
            Sugerencias
        </h1>
        <div class="example">
            <h2>Enviar sugerencia</h2>
            <hr>
                <div class="grid">
                        <div class="row">
                            <div class="span5">
                                 <?php echo form_open('panel/s'); ?>
                                        <label>Asunto</label>
                                        <div class="input-control text">
                                                <input type="text" name="asunto" id="asunto"/>
                                                <button class="btn-clear"></button>
                                        </div>
                                        <label>Comentario</label>
                                        <div class="input-control textarea" style="margin-bottom: 20px">
                                                <textarea name="mensaje" id="mensaje" ></textarea>
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
                                        <button class="inverse" id="send-msj" type="submit">Guardar mensaje</button>
                                <?php echo form_close(); ?>
                            </div>
                        <div class="span12" style="margin-left: 0">
                                <h2>Ultimos mensajes</h2>
                                <hr>
                                <table class="table">
                                <thead>
                                        <tr>
                                                <th class="text-left">Asunto</th>
                                                <th class="text-left">Mensaje</th>
                                                <th class="text-left" width="200">Fecha</th>
                                                <th class="text-left">Estado</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php if($mensajes): ?>
                                        <?php foreach($mensajes as $row): ?>
                                                <tr>
                                                         <td><?php echo $row->asunto; ?></td>
                                                         <td><?php echo $row->mensaje; ?></td>
                                                         <td><?php echo date("d-m-Y h:i:s", strtotime($row->fecha)); ?></td>
                                                         <td><?php echo $row->estado; ?></td>
                                                </tr>
                                        <?php endforeach ?>
                                       <?php endif; ?>
                                </tbody>
                        </div>
                        </div>
                </div>
        </div>
 </div>

<script>
        $(document).ready(function(){
               <?php if($ok): ?>
                        alert("Sugerencia enviada exitosamente!");
               <?php endif;?>
        });
</script>
