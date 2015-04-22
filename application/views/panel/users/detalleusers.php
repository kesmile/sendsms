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
            <a href="<?php echo site_url('panel') ?>" id="back" ><i class="icon-arrow-left-3 fg-darker smaller"></i></a> Envio
        </h1>
        <div class="example">
            <h2>Administrar envio por usuario</h2>
            <hr>
		                <form method="get">
                        <div class="grid">
                                <div class="row">
                                    <div class="span3">
                                        <span class="seach">Mes</span>
                                        <div class="input-control select" style="width: 67%;">
                                                <select name="mes">
                                                        <option value="">Todos</option>
                                                <?php if($meses): foreach($meses as $mes): ?>
                                                    <option value="<?php echo $mes['value']?>" <?php echo ($mes['value'] == $select_mes)? 'selected': false ?>><?php echo $mes['name']; ?></option>
                                                <?php endforeach; endif;?>
                                                </select>
                                            </div>
                                    </div>
				    <div class="span3">
                                        <span class="seach">Año</span>
                                        <div class="input-control select" style="width: 67%;">
                                                <select name="anio">
                                                <?php if($anios): foreach($anios as $anio): ?>
                                                    <option value="<?php echo $anio['value'];?>" <?php echo ($mes['value'] == $select_anio)? 'selected': false ?>><?php echo $anio['value']; ?></option>
                                                <?php endforeach; endif;?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="span1">
                                        <button class="primary">Buscar</button>
                                    </div>
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
		 
		 <?php if($users): ?>
		<table class="table" style="width: 50%">
                                <thead>
                                        <tr>
                                                <th class="text-left">Usuario</th>
                                                <th class="text-left">Menjase enviados</th>
                                        </tr>
				</thead>
				<tbody>
					<?php
						$total = 0;
					        foreach($users as $row):
						$total += $row->total;
						?>
					<tr>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->total; ?></td>
					</tr>
				<? endforeach; ?>
			          
					<tr>
						<td><b>Total</b></td>
						<td><b><?php echo $total; ?></b></td>
					</tr>
				
				</tbody>
				
		</table>
		<?php endif; ?>
		
		<?php if($total_users): ?>
		<table class="table" style="width: 50%">
                                <thead>
                                        <tr>
                                                <th class="text-left">Mes</th>
						<th class="text-left">Usuario</th>
                                                <th class="text-left">Menjase enviados</th>
                                        </tr>
				</thead>
				<tbody>
					<?php
						$total = 0;
					        foreach($total_users as $row):
						$total += $row->total;
						?>
					<tr>
						<td><?php echo getTextM(substr($row->fecha,0,2)); ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->total; ?></td>
					</tr>
				<? endforeach; ?>
			          
					<tr>
						<td><b>Total</b></td>
						<td></td>
						<td><b><?php echo $total; ?></b></td>
					</tr>
				
				</tbody>
				
		</table>
		<?php endif; ?>
		
        </div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		

		
        });
</script>
<?php
  function getTextM($mes){
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
                              foreach($meses as $row){
                                if($row['value'] == $mes){
                                  return $row['name'];
                                }
                              }
    
  }
?>
