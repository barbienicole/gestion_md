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

                <div class="row">
                    <div class="col-md-4">
                        <label>Usuario</label>
                        <input readonly value="<?php echo $this->session->userdata('usuario_nombre');?>" class="form-control" name="input-usuario" id="input-usuario" />
                    </div>
                    <div class="col-md-4">
                        <label>Código</label>
                        <input class="form-control" name="input-codigo" id="input-codigo" />
                    </div>
                    <div class="col-md-4">
                        <label>Fecha</label>
                        <input value="<?php echo date('Y-m-d');?>" class="form-control" type="date" name="input-fecha" id="input-fecha" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Título</label>
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
                        <label>Cliente</label>
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
        <br><br>         
        <div class="row">
            <div class="col-md-12">
                <fieldset>    	
                    <legend>Detalle Presupuestado</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table table="table-detalle_pre" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>N° Item</th>
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

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <fieldset>    	
                    <legend>Detalle Real</legend>
                    <div class="panel">
                        <div class="panel-body">
                            <table table="table-real-detalle" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>N° Item</th>
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
        <a class= "btn btn-xs btn-info" href="<?php echo base_url();?>index.php/CotizacionesController/index">Volver</a>
        <br><br>
    </div>
</div>

<?php $this->load->view('layout/main_bot');?>   
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>     
<script>
    $(document).ready( function () {
    });
</script>