@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Pagos y Recibos <small>Solo Pagos y Recibos del contrato seleccionado del contrato {{$contract->no}}-{{$contract->year}} que comprede las fechas de {!! date("d-m-Y",strtotime($student->initd)); !!} al {!! date("d-m-Y",strtotime($student->endd));  !!}</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model($receipts,['route'=>['payments.update',$receipts->id_receipts],'method'=>'PUT','class'=>'form-horizontal']) !!}
                                
                                {!! Form::hidden('student', $contract->student);!!}
                                {!! Form::hidden('contract', $contract->id_contracts);!!}

                               

                                <div class="form-group"><label class="col-sm-2 control-label">Número</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('no',null,['class'=>'form-control','id'=>'no','placeholder'=>'Ingrese el número de pagos a efectuar','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Pagos</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('payments',null,['class'=>'form-control','id'=>'payments','placeholder'=>'Ingrese el número de pagos a efectuar','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Monto</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('grant',null,['class'=>'form-control','id'=>'grant','placeholder'=>'Ingrese el monto en queztalez a pagar','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha de Inicio</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('initd', $receipts->initd,['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Primer día del pago</span>
                                    
                                    </div>
                                    
                                </div>

                                 

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha Final</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('endd', $receipts->endd,['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Ultimo día del pago</span>
                                    
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


<script src="../js/plugins/chosen/chosen.jquery.js"></script>

<script>
      $('.chosen-select').chosen({width: "100%"});
</script>

@endsection

