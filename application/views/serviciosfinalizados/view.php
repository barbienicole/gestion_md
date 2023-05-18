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
                        <input readonly value="<?php echo !empty($cabecera[0]['usuario_nombre']) ? $cabecera[0]['usuario_nombre'] : 'N/A';?>" class="form-control" name="input-usuario" id="input-usuario" />
                    </div>
                    <div class="col-md-4">
                        <label>Código</label>
                        <input readonly class="form-control" name="input-codigo" id="input-codigo" value="<?php echo !empty($cabecera[0]['codigo']) ? $cabecera[0]['codigo'] : 'N/A';?>"/>
                    </div>
                    <div class="col-md-4">
                        <label>Fecha</label>
                        <input readonly value="<?php echo !empty($cabecera[0]['fecha_creacion']) ? $cabecera[0]['fecha_creacion'] : date('Y-m-d');?>" class="form-control" type="date" name="input-fecha" id="input-fecha" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Título</label>
                        <input disabled  value="<?php echo !empty($cabecera[0]['titulo']) ? $cabecera[0]['titulo'] : 'N/A';?>" class="form-control" name="input-titulo" id="input-titulo" />
                    </div>

                    <div class="col-md-4">
                        <label>Cliente</label>
                        <select disabled class="form-control" id="select-cliente" name="select-cliente">
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
                        <textarea readonly rows="4" value="" class="form-control" name="textarea-descripcion" id="textarea-descripcion" ><?php echo !empty($cabecera[0]['descripcion']) ? $cabecera[0]['descripcion'] : 'N/A';?></textarea>
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




<hr>
<div class="row">
    <div class="col-md-12">
        <a class= "btn btn-xs btn-info" href="<?php echo base_url();?>index.php/ServiciosFinalizadosController/index">Volver</a>
        <br><br>
    </div>
</div>

<?php $this->load->view('layout/main_bot');?>   
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>     
<script>
    $(document).ready( function () {
        $('#select-cliente').val('<?php echo !empty($cabecera[0]['cliente_id']) ? $cabecera[0]['cliente_id'] : 1;?>');
    });
</script>