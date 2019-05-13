<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MiE | Olvide mi password</title>

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{url('css/animate.css')}}" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Olvide mi Contraseña</h2>

                    <p>
                       Ingrese su Email para restablecer su contraseña
                       @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Error!</strong> El correo que ingresaste no se encuentra registrado.<br><br>
                            <ul>
                                
                            </ul>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-success">
                            <strong>Recuperación enviada</strong> El correo fue enviado exitosamente<br><br>
                        </div>
                    @endif
                    </p>

                    <div class="row">

                        <div class="col-lg-12">

                            <form class="m-t" role="form" action="{{url('password/email')}}" method="POST"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <input type="email" value="{{ old('email') }}" class="form-control" placeholder="Correo Electrónico" required="" name="email">
                                </div>


                                <button type="submit" class="btn btn-primary block full-width m-b">Enviar Email</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                MiE
            </div>
            <div class="col-md-6 text-right">
               <small><?php echo date('Y'); ?></small>
            </div>
        </div>
    </div>

</body>

</html>
