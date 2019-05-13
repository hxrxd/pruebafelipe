@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Datos de referencia</span>
                   <br/><h3>Madre</h3></h2>

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
                            
                           
                            {!! Form::model($madre,['route'=>['references.updatem',$madre->id_families],'method'=>'PUT','class'=>'form-horizontal']) !!}

                            {!! Form::hidden('relationship', "Madre");!!}
                                
                                <p>Datos de la Madre</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'namep','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phone',null,['class'=>'form-control','id'=>'phonep','required'=>''])!!}
                                        
                                    
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