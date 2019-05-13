@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresar Cohorte <small>Ingresar Cohortes de la forma siguiente No. de cohorte una letra c el año y un numero correlativo por si entra más de un gurpo a la cohorte, todo esto relacionado con el acuerdo a generar</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'cohortes.store','class'=>'form-horizontal','method'=>'POST']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Identificador de Cohorte</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('cohorte',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el Nombre de la sede','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                       
                                </div>


                                
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>




@endsection


@section('script')




@endsection