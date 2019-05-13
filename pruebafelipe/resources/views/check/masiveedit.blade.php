@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Registro de entraga o liquidación de cheques</span>
                   <br/><h3>Proceso de liquidación de cheques</h3></h2>

                    <p> 
                    Ingresar los números de cheques separados por comas y sin espacios, la fecha a modificar y que campo desea actualizar
                    </p>


                   


                </div>


            </div>
        </div>  
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Cheques <small>Colocar el número de cheques separados por comas</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model(null,['route'=>['updatemassiveedit'],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group "><label class="col-sm-2 control-label">Cheques</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::textarea('checks', null ,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha registrar</label>

                                    <div class="col-sm-10">
                                                                  
                                       {!! Form::date('date', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Tipo de registro</label>

                                    <div class="col-sm-10">
                                                                           
                                       
                                        {!!Form::select('type', array('1' => 'Entregados', '2' => 'Liquidados'),1,['class'=>'form-control m-b','required'=>'']); !!}
                                    
                                    </div>
                                    
                                </div>

                                 

                               

                                
                                
                                <div class="box-footer">

                                <div class="form-group "><label class="col-sm-2 control-label"></label>

                                    <div class="col-sm-10">
                                                                           
                                       
                                        {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                                    
                                    </div>
                                    
                                </div>



                               
                       
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>




@endsection

@section('script')


<script src="js/plugins/validate/jquery.validate.min.js"></script>
<script src="js/plugins/validate/msg.js"></script>



@endsection