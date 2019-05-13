@extends('admintemplate')

@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Datos Proporcionados al Programa EPSUM</span>
                   <br/><h3>Supervisor {{$supervisor->name}}, tel: {{$supervisor->phone}}</h3></h2>

                    <p>     
                      La infomación no puede ser modificada, cualquier cambio reportarlo a <A HREF="mailto:miepsum@gmail.com">miepsum@gmail.com</A>
                    </p>
                
                       
                </div>


            </div>
        </div>
</div>
 
            <div class="row">
                 <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Email</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->email}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>DPI</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->dpi}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Carné</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->carne}}</h3>
                               
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>DPI Escrito</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->dpiw}}</h3>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Nombre</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->name}} <br>{{$student->fsurname}} {{$student->ssurname}}</h3>
                               
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                 <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Sexo</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->genders}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Estado Civil</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->status}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Cumpleaños</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{ date("d/m/Y",strtotime($student->birthdate)) }}</h3>
                               
                            </div>
                        </div>
                    </div>
            </div>

             <div class="row">

                <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Nacionalidad</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->nationality }}</h3>
                               
                            </div>
                        </div>
                    </div>

                 <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Número Personal</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->personalp}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Número Domiciliar</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->homep}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     
            </div>

             <div class="row">

                

                 <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Carrera</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->carrer}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Unidad Académica</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->academicu}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     
            </div>

             <div class="row">

                

                 <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Dirección</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->adressr}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Dirección Escrita</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->adressrw}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     
            </div>

          
<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Datos EPS</span>
                  
                    
                    
                
                       
                </div>


            </div>
        </div>
</div>

            <div class="row">
                 <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Fecha de inicio</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{ date("d/m/Y",strtotime($student->initd)) }}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Fecha de Finalización</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{ date("d/m/Y",strtotime($student->endd)) }}</h3>
                               
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Tipo</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{ $student->practice }}</h3>
                               
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">

                

                 <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Sede</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->headquarter}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h2>Equipo</h2>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">{{$student->team}}</h3>
                               
                            </div>
                        </div>
                    </div>
                     
            </div>





@endsection

@section('script')



@endsection