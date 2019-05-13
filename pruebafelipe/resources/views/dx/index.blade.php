@extends('admintemplate')

@section('place')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Diagnóstico</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">{{$team->name}}</a>
            </li>
            <li class="active">
                <strong>{{substr($cohort->cohorte,0,14)}}</strong>
            </li>
        </ol>
    </div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="">
                <div class="ibox-content">

                  @if($dx == null)

                  <div class="row">
                      <div class="col-lg-12">
                            <div class="float-e-margins">
                                <div class="text-center p-md">
                                    <h2><span class="text-navy">Aún no se ha registrado un diagnóstico</span>
                                    <br/><h3></h3></h2>
                                    <p>
                                      Comienza a editar el informe diagnóstico de tu equipo haciendo clic en el siguiente botón
                                    </p>
                                    </br>
                                    <a href="{{ url('dx/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Registrar</a>
                                </div>
                            </div>
                      </div>
                  </div>

                  @else

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <!--<button class="btn btn-white pull-right" type="button" style="margin-left:5px"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Subir</span></button>-->
                                @if($dx->editing == 0)
                                  @if($dx->edit_flag == 100)
                                    <a href="{{ url('dx/edit')}}" class="btn btn-white pull-right" type="button"><i class="fa fa-edit"></i> Editar</a>
                                  @else
                                    <a href="{{ url('dx/edit/'.$dx->edit_flag)}}" class="btn btn-white pull-right" type="button"><i class="fa fa-edit"></i> Continuar editando</a>

                                  @endif
                                @else
                                  <a class="btn btn-white pull-right" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Editar</a>
                                @endif

                            </div>
                            <dl class="dl-horizontal">
                                @if($dx->edit_flag == 100)
                                  <dt>Estado</dt> <dd><span class="label label-primary">Finalizado</span></dd>
                                @else
                                  <dt>Estado</dt> <dd><span class="label label-primary">En edición</span></dd>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">

                                <dt>Equipo:</dt> <dd>{{$team->name}}</dd>
                                <dt>Cohorte:</dt> <dd>  {{substr($cohort->cohorte,0,14)}}</dd>
                                <dt>Municipio:</dt> <dd>{{$municipality->municipality}} </dd>
                                <dt>Departamento:</dt> <dd> 	{{$department->departament}} </dd>
                            </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >

                                <dt>Creado por:</dt> <dd>{{$dx->user_create}}</dd>
                                <dt>Modificado por:</dt> <dd>{{$dx->user_update}}</dd>
                                <dt>Última actualización:</dt> <dd>{{$dx->updated_at}}</dd>
                                <dt>Participantes:</dt>
                                <dd class="project-people">
                                  @foreach ($participants as $participant)
                                    <a href="">
                                      <img
                                      alt="image"
                                      class="img-circle"
                                      avatar="{{substr($participant->name,0,1).' '.$participant->fsurname}}"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="{{$participant->name.' '.$participant->fsurname}}">
                                    </a>
                                  @endforeach
                              </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Completado:</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div style="width:{{$dx->edit_flag.'%'}};" class="progress-bar"></div>
                                    </div>
                                    @if($dx->edit_flag == 100)
                                      <small>Diagnóstico completado al <strong>{{$dx->edit_flag.'%'}}</strong>. Clic en el botón Editar, para modificar la información.</small>
                                    @else
                                      <small>Diagnóstico completado al <strong>{{$dx->edit_flag.'%'}}</strong>. Clic en el botón Editar, para continuar.</small>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>

                    @endif

                    <div class="animated fadeInRight">
                        <div class="row">
                              <div class="col-lg-12">
                                  <div class="float-e-margins">
                                      <div style="padding-top:2%; padding-bottom:2%">
                                          <h2>Equipo</h2>

                                              </div>
                                              <div class="">
                                                  <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                      <thead>
                                                      <tr>
                                                          <th>Carné</th>
                                                          <th>Nombre</th>
                                                          <th>Carrera</th>
                                                          <th>Facultad/Unidad Académica</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        @foreach($participants as $p)
                                                        <tr>
                                                            <td>{{ $p->carne }}</td>
                                                            <td>{{ $p->fsurname.' '.$p->ssurname.', '.$p->name }}</td>
                                                            <td>{{ $p->career}}</td>
                                                            <td>{{ $p->academicu }}</td>
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
            </div>
        </div>
    </div>
</div></div>

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
        @if($dx!=null)
          <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="changeEditStatusCommit('{{$dx->id}}')">No es cierto, nadie está editando</button>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

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


    function changeEditStatusCommit(iddx){
      swal({
          title: "¿Estás seguro?",
          text: "Queremos salvaguardar la consistencia de la información que registras",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "¡Sí estoy seguro!",
          cancelButtonText: "Cancelar",
          closeOnConfirm: false
      }, function () {

        $.ajax({
            type: 'post',
            url: '{{asset("changeEditDxStatus")}}',
            data: {
                '_token': "{{ csrf_token() }}",
                'id': iddx
            },
            success: function(data) {
                location.reload();
            }
          });

          swal("¡Puedes seguir editando!", "Vuelve a dar clic en Editar para hacer cambios en el diagnóstico.", "success");
      });
    }
</script>
@endsection
