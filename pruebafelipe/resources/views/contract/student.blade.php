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

                    <h2><span class="text-navy">Registro de contratos</span>
                   <br/><h3>Sólo registrar un contrato por estudiante cada año, si ya se registro por favor editarlo y descargarlo desde el menú</h3></h2>

                    <p>     
                      Por medio de esta aplicación se genera un correlativo de contratos con la infirmación de cada estudiante.
                    </p>
                    

                    <form action="{{ url('/createcontract')}}" method="GET">
                        <div class="input-group">

                            <div class="form-group">

                                    {!!Form::select('student',$students,null,['id'=>'student','class'=>'chosen-select','tablaindex'=>'2'])!!}
   
                            </div>
                            
                            <span class="input-group-btn"> 

                            <button type="submit" class="btn btn-primary">Registrar</button> 

                            </span>

                    </div>

                    </form>
                      
                       
                </div>


            </div>
        </div>
</div>

@endsection

@section('script')


<script src="js/plugins/chosen/chosen.jquery.js"></script>


<script>
      $('.chosen-select').chosen({width: "100%"});
</script>

@endsection
