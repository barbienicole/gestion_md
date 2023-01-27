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
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Usuarios';?></h4>
                    <hr>
                    <button class="btn btn-primary">Agregar</button>
                    <hr>
                    <table id="table-usuarios" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%">Id</th>
                                <th width="60%">Nombre</th>
                                <th width="20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-usuarios">
                        <?php
                            if(!empty($usuarios)){
                               //vienen registros
                               foreach($usuarios as $usuario){
                                echo '<tr>';
                                echo '<td>'.$usuario['id'].'</td>';
                                echo '<td>'.$usuario['nombre'].'</td>';
                                echo '<td align="center"><button class="btn btn-xs btn-warning">editar</button> <button class="btn btn-xs btn-danger">eliminar</button></td>';
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
            $('#table-usuarios').DataTable({
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
    </script>
</body>

</html>