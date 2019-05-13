@extends('admintemplate')
@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Registro de proceso para primer pago</span>
                   <br/><h3>Proceso de liquidación de cheques</h3></h2>

                    <p> 
                    Ingresar los números de carnet separados por comas, proceso al que fué enviada la papelería y la fecha de envío
                    </p>
                </div>


            </div>
        </div>  
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar estado del expediente <small>Colocar el número de carnet del estudiante separado por comas sin espacions ni cambios de párrafo</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model(null,['route'=>['updatemassivestatus'],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group "><label class="col-sm-2 control-label">Estudiantes</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::textarea('students', null ,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group "><label class="col-sm-2 control-label">Tipo de registro</label>

                                    <div class="col-sm-10">
                                                                           
                                       
                                        {!!Form::select('type', array('1' => 'Papelería Completa', '2' => 'Contrato con firma','3' => 'Presupuesto','4' => 'Revisión 1','5' => 'Revisión 2','6' => 'Contabilidad','7' => 'Pagado'),1,['class'=>'form-control m-b','required'=>'']); !!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha registrar</label>

                                    <div class="col-sm-10">
                                                                  
                                       {!! Form::date('date', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        
                                    
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