@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Nueva correspondencia recibida por:</span>
                   <br/><h3>{{Auth::user()->fname}} {{Auth::user()->lname}}</h3></h2>

                    <p> 
                    A continuación coloque lo correspondiente de la correspondecia recibida
                    </p>



                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Correspondencia recibida </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'inbox.store','class'=>'form-horizontal','method'=>'POST','id'=>'form']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha:</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('datein', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'','id'=>'sender']); !!}
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Procedencia:</label>

                                     <div class="col-sm-10">
                                      
                                    {!!Form::text('sender',null,['class'=>'form-control','id'=>'sender','placeholder'=>'Nombre o entidad que lo envía','required'=>''])!!}
                                </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Documento:</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::text('message',null,['class'=>'form-control','id'=>'message','placeholder'=>'Nombre del documento','required'=>''])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Destinatario:</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('receiver',$users,null,['id'=>'receiver','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Asunto:</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::textArea('subject',null,['class'=>'form-control','id'=>'subject','placeholder'=>'Descripción del asunto principal de la correspondencia','required'=>'','style'=>'height: 6em;'])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Descripción:</label>

                                    <div class="col-sm-10">
                                    
                                         {!!Form::textArea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Descripción opcional para la correspondecia, puede hacer referencia al tipo de correspondecia a enviar','style'=>'height: 6em;'])!!}
                                       
                                    
                                    </div>
                                    
                                </div>

                                <div class="hr-line-dashed"></div>
                                
                                <div>
                                    {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary pull-right']) !!}
                                </div>
                                
                                <div class="form-group"></div>
                                
                             
                       
                               
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
                    
                   
                     message:{
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
