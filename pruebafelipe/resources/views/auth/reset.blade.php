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

                    <h2 class="font-bold">Restablecer mi Contraseña</h2>

                    <p>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Por favor corrige los siguientes errores:<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </p>

                    <div class="row">

                        <div class="col-lg-12">

                            <form class="m-t" role="form" action="{{url('password/reset')}}" method="POST"  >
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
                            {!! Form::hidden('token',$token,null) !!}

                             
                                
                                <div class="form-group">
                                    <input type="email" value="{{ old('email') }}" class="form-control" placeholder="Correo Electrónico" required="" name="email">
                                </div>

                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Confirme Contraseña" required="">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Restablecer Contraseña</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                MiEPS
            </div>
            <div class="col-md-6 text-right">
               <small><?php echo date('Y'); ?></small>
            </div>
        </div>
    </div>

</body>

</html>
