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
        <legend>Datos Servicio</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <p><font color="red">(*)</font> Datos Obligatorios</p>
                <div class="row">
                    <div class="col-md-4">
                        <label>Usuario</label>
                        <input readonly value="<?php echo $this->session->userdata('usuario_nombre');?>" class="form-control" name="input-usuario" id="input-usuario" />
                    </div>
                    <div class="col-md-4">
                        <label>Ticket<font color="red">(*)</font></label>
                        <input class="form-control" name="input-ticket" id="input-ticket" />
                    </div>
                    <div class="col-md-4">
                        <label>ISTT<font color="red">(*)</font></label>
                        <input class="form-control" name="input-istt" id="input-istt" />
                    </div>
                    <div class="col-md-4">
                        <label>Fecha <font color="red">(*)</font></label>
                        <input value="<?php echo date('Y-m-d');?>" class="form-control" type="date" name="input-fecha" id="input-fecha" />
                    </div>
                    <div class="col-md-4">
                        <label>Servicio<font color="red">(*)</font></label>
                        <select class="form-control" id="select-servicio" name="select-servicio">
                        <option value="">Seleccione</option>
                        <?php
                        if(!empty($servicios)){
                            foreach($servicios as $c){
                                 echo '<option value="'.$c['id'].'">'.$c['nombre'].'  </option>';
                             }
                        }
                         ?>
                    </select>
                    </div>
                    <div class="col-md-4">
                        <label>Valor<font color="red">(*)</font></label>
                        <input class="form-control" name="input-valor" id="input-valor" />
                    </div>
                    <div class="col-md-4">
                        <label>Nota de Venta</label>
                        <input class="form-control" name="input-nota_venta" id="input-nota_venta" />
                    </div>
                    <div class="col-md-4">
                        <label>Orden de Compra</label>
                        <input class="form-control" name="input-orden_compra" id="input-orden_compra" />
                    </div>
                    <div class="col-md-4">
                        <label>Factura</label>
                        <input class="form-control" name="input-factura" id="input-factura" />
                    </div>
                </div>
                <br>
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
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" onclick="generarServicoFinalizado();">Generar</button>
        <a class= "btn btn-xs btn-danger" href="<?php echo base_url();?>index.php/ServiciosFinalizadosController/index">Cancelar</a>
        <br><br>
    </div>
</div>

<?php $this->load->view('layout/main_bot');?>   
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>     
<script>
    var iva_historico = <?= $iva?>;
    
    var neto = 0;
    var iva = 0;
    var total = 0;

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
    
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    function generarServicioFinalizado(){
        let c = confirm('Confirme la Finalización de este Servicio');
        if(c){
            let usuario = '<?php echo $this->session->userdata("usuario_id");?>';
            let istt = $('#input-istt').val();
            let ticket = $('#input-ticket').val();
            let fecha = $('#input-fecha').val();
            let servicio = $('#select-servicio').val();
            let cliente = $('#select-cliente').val();
            let valor = $('#input-cliente').val();
            let descripcion = $('#textarea-descripcion').val();
            let nota_venta = $('#input-nota_venta').val();
            let orden_compra = $('#input-orden_compra').val();
            let factura = $('#input-factura').val();

            if(data.length > 0){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/ServiciosFinalizadosController/addServicioFinalizado',
                    type: 'post',
                    dataType: 'json',
                    data: {
                                data: data, 
                                usuario: usuario,
                                istt: istt,
                                ticket: ticket,
                                fecha: fecha,
                                servicio: servicio,
                                cliente: cliente,
                                valor: valor,
                                descripcion: descripcion,
                                nota_venta: nota_venta,
                                orden_compra: orden_compra,
                                factura: factura,
                                iva_historico: iva_historico,
                                iva: iva,
                                total: total,
                            },
                    success: function(response){
                        if(parseInt(response['codigo']) == 1){
                            alert(response['response']);
                            window.location.href = '<?php echo base_url();?>index.php/ServiciosFinalizadosController/index';
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