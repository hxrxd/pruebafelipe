<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro Correcto</title>

    {!! Html::style('css/bootstrap.min.css')!!}
    {!! Html::style('font-awesome/css/font-awesome.css')!!}

    {!! Html::style('css/animate.css')!!}
    {!! Html::style('css/style.css')!!}

   

</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <h1 class="logo-name">MiE</h1>
        <h3 class="font-bold">Registro Correcto</h3>

        <div class="error-desc">
            Gracias por registrarse en nuestra plataforma puedes iniciar sesión aquí
            <form class="form-inline m-t" role="form" action="login">
                
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    {!!Html::script('js/jquery-3.1.1.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
</body>

</html>
