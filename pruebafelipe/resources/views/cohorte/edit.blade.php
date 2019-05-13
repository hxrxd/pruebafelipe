@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Cohorte <small></h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                             {!! Form::model($cohorte,['route'=>['cohortes.update',$cohorte->id],'method'=>'PUT','class'=>'form-horizontal']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Identificador de Cohorte</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('cohorte',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el Nombre de la sede','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                                    <div class="col-sm-10">
                                        {!!Form::checkbox('status', null, $cohorte->status, ['id'=>'status','class'=>'js-switch'])!!}
                                    </div>
                                </div>

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                       
                                </div>


                                
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>




@endsection


@section('script')
<script src="../../js/plugins/switchery/switchery.js"></script>
<script>
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#2ebeef', size: 'small' });
     
</script>


@endsection