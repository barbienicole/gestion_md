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
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Clientes';?></h4>
                    <hr>
                    <a class="btn btn-primary" href="<?php echo base_url();?>index.php/ClientesController/add">Agregar</a>
                    <hr>
                    <table id="table-clientes" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="10%">Rut</th>
                                <th width="25%">Nombre</th>
                                <th width="20%">Razón Social</th>
                                <th width="10%">Dirección</th>
                                <th width="10%">e-Mail</th>
                                <th width="5%">Teléfono</th>
                                <th width="5%">Comuna</th>
                                <th width="10%">Acciones</th>                            
                            </tr>
                        </thead>
                        <tbody id="tbody-clientes">
                        <?php
                            if(!empty($clientes)){
                               //vienen registros
                               foreach($clientes as $cliente){
                                echo '<tr>';
                                echo '<td>'.$cliente['id'].'</td>';
                                echo '<td>'.$cliente['rut'].'</td>';
                                echo '<td>'.$cliente['nombre'].'</td>';
                                echo '<td>'.$cliente['razonsocial'].'</td>';
                                echo '<td>'.$cliente['direccion'].'</td>';
                                echo '<td>'.$cliente['email'].'</td>';
                                echo '<td>'.$cliente['telefono'].'</td>';
                                echo '<td>'.$cliente['comuna'].'</td>';
                                echo '<td align="center">
                                            <a class="btn btn-xs btn-warning" href="'.base_url().'index.php/ClientesController/edit?id='.$cliente['id'].'">editar</a> 
                                            <button class="btn btn-xs btn-danger" onclick="deleteCliente('.$cliente['id'].');">eliminar</button>
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
            $('#table-clientes').DataTable({
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

        function deleteCliente(cliente_id){
            let c = confirm('Confirme la eliminación de este registro.');
            if(c){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/ClientesController/deleteCliente',
                    data: {id: cliente_id},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/ClientesController/index';
                        else
                            alert('Hubo un problema con la eliminación del Cliente # '+ id);
                    }   
                });
            }
        }
    </script>
</body>

</html>