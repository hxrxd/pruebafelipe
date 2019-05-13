<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MiE | Registro</title>

    {!! Html::style('css/bootstrap.min.css')!!}
    {!! Html::style('font-awesome/css/font-awesome.css')!!}
    {!! Html::style('css/plugins/iCheck/custom.css')!!}
    {!! Html::style('css/animate.css')!!}
    {!! Html::style('css/style.css')!!}


   

    

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">MiE</h1>

            </div>
            <h3>Registro en la plataforma</h3>
            <p>Creación de cuenta de usuario para miembros del Programa EPSUM</p>
            <form class="m-t" role="form" action="register" method="post">
             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombres" required="" name="fname">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Apellidos" required="" name="lname">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" required="" name="password">
                </div>
                
               
                <button type="submit" class="btn btn-primary block full-width m-b">Registrar</button>

                <p class="text-muted text-center"><small>Ya tienes una cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login">Iniciar</a>
            </form>
            <p class="m-t"> <small>MiE desarrollado por Kevin Hared González  &copy; <?php echo date('Y'); ?></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    {!!Html::script('js/jquery-3.1.1.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/plugins/iCheck/icheck.min.js')!!}
   
    <!-- iCheck -->
    
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
