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
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Items';?></h4>
                    <hr>
                    <a class="btn btn-primary" href="<?php echo base_url();?>index.php/ItemsController/add">Agregar</a>
                    <hr>
                    <table id="table-items" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%">Id</th>
                                <th width="60%">Nombre</th>
                                <th width="20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-items">
                        <?php
                            if(!empty($items)){
                               //vienen registros
                               foreach($items as $item){
                                echo '<tr>';
                                echo '<td>'.$item['id'].'</td>';
                                echo '<td>'.$item['nombre'].'</td>';
                                echo '<td align="center">
                                            <a class="btn btn-xs btn-warning" href="'.base_url().'index.php/ItemsController/edit?id='.$item['id'].'">editar</a> 
                                            <button class="btn btn-xs btn-danger" onclick="deleteItem('.$item['id'].');">eliminar</button>
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
            $('#table-items').DataTable({
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

        function deleteItem(item_id){
            let c = confirm('Confirme la eliminaci??n de este registro.');
            if(c){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/ItemsController/deleteItem',
                    data: {id: item_id},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/ItemsController/index';
                        else
                            alert('Hubo un problema con la eliminaci??n del Item # '+ id);
                    }   
                });
            }
        }
    </script>
</body>

</html>