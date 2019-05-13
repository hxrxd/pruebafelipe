@extends('admintemplate')

@section('place')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Proyectos</h2>
        <ol class="breadcrumb">
          <li>
            @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin")
              <a href="">Todos los proyectos</a>
            @else
              <a href="">{{$supervisor->name}}</a>
            @endif
          </li>
          <li id="cohort_title" class="active">
              <strong></strong>
          </li>
        </ol>        
    </div>
</div>

<div class="row wrapper border-bottom white-bg ibox">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="">

                <div class="">
                    <div class="project-list">
                      @if($pjs == null)


                      @else
                      <div id="results"><div id="nodata"></div>

                        <div class=" animated fadeInRight">
                                  <div class="row">
                                      <div class="col-lg-12">
                                      <div class=" float-e-margins">
                                          <div class="ibox-title">

                                          </div>
                                          <div class="ibox-content">

                                          <div class="table-responsive">

                                          <table class="table table-hover dataTables-example" >
                                          <thead>
                                          <tr>
                                              <th>Nombre</th>
                                              <th>Tipo</th>
                                              <th>Equipo</th>
                                              <th>Cohorte</th>
                                              <th>Línea de intervención</th>
                                              <th>Estado</th>
                                              <th>Estudiante</th>
                                              <th>Operaciones</th>
                                          </tr>
                                          </thead>
                                          <tbody>

                                            @foreach($pjs as $d)

                                            <tr>
                                                <td>{{ $d->name }}</td>
                                                <td>{{ $d->type }}</td>
                                                <td>{{ $d->team }}</td>
                                                <td>{{ $d->cohort }}</td>
                                                <td>{{ $d->line }}</td>
                                                @if($d->status == 0)
                                                  <td><span class="label label-primary">Finalizado</span></td>
                                                @else
                                                  <td><span class="label label-error">En ejecución</span></td>
                                                @endif
                                                <td>{{ $d->namestudent }} {{ $d->lastnamenamestudent}} {{ $d->slastnamenamestudent}} </td>
                                                <td>
                                                  <a href="{{url('gotoproject/'.$d->id.'/'.$d->id_team.'/'.$d->cohort.'/'.$d->type)}}" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> Ir al proyecto </a>
                                                  @if($d->status == 1)
                                                    <a href="{{url('showpj/'.$d->id)}}" class="btn btn-white btn-sm disabled"><i class="fa fa-external-link"></i> Ficha final </a>
                                                  @else
                                                    <a href="{{url('showpj/'.$d->id)}}" class="btn btn-white btn-sm"><i class="fa fa-external-link"></i> Ficha final </a>
                                                  @endif
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

                          </div>
                      @endif
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




    function downloadFile(file_path){
      if(file_path == null){
        swal({
            title: "El archivo aún no está disponible",
            text: "El informe requerido no ha sido cargado."
        });
      }else{

      }
    }

</script>

@endsection
