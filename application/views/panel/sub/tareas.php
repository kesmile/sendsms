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
            Mensajes Programados
        </h1>
        <div class="example">
            <h2>Tareas</h2>
            <hr>
                <?php if($result): ?>
                        <table class="table">
                                <thead>
                                        <tr>
                                                <th class="text-left" width="90">Fecha</th>
                                                <th class="text-left" >Hora</th>
                                                <th class="text-left">Numeros</th>
                                                <th class="text-left">Mensaje</th>
                                                <th class="text-left">Acciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <? foreach($result as $row): ?>
                                        <tr>
                                                <td><?php echo date("d-m-Y", strtotime($row->fecha)); ?></td>
                                                <td><?php echo $row->hora .":00" ?></td>
                                                <td>
                                                                <?php echo wordlimit($row->numeros, $length = 6, $ellipsis = "..."); ?>
                                                </td>
                                                <td>
                                                        <?php echo $row->mensaje; ?>        
                                                </td>
                                                <td>
								<a href="<?php echo site_url('panel/index/'. $row->id) ?>" >Editar</a>
                                                                <a href="<?php echo site_url('panel/taskdelete/'. $row->id) ?>" class="eliminar" >Eliminar</a>
                                                        
                                                </td>
                                        </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
			<div id="data"></div>
                <?php endif; ?>
        </div>
 </div>

<script>
        $(document).ready(function(){
                $('.eliminar').click(function(e){
                    var isConfirm = confirm("¿Estas seguro que deseas eliminar esta tarea?");
                    if (isConfirm) {
                        $.ajax({
				url: $(this).attr("href"),
				type: 'GET',
				success:function(data){
					if (data == 1) {
						window.location.reload();
					}else{
						alert('Error no se pudo eliminar tarea');
					}
				  
				   }
			   });
                    }
			
			e.preventDefault();
			});
		
        });
</script>
<?php
 function wordlimit($string, $length, $ellipsis = "...")
      {
	  $words = explode(',', $string);
	  if (count($words) > $length)
	  {
		  return implode(',', array_slice($words, 0, $length)) ." ". $ellipsis;
	  }
	  else
	  {
		  return $string;
	  }
      }
 function porcentaje($fallidos, $total){
        $var = ($fallidos * 100);
        if($var > 0){
                return $var / $total;
        }
                return 100;
        
 }
 
?>
