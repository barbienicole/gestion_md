<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('layout/head');?>
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
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">  
        <!-- sidebar-->
        <?php $this->load->view('layout/sidebar');?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('layout/nav');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid m-2" style="background-color: #fff; min-height: 500px;">
                    <!-- main content -->
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Nuevo Proyecto';?></h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <fieldset>    	
                            <legend>Datos Generales</legend>
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Usuario</label>
                                            <input readonly value="Nombre Usuario Logueado" class="form-control" name="input-usuario" id="input-usuario" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>C??digo</label>
                                            <input class="form-control" name="input-codigo" id="input-codigo" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Fecha</label>
                                            <input value="<?php echo date('Y-m-d');?>" class="form-control" type="date" name="input-fecha" id="input-fecha" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>T??tulo</label>
                                            <input  value="" class="form-control" name="input-titulo" id="input-titulo" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Descripci??n</label>
                                            <input class="form-control" name="input-descripcion" id="input-descripcion" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Cliente</label>
                                            <select class="form-control" id="select-clientes" name="select-clientes">
                                                <option value="">Seleccione el Cliente</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </fieldset>			
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-items">Agregar Item</button>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                        <fieldset>    	
                            <legend>Detalle</legend>
                            <div class="panel">
                                <div class="panel-body">
                                    <table table="table-detalle" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>N?? Item</th>
                                                <th>Item</th>
                                                <th>Cantidad</th>
                                                <th>Valor Unitario</th>
                                                <th>Sub Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detalle">
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <fieldset class="col-md-4">    	
                                            <legend>Resumen</legend>
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <table class="">
                                                        <tr>
                                                            <td>Neto</td>
                                                            <td id="td-neto">0</td>
                                                        </tr>

                                                        <tr>
                                                            <td>IVA</td>
                                                            <td id="td-iva">0</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Total</td>
                                                            <td id="td-total">0</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                        </fieldset>
                                    </div>
                                    	
                                </div>
                            </div>
                            
                        </fieldset>			
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a class= "btn btn-xs btn-danger" href="<?php echo base_url();?>index.php/MaterialesController/index">Cancelar</a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('layout/footer');?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="modal-items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php $this->load->view('layout/scripts');?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table-carga-items').DataTable({
                lengthMenu: [
                    [5, 25, 50, -1],
                    [5, 25, 50, 'All'],
                ],
                pageLength: 5,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay informaci??n",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
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

        function cargarItem(item_id){
            item_id = item_id.replace('btn-','');
            let cantidad = $('#input-cantidad-'+item_id).val();

            $.ajax({
                url: '<?php echo base_url();?>index.php/ItemsController/getDataItem',
                type: 'post',
                data: {id: item_id},
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    let tbody = '<tr id="tr-'+item_id+'">';
                    tbody += '<td>'+item_id+'</td>';
                    tbody += '<td>'+response[0]['nombre']+'</td>';
                    tbody += '<td id="td-cantidad_item-'+item_id+'">'+cantidad+'</td>';
                    tbody += '<td><input onkeyup="calcularSubTotal(this.id);" value="0" type="number" id="input-valor_unitario-'+item_id+'" name="input-valor_unitario" /></td>';
                    tbody += '<td><input class="form-control" name="input-sub_total" id="input-sub_total-'+item_id+'" readonly></td>';
                    tbody += '<td><button id="btn-remove-'+item_id+'" class="btn btn-danger" onclick="removerItem(this.id);">remover</button></td>';
                    tbody += '</tr>';
                    $('#tbody-detalle').append(tbody);

                    $('#modal-items').modal('hide');
                }
            });
        }

        function removerItem(identificador_item){
            identificador_item = identificador_item.replace('btn-remove-','');
            let c = confirm('Cofirme esta operaci??n');
            if(c)
                $('#tr-'+identificador_item).remove();

            sumatoriaTotal();
        }

        function calcularSubTotal(identificador){
            let valor_unitario = $('#'+identificador).val();
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

            let iva = sumatoria * 0.19;
            let total = sumatoria + iva;

            $('#td-neto').html(sumatoria);
            $('#td-iva').html(iva);
            $('#td-total').html(total);

        }

        </script>
</body>

</html>