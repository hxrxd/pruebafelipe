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

                    <h2><span class="text-navy">Registro para estudiantes EPSUM</span>
                   <br/><h3>Sólo registrate si ya tienes sede asignada</h3></h2>

                    <p>     
                      Por medio de esta aplicación tus datos serán guardados y utilizados para tu expediente de EPS multidisciplinario
                    </p>
                    

                    <form action="{{ url('/studentws')}}" method="GET">
                        <div class="input-group">
                            <input name="carne" type="text" class="form-control" placeholder="Ingresa tu carne"> 
                            <span class="input-group-btn"> 
                            <button type="submit" class="btn btn-primary">Registrar</button> </span>
                        </div>

                    </form>
                      
                       
                </div>


            </div>
        </div>
</div>

@endsection

