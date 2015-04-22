<style>
        .seach{
                display: inline-block;
                float: left;
                margin-right: 10px;
        }
        .popup{
                padding: 15px;
        }
        .table a{
                color: #000 !important;
        }
        .table a:hover{
                color: #2e92cf !important;
        }
        .bold{
                font-weight: 700;
        }
</style>


<div class="container">
        <h1>
            Mensajes Recibidos
        </h1>
        <div class="example">
            
            
            <table class="table">
                                <thead>
                                        <tr>
                                                <th class="text-left" width="100">Telefono</th>
                                                <th class="text-left" width="100">Fecha</th>
                                                <th class="text-left" width="100" style="max-width:300px !important">Mensaje</th>
                                                <th class="text-left" width="100"></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php if($result):?>
                                         <?php foreach($result as $row): ?>
                                                <tr>
                                                        <td><a href="<?php echo site_url('ejecutar/read/' . $row->id) ?>" class="<?php echo ($row->flag)? 'bold' : false; ?>"><?php echo $row->telefono; ?></a></td>
                                                        <td><a href="<?php echo site_url('ejecutar/read/' . $row->id) ?>" class="<?php echo ($row->flag)? 'bold' : false; ?>"><?php echo date("d-m-Y h:i:s", strtotime($row->fecha)); ?></a></td>
                                                        <td style="max-width:400px !important"><a href="<?php echo site_url('ejecutar/read/' . $row->id) ?>" class="<?php echo ($row->flag)? 'bold' : false; ?>" style="word-wrap: break-word; text-align: justify;"><?php echo $row->mensaje; ?></a></td>
                                                        <td><a href="<?php echo site_url("/panel/respuesta?telefono=" . $row->telefono ); ?>" ><i class="icon-clipboard"></i> Responder</a> |
<?php if($row->flag == 1): ?>
<a href="<?php echo site_url('ejecutar/read/' . $row->id) ?>">Marcar como leido</a>
<?php else: ?>
visto
<?php endif;?>
                                                        </td>
                                                </tr>
                                         <?php endforeach; ?>
                                        <?php endif; ?>
                                </tbody>
                        </table>
            
            
        </div>
 </div>

<script>
        $(document).ready(function(){
                
        });
</script>
<?php

 
?>
