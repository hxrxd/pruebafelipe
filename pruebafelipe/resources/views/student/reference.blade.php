@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Ingresa tus datos de Referencia</span>
                   <br/><h3>Necesitamos algunos datos de referencia</h3></h2>

                     <p class="help-block m-b-none" style="color:red">Si no tienes la información de Supervisor de Unidad Académica y Encargado de la sede coloca un punto "." y luego podrás editarla. <br> En la sección Estudiantes > Editar Referencias</p>                
                       
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
                            
                            {!! Form::open(['route'=>'references.store','class'=>'form-horizontal','method'=>'POST']) !!}
                                
                                <p>Datos del Padre</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('namep',null,['class'=>'form-control','id'=>'namep','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phonep',null,['class'=>'form-control','id'=>'phonep','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <p>Datos de la Madre</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('namem',null,['class'=>'form-control','id'=>'namem','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phonem',null,['class'=>'form-control','id'=>'phonem','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <p>Datos Supervisor Unidad Académica</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nameu',null,['class'=>'form-control','id'=>'nameu','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phoneu',null,['class'=>'form-control','id'=>'phoneu','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Correo Electrónico</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('emailu',null,['class'=>'form-control','id'=>'emailu','required'=>'','type'=>'email'])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <p>Datos Encargado de la Sede</p>

                                 <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nameh',null,['class'=>'form-control','id'=>'nameh','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phoneh',null,['class'=>'form-control','id'=>'phoneh','required'=>''])!!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Correo Electrónico</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('emailh',null,['class'=>'form-control','id'=>'emailh','required'=>'','type'=>'email'])!!}
                                        
                                    
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