@extends('admintemplate')




@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Realizado</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Sede evaluada correctamente</span>
                   

                </div>


            </div>
        </div>
</div>

<div class="row">
    <div class="col-lg-4">
        
    </div>

     <div class="col-md-4">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title" >
                            <h1 style="text-align:center;">
                                <i class="fa fa-check modal-icon te"></i>
                            </h1>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img alt="image" class="img-responsive" src="img/rawpixel2.jpg">
                            </div>
                            <div class="ibox-content profile-content text-center">
                                <h4><strong>Almacenamiento exitoso</strong></h4>
                               
                                <h5>
                                    ¡Gracias por ir con EPSUM!
                                </h5>
                                <p>
                                    Te agradecemos el desempeño a lo largo de tu EPS, PPS, EDC o PBP por que mejoraste con tu trabajo comunidades necesitadas en nuestro país, tratamos de hacer todo lo posible para que tu experiencia dentro del Programa sea amena. Disculpanos por los errores haremos lo posible para mejorar
                                </p>
                                
                               
                            </div>
                    </div>
                </div>
                    </div>

    <div class="col-lg-4">
        
    </div>


</div>



@endsection

@section('script')
    

    
        
@endsection