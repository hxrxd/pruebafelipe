@extends('admintemplate')

@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Correcto</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Generación de formularios</span>
                   <br/><h3>Contrato, AB-USAC-04 y AB-USAC-06</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede ver generar  pagos y recibos de {{$student->carne}} {{$student->name}} {{$student->fsurname}} {{$student->ssurname}}
                    </p>

                    <div class="ibox-content">
                      <h3>AB-USAC-04</h3>
                        <li style="list-style:none">Formulario {!! link_to_route('forms04.download','Descargar', $parameters = $receipts->id_receipts, $attributes = ['class'=>'btn btn-info btn-xs']); !!}</li>
                    </div>
                    

                  

                    <div class="ibox-content">
                      <h3>AB-USAC-06</h3>
                        <li style="list-style:none">Formulario {!! link_to_route('forms06.download','Descargar', $parameters = $receipts->id_receipts, $attributes = ['class'=>'btn btn-info btn-xs']); !!}</li>
                    </div>
                    

                    
                      
                       
                </div>


            </div>
        </div>
</div>

@endsection
