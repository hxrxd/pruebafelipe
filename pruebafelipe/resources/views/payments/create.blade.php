@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>
                                Crear Pagos y Recibos <small>Solo Pagos y Recibos de la gestion seleccionada no. {{$engagement->no}}-{{$engagement->year}} que comprede las fechas de {!! date("d-m-Y",strtotime($engagement->initd)); !!} al {!! date("d-m-Y",strtotime($engagement->endd));  !!}
                            </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'payments.store','class'=>'form-horizontal','method'=>'POST']) !!}
                                
                                {!! Form::hidden('student', $engagement->student);!!}
                                {!! Form::hidden('engagement', $engagement->id_engagement);!!}
                                {!! Form::hidden('contract', $engagement->contract);!!}

                               

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
                                                                           
                                        {!! Form::date('initd', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Primer día del pago</span>
                                    
                                    </div>
                                    
                                </div>

                                 

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha Final</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('endd', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
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

