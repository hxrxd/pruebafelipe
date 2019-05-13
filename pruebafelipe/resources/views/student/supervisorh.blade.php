@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Datos de referencia</span>
                   <br/><h3>Encargado en sede</h3></h2>

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
                            
                          
                            {!! Form::model($supervisorh,['route'=>['references.updatesh',$supervisorh->id_supervisors_h],'method'=>'PUT','class'=>'form-horizontal']) !!}
                                
                               
                                 <p>Datos Encargado de la Sede</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'nameh','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phone',null,['class'=>'form-control','id'=>'phoneh','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Correo Electrónico</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('email',null,['class'=>'form-control','id'=>'emailh','required'=>'','type'=>'email'])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Oficina o Departamento</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('place',null,['class'=>'form-control','id'=>'place','required'=>''])!!}
                                        
                                    
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