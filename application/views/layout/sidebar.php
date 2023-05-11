<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
    <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
        <!--<i class="fas fa-cogs"></i>-->
        <img src="<?php echo base_url();?>assets/img/logo_md_blanco.png" class="img-responsive" width="90px;"/>
    </div>
    <div class="sidebar-brand-text mx-3">Panel Control<sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Administración</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Configuración</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Configuración:</h6>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/UsuariosController/index">Usuarios</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/RolesController/index">Roles</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/ClientesController/index">Clientes</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/ServiciosController/index">Servicios</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/ItemsController/index">Items</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/SucursalesController/index">Sucursales</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/MaterialesController/listado">Materiales</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/ConfiguracionesController/index">Parametrización</a>
            <a class="collapse-item">Permisos</a>

        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Gestión</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestión:</h6>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/MaterialesController/index">Stock Materiales</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/CotizacionesController/index">Programación Proyectos</a>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/TicketsController/index">Tickets</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Reportes
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Entidad</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Stock Materiales:</h6>
            <a class="collapse-item" href="#">Movimientos</a>
            <a class="collapse-item" href="#">Listado</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Programación Proyectos:</h6>
            <a class="collapse-item" href="<?php echo base_url();?>index.php/CotizacionesController/historico">Histórico</a>
            <h6 class="collapse-header">Información Log:</h6>
            <a class="collapse-item" href= "<?php echo base_url();?>index.php/LogsController/index">Logs</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<!--
<li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li>
-->
<!-- Nav Item - Tables -->
<!--
<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>
-->
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->