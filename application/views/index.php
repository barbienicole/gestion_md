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
                <div class="container-fluid">
                    <!-- main content -->
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
        $(document).ready(function() {
            
        });
        function logout(){
            window.location.href = '<?php echo base_url();?>'+'index.php/UsuariosController/logout';
        }
    </script>
</body>
</html>