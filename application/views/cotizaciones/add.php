<?php $this->load->view('layout/main_top');?>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
<style>
    fieldset 
    {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        /*background-color:#f5f5f5;*/
        padding-left:10px!important;
    }	

    legend
    {
        font-size:14px;
        font-weight:bold;
        margin-bottom: 0px; 
        width: 35%; 
        border: 1px solid #ddd;
        border-radius: 4px; 
        padding: 5px 5px 5px 10px; 
        background-color: #ffffff;
    }

    nav > div a.nav-item.nav-link.active:after
    {
    content: "";
    position: relative;
    bottom: -60px;
    left: -10%;
    border: 15px solid transparent;
    border-top-color: #e74c3c ;
    }
</style>
<!-- main content -->
<div class="row">
    <div class="col-md-12">
    <fieldset>    	
        <legend>Datos Generales</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <p><font color="red">(*)</font> Datos Obligatorios</p>
                <div class="row">
                    <div class="col-md-4">
                        <label>Usuario</label>
                        <input readonly value="<?php echo $this->session->userdata('usuario_nombre');?>" class="form-control" name="input-usuario" id="input-usuario" />
                    </div>
                    <div class="col-md-4">
                        <label>Código <font color="red">(*)</font></label>
                        <input class="form-control" name="input-codigo" id="input-codigo" />
                    </div>
                    <div class="col-md-4">
                        <label>Fecha <font color="red">(*)</font></label>
                        <input value="<?php echo date('Y-m-d');?>" class="form-control" type="date" name="input-fecha" id="input-fecha" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Título <font color="red">(*)</font></label>
                        <input  value="" class="form-control" name="input-titulo" id="input-titulo" />
                    </div>
                    <div class="col-md-4">
                        <label>Estado</label>
                        <select disabled class="form-control" id="select-estado" name="select-estado">
                            <?php
                            if(!empty($estados)){
                                foreach($estados as $e){
                                    if($e['id'] == 1)
                                        echo '<option selected value="'.$e['id'].'">'.$e['nombre'].' </option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Cliente <font color="red">(*)</font></label>
                        <select class="form-control" id="select-cliente" name="select-cliente">
                            <option value="">Seleccione</option>
                            <?php
                            if(!empty($clientes)){
                                foreach($clientes as $c){
                                    echo '<option value="'.$c['id'].'">'.$c['rut'].' '.$c['razonsocial'].' </option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Descripción</label>
                        <textarea rows="4" value="" class="form-control" name="textarea-descripcion" id="textarea-descripcion" ></textarea>
                    </div>
                </div>
            </div>
        </div>
        
    </fieldset>			
    </div>
</div>
<hr>

<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-pre-tab" data-toggle="tab" href="#nav-pre" role="tab" aria-controls="nav-pre" aria-selected="true">Presupuestado</a>
        <a class="nav-item nav-link" id="nav-real-tab" data-toggle="tab" href="#nav-real" role="tab" aria-controls="nav-real" aria-selected="false">Real</a>
    </div>
</nav>
<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent" style="border-left: 1px solid #ddd !important;border-rigth: 1px solid #ddd !important;">

    <div class="tab-pane fade show active" id="nav-pre" role="tabpanel" aria-labelledby="nav-pre-tab" style="padding: 5px;">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-items">Agregar Item</button>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <fieldset>    	
                    <legend>Detalle Presupuestado</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table id="table-detalle_pre" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Item</th>
                                        <th>Item</th>
                                        <th>Cantidad</th>
                                        <th>Valor Unitario</th>
                                        <th>Sub Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-detalle_pre">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>			
            </div>
            <div class="col-md-12 mt-2">
                <fieldset class="col-md-12">    	
                    <legend>Resumen</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table class="">
                                <tr>
                                    <td><strong>Neto:</strong></td>
                                    <td id="td-neto_pre">0</td>
                                </tr>

                                <tr>
                                    <td><strong>IVA:</strong></td>
                                    <td id="td-iva_pre">0</td>
                                </tr>

                                <tr>
                                    <td><strong>Total:</strong></td>
                                    <td id="td-total_pre">0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="tab-pane fade show" id="nav-real" role="tabpanel" aria-labelledby="nav-real-tab" style="padding: 5px;">
 
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-real-items">Agregar Item</button>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <fieldset>    	
                    <legend>Detalle Real</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table id="table-detalle_real" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Item</th>
                                        <th>Item</th>
                                        <th>Cantidad</th>
                                        <th>Valor Unitario</th>
                                        <th>Sub Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-real-detalle">
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </fieldset>			
            </div>
            <div class="col-md-12 mt-2">
                <fieldset class="col-md-12">    	
                    <legend>Resumen</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table class="">
                                <tr>
                                    <td><strong>Neto:</strong></td>
                                    <td id="td-real-neto">0</td>
                                </tr>

                                <tr>
                                    <td><strong>IVA:</strong></td>
                                    <td id="td-real-iva">0</td>
                                </tr>

                                <tr>
                                    <td><strong>Total:</strong></td>
                                    <td id="td-real-total">0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </fieldset>
            </div>
        </div>
    </div>
</div>




<hr>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" onclick="generarCotizacion();">Generar</button>
        <a class= "btn btn-xs btn-danger" href="<?php echo base_url();?>index.php/CotizacionesController/index">Cancelar</a>
        <br><br>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-items-label">Listado de Items</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="table-carga-items" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Cargar</th>
                    </tr>
                </thead>
                <tbody id="tbody-carga-items">
                    <?php
                        if(!empty($items)){
                            //vienen registros
                            foreach($items as $item){
                                echo '<tr>';
                                echo '<td>'.$item['id'].'</td>';
                                echo '<td>'.$item['nombre'].'</td>';
                                echo '<td><input value="0" class="form-control" type="number" name="input-item_cantidad" id="input-cantidad-'.$item['id'].'"></td>';
                                echo '<td><button class="btn btn-primary" id="btn-'.$item['id'].'" onclick="cargarItem(this.id);">agregar</button></td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            //no vienen registros
                            echo '<tr><td colspan="4">No existen registros.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal Real-->
<div class="modal fade" id="modal-real-items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-real-items-label">Listado de Items</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="table-real-carga-items" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Cargar</th>
                    </tr>
                </thead>
                <tbody id="tbody-real-carga-items">
                    <?php
                        if(!empty($items)){
                            //vienen registros
                            foreach($items as $item){
                                echo '<tr>';
                                echo '<td>'.$item['id'].'</td>';
                                echo '<td>'.$item['nombre'].'</td>';
                                echo '<td><input value="0" class="form-control" type="number" name="input-real-item_cantidad" id="input-real-cantidad-'.$item['id'].'"></td>';
                                echo '<td><button class="btn btn-primary" id="btn-real-'.$item['id'].'" onclick="cargarItemReal(this.id);">agregar</button></td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            //no vienen registros
                            echo '<tr><td colspan="4">No existen registros.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/main_bot');?>   
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>     
<script>
    var iva_historico = <?= $iva?>;
    
    var neto_pre = 0;
    var iva_pre = 0;
    var total_pre = 0;

    var neto_real = 0;
    var iva_real = 0;
    var total_real = 0;

    $(document).ready( function () {
        $('#table-carga-items').DataTable({
            lengthMenu: [
                [5, 25, 50, -1],
                [5, 25, 50, 'All'],
            ],
            pageLength: 5,
            language: {
                "decimal": ",",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        $('#table-real-carga-items').DataTable({
            lengthMenu: [
                [5, 25, 50, -1],
                [5, 25, 50, 'All'],
            ],
            pageLength: 5,
            language: {
                "decimal": ",",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
    //PRE
    function cargarItem(item_id){
        item_id = item_id.replace('btn-','');
        let cantidad = $('#input-cantidad-'+item_id).val();

        $.ajax({
            url: '<?php echo base_url();?>index.php/ItemsController/getDataItem',
            type: 'post',
            data: {id: item_id},
            dataType: 'json',
            success: function(response){

                let tbody = '<tr id="tr-'+item_id+'">';
                tbody += '<td>'+item_id+'</td>';
                tbody += '<td>'+response[0]['nombre']+'</td>';
                tbody += '<td id="td-cantidad_item-'+item_id+'">'+cantidad+'</td>';
                tbody += '<td><input onkeyup="calcularSubTotal(this.id);" value="0" type="number" id="input-valor_unitario-'+item_id+'" name="input-valor_unitario" /></td>';
                tbody += '<td><input class="form-control" name="input-sub_total" value="0" id="input-sub_total-'+item_id+'" readonly></td>';
                tbody += '<td><button id="btn-remove-'+item_id+'" class="btn btn-danger" onclick="removerItem(this.id);">remover</button></td>';
                tbody += '</tr>';
                $('#tbody-detalle_pre').append(tbody);

                $('#modal-items').modal('hide');
            }
        });
    }

    function removerItem(identificador_item){
        identificador_item = identificador_item.replace('btn-remove-','');
        let c = confirm('Cofirme esta operación');
        if(c)
            $('#tr-'+identificador_item).remove();

        sumatoriaTotal();
    }

    function calcularSubTotal(identificador){
        let valor_unitario = $('#'+identificador).val() != '0' ? $('#'+identificador).val() : 0;
        item_id = identificador.replace('input-valor_unitario-','');
        let cantidad = $('#td-cantidad_item-'+item_id).html();
        let calculo = cantidad * valor_unitario;
        $('#input-sub_total-'+item_id).val(calculo);
        sumatoriaTotal();
    }

    function sumatoriaTotal(){
        let sub_totales = $('input[name="input-sub_total"]');
        let sumatoria = 0;
        for(let i=0; i < sub_totales.length; i++){
            sumatoria += parseInt($(sub_totales[i]).val());
        }

        let iva = Math.round(sumatoria * iva_historico);
        let total = Math.round(sumatoria + iva);

        neto_pre = sumatoria;
        iva_pre = iva;
        total_pre = total;

        $('#td-neto_pre').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sumatoria));
        $('#td-iva_pre').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(iva));
        $('#td-total_pre').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(total));

    }
    //----------------------------------------------------------------------------------------------------------
    //REAL
    function cargarItemReal(item_id){
        item_id = item_id.replace('btn-real-','');
        let cantidad = $('#input-real-cantidad-'+item_id).val();

        $.ajax({
            url: '<?php echo base_url();?>index.php/ItemsController/getDataItem',
            type: 'post',
            data: {id: item_id},
            dataType: 'json',
            success: function(response){

                let tbody = '<tr id="tr-real-'+item_id+'">';
                tbody += '<td>'+item_id+'</td>';
                tbody += '<td>'+response[0]['nombre']+'</td>';
                tbody += '<td id="td-real-cantidad_item-'+item_id+'">'+cantidad+'</td>';
                tbody += '<td><input onkeyup="calcularSubTotalReal(this.id);" value="0" type="number" id="input-real-valor_unitario-'+item_id+'" name="input-real-valor_unitario" /></td>';
                tbody += '<td><input class="form-control" name="input-real-sub_total" value="0" id="input-real-sub_total-'+item_id+'" readonly></td>';
                tbody += '<td><button id="btn-real-remove-'+item_id+'" class="btn btn-danger" onclick="removerItemReal(this.id);">remover</button></td>';
                tbody += '</tr>';
                $('#tbody-real-detalle').append(tbody);

                $('#modal-real-items').modal('hide');
            }
        });
    }

    function removerItemReal(identificador_item){
        identificador_item = identificador_item.replace('btn-real-remove-','');
        let c = confirm('Cofirme esta operación');
        if(c)
            $('#tr-real-'+identificador_item).remove();

        sumatoriaTotalReal();
    }

    function calcularSubTotalReal(identificador){
        let valor_unitario = $('#'+identificador).val() != '0' ? $('#'+identificador).val() : 0;
        item_id = identificador.replace('input-real-valor_unitario-','');
        let cantidad = $('#td-real-cantidad_item-'+item_id).html();
        let calculo = cantidad * valor_unitario;
        $('#input-real-sub_total-'+item_id).val(calculo);
        sumatoriaTotalReal();
    }

    function sumatoriaTotalReal(){
        let sub_totales = $('input[name="input-real-sub_total"]');
        let sumatoria = 0;
        for(let i=0; i < sub_totales.length; i++){
            sumatoria += parseInt($(sub_totales[i]).val());
        }

        let iva = Math.round(sumatoria * iva_historico);
        let total = Math.round(sumatoria + iva);

        neto_real = sumatoria;
        iva_real = iva;
        total_real = total;

        $('#td-real-neto').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sumatoria));
        $('#td-real-iva').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(iva));
        $('#td-real-total').html(new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(total));
    }
    //----------------------------------------------------------------------------------------------------------
    function generarCotizacion(){
        let c = confirm('Confirme la creación de este Proyecto');
        if(c){
            let usuario = '<?php echo $this->session->userdata("usuario_id");?>';
            let codigo = $('#input-codigo').val();
            let fecha = $('#input-fecha').val();
            let titulo = $('#input-titulo').val();
            let estado = $('#select-estado').val();
            let cliente = $('#select-cliente').val();
            let descripcion = $('#textarea-descripcion').val();
            //--------------------------------------------------------------------------------------------------------
            let dataPre = [];
            let dataReal = [];
            //pre
            //--------------------------------------------------------------------------------------------------------
            let table_pre = document.getElementById('table-detalle_pre');
            for (var r = 1, n = table_pre.rows.length; r < n; r++) {

                let idItem = table_pre.rows[r].cells[0].innerHTML;
                let cantidad = table_pre.rows[r].cells[2].innerHTML;
                let valor_unitario = $('#input-valor_unitario-'+idItem).val();
                let sub_total = $('#input-sub_total-'+idItem).val();

                let temp = [idItem, cantidad, valor_unitario, sub_total];
                dataPre.push(temp);
            }
            //real
            let table_real = document.getElementById('table-detalle_real');
            for (var r = 1, n = table_real.rows.length; r < n; r++) {

                let idItem = table_real.rows[r].cells[0].innerHTML;
                let cantidad = table_real.rows[r].cells[2].innerHTML;
                let valor_unitario = $('#input-real-valor_unitario-'+idItem).val();
                let sub_total = $('#input-real-sub_total-'+idItem).val();

                let temp = [idItem, cantidad, valor_unitario, sub_total];
                dataReal.push(temp);
            }

            //--------------------------------------------------------------------------------------------------------
            if(dataPre.length > 0){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/CotizacionesController/addCotizacion',
                    type: 'post',
                    dataType: 'json',
                    data: {
                                dataPre: dataPre, 
                                dataReal: dataReal,
                                usuario: usuario,
                                codigo: codigo,
                                fecha: fecha,
                                titulo: titulo,
                                estado: estado,
                                cliente: cliente,
                                descripcion: descripcion,
                                iva_historico: iva_historico,
                                neto_pre: neto_pre,
                                iva_pre: iva_pre,
                                total_pre: total_pre,
                                neto_real: neto_real,
                                iva_real: iva_real,
                                total_real: total_real
                            },
                    success: function(response){
                        if(parseInt(response['codigo']) == 1){
                            alert(response['response']);
                            window.location.href = '<?php echo base_url();?>index.php/CotizacionesController/index';
                        }
                        else{
                            alert(response['response']);
                        }
                    }
                });
            }
            else
                alert('Debe existir al menos un detalle Presupuestado');
        }
    }
</script>