@extends('admintemplate')

@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Generación de Contratos</span> </h2>
           
                    <p>     
                      Sigue las instrucciones para generar el formulario correcto, Las fechas asignadas son {!! date("d-m-Y",strtotime($contract->initd)); !!} {!! date("d-m-Y",strtotime($contract->endd));  !!} período por: {!! date("d-m-Y",strtotime($student->initd)); !!} {!! date("d-m-Y",strtotime($student->endd));  !!}
                    </p>

                    <div class="ibox-content">
                    
                      <h3>Contratos</h3>
                      <li style="list-style:none">1 de mes a fin de mes {!! link_to_route('gcontrato1.download','Descargar', $parameters = $contract->id_contracts, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}</li>

                       <li style="list-style:none">15 de mes a 15 de mes {!! link_to_route('gcontrato15.download','Descargar', $parameters = $contract->id_contracts, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}</li>

                       <li style="list-style:none">15 de mes a fin de mes {!! link_to_route('gcontrato1530.download','Descargar', $parameters = $contract->id_contracts, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}</li>

                                          
                      
                    </div>

                     <div class="ibox-content">
                    
                    
                    

                    
                      
                       
                </div>


            </div>
        </div>
</div>
</div>

@endsection
