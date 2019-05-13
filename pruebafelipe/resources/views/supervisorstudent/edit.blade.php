@extends('admintemplate')


@section('place')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Estudiantes <small></h5>
                            <div class="ibox-tools">
                                {!! $student->email!!} {!! $student->carne !!} 
                            </div>
                        </div>
                        <div class="ibox-content">
                            {!! Form::model($student,['route'=>['supervisorstudent.update',$student->id_student],'method'=>'PUT','class'=>'form-horizontal']) !!}
                               

                                <div class="form-group"><label class="col-sm-2 control-label">Nombres</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Primer Apellido</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('fsurname',null,['class'=>'form-control','id'=>'fsurname','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Segundo Apellido</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('ssurname',null,['class'=>'form-control','id'=>'ssurname','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">DPI</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('dpi',null,['class'=>'form-control','id'=>'dpi','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">DPI Escrito</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('dpiw',null,['class'=>'form-control','id'=>'dpiw','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Sexo</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('gender',$genders,$student->gender,['id'=>'gender','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Estado Civil</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('cstatus',$civilstatus,$student->cstatus,['id'=>'cstatus','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Fecha de naciemiento</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('birthdate', $student->birthdate,['class'=>'form-control','required'=>'']); !!}
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
                                <div class="form-group"><label class="col-sm-2 control-label">Nacionalidad</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('nationality',null,['class'=>'form-control','id'=>'nationality','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Dirección</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('adressr',null,['class'=>'form-control','id'=>'adressr','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Dirección Escrita</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('adressrw',null,['class'=>'form-control','id'=>'adressrw','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('municipalityr',$municipality,$student->municipalityr,['id'=>'municipalityr','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Carrera</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('carrer',null,['class'=>'form-control','id'=>'carrer','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Unidad Académica</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('academicu',null,['class'=>'form-control','id'=>'academicu','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                

                                <div class="form-group"><label class="col-sm-2 control-label">Tipo de Práctica</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('practice',$practices,$student->practice,['id'=>'practice','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Financiamiento</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('financing',$financings,$student->financing,['id'=>'financing','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha de Inicio</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('initd', $student->initd,['class'=>'form-control','required'=>'']); !!}
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fecha de Finalización</label>

                                    <div class="col-sm-10">
                                        {!! Form::date('endd', $student->endd,['class'=>'form-control','required'=>'']); !!}
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Sede</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('headquarter',$headquarters,$student->headquarter,['id'=>'headquarter','class'=>'form-control m-b chosen-select','tablaindex'=>'2'])!!}
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Duración del EPS</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('length',null,['class'=>'form-control','id'=>'length','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Pagos</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('payments',null,['class'=>'form-control','id'=>'payments','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>


                                <div class="form-group"><label class="col-sm-2 control-label">Monto</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('grant',null,['class'=>'form-control','id'=>'grant','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Monto en letras</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('grantm',null,['class'=>'form-control','id'=>'grantm','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>
                                
                                 <div class="form-group"><label class="col-sm-2 control-label">Cohorte</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('cohorte',$cohortes,null,['id'=>'cohorte','class'=>'form-control m-b'])!!}
                                    </div>
                                </div>





                                
                               
                               <div class="hr-line-dashed"></div>
                              

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                       
                            
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