@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Editar correspondencia</span>
                   <br/><h3>{{Auth::user()->fname}} {{Auth::user()->lname}}</h3></h2>

                    <p> 
                    A continuación coloque a Quién se dirige la correspondencia y el Asunto de la misma, si es necesario coloque una descripción
                    </p>



                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Nueva correspondencia de: </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::model($correlative,['route'=>['correlatives.update',$correlative->id],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Dirigida a:</label>

                                     <div class="col-sm-10">
                                      
                                    {!!Form::text('to',null,['class'=>'form-control','id'=>'to','placeholder'=>'Nombre o entidad destinataria','required'=>''])!!}
                                </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Asunto</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::text('subject',null,['class'=>'form-control','id'=>'subject','placeholder'=>'Asunto referido en la correspondencia','required'=>''])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::text('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Descripción opcional para la correspondecia, puede hacer referencia al tipo de correspondecia a enviar'])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                <div class="hr-line-dashed"></div>
                                
                                <div>
                                    {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary pull-right']) !!}
                                </div>
                                
                                <div class="form-group"></div>
                                
                             
                       
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>




@endsection

@section('script')


<script src="js/plugins/validate/jquery.validate.min.js"></script>
<script src="js/plugins/validate/msg.js"></script>

 <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                    
                   
                     to:{
                         required: true
                        
                     },
                     subject:{
                         required: true
                        
                     },
                    
                 }
             });
        });
    </script>

@endsection
@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Nueva correspondencia para enviar</span>
                   <br/><h3>{{Auth::user()->fname}} {{Auth::user()->lname}}</h3></h2>

                    <p> 
                    A continuación coloque a Quién se dirige la correspondencia y el Asunto de la misma, si es necesario coloque una descripción
                    </p>



                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Nueva correspondencia </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'correlatives.store','class'=>'form-horizontal','method'=>'POST','id'=>'form']) !!}


                                {!! Form::hidden('email', Auth::user()->email);!!}

                                <div class="form-group"><label class="col-sm-2 control-label">Dirigida a:</label>

                                     <div class="col-sm-10">
                                      
                                    {!!Form::text('to',null,['class'=>'form-control','id'=>'to','placeholder'=>'Nombre o entidad destinataria','required'=>''])!!}
                                </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Asunto</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::text('subject',null,['class'=>'form-control','id'=>'subject','placeholder'=>'Asunto referido en la correspondencia','required'=>''])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::text('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Descripción opcional para la correspondecia, puede hacer referencia al tipo de correspondecia a enviar'])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                <div class="hr-line-dashed"></div>
                                
                                <div>
                                    {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary pull-right']) !!}
                                </div>
                                
                                <div class="form-group"></div>
                                
                             
                       
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>




@endsection

@section('script')


<script src="js/plugins/validate/jquery.validate.min.js"></script>
<script src="js/plugins/validate/msg.js"></script>

 <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                    
                   
                     to:{
                         required: true
                        
                     },
                     subject:{
                         required: true
                        
                     },
                    
                 }
             });
        });
    </script>

@endsection
