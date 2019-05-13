@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Gracias por formar parte de nuestro Programa</span>
                   <br/><h3>Los datos en verde ya los validamos por tí, sólo cambialos si en realidad es necesario</h3></h2>

                    <p>     
                      Ingresa tus datos de forma correcta, datos reales y solo registrate si ya tienes sede asignada, si no está tu sede busca a tu supervisor, el la agregará por ti
                    </p>
                
                       
                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Estudiante Identificado<small> llena los datos que se te solicitan acontinuación segun el EPS que realizaras</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'student.store','class'=>'form-horizontal','method'=>'POST']) !!}
                                
                                <p>Datos Personales</p>

                                 <div class="form-group has-success"><label class="col-sm-2 control-label">DPI</label>


                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('dpi',$dpin,['class'=>'form-control','id'=>'dpi','required'=>''])!!}
                                        <span class="help-block m-b-none" style="color:red">Te agradecemos si nos dejas tu DPI con espacios, de la siguiente forma 1234 56789 0101</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group has-success"><label class="col-sm-2 control-label">DPI Escrito</label>

                                    <div class="col-sm-10">
                                                                           
                                        {!!Form::text('dpiw',$dpiw,['class'=>'form-control','id'=>'dpiw','placeholder'=>'Ingresar tu dirección escrita','required'=>''])!!}
                                        <span class="help-block m-b-none" style="color:red">Verifica la escritura de tu DPI el cero es importante. Ejemplo si tu dpi tien un 0101 y aparece ciento un corrijelo por cero ciento uno. Quita los espacios extres</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group has-success"><label class="col-sm-2 control-label">Nombres</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',$alumno->NOMBRE1." ".$alumno->NOMBRE2." ".$alumno->NOMBRE3,['class'=>'form-control','id'=>'name','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group has-success"><label class="col-sm-2 control-label">Primer Apellido</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('fsurname',$alumno->APELLIDO1,['class'=>'form-control','id'=>'fsurname','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group has-success"><label class="col-sm-2 control-label">Segundo Apellido</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('ssurname',$alumno->APELLIDO2,['class'=>'form-control','id'=>'ssurname','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>
                                  <div class="form-group has-success"><label class="col-sm-2 control-label">Nacionalidad</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nationality',$alumno->NOM_NAC,['class'=>'form-control','id'=>'nationality','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Fecha de nacimiento</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('birthdate', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none" style="color:red">Recuerda colocar tu fecha de nacimiento</span>
                                    </div>
                                    
                                </div>

                                
                               

                                <div class="form-group"><label class="col-sm-2 control-label">Sexo</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('gender',$genders,null,['id'=>'gender','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Estado Civil</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('cstatus',$civilstatus,null,['id'=>'cstatus','class'=>'form-control m-b'])!!}
                                        <span class="help-block m-b-none" style="color:red">Selecciona tu sexo</span>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>
                                 <p>Datos Universitarios</p>

                                 <div class="form-group has-success"><label class="col-sm-2 control-label">Carnet</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('carne',$alumno->CARNET,['class'=>'form-control','id'=>'carne','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Carrera</label>

                                    <div class="col-sm-10">

                                        <select name="carrer" id="carrer" class="form-control">
                                            @foreach($alumno->DETALLE_ACADEMICO as $detail)
                                              <option value="{{ $detail->NOMBRE_CARRERA }}">{{ $detail->NOMBRE_CARRERA }}</option>

                                                
                                            @endforeach
                                        </select>
                                    
                                    
                                    </div>
                                    
                                </div>


                                <div class="form-group"><label class="col-sm-2 control-label">Unidad Académica</label>

                                    <div class="col-sm-10">

                                        <select name="academicu" id="academicu" class="form-control">
                                            @foreach($alumno->DETALLE_ACADEMICO as $detail)
                                              <option value="{{ $detail->NOMBRE_UNIDAD }}">{{ $detail->NOMBRE_UNIDAD }}</option>
                                                
                                            @endforeach
                                        </select>
                                    
                                    
                                    </div>
                                    
                                </div>

                                <div class="hr-line-dashed"></div>
                                <p>Datos de Referencia</p>

                                <div class="form-group has-success"><label class="col-sm-2 control-label">Correo Electrónico</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('email',Auth::user()->email,['class'=>'form-control','id'=>'email','type'=>'text','placeholder'=>'Ingresar tu correo electrónico','disabled'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono Personal</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('personalp',null,['class'=>'form-control','id'=>'personalp','placeholder'=>'Ingresar tu teléfono celular','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Teléfono Domiciliar</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('homep',null,['class'=>'form-control','id'=>'homep','placeholder'=>'Ingresar tu teléfono fijo','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>
                                 <div class="hr-line-dashed"></div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Dirección Actual</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('adressr',null,['class'=>'form-control','id'=>'adressr','placeholder'=>'Ingresar tu dirección','required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Dirección Actual Escrita</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('adressrw',null,['class'=>'form-control','id'=>'adressrw','placeholder'=>'Ingresar tu dirección escrita','required'=>''])!!}
                                        <span class="help-block m-b-none" style="color:red">Debes de escribir tu dirección. Ejemplo 7.a calle y 2 avenida 11-30 zona 2 en este espacio escribe: séptima calle, segunda avenida, once guion treinta, zona dos. LAS COMAS SON IMPORTANTES</span>
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                                    <div class="col-sm-10">
                                        {!!Form::select('departamenta',$departaments,null,['id'=>'departamenta','class'=>'form-control m-b'])!!} 
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('municipalityr',$municipality,null,['id'=>'municipalityr','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Departamento de Naciemiento</label>

                                    <div class="col-sm-10">
                                        {!!Form::select('departamentb',$departaments,null,['id'=>'departamentb','class'=>'form-control m-b'])!!} 
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Municipio de Nacimiento</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('municipalityb',$municipality,null,['id'=>'municipalityb','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                               <div class="hr-line-dashed"></div>
                               <p>Datos del EPS</p>

                               <div class="form-group"><label class="col-sm-2 control-label">Tipo de Práctica</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('practice',$practices,null,['id'=>'practice','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Sede</label>
                                        <div class="col-sm-10">
                                            {!!Form::select('headquarter',$headquarters,null,['id'=>'headquarter','class'=>'form-control m-b','required'=>''])!!}
                                        </div>
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Fecha de Inicio</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('initd', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none" style="color:red">Tu fecha de inicio corresponde a la carta de asignación, puede ser 1 o 15 de febrero en la mayóría de los casos</span>
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha de Finalización</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('endd', \Carbon\Carbon::now(),['class'=>'form-control','required'=>'']); !!}
                                        <span class="help-block m-b-none" style="color:red">Es tu último día de EPS comúnmente es el 15 o el último día del mes</span>
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Cohorte</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('cohorte',$cohortes,null,['id'=>'cohorte','class'=>'form-control m-b'])!!}
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


<script src="js/plugins/chosen/chosen.jquery.js"></script>
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<script>
    function getHead(){
        var idcarrer = jQuery('#carrer').val();
        var idua = jQuery('#academicu').val();
        console.log(idcarrer+'---'+idua);
        $.get('{{url('information/request/ajax-state?value=')}}' + idcarrer+'-'+idua, function(data) {
            console.log(data);
            $('#headquarter').empty();
            $.each(data, function(index,subCatObj){
                $('#headquarter').append(''+subCatObj.sd+'');
                $("#headquarter").append('<option value="'+subCatObj.id+'-'+subCatObj.it+'"> '+subCatObj.sd+' </option>');
            });
        });
    }
    
    $(document).ready(function(){
        getHead();
        jQuery('#carrer').change(getHead);
       
    });
</script>

<script>
    
       $('#departamenta').on('change', function(e){
        console.log(e.target.value);
        var id_departament = e.target.value;
        
        $.get('{{url('information/create/ajax-state?id_departament=')}}' + id_departament, function(data) {
            console.log(data);
            $('#municipalityr').empty();
            $.each(data, function(index,subCatObj){
                $('#municipalityr').append(''+subCatObj.municipality+'');
                $("#municipalityr").append('<option value='+subCatObj.id_municipality+'> '+subCatObj.municipality+' </option>');
            });
        });
    });
    
</script>

<script>
       $('#departamentb').on('change', function(e){
        console.log(e.target.value);
        var id_departament = e.target.value;
        
        $.get('{{url('information/create/ajax-state?id_departament=')}}' + id_departament, function(data) {
            console.log(data);
            $('#municipalityb').empty();
            $.each(data, function(index,subCatObj){
                $('#municipalityb').append(''+subCatObj.municipality+'');
                $("#municipalityb").append('<option value='+subCatObj.id_municipality+'> '+subCatObj.municipality+' </option>');
            });
        });
    });

  

</script>

<script>
      $('.chosen-select').chosen({width: "100%"});
</script>

@endsection