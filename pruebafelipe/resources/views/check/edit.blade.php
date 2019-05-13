@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Edición de Cheque No. {{$check->nocheck}}</span>
                   <br/><h3>Proceso de Liquidación</h3></h2>

                    <p> 
                    Sólo modificar la fecha si ya se pago o liquidó el cheque
                    </p>


                   


                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Cheque <small>Colocar la fecha</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model($check,['route'=>['check.update',$check->id_check],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha de recepción</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('datein', $check->datein,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha de entrega</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('datepay', $check->datepay,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha de Liquidación</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('dateout', $check->dateout,['class'=>'form-control','required'=>'']); !!}
                                        
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Descripción </label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('desc',$check->desc,['class'=>'form-control','id'=>'grant','placeholder'=>'Ingrese numero de cheque','required'=>''])!!}
                                    
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


<script src="js/plugins/validate/jquery.validate.min.js"></script>
<script src="js/plugins/validate/msg.js"></script>



@endsection