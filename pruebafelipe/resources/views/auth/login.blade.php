<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MiE | Inicio</title>

    {!! Html::style('css/bootstrap.min.css')!!}
    {!! Html::style('font-awesome/css/font-awesome.css')!!}

    {!! Html::style('css/animate.css')!!}
    {!! Html::style('css/style.css')!!}

    <style type="text/css">
        body {
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #444;
            background: url(img/login.png);
            background-size: cover;
            padding: 0;
            margin: 0;
            font-size: 13px;
            color: #676a6c;
            overflow-x: hidden;
            }
        p{
            color: #fff;
        }

         h3{
            color: #fff;
        }

        a{
            color: #fff;
            font-size: 15px;
        }



    </style>

    <!-- Facebook Open Graph -->
      <meta property="og:type" content="website"/>
      <meta property="og:title" content="MiE 2.0"/>
      <meta property="og:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta property="og:image" content="{{asset('img/card-2.png')}}"/>

    <!-- Twitter Cards -->
      <meta name="twitter:card" content="summary_large_image"/>
      <meta name="twitter:title" content="MiE 2.0"/>
      <meta name="twitter:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta name="twitter:image" content="{{asset('img/card-2.png')}}">
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">MiE</h1>

            </div>
            <h3 >Bienvenido a MiE 2.0</h3>
            <p>Software para el manejo y gestión de la información del programa EPSUM
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->

            </p>
            <p>Inicia Sesión para continuar.</p>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Los datos no coinciden

                        </div>
                    @endif
            <form class="m-t" role="form" action="login" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="Correo" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <button type="submit" class="btn btn-success block full-width m-b">Iniciar</button>

                <a href="password/email"><small>Olvide mi Contraseña</small></a>
                <p class="text-center"><small>No tengo una cuenta</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register">Crea Una Cuenta</a>
            </form>
            <p class="m-t"> <small>MiEPS desarrollado por Kevin y Carlos  &copy; <?php echo date("Y");  ?>
                            </small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->

    {!!Html::script('js/jquery-3.1.1.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}


</body>

</html>
