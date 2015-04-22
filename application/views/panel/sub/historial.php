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
            Mensajes enviados
        </h1>
        <div class="example">
            <h2>Buscar</h2>
            <hr>
                <form>
                        <div class="grid">
                                <div class="row">
                                    <div class="span3">
                                        <span class="seach">Desde</span>
                                        <div class="input-control date" style="float: left;" >
                                                <input id="fecha_init" name="fecha_init" value="<?php
                                                        if($fecha_init != null){
                                                            echo $fecha_init;
                                                        }else{
                                                            echo date("Y-m-d");
                                                            }
                                                        ?>" type="date" />
                                        </div>
                                    </div>
                                    <div class="span3">
                                        <span class="seach">Hasta</span>
                                        <div class="input-control date" style="float: left;" >
                                                <input id="fecha_end" name="fecha_end" value="<?php
                                                        if($fecha_end != null){
                                                            echo $fecha_end;
                                                        }else{
                                                            echo date("Y-m-d");
                                                            }
                                                        ?>" type="date" />
                                        </div>
                                    </div>
                                <?php if($user_id == 1): ?>
                                    <div class="span3">
                                        <span class="seach">Hasta</span>
                                        <div class="input-control select" style="width: 67%;">
                                                <select name="user">
                                                        <option value="">Todos</option>
                                                <?php if($users): foreach($users as $usuario): ?>
                                                    <option value="<?php echo $usuario->id?>"><?php echo $usuario->username; ?></option>
                                                <?php endforeach; endif;?>
                                                </select>
                                            </div>
                                    </div>
                                <?php endif; ?>
                                    <div class="span1">
                                        <button class="primary">Buscar</button>
                                    </div>
                                <?php if($export):?>
                                    <div class="span1">
                                        <?php if(isset($_GET['user']) && $user_id == 1){
                                                $user = "&user=" . $_GET['user'];
                                        }else{
                                                $user = "";
                                        }?>
                                        <a class="success button" href="<?php echo site_url('panel/exportrone?fecha_init=' . $fecha_init ."&fecha_end=" . $fecha_end . $user); ?>" >Exportar</a>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </div>
                </form>
                
                <?php if ($msj != null){ ?>
                       <p>
                          <div class="notice marker-on-top bg-red fg-white">
                           
                               <?php echo $msj; ?>
                           
                          </div>
                       </p>
                 <?php } ?>
                
                
                <?php if($result): 
                	$total_enviados = 0;
                	$total_fallidos = 0;
                ?>
                        <table class="table">
                                <thead>
                                        <tr>
                                                <th class="text-left" width="20">Numero de mensajes</th>
                                                <th class="text-left">Mensaje</th>
                                                <th class="text-left">Enviados</th>
                                                <th class="text-left">Fallidos</th>
                                                <th class="text-left">Total</th>
                                                <th class="text-left" width="20">% enviados</th>
                                                <th class="text-left" width="100">Fecha</th>
                                                <th class="text-left">Usuario</th>
                                                <th class="text-left">Detalle</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <? foreach($result as $row): ?>
                                        <tr>
                                                <td><? if( count(explode(",", $row->numbers)) >= 3): ?>
                                                                <?php echo wordlimit($row->numbers, $length = 3, $ellipsis = "..."); ?>
                                                        <?php else: ?>
                                                              <?php echo $row->numbers; ?>
                                                        <?php endif ?>
                                                </td>
                                                <td>
                                                        <?php echo $row->mensaje; ?>        
                                                </td>
                                                <td><?php echo $row->enviados; $total_enviados +=  $row->enviados?> </td>
                                                <td><?php echo $fallidos = $row->total - $row->enviados; $total_fallidos += $fallidos;?></td>
                                                <td><?php echo $row->total; ?></td>
                                                        
                                                <td><?php echo porcentaje($fallidos, $row->total) . "%"; ?></td>
                                                <td width="100"><?php echo substr($row->fecha,0,-3); ?></td>
                                                <td><?php echo $row->username; ?></td>
                                                <td>
                                                                <a href="<?php echo site_url('panel/reportind/'. $row->id) ?>" class="detalle" >ver
                                                                        
                                                                </a>
                                                        
                                                </td>
                                        </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                        <div>
                        	<b>Total enviados:</b> <?php echo $total_enviados; ?> </br>
                   		<b>Total fallidos:</b> <?php echo $total_fallidos; ?> </br>
                   		<b>Suma total:</b> <?php echo $total_enviados + $total_fallidos; ?>
                        </div>
                <?php endif; ?>
        </div>
 </div>

<script>
        $(document).ready(function(){
                
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
                $porcentaje = $var / $total;
                return round((100 - $porcentaje),2);
        }
                return 100;
        
 }
 
?>
