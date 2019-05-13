@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Creación de Contrato</span>
                   <br/><h3>{{$student->name}} {{$student->fsurname}} {{ $financing->name}} {{$cohorte->cohorte}}</h3></h2>

                    <p> 
                    El contracto consta de tres periodos importantes, el primero que comprende de la fecha de inicio al final de mes. El segundo que son meses completos antes de terminar. y el último que comprende el periodo del último pago. La fehca máxima para colocar es el 31 de diciembre del mismo año. Estudiante asignado las fechas: {!! date("d-m-Y",strtotime($student->initd)); !!} {!! date("d-m-Y",strtotime($student->endd));  !!}
                    </p>



                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Crear Contrato <small>Estas creado el contrato de {{$student->carne}}</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'contract.store','class'=>'form-horizontal','method'=>'POST','id'=>'form']) !!}


                                {!! Form::hidden('student', $student->id_student);!!}

                                <div class="form-group"><label class="col-sm-2 control-label">Acuerdo</label>

                                    <div class="col-sm-10">
                                        {!!Form::select('agreement',$agreements,null,['id'=>'agreement','class'=>'form-control m-b'])!!} 
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Duración</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('length',null,['class'=>'form-control','id'=>'length','placeholder'=>'Ingrese la duración en meses del contrato','required'=>''])!!} <span>Escrita, por ejemplo seis meses y medio</span>
                                    
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
                                                                           
                                        {!! Form::date('initd', $student->initd,['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Puede ser la fecha de inicio del EPS o 31 de enero </span>
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group "><label class="col-sm-2 control-label">Fecha final del primer periodo</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('date2', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Es la fecha en que culmina el mes indicado anteriormente</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha inicial del segundo periodo</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('date3', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Es el día inmediato siguiente al anterior</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha final del segundo periodo</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('date4', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Es uno antes al día que comienza el periodo para el último pago</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha inicial del tercer periodo</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('date5', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Es el primer día del periodo comprendido del último pago</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group "><label class="col-sm-2 control-label">Fecha Final</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!! Form::date('endd', $student->endd,['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none">Es el ultimo día del EPS o 31 de diciembre</span>
                                    
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

