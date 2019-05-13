@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Sedes <small></h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::model($headquarter,['route'=>['headquarters.update',$headquarter->id_headquarters],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el Nombre de la sede'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Encargado</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nameincharge',null,['class'=>'form-control','id'=>'nameincharge','placeholder'=>'Ingrese el Nombre del encargado de la sede'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Cargo</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('charge',null,['class'=>'form-control','id'=>'charge','placeholder'=>'Ingrese el Nombre del encargado de la sede'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Telefono</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('phone',null,['class'=>'form-control','id'=>'phone','placeholder'=>'Ingrese el teléfono de la sede'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Equipo</label>

                                    <div class="col-sm-10">

                                    
                                   {!!Form::select('team',$team,$headquarter->team,['id'=>'id_team','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2'])!!}


                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Estado</label>

                                    <div class="col-sm-10">

                                    
                                   {!!Form::checkbox('status', null,$headquarter->status, ['id'=>'status','class'=>'js-switch'])!!}


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

<script src="../../js/plugins/chosen/chosen.jquery.js"></script>
<script src="../../js/plugins/switchery/switchery.js"></script>

<script>
      $('.chosen-select').chosen({width: "100%"});
      var elem = document.querySelector('.js-switch');
      var switchery = new Switchery(elem, { color: '#2ebeef' });
</script>

@endsection