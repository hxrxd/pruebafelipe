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

                    <h2><span class="text-navy">Solicitud de disciplinas</span>
                   <br/><h3>Panel de Control</h3></h2>

                    <p>     
                      Por medio de esta consola de administración puede confirmar y agregar solucitudes de disciplinas a sedes del programa EPSUM, recurde que una sede puede ser un CAP, Puesto de Salud, Municipalidad, Gobernación o cualquier institución asignada al estudiante. Las disciplinas presentadas en la tabla son obtenidas de la cohorte anterior.
                    </p>
                @if($reqAct->act===1)
                    <a href="{{ url('getAssignment')}}" class="btn btn-primary" role="button"><i class="fa fa-print"></i> Imprimir documento de solicitudes </a>
                    <a href="{{ url('requestdisciplines/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Registrar nueva solicitud </a>
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
                        <h5>Solicitud de disciplinas para {{$ncohorte->next}}</h5>
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
                @if($reqAct->act===1)
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Equipo</th>
                        <th>Sede</th>
                        <th>Disciplina</th>
                        <th>Unidad Académica</th>
                        <th>Validación</th>
                        <th>Agregar Unidad académica</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($assignment)!=0)
                        @foreach($assignment as $agg)
                        
                        <tr>
                            <td>{{ $agg->dp }}</td>
                            <td>{{ $agg->mun }}</td>
                            <td>{{ $agg->equipo }}</td>
                            <td>{{ $agg->sede }}</td>
                            <td>{{ $agg->disciplina }}</td>
                            <td>{{ $agg->ua }}</td>
                            @if($agg->act === 2)
                                <td class="color-red">Un estudiante</td>
                                <td class="color-red">se encuentra asignado</td>
                            @else
                                <td>{!!Form::checkbox('act', null,$agg->act, ['id'=>$agg->id, 'name'=>'act','class'=>'js-switch'])!!}</td>
                                <td>
                                    {!! link_to_route('requestdisciplines.edit','Agregar', $parameters = $agg->id, $attributes = ['class'=>'btn btn-primary btn-xs']); !!}
                                </td>
                            @endif
                        </tr>
                    
                        
                        @endforeach
                    @endif
                    </tbody>
                    </table>
                @elseif($reqAct->act===0)
                    <h3 style='text-align: center'> Actualmente no se encuentra activo la función de solicitud de disciplinas </h3>
                @endif
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>

@endsection

@section('script')
    
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
    <script src="js/plugins/switchery/switchery.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html,{ size: 'small', color: '#2ebeef' });
        });
        
        switchery.addEventListener('click', function() {
                    if(self.isDisabled()===true) {
                        alert('hi');
                    };//<-dont handle click if disabled

                })
                
    </script>
     <script>
         var flag;
         var idAct;
        $(document).ready(function(){
            $('input[name=act]').change(function(){
                    if($(this).is(':checked')) {
                        idAct=$(this).attr('id');
                        flag= 1;
                    } else {
                        idAct=$(this).attr('id');
                        flag= 0;
                    }
                    //
                    jQuery.ajax({
                        url: '{{asset("request/disciplines/idRequest/value")}}'.replace('idRequest/value', idAct+'/'+flag),
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            //console.log('console:'+data['result']);
                            console.log(data['result']);
                            toastr.success('Se realizado el cambio de asignación con éxito','¡Cambio guardado!');
                        },error:function(){
                            console.log('ERROR');
                            toastr.success('Se ha producido un error, contactar con los desarrolladores','¡ERROR!');
                        }
                    });
                });
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
    <style>
        .color-red{
            color:white;
            background-color: #a03522;
        }
    </style>
@endsection