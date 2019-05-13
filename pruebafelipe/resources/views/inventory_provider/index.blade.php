@extends('admintemplate')




@section('place')

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Proveedores</span>
                   <br/></br>


                    <a href="{{ url('inventory/provider/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Registrar un nuevo proveedor</a>
                    <a href="{{ url('rep/providers')}}" class="btn btn-primary" role="button"><i class="fa fa-download"></i> Generar Reporte PDF</a>
                    <a href="{{ url('getInvRegs')}}" class="btn btn-primary" role="button"><i class="fa fa-download"></i> XLS (Excel)</a>

                </div>


            </div>
        </div>
</div>


<div class=" animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Registros de proveedores</h5>
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
                        <th>NIT</th>
                        <th>Proveedor</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($providers as $prov)

                    <tr>
                        <td>{{ $prov->nit }}</td>
                        <td>{{ $prov->name }}</td>
                        <td>{{ $prov->phone }}</td>
                        <td>{{ $prov->email }}</td>
                        <td>
                            <a href="{{ url('inventory/provider/edit/'.$prov->id)}}" class="btn btn-primary btn-xs" type="button"><i class="fa fa-edit"></i> Editar</a>
                            <a href="{{ url('inventory/provider/dismiss/'.$prov->id)}}" class="btn btn-danger btn-xs" type="button" id="dismiss-btn"><i class="fa fa-close"></i> Dar de baja</a>
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


    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>

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

    <script>
      $(document).ready(function () {
        $('#dismiss-btn').click(function(){
          swal({
              title: "¡Operación exitosa!",
              text: "Se ha dado de baja al proveedor",
              type: "success"
          });
        });
      });
    </script>

@endsection
