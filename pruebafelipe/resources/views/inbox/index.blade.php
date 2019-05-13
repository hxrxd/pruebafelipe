@extends('admintemplate')




@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Realizado verifique el número asignado</strong> {{Session::get('message')}}
</div>
@endif

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">

                    <h2><span class="text-navy">Bandeja de entrada EPSUM</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración visualizar los documentos recibidos en las oficinas del Programa EPSUM
                    </p>

                     @if(Auth::user()->rol == "Secretaria"||Auth::user()->rol == "Admin")
                     <a href="{{ url('/inbox/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Registrar</a>
                    @endif


                </div>


            </div>
        </div>
</div>


<div class="animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Correlativos Registrados</h5>
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
                        <th>Número</th>
                        <th>Procedencia</th>
                        <th>Dirigida a</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inbox as $inb)
                    
                    <tr>
                        <td>{{ $inb->no }}</td>
                        <td>{{ $inb->sender }}</td>
                        <td>{{  $inb->fname }} {{  $inb->lname }}</td>
                        <td>{{ $inb->message }}</td>
                        <td>{{ date("d-m-Y ",strtotime($inb->datein)) }}</td>
                        <td align="center">

                            @if(Auth::user()->rol == "Secretaria" || Auth::user()->rol == "Admin")
                            {!! link_to_route('inbox.edit','Editar', $parameters = $inb->id_inbox, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}
                            @endif

                             {!! link_to_route('gen.inbox','Imprimir', $parameters = $inb->id_inbox, $attributes = ['class'=>'btn btn-info btn-xs']); !!}

                            



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