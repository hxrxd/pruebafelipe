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

                    <h2><span class="text-navy">Finiquitos creados en el año</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede ver volver a generar finiquitos que ya realizó en ocaciones anteriores
                    </p>
                       


                </div>


            </div>
        </div>
</div>


<div class=" animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Finiquitos Registrados</h5>
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
                        <th>No.</th>
                        <th>Carne</th>
                       {{--  <th>Codigo</th> --}}
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Unidad Académica</th>
                        <th>Equipo</th>
                        <th>Supervisor</th>
                         @if(Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin" || Auth::user()->rol == "Coordinador")
                        <th>Operación</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settlement as $set)
                    <tr>
                        <td>{{ $set->no }}</td>
                        <td>{{ $set->carne }}</td>
                       {{--   <td>{{ $status->no }}-{{ $status->year}}</td> --}}
                        <td>{{ $set->name }} {{ $set->fsurname }} {{ $set->ssurname }}</td>
                        <td>{{ $set->carrer }}</td>
                        <td>{{ $set->academicu }}</td>
                        <td>{{ $set->team }}</td>
                        <td>{{ $set->supervisor }}</td>                     
                         @if(Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin" || Auth::user()->rol == "Coordinador")
                        <td>
                            @if(Auth::user()->id == $set->iduser|| Auth::user()->rol == "Admin" )
                            {!! link_to_route('settlement.redownload','Finiquito', $parameters = $set->id_student, $attributes = ['class'=>'btn btn-danger btn-xs']); !!}
                            @endif
                        </td>
                         @endif
                            
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
                  "order": [[ 0, "desc" ]],
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