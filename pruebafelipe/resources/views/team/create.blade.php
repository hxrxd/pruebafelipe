@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresar Equipos <small>sólo ingresar equipos no agreagados</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'teams.store','class'=>'form-horizontal','method'=>'POST']) !!}
                                <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese un nombre de identificación para el equipo','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Supervisor</label>

                                    <div class="col-sm-10">
                                    {!!Form::select('supervisor',$supervisor,null,['id'=>'id_supervisors','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Financiamiento</label>

                                    <div class="col-sm-10">
                                    {!!Form::select('financing',$financing,null,['id'=>'id_financings','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                                    <div class="col-sm-10">
                                        {!!Form::select('departament',$departaments,null,['id'=>'departament','class'=>'form-control m-b'])!!} 
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('municipality',$municipality,null,['id'=>'municipality','class'=>'form-control m-b'])!!}
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
<script>
       $('#departament').on('change', function(e){
        console.log(e.target.value);
        var id_departament = e.target.value;
        
        $.get('{{url('information/create/ajax-state?id_departament=')}}' + id_departament, function(data) {
            console.log(data);
            $('#municipality').empty();
            $.each(data, function(index,subCatObj){
                $('#municipality').append(''+subCatObj.municipality+'');
                $("#municipality").append('<option value='+subCatObj.id_municipality+'}> '+subCatObj.municipality+' </option>');
            });
        });
    });
</script>
@endsection