<div class="container">
        <h1>
            <a href="<?php echo site_url('panel') ?>" id="back" ><i class="icon-arrow-left-3 fg-darker smaller"></i></a> Usuarios
        </h1>
        <div class="example">
            <h2>Administrar</h2>
            <hr>
		
		<table class="table" style="width: 50%">
                                <thead>
                                        <tr>
                                                <th class="text-left">Usuario</th>
                                                <th class="text-left">Estado</th>
                                                <th class="text-left">Acciones</th>
                                        </tr>
				</thead>
				<tbody>
					<?php if($users):
					        foreach($users as $row): ?>
					<tr>
						<td><?php echo $row->username; ?></td>
						<td><?php echo ($row->estado == 1)? 'Activo' : 'Desactivado'; ?></td>
						<td><a href="<?php echo site_url("users/update/" . $row->id); ?>" class="detalle" >Editar</a></td>
					</tr>
				<? endforeach;
			          endif;
				?>
				</tbody>
				
		</table>
	    <a href="<?php echo site_url("users/add"); ?>" class="detalle" >Agregar usuario</a>
        </div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		

		
        });
</script>

