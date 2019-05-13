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

                <h2><span class="text-navy">Gestiones</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede ver las gestiones creadas para el contrato 
                    </p>

                    <p>
                        Estudiante <b>{{$student->name}} {{$student->fsurname}} {{$student->ssurname }}</b>, de numero carnet {{$student->carne}} y contrato No.{{$contract->no}}-{{$contract->year}}
                    </p>

                     {!! link_to_route('enga.createe','Crear', $parameters = $contract->id_contracts, $attributes = ['class'=>'btn btn-primary']); !!}
                    



                </div>


            </div>
        </div>
</div>


<div class=" animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Gestiones Registradas</h5>
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
                        
                        <th>No</th>
                        
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($engagements as $engagement)
                    
                    <tr>
                       
                        <td>{{ $engagement->no}}-{{$engagement->year }}</td>
                        <td>{!! date("d-m-Y",strtotime($engagement->initd)); !!}</td>
                        <td>{!! date("d-m-Y",strtotime($engagement->endd)); !!}</td>
                        <td align="center">
                            {!! link_to_route('engagement.edit','Editar', $parameters = $engagement->id_engagement, $attributes = ['class'=>'btn btn-default btn-xs']); !!}

                            {{-- cambiar ruta --}}

                             {!! link_to_route('gengagement.download','Generar', $parameters = $engagement->id_engagement, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}


                           {!! link_to_route('pay.index','Pago', $parameters = $engagement->id_engagement, $attributes = ['class'=>'btn btn-info btn-xs']); !!}

                           
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