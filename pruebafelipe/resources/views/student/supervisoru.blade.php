@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Datos de referencia</span>
                   <br/><h3>Supervisor unidad académica</h3></h2>

                    <p>     
                      Proporciona la información según se te pide
                    </p>
                
                       
                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Información de referencia<small> llena los siguientes datos</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                          
                            {!! Form::model($supervisoru,['route'=>['references.updatesu',$supervisoru->id_supervisors_u],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <p>Datos Supervisor Unidad Académica</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'nameu','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phone',null,['class'=>'form-control','id'=>'phoneu','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Correo Electrónico</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('email',null,['class'=>'form-control','id'=>'emailu','required'=>'','type'=>'email'])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                               
                                

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}

                                
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>




@endsection

@section('script')



@endsection