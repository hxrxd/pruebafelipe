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
                <div class="ibox-content  p-md">

                    <h2><span class="text-navy">Tramite de Pago</span>
                   <br/><h3>Estado del proceso de primer pago de ayuda becaria</h3></h2>

                    <p>
                      El primer pago de ayuda becaria tiene un proceso extenso para validar la información de los estudiantes que realizan el EPS, este proceso pasa por diversas etapas las cuales se te muestran a continuación, las etapas en color azul ya fueron culminadas y las etapas en gris estan por concretarse
                    </p>
                </div>
            </div>
        </div>
</div>






    @if($statusinfo->pay == "0001-01-01")   

    <div class="row">
    @if($statusinfo->stationery == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-folder-open fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                                Papelería Revisada
                            </h3>
                            <small>papelería revisada por gestores</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-folder-open fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->stationery)) }}</h1>
                            <h3 class="font-bold no-margins">
                                Papelería Revisada
                            </h3>
                            <small>papelería revisada por gestores</small>
                        </div>
                    </div>
     </div>
    
    @endif

    @if($statusinfo->contract == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-file-text fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                                Contrato
                            </h3>
                            <small>contrato firmado por Rector</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-file-text fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->contract)) }}</h1>
                            <h3 class="font-bold no-margins">
                                Contrato
                            </h3>
                            <small>contrato firmado por Rector</small>
                        </div>
                    </div>
     </div>
    @endif

     @if($statusinfo->budget == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                               Gestión del Pago
                            </h3>
                            <small>Presupuesto adjudicado</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->budget)) }}</h1>
                            <h3 class="font-bold no-margins">
                               Gestión del Pago
                            </h3>
                            <small>Presupuesto adjudicado</small>
                        </div>
                    </div>
     </div>
    @endif

    @if($statusinfo->toaim1 == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa fa-low-vision fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                               Revision de gestión
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa fa-low-vision fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->toaim1)) }}</h1>
                            <h3 class="font-bold no-margins">
                               Revision de gestión
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
     </div>
    @endif

     @if($statusinfo->toaim2 == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-eye fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                               Revision de pago
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-eye fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->toaim2)) }}</h1>
                            <h3 class="font-bold no-margins">
                               Revision de pago
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
     </div>
    @endif

     @if($statusinfo->conta == "0001-01-01")   
    <div class="col-lg-2">
                    <div class="widget  p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                            <h1 class="m-xs">...</h1>
                            <h3 class="font-bold no-margins">
                               Trámite en Contabilidad
                            </h3>
                            <small>verificación para cheque</small>
                        </div>
                    </div>
    </div>
    @else
    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                            <h1 class="m-xs">{{ date("d/m/Y",strtotime($statusinfo->conta)) }}</h1>
                            <h3 class="font-bold no-margins">
                              Trámite en Contabilidad
                            </h3>
                            <small>verificación para cheque</small>
                        </div>
                    </div>
     </div>
    @endif

    </div>

    @else

    <div class="row">

    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-folder-open fa-4x"></i>
                            <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                                Papelería Revisada
                            </h3>
                            <small>papelería revisada por gestores</small>
                        </div>
                    </div>
     </div>

    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-file-text fa-4x"></i>
                            <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                                Contrato
                            </h3>
                            <small>contrato firmado por Rector</small>
                        </div>
                    </div>
     </div>

    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                           <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                               Gestión del Pago
                            </h3>
                            <small>Presupuesto adjudicado</small>
                        </div>
                    </div>
     </div>

    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa fa-low-vision fa-4x"></i>
                           <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                               Revision de gestión
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
     </div>

    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-eye fa-4x"></i>
                           <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                               Revision de pago
                            </h3>
                            <small>Revisión de auditoría</small>
                        </div>
                    </div>
     </div>


    <div class="col-lg-2">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-edit fa-4x"></i>
                           <h1>Listo</h1>
                            <h3 class="font-bold no-margins">
                              Trámite en Contabilidad
                            </h3>
                            <small>verificación para cheque</small>
                        </div>
                    </div>
     </div>

    </div>

        @if($check->datepay == "0001-01-01") 
        <div class="col-lg-12">
                    <div class="widget style1 lazur-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h2 class="font-bold">Ultimo cheque disponible desde: {{ date("d/m/Y",strtotime($check->datein)) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
         @else
          <div class="col-lg-12">
                    <div class="widget  p-lg text-center">
                        <div class="row vertical-align">
                            <div class="col-xs-3">
                                
                            </div>
                            <div class="col-xs-9 text-right">
                                <h2 class="font-bold">Cheque recibido el: {{ date("d/m/Y",strtotime($check->datepay)) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
         @endif
    @endif
</div>
</div>



 @if($statusinfo->notice != "")   
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-warning modal-icon"></i>
        <h4 class="modal-title">Papelería faltante</h4>
        <h5>No podemos iniciar el trpamite</h5>
      </div>
      <div class="modal-body">
        
        <p>Tu trámite de ayuda becaria esta pausado debiado a que no haz entregado los documentos siguientes: <strong>{{$statusinfo->notice}}</strong>. Estos documentos son vitales para provisionar tu pago</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endif

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