@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar unidades académicas <small></h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::model($data,['route'=>['requestsupervisor.update',$data->id],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Supervisor</label>

                                    <div class="col-sm-10">

                                        
                                        {!!Form::text('namesuper',null,['class'=>'form-control','id'=>'namesuper','disabled'=>'','placeholder'=>'Ingrese el Nombre del supervisor'])!!}

                                    </div>

                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('dp',null,['class'=>'form-control','id'=>'dp','disabled'=>'','placeholder'=>'Ingrese el Nombre del departamento'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Municipalidad</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('mun',null,['class'=>'form-control','id'=>'mun','disabled'=>'','placeholder'=>'Ingrese el Nombre de la municipalidad'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Equipo</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('equipo',null,['class'=>'form-control','id'=>'equipo','disabled'=>'','placeholder'=>'Ingrese el Nombre del equipo'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Sede</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('sede',null,['class'=>'form-control','id'=>'sede','disabled'=>'','placeholder'=>'Ingrese la sede'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Disciplina</label>

                                    <div class="col-sm-10">

                                    
                                    {!!Form::text('disciplina',null,['class'=>'form-control','id'=>'disciplina','disabled'=>'','placeholder'=>'Ingrese la sede'])!!}


                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Unidades Académicas</label>

                                    <div class="col-sm-10">
                                        <select class='js-example-basic-multiple' name='states[]' multiple='multiple' style='width:100%;' id='UA' required>
                                            @foreach($pla as $key => $value)
                                                <option value='{{$value}}' selected>{{$value}}</option>
                                            @endforeach
                                            @foreach($m as $key => $value)
                                                <option value='{{$value}}'>{{$value}}</option>
                                            @endforeach
                                        </select>

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
<link href="../../css/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="../../js/plugins/select2/select2.full.min.js"></script>
<script src="../../js/plugins/chosen/chosen.jquery.js"></script>
<script src="../../js/plugins/switchery/switchery.js"></script>

<script>
    $(document).ready(function(){
        jQuery('.js-example-basic-multiple').select2({placeholder: "Seleccione",allowClear: true});
    });
</script>
@endsection