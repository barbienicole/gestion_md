<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('layout/head');?>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
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
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Materiales';?></h4>
                    <hr>
                    <a class="btn btn-primary" href="<?php echo base_url();?>index.php/MaterialesController/add">Agregar</a>
                    <hr>
                    <table id="table-materiales" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="10%">Código</th>
                                <th width="40%">Nombre</th>
                                <th width="10%">Valor</th>
                                <th width="10%">Stock Ideal</th>
                                <th width="10%">Stock</th>
                                <th width="15%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-materiales">
                        <?php
                            if(!empty($materiales)){
                               //vienen registros
                               foreach($materiales as $material){
                                echo '<tr>';
                                echo '<td>'.$material['id'].'</td>';
                                echo '<td>'.$material['codigo'].'</td>';
                                echo '<td>'.$material['nombre'].'</td>';
                                echo '<td>'.$material['valor'].'</td>';
                                echo '<td>'.$material['stockideal'].'</td>';
                                echo '<td><input min="0" style="width: 60%;" type="number" value="'.$material['stock'].'" name="input-stock" id="input-stock-'.$material['id'].'" /><button id="'.$material['id'].'" class="btn btn-sm btn-primary ml-1" onclick="updateStock(this.id);">Ok</button></td>';
                                echo '<td align="center">
                                            <a class="btn btn-xs btn-warning" href="'.base_url().'index.php/MaterialesController/edit?id='.$material['id'].'">editar</a> 
                                            <button class="btn btn-xs btn-danger" onclick="deleteMaterial('.$material['id'].');">eliminar</button>
                                      </td>';
                                echo '</tr>';
                               }
                            }
                            else{
                                //no vienen registros
                                echo '<tr><td colspan="3">No existen registros.</td></tr>';
                            }
                        ?>
                        </tbody>
                    </table>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php $this->load->view('layout/scripts');?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table-materiales').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
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

        function deleteMaterial(material_id){
            let c = confirm('Confirme la eliminación de este registro.');
            if(c){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/MaterialesController/deleteMaterial',
                    data: {id: material_id},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/MaterialesController/index';
                        else
                            alert('Hubo un problema con la eliminación del Material # '+ id);
                    }   
                });
            }
        }

        function updateStock(material_id){
            let c = confirm('Confirme esta operación');
            if(c){
                let nuevoStock = $('#input-stock-'+material_id).val();
                $.ajax({
                    url: '<?php echo base_url();?>index.php/MaterialesController/updateStock',
                    data: {id: material_id, nuevoStock: nuevoStock},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/MaterialesController/index';
                        else
                            alert('Hubo un problema con la actualización del stock del Material # '+ id);
                    }   
                });
            }
        }
    </script>
</body>

</html>