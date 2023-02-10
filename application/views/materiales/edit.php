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
                            <input required class="form-control" name="input-codigo" id="input-codigo" placeholder="Ingrese Codigo" value="<?php if(!empty($data[0]['codigo'])) echo $data[0]['codigo'];?>">
                            <br>
                            <input required class="form-control" name="input-nombre" id="input-nombre" placeholder="Ingrese Nombre" value="<?php if(!empty($data[0]['nombre'])) echo $data[0]['nombre'];?>">
                            </br>
                            <input required class="form-control" name="input-modelo" id="input-modelo" placeholder="Ingrese Modelo" value="<?php if(!empty($data[0]['modelo'])) echo $data[0]['modelo'];?>">
                            <br>
                            <input required class="form-control" name="input-valor" id="input-valor" placeholder="Ingrese Valor" value="<?php if(!empty($data[0]['valor'])) echo $data[0]['valor'];?>">
                            </br>
                            <input required class="form-control" name="input-stock" id="input-stock" placeholder="Ingrese Stock" value="<?php if(!empty($data[0]['stock'])) echo $data[0]['stock'];?>">
                            <br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="updateMaterial();">Enviar</button>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php $this->load->view('layout/scripts');?>
    <script>
        function updateMaterial(){
            let material_id = '<?php echo $data[0]['id'];?>';
            let material_codigo = $('#input-codigo').val();
            let material_nombre = $('#input-nombre').val();
            let material_modelo = $('#input-modelo').val();
            let material_valor = $('#input-valor').val();
            let material_stock = $('#input-stock').val();

            if(material_nombre.trim() != ''){
                $.ajax({
                    url: '<?php echo base_url();?>index.php/MaterialesController/editMaterial',
                    data: {id: material_id, codigo: material_codigo, nombre: material_nombre, modelo: material_modelo, valor: material_valor, stock: material_stock},
                    type: 'post',
                    dataType: 'text',
                    success: function(response){
                        if(response == '1')
                            window.location.href = '<?php echo base_url();?>index.php/MaterialesController/index';
                        else
                            alert('Hubo un problema con la actualización del Material # '+ id);
                    }   
                });
            }
            else{
                alert('Material debe tener un valor');
            }
        }
    </script>
</body>

</html>