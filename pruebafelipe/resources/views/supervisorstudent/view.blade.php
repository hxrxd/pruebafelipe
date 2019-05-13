@extends('admintemplate')

@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Aviso</strong> {{Session::get('message')}}
</div>
@endif

<div class="row wrapper border-bottom white-bg page-heading">
    

  <div class="row">
        <div class="col-lg-12">
            <div class="animated fadeInUp">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Finiquito</span>
                   <br/><h3>Requerimiento para generación de finiquito</h3></h2>

                    <p>
                      Los estudiantes tienen la obligación de subir sus proyectos   , evaluar al supervisor y a la sede para poder obtener su finiquito

                    </p>
                    <p>
                       {{--  @if($project != null && $appraisals != null && $partnerRating != null) --}}
                            {!! link_to_route('settlement.download','Descargar', $parameters = $studentinfo->id_student, $attributes = ['class'=>'btn btn-danger btn-lg']); !!}
                       {{--  @endif --}}
                    </p>
                </div>
            </div>
        </div>
</div>

</div>
    <div class="row">

    @if($project == null)   
    <div class="col-lg-4">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-times fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                                Proyecto Mono
                            </h3>
                            <small>En espera</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-4">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-check fa-4x"></i>
                            <h1 class="m-xs">Listo</h1>
                            <h3 class="font-bold no-margins">
                                Proyecto Mono
                            </h3>
                            <small>Ingresado</small>
                        </div>
                    </div>
     </div>
    
    @endif

    @if($appraisals == null)   
    <div class="col-lg-4">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-times fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                                Evaluación del Supervisor
                            </h3>
                            <small>En espera</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-4">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-check fa-4x"></i>
                            <h1 class="m-xs">Listo</h1>
                            <h3 class="font-bold no-margins">
                                Evaluación del Supervisor
                            </h3>
                            <small>Ingresado</small>
                        </div>
                    </div>
     </div>
    
    @endif

    @if($partnerRating == null)   
    <div class="col-lg-4">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-times fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                               Evaluación de la Sede
                            </h3>
                            <small>En espera</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-4">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-check fa-4x"></i>
                            <h1 class="m-xs">Listo</h1>
                            <h3 class="font-bold no-margins">
                               Evaluación de la Sede
                            </h3>
                            <small>Ingresado</small>
                        </div>
                    </div>
     </div>
    
    @endif


    
</div>
    
@endsection

@section('script')

<script>
  $(window).on('load',function(){
      $('#myModal').modal('show');
  });
  document.getElementById("introduction").setCustomValidity("Debes llenar este campo");
  document.getElementById("objective").setCustomValidity("Debes llenar este campo");
</script>

@endsection