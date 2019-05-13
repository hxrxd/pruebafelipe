@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Crear Instancia del Cheque <small>Solo Cheques del contrato seleccionado del pago {{$receipt->no}}-{{$receipt->year}} que comprede las fechas de {!! date("d-m-Y",strtotime($receipt->initd)); !!} al {!! date("d-m-Y",strtotime($receipt->endd));  !!} </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'check.store','class'=>'form-horizontal','method'=>'POST']) !!}
                                
                                {!! Form::hidden('student', $student->id_student);!!}
                                {!! Form::hidden('receipt', $receipt->id_receipts);!!}
                                {!! Form::hidden('grant', $receipt->grant);!!}
                                {!! Form::hidden('no', $receipt->no);!!}
                                {!! Form::hidden('year', $receipt->year);!!}

                               

                                 <div class="form-group"><label class="col-sm-2 control-label">Cheque</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nocheck',null,['class'=>'form-control','id'=>'grant','placeholder'=>'Ingrese numero de cheque','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha de Llegada</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('datein', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Llegada del cheque</span>
                                    
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

