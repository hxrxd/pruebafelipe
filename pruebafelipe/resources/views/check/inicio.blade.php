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

                    <h2><span class="text-navy">Cheques</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede ver los cheques y su estado
                    </p>

                         <a href="{{ url('massiveedit')}}" class="btn btn-primary" role="button"><i class="fa fa-refresh"></i> Actualizar</a>

                         <a href="{{ url('getchecks')}}" class="btn btn-success" role="button"><i class="fa fa-download"></i> Descargar</a>



                </div>


            </div>
        </div>
</div>


<div class="animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Cheques Registrados</h5>
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
                        <th>Estudiante</th>
                        <th>Pago</th>
                        <th>Monto</th>
                        <th>Cheque</th>
                        <th>Ingreso</th>
                        <th>Entrega</th>
                        <th>Liquidación</th>
                        <th>Descripcion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($check as $c)
                    
                    <tr>
                        <td>{{$c->carne}}</td>
                        <td>{{$c->name}} {{$c->fsurname}} {{$c->ssurname}}</td>
                        <td>{{$c->no}}-{{$c->year}}</td>
                        <td>{{$c->grant}}</td>
                        <td>{{$c->nocheck}}</td>
                        <td>{!! date("d/m/Y",strtotime($c->datein)); !!}</td>
                        <td>{!! date("d/m/Y",strtotime($c->datepay)); !!}</td>
                        <td>{!! date("d/m/Y",strtotime($c->dateout)); !!}</td>
                         <td align="center">
                           {{$c->desc}}
                            
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
    

    <script src="../public/js/plugins/dataTables/datatables.min.js"></script>

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