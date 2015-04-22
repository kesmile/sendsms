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
          <a href="javascript:history.back()" id="back" ><i class="icon-arrow-left-3 fg-darker smaller"></i></a>  Mensajes enviados
        </h1>
        <div class="example">
            <h2>Detalle individual</h2>
            <hr>
                <a class="success button" href="<?php echo site_url('panel/exportrdos/'.$id); ?>" >Exportar</a>
                <?php if($result): ?>
                        <table class="table">
                                <thead>
                                        <tr>
                                                <th class="text-left">Telefono</th>
                                                <th class="text-left">Mensaje</th>
                                                <th class="text-left">Estado</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <? foreach($result as $row): ?>
                                        <tr>
                                                <td><?php echo $row->telefono ?></td>
                                                <td><?php echo $row->mensaje ?></td>
                                                <td><?php echo $row->estado ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                <?php endif; ?>
        </div>
 </div>

<script>
        $(document).ready(function(){
                //$('#back').click(function(){
                  //      history.back(-1);
                    //    });
        });
</script>
