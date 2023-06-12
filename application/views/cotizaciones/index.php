<?php $this->load->view('layout/main_top');?>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
<div class="row">
    <div class="col-md-2">
        <label>Desde</label>
        <input class="form-control" type="date" name="input-desde" id="input-desde" value="<?php echo date('Y-m-').'01';?>">
    </div>

    <div class="col-md-2">
        <label>Hasta</label>
        <input class="form-control" type="date" name="input-hasta" id="input-hasta" value="<?php echo date('Y-m-d');?>">
    </div>

    <div class="col-md-2">
        <label>Cliente</label>
        <select class="form-control" id="select-cliente" name="select-cliente">
            <option value="">Todos</option>
            <?php
            if(!empty($clientes)){
                foreach($clientes as $c){
                    echo '<option value="'.$c['id'].'">'.$c['rut'].' '.$c['razonsocial'].' </option>';
                }
            }
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label>Estado</label>
        <select class="form-control" id="select-estado" name="select-estado">
            <option value="">Todos</option>
            <?php
            if(!empty($estados)){
                foreach($estados as $e){
                    echo '<option value="'.$e['id'].'">'.$e['nombre'].' </option>';
                }
            }
            ?>
        </select>
    </div>
    
    <div class="col-md-2">
        <br><button class="btn btn-primary btn-sm mt-2" onclick="cargarTabla();">Filtrar</button>
    </div>
</div>
<hr>
<a href="<?php echo base_url();?>index.php/CotizacionesController/add" class="btn btn-primary">Agregar</a>
<hr>
<div class="row">
    <div class="table-responsive" id="div-tabla">
        <table id="table-cotizaciones" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Título</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Margen</th>
                    <th class="text-center">Presupuestado $</th>
                    <th class="text-center">Real $</th>
                    <th class="text-center">Diferencia $</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>                            
                </tr>
            </thead>
            <tbody id="tbody-cotizaciones">
            </tbody>
            <tfoot id="tfoot-cotizaciones">
            </tfoot>
        </table>
   </div>
</div>
<?php $this->load->view('layout/main_bot');?>   
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>             
<script>
    var div_tabla = $('#div-tabla').html();
    $( document ).ready(function() {
        cargarTabla();
    });
    function cargarTabla(){
        let desde = $('#input-desde').val();
        let hasta = $('#input-hasta').val();
        let cliente = $('#select-cliente').val();
        let estado = $('#select-estado').val();

        let tbody = '';
        let tfoot = '';

        $.ajax({
            url: '<?php echo base_url();?>index.php/CotizacionesController/obtenerCotizaciones',
            data: {desde: desde, hasta: hasta, cliente: cliente, estado: estado},
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
                $('#div-tabla').html(div_tabla);
            },
            success: function(response){
                let sum_presupuestado = 0;
                let sum_real = 0;
                let sum_diferencia = 0;

                if(response.length > 0){
                    for(let i=0; i < response.length; i++){
                        sum_presupuestado += parseInt(response[i]['total']);
                        sum_real += parseInt(response[i]['total_real']);
                        sum_diferencia += parseInt(response[i]['diferencia']);

                        tbody += '<tr>';
                        tbody += '<td>'+response[i]['id']+'</td>';
                        tbody += '<td>'+response[i]['codigo']+'</td>';
                        tbody += '<td>'+response[i]['fecha_creacion']+'</td>';
                        tbody += '<td>'+response[i]['titulo']+'</td>';
                        tbody += '<td>'+response[i]['cliente']+'</td>';
                        tbody += '<td>'+(response[i]['margen'] != null ? response[i]['margen'] : 'N/A' )+'</td>';
                        tbody += '<td class="text-right">'+response[i]['totales_presupuestado']+'</td>';
                        tbody += '<td class="text-right">'+response[i]['totales_real']+'</td>';
                        tbody += '<td class="text-right">'+response[i]['diferencia']+'</td>';
                        tbody += '<td>'+response[i]['estado']+'</td>';
                        tbody += '<td><a href="<?php echo base_url();?>index.php/CotizacionesController/view?id='+response[i]['id']+'" class="btn btn-info btn-sm" title="Ver cotización">ver</a> <a href="<?php echo base_url();?>index.php/CotizacionesController/edit?id='+response[i]['id']+'" class="btn btn-warning btn-sm" title="Editar cotización">editar</a></td>';
                        tbody += '</tr>';
                    }
                    if(sum_diferencia < 0)
                        sum_diferencia = '<font color="red">'+new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sum_diferencia)+'</font>';
                    else if(sum_diferencia > 0)
                        sum_diferencia = '<font color="green">'+new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sum_diferencia)+'</font>';
                    tfoot += '<tr><td colspan="6" class="text-center"><strong>Totales $</strong></td><td class="text-right">'+new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sum_presupuestado)+'</td><td class="text-right">'+new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(sum_real)+'</td><td class="text-right">'+sum_diferencia+'</td><td colspan="2"></td></tr>';
                }

                $('#tbody-cotizaciones').html(tbody);
                $('#tfoot-cotizaciones').html(tfoot);
                $('#table-cotizaciones').DataTable({
                    columnDefs: [
                    {
                        targets: [6,7,8],
                        render: $.fn.dataTable.render.number('.', ',', 0, '$','')
                    }
                    ],
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
            }
        });
    }
</script>