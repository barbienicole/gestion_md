<html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!------ Include the above in your HEAD tag ---------->
    <?php $this->load->view('layout/scripts');?>
    <style>
        /*
            body#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}
        */
        body#LoginForm{
            background-color: #444;
        }
        .form-heading { color:#fff; font-size:23px;}
        .panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
        .panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
        .login-form .form-control {
        background: #f7f7f7 none repeat scroll 0 0;
        border: 1px solid #d4d4d4;
        border-radius: 4px;
        font-size: 14px;
        height: 50px;
        line-height: 50px;
        }
        .main-div {
        background: #ffffff none repeat scroll 0 0;
        border-radius: 2px;
        margin: 10px auto 30px;
        max-width: 38%;
        padding: 50px 70px 70px 71px;
        }

        .login-form .form-group {
        margin-bottom:10px;
        }
        .login-form{ text-align:center;}
        .forgot a {
        color: #777777;
        font-size: 14px;
        text-decoration: underline;
        }
        .login-form  .btn.btn-success {
        /*
        background: #f0ad4e none repeat scroll 0 0;
        border-color: #f0ad4e;
        color: #ffffff;
        */
        font-size: 14px;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0;
        }
        .forgot {
        text-align: left; margin-bottom:30px;
        }
        .botto-text {
        color: #ffffff;
        font-size: 14px;
        margin: auto;
        }
        .login-form .btn.btn-primary.reset {
        background: #ff9900 none repeat scroll 0 0;
        }
        .back { text-align: left; margin-top:10px;}
        .back a {color: #444444; font-size: 13px;text-decoration: none;}

    </style>

</head>
<body id="LoginForm">
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
        <img src="<?php echo base_url();?>assets/img/logo_md_negro.png" class="img-responsive" width="250px;"/>
        <br><br>
        <h2>Iniciar Sesión</h2>
        <p>Porfavor ingresa tu usuario y contraseña</p>
        <?php
        if(!empty($mensaje)){
            echo '<p>'.$mensaje.'</p>';
        }
        ?>
   </div>
    <form id="form-login" action="<?php echo base_url();?>index.php/UsuariosController/login" method="post">
        <div class="form-group">
            <input required type="text" class="form-control" id="input-email" name="usuario" placeholder="Usuario">
        </div>
        <div class="form-group">
            <input required type="password" class="form-control" id="input-password" name="password" placeholder="Contraseña">
        </div>
        <button type="submit" class="btn btn-success">Aceptar</button>
    </form>
    </div>
</div></div></div>
</body>
</html>
