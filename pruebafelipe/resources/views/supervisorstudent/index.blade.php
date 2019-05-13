@extends('admintemplate')




@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Realizado</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Estudiantes EPSUM</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración editar los estudiantes asignados al Programa
                    </p>

                        <a href="{{ url('supervisorexcel')}}" class="btn btn-primary" role="button"><i class="fa fa-download"></i> Descargar</a>

                        
                </div>


            </div>
        </div>
</div>


<div class=" animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Estudiantes Registrados</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                            
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                    <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Carne</th>
                        <th>Nombre</th>
                        <th>Equipo</th>
                        <th>Carrera</th>
                        <th>Unidad</th>
                        <th>Supervisor</th>
                        <th>Cohorte</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                    
                    <tr>
                        <td>{{ $student->carne }}</td>
                        <td>{{ $student->name }} {{ $student->fsurname }} {{ $student->ssurname }}</td>
                        <td>{{  $student->team }}</td>
                        <td>{{ $student->carrer }}</td>
                        <td>{{  $student->academicu}}</td>
                        <td>{{  $student->supervisor}}</td>
                        <td>{{  $student->cohorte}}</td>
                        <td align="center">

                            {!! Html::decode(link_to_route('supervisorstudent.show','<i class="fa fa-eye"></i>', $parameters = $student->id_student, $attributes = ['class'=>'btn btn-primary btn-xs'])) !!}
                            {!! Html::decode(link_to_route('supervisorstudent.edit','<i class="fa fa-edit"></i>', $parameters = $student->id_student, $attributes = ['class'=>'btn btn-warning btn-xs'])) !!}
                            {!! Html::decode(link_to_route('ficha.download','<i class="fa fa-file"></i>', $parameters = $student->id_student, $attributes = ['class'=>'btn btn-info btn-xs'])) !!}

                            {{-- {!! link_to_route('settlement.download','Finiquito', $parameters = $student->id_student, $attributes = ['class'=>'btn btn-danger btn-xs']); !!}
 --}}
                            {!! link_to_route('settlement.view','Finiquito', $parameters = $student->id_student, $attributes = ['class'=>'btn btn-danger btn-xs']); !!}

                        </td>
                            
                    </tr>
                   
                    
                    @endforeach
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>

@endsection

@section('script')
    

    <script src="js/plugins/dataTables/datatables.min.js"></script>

     <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                language: {
                    
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar: ",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }

                }
            } );

        });

    </script>
        
@endsection