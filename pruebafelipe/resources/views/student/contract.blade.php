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

                    <h2><span class="text-navy">Generación de Contrato</span>
                   <br/><h3>Sólo genera esta contrato si ya te inscribiste</h3></h2>

                    <p>     
                      Sigue las instrucciones para generar tu contrato correcto
                    </p>

                    <div class="ibox-content">
                    <ul style="list-style-type:none">
                      <li>Tu EPS comienza en día 1 <a href="{{ url('contrato1')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>
                      <li>Tu EPS comienza en día 15 <a href="{{ url('contrato15')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>
                      <li>Tu EPS comienza en día 1 y sigue hasta el próximo año <a href="{{ url('contrato1')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>
                      <li>Tu EPS comienza en día 15 y sigue hasta el próximo año <a href="{{ url('contrato1531')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>

                      <li>15 días de enero<a href="{{ url('contrato15e')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>

                      <li>31 días de enero<a href="{{ url('contrato31e')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>

                      <li>1 de enero al 15 de mes<a href="{{ url('contrato115')}}" class="btn btn-success btn-xs" role="button"><i class="fa fa-plus"></i> Contrato</a></li>
                      
                    </div>
                    

                    
                      
                       
                </div>


            </div>
        </div>
</div>

@endsection
