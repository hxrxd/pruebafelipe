@extends('admintemplate')

@section('place')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Diagnósticos</h2>
        <ol class="breadcrumb">
          <li>
            @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin")
              <a href="">Todos los diagnósticos</a>
            @else
              <a href="">{{$supervisor->name}}</a>
            @endif

          </li>
          <li id="cohort_title" class="active">
              <strong>{{$cohort}}</strong>
          </li>
        </ol>
    </div>
</div>

<div class="row wrapper border-bottom white-bg ibox">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="">
                <div class="ibox-title" style="height:75px;">
                    <h5>Lista de diagnósticos</h5>
                    <div class="ibox-tools">
                        <!--<select id="cohort_select" class="form-control m-b" style="max-width:250px; float:right; border: 1.5px solid #cccccc;border-radius:5px">
                          @foreach ($gcohorts as $co => $value)
                            <option value="{{ $co }}" selected> {{ $value }}</option>
                          @endforeach
                        </select>-->
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="project-list">
                      @if($dxs == null)
                      <div id="no_info" class="row">
                          <div class="col-lg-12">
                                <div class="float-e-margins">
                                    <div class="text-center p-md">
                                        <h2><span class="text-navy">Aún no hay diagnósticos que mostrar para esta cohorte.</span>
                                        <br/><h3></h3></h2>
                                        <p>
                                          En cuanto se comiencen a registrar aparecerán aquí en orden cronológico. Puedes intentar seleccionando otra cohorte
                                        </p>
                                        </br>

                                    </div>
                                </div>
                          </div>
                      </div>
                      <!--<div id="results"><div id="nodata"></div>
                        <table id="dxtable" class="table table-hover dataTables-example"></table></div>-->
                      @else
                      <div id="results"><div id="nodata"></div>
                        <table id="dxtable" class="table table-hover dataTables-example">
                          <thead>
                          <tr>
                              <th>Estado</th>
                              <th>Diagnóstico</th>
                              <th>Cohorte</th>
                              <th>Avance</th>
                              <th>Operaciones</th>
                          </tr>
                          </thead>
                            <tbody>

                                @foreach ($dxs as $dx)

                                <tr>
                                    <td class="project-status">
                                    @if($dx->edit_flag == 100)
                                        <span class="label label-primary">Finalizado</span>
                                    @else
                                        <span class="label label-danger">Editando</span>
                                    @endif
                                    </td>
                                    <td class="project-title">
                                        <a href="#">{{$dx->team}}</a>
                                        <br/>
                                        <small>Fecha de creación: {{$dx->created_at}}</small>
                                    </td>
                                    <td class="project-completion">
                                            <p>{{$dx->cohort}}</p>
                                    </td>
                                    <td class="project-completion">
                                            <small>Completado: {{$dx->edit_flag}}%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: {{$dx->edit_flag}}%;" class="progress-bar"></div>
                                            </div>
                                    </td>
                                    <!--<td class="project-people" style="max-width:160px;">
                                      @foreach($participants as $participant)
                                        @if($participant->team == $dx->team)
                                        <a href=""><img alt="image" class="img-circle" avatar="{{substr($participant->name,0,1).' '.$participant->fsurname}}"></a>
                                        @endif
                                      @endforeach
                                    </td>-->
                                    <td class="project-actions">
                                        <a href="{{url('dx/detail/'.$dx->team.'/'.$dx->cohort)}}" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> Ver detalle </a>
                                        @if($dx->edit_flag == 100)
                                          <a href="{{url('teams/download/dx/'.$dx->id_team.'/'.$dx->cohort)}}" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> PDF </a>
                                        @else
                                          <a href="{{url('teams/download/dx/'.$dx->id_team.'/'.$dx->cohort)}}" class="btn btn-white btn-sm" disabled><i class="fa fa-external-link"></i> PDF </a>
                                        @endif
                                        <a id="dw-button" onclick="downloadFile({{$dx->path}})" class="btn btn-white btn-sm"><i class="fa fa-download"></i> Descargar </a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table></div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-meh-o modal-icon"></i>
        <h4 class="modal-title">Parece que alguien más está editando...</h4>
        <h5>Un integrante de tu equipo está trabajando en este momento, trata de editar más tarde.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
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
/*
     * LetterAvatar
     *
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d){


        function LetterAvatar (name, size) {

            name  = name || '';
            size  = size || 60;

            var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
                ],

                nameSplit = String(name).toUpperCase().split(' '),
                initials, charIndex, colourIndex, canvas, context, dataURI;


            if (nameSplit.length == 1) {
                initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
            } else {
                initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
            }

            if (w.devicePixelRatio) {
                size = (size * w.devicePixelRatio);
            }

            charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
            colourIndex   = charIndex % 20;
            canvas        = d.createElement('canvas');
            canvas.width  = size;
            canvas.height = size;
            context       = canvas.getContext("2d");

            context.fillStyle = colours[colourIndex - 1];
            context.fillRect (0, 0, canvas.width, canvas.height);
            context.font = Math.round(canvas.width/2)+"px Arial";
            context.textAlign = "center";
            context.fillStyle = "#FFF";
            context.fillText(initials, size / 2, size / 1.5);

            dataURI = canvas.toDataURL();
            canvas  = null;

            return dataURI;
        }

        LetterAvatar.transform = function() {

            Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
                name = img.getAttribute('avatar');
                img.src = LetterAvatar(name, img.getAttribute('width'));
                img.removeAttribute('avatar');
                img.setAttribute('alt', name);
            });
        };


        // AMD support
        if (typeof define === 'function' && define.amd) {

            define(function () { return LetterAvatar; });

        // CommonJS and Node.js module support.
        } else if (typeof exports !== 'undefined') {

            // Support Node.js specific `module.exports` (which can be a function)
            if (typeof module != 'undefined' && module.exports) {
                exports = module.exports = LetterAvatar;
            }

            // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
            exports.LetterAvatar = LetterAvatar;

        } else {

            window.LetterAvatar = LetterAvatar;

            d.addEventListener('DOMContentLoaded', function(event) {
                LetterAvatar.transform();
            });
        }

    })(window, document);

    $('#cohort_select').on('change', function(e){
     current_cohort = $('#cohort_select option:selected').text();


     $.get('{{asset("diagnostics/cohort/current")}}'.replace('current',current_cohort.substring(1,15)), function(data) {
          console.log('LENGTH: '+data.length);
          $('#no_info').empty();
          if(data.length == 0){
            $('#nodata').empty();
            $('#nodata').append('<div class="col-lg-12"><div class="float-e-margins"><div class="text-center p-md"><h2><span class="text-navy">No hay diagnósticos que mostrar para la cohorte seleccionada.</span><br/><h3></h3></h2><p>Intenta buscar para otra cohorte</p></br></div></div></div>');
            $('#dxtable').empty();
          }else{
            $('#nodata').empty();
            $('#dxtable').empty();
            $('#dxtable').append('<tbody>');
           data.forEach(function(d){
             console.log('flaaaaag: '+d.team);
             console.log('cooooooo: {{$cohort}}');

             var path = 'teams/download/dx/'+d.team_id+'/'+d.cohort;

             if(d.edit_flag == 100){
               $('#dxtable').append('<tr><td class="project-status"><span class="label label-primary">Finalizado</span></td><td class="project-title"><a href="#">'+d.team+'</a><br/><small>Fecha de creación: '+d.created_at+'</small></td><td class="project-completion"><small>Completado: '+d.edit_flag+'%</small><div class="progress progress-mini"><div style="width: '+d.edit_flag+'%;" class="progress-bar"></div></div></td><td class="project-actions"><a href="detail/'+d.team+'/'+current_cohort.substring(1,15)+'" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> Ver detalle </a><a href="{{url("path_to_report")}}" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> PDF </a><a onclick="downloadFile()" style="margin-left:5px" class="btn btn-white btn-sm"><i class="fa fa-download"></i> Descargar </a></td></tr>'.replace('path_to_report',path));
             }else{
               $('#dxtable').append('<tr><td class="project-status"><span class="label label-danger">Editando</span></td><td class="project-title"><a href="#">'+d.team+'</a><br/><small>Fecha de creación: '+d.created_at+'</small></td><td class="project-completion"><small>Completado: '+d.edit_flag+'%</small><div class="progress progress-mini"><div style="width: '+d.edit_flag+'%;" class="progress-bar"></div></div></td><td class="project-actions"><a href="detail/'+d.team+'/'+current_cohort.substring(1,15)+'" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> Ver detalle </a><a href="{{url("path_to_report")}}" class="btn btn-white btn-sm" disabled><i class="fa fa-external-link"></i> PDF </a><a onclick="downloadFile()" style="margin-left:5px" class="btn btn-white btn-sm" disabled><i class="fa fa-download"></i> Descargar </a></td></tr>'.replace('path_to_report',path));
             }

           });
           $('#dxtable').append('</tbody>');

       }

       });

        $('#cohort_title').empty();
       $('#cohort_title').append('<strong>'+current_cohort.substring(1,15)+'</strong>');
    });


    function downloadFile(){

        swal({
            title: "El archivo aún no está disponible",
            text: "El informe requerido no ha sido cargado.",
            confirmButtonColor: "#1ab394"
        });

    }

</script>

@endsection
