<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('layout/head');?>
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
                    <h4><?php if(!empty($titulo)) echo $titulo;else echo 'Agregar Cliente';?></h4>
                    <hr>
                    <form action="<?php echo base_url();?>index.php/ClientesController/addCliente" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <input required class="form-control" name="input-rut" id="input-rut" placeholder="Ingrese Rut">
                                <br>
                                <input required class="form-control" name="input-nombre" id="input-nombre" placeholder="Ingrese Nombre">
                                </br>
                                <input required class="form-control" name="input-razonsocial" id="input-razonsocial" placeholder="Ingrese Razón Social">
                                <br>
                                <input required class="form-control" name="input-telefono" id="input-telefono" placeholder="Ingrese Teléfono">
                                </br>
                                <input required class="form-control" name="input-email" id="input-email" placeholder="Ingrese e-Mail">
                                <br>
                                <input required class="form-control" name="input-direccion" id="input-direccion" placeholder="Ingrese Dirección">          
                                </br>
                                <input required class="form-control" name="input-comuna" id="input-comuna" placeholder="Ingrese Comuna">
                                
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Enviar</button>
                                <a class= "btn btn-xs btn-danger" href="<?php echo base_url();?>index.php/ClientesController/index">Cancelar</a>
                            </div>
                        </div>
                    </form>
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
    <script>
    </script>
</body>

</html>