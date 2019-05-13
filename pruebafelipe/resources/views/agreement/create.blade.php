@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresar Acuerdos <small>Solo Ingresar acuerdos no agreagados</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'agreement.store','class'=>'form-horizontal','method'=>'POST','id'=>'form']) !!}
                                <div class="form-group"><label class="col-sm-2 control-label">Número de acuerdo</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('agreement_n',null,['class'=>'form-control','id'=>'agreement_n','placeholder'=>'Ingrese el Número de acuerdo','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Número de acuerdo escrito</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('agreement_w',null,['class'=>'form-control','id'=>'agreement_w','placeholder'=>'Ingrese el Número de acuerdo escrito','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha del Acuerdo</label>

                                    <div class="col-sm-10">
                                    
                                        {!! Form::date('date_n', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha del Acuerdo escrita</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('date_w',null,['class'=>'form-control','id'=>'date_w','placeholder'=>'Ingrese el Nombre del Supervisor','required'=>''])!!}
                                    
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

@section('script')


<script src="../js/plugins/validate/jquery.validate.min.js"></script>
<script src="../js/plugins/validate/msg.js"></script>

 <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                    
                     agreement_n: {
                         required: true
                         
                     },
                    
                 }
             });
        });
    </script>

@endsection

