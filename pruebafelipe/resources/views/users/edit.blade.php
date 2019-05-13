@extends('admintemplate')


@section('place')
        @include('template.alert')

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Usuario <small>Edición de parametros del usuario</h5>
                            <div class="ibox-tools">
                            

                            
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::model($users,['route'=>['users.update',$users->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">
                                    
                                        
                                        {!!Form::text('fname',null,['class'=>'form-control','id'=>'fname','placeholder'=>'Ingrese el Nombre del usuario'])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Apellido</label>

                                    <div class="col-sm-10">

                                        
                                        {!!Form::text('lname',null,['class'=>'form-control','id'=>'lname','placeholder'=>'Ingrese el Teléfono del Supervisor'])!!}

                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        {!!Form::text('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Ingrese la Región del Supervisor'])!!}
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Rol</label>

                                    <div class="col-sm-10">

                                    
                                   <select name="rol" id="rol" class="form-control m-b">
                                        <option>Estudiante</option>                       
                                        <option>Supervisor</option>  
                                        <option>Tesorero</option>   
                                        <option>Gestor</option>
                                        <option>Monitor</option> 
                                        <option>Secretaria</option>                    
                                        <option>Coordinador</option> 
                                        <option>Admin</option>                          


                                       
                                   </select>


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
    

    
        
@endsection