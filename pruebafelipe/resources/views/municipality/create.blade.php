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
                        <div class="ibox-title">
                            <h5>Ingresar Municipio <small>Solo Ingresar Municipios no agreagados</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                           {!! Form::open(['route'=>'municipality.store','class'=>'form-horizontal','method'=>'POST']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                                    <div class="col-sm-10">

                                    {!!Form::select('departament',$departaments,null,['id'=>'departament','class'=>'form-control m-b'])!!}

                                    </div>
                                    
                                </div>
                                

                                <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>

                                    <div class="col-sm-10">
                                        {!!Form::text('municipality',null,['class'=>'form-control','id'=>'municipality','placeholder'=>'Ingrese el nuevo municipio','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>
                               
                                <div class="box-footer">

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                       
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>




@endsection

@section('content')


@endsection