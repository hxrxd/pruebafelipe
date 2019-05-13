@extends('admintemplate')




@section('place')

@if(Session::has('message'))
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Generación de Ficha de Solicitud de beca</span>
                   <br/><h3>Sólo genera esta ficha si ya te inscribiste</h3></h2>

                    <p>     
                      Por medio de esta aplicación se genera tu ficha de solicitud de beca, debes de firmarla y entregarla a tu Supervisor EPSUM
                    </p>
                    

                     <a href="{{ url('genficha')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Generar</a>
                      
                       
                </div>


            </div>
        </div>
</div>

@endsection

