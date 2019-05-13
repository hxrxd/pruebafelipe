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

                    <h2><span class="text-navy">Estado de Primer Pago</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede ver y ediar las fases del expediente del estudiante con la fecha en la que se envió. Por defeto sale la fecha 01/01/0001 esto quiere decir que aun no se actualiza el registro
                    </p>
                        <a href="{{ url('massivestatus')}}" class="btn btn-primary" role="button"><i class="fa fa-refresh"></i> Actualizar</a>
                        <a href="{{ url('logexpediente')}}" class="btn btn-success" role="button"><i class="fa fa-download"></i> Descargar</a>
                        <a href="{{ url('statuses/create')}}" class="btn btn-default" role="button"><i class="fa fa-plus"></i> Registrar</a>



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
                       {{--  <th>Codigo</th> --}}
                        <th>Nombre</th>
                        <th>Papelería</th>
                        <th>Contrato</th>
                        <th>Presupuesto</th>
                        <th>Rev1</th>
                        <th>Rev2</th>
                        <th>Conta</th>
                        <th>Pagado</th>
                        <th>Falta</th>
                         @if(Auth::user()->rol == "Gestor" || Auth::user()->rol == "Admin" || Auth::user()->rol == "Coordinador")
                        <th>Operaciones</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $status)
                    <tr>
                        <td>{{ $status->carne }}</td>
                       {{--   <td>{{ $status->no }}-{{ $status->year}}</td> --}}
                        <td>{{ $status->name }} {{ $status->fsurname }} {{ $status->ssurname }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->stationery)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->contract)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->budget)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->toaim1)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->toaim2)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->conta)) }}</td>
                        <td>{{ date("d/m/Y",strtotime($status->pay)) }}</td>
                        <td>{{ $status->notice }}</td>
                     
                         @if(Auth::user()->rol == "Gestor" || Auth::user()->rol == "Admin" || Auth::user()->rol == "Coordinador")
                        <td>
                            {!! link_to_route('statuses.edit','Editar', $parameters = $status
                            ->id, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}
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