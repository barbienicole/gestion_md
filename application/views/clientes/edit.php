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
                    <h4><?php if(!empty($titulo)) echo $titulo;?></h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <input required class="form-control" name="input-rut" id="input-rut" placeholder="Ingrese Rut" value="<?php if(!empty($data[0]['rut'])) echo $data[0]['rut'];?>">
                            <br>
                            <input required class="form-control" name="input-nombre" id="input-nombre" placeholder="Ingrese Nombre" value="<?php if(!empty($data[0]['nombre'])) echo $data[0]['nombre'];?>">
                            </br>
                            <input required class="form-control" name="input-razonsocial" id="input-razonsocial" placeholder="Ingrese Razón Social" value="<?php if(!empty($data[0]['razonsocial'])) echo $data[0]['razonsocial'];?>">
                            <br>
                            <input required class="form-control" name="input-telefono" id="input-telefono" placeholder="Ingrese Telefono" value="<?php if(!empty($data[0]['telefono'])) echo $data[0]['telefono'];?>">
                            </br>
                            <input required class="form-control" name="input-email" id="input-email" placeholder="Ingrese e-Mail" value="<?php if(!empty($data[0]['email'])) echo $data[0]['email'];?>">
                            <br>
                            <input required class="form-control" name="input-direccion" id="input-direccion" placeholder="Ingrese Dirección" value="<?php if(!empty($data[0]['direccion'])) echo $data[0]['direccion'];?>">
                            </br>
                            <input required class="form-control" name="input-comuna" id="input-comuna" placeholder="Ingrese Comuna" value="<?php if(!empty($data[0]['comuna'])) echo $data[0]['comuna'];?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="updateCliente();">Enviar</button>
                            <a class= "btn btn-xs btn-danger" href="<?php echo base_url();?>index.php/ClientesController/index">Cancelar</a>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php $this->load->view('layout/scripts');?>
    <script>
        function updateCliente(){
            let cliente_id = '<?php echo $data[0]['id'];?>';
            let cliente_rut = $('#input-rut').val();
            let cliente_nombre = $('#input-nombre').val();
            let cliente_razonsocial = $('#input-razonsocial').val();
            let cliente_telefono = $('#input-telefono').val();
            let cliente_email = $('#input-email').val();
            let cliente_direccion = $('#input-direccion').val();
            let cliente_comuna = $('#input-comuna').val();

            if(cliente_rut.trim() != ''){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/ClientesController/editCliente',
                    data: {id: cliente_id, rut: cliente_rut, nombre: cliente_nombre, razonsocial: cliente_razonsocial, 
                            telefono: cliente_telefono, email: cliente_email, direccion: cliente_direccion, comuna: cliente_comuna},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/ClientesController/index';
                        else
                            alert('Hubo un problema con la actualización del Cliente # '+ id);
                    }   
                });
            }
            else{
                alert('Cliente debe tener un valor');
            }
        }
    </script>
</body>

</html>