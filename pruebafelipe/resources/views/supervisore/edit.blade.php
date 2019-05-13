@extends('admintemplate')


@section('place')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Supervisores <small>Edición de parametros del supervisor</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::model($supervisor,['route'=>['supervisore.update',$supervisor->id_supervisors],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el Nombre del Supervisor'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono</label>

                                    <div class="col-sm-10">

                                        
                                        {!!Form::text('phone',null,['class'=>'form-control','id'=>'phone','placeholder'=>'Ingrese el Teléfono del Supervisor'])!!}

                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Región</label>

                                    <div class="col-sm-10">
                                        {!!Form::text('region',null,['class'=>'form-control','id'=>'region','placeholder'=>'Ingrese la Región del Supervisor'])!!}
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">

                                    
                                   {!!Form::select('iduser',$users,$supervisor->id_supervisors,['id'=>'iduser','class'=>'form-control m-b chosen-select','tablaindex'=>'2'])!!}


                                    </div>
                                    
                                </div>
                                 <div class="hr-line-dashed"></div>
                                <div class="box-footer">

                                {!! Form::Submit('Editar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                                
                               
                                </div>
                                
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('script')


<script src="../../js/plugins/chosen/chosen.jquery.js"></script>

<script>
      $('.chosen-select').chosen({width: "100%"});
</script>

@endsection