@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Edición de Estado</span>
                   <br/><h3>Proceso de Pago</h3></h2>

                    <p> 
                    Sólo modificar la fecha si ya se envió el expediente a la siguiente parte del proceso
                    </p>


                   


                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Estado <small>Colocar la fecha de envío</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model($status,['route'=>['statuses.update',$status->id],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group "><label class="col-sm-2 control-label">Papelería Completa</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('stationery', $status->stationery,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Contrato para Firmas</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('contract', $status->contract,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Presupuesto</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('budget', $status->budget,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Primera Revisión</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('toaim1', $status->toaim1,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Segunda Revisión</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('toaim2', $status->toaim2,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Contabilidad</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('conta', $status->conta,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Pagado</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('pay', $status->pay,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Alerta</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::text('notice', $status->notice,['class'=>'form-control']); !!}
                                        
                                    
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

 <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                    
                     
                     payments:{
                         required: true,
                         number:true
                     },
                     grant:{
                         required: true,
                         number:true
                     },
                    
                 }
             });
        });
    </script>

@endsection

