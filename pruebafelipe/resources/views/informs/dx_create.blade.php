@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="sheet" class="ibox float-e-margins white-bg">

      <!-- Title bar -->

      <div class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{URL::previous()}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">Informe diagnóstico</h1>
                        <h4>{{$municipality->municipality.', '.$department->departament}} - {{(substr($cohort->name,0,1) === '1')?'Primera ':'Segunda '}} {{substr($cohort->name,2,14)}}</h4>
                    </div>
                </div>
          </div>
      </div>

      <!-- Dx status -->

      <div id="dx-presentation" class="center-text-div animated fadeInUp" style="display:none">
        @foreach ($squad as $member)
          <button class="cool-avatar hvr-grow" data-toggle="tooltip" title="{{$member->name.' '.$member->fsurname}}">{{substr($member->name,0,1).substr($member->fsurname,0,1)}}</button>
        @endforeach
        <p id="progress-info" style="font-weight:bold;margin-top:20px;color:#ccc">Progreso de avance de registro de plan de trabajo: 0%</p>
        <div style="padding:10px 60px;">
          <div class="progress progress-striped active m-b-sm">
              <div id="bar" class="progress-bar progress-bar-warning"></div>
          </div>
        </div>
        <div>
          <button type="button" class="cool-button-secoundary hvr-grow" onclick="">Seguir editando</button>
          <button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:20px;">Equipo</button>
          <button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:20px;">Sucesos</button>
        </div>

      </div>

      <!-- No dx view-->

      <div id="empty-box" class="cool-empty animated fadeInUp" style="display:none">
        <div class="cool-empty-text">
          <p>No se ha comenzado a editar el diagnóstico</p>
          <p style="font-size:14px;">Este espacio es compartido, lo cual significa que todos los integrantes de tu equipo podrán acceder al mismo contenido que aquí se registre. <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a></p><br>
          <button type="button" id="start-button" class="cool-button bg-orange hvr-grow">¡Comenzar a editar!</button>
        </div>
      </div>

      <!-- Territory info -->

      <div id="edit-territory" class="animated fadeInUp" style="margin-top:60px;display:none">
        <h1 class="title-center">¡Empecemos con la información del territorio!</h1>
        <p class="description-center">La información territorial define la ubicación y características geográficas del territorio intervenido.</p>

        <div class="cool-form">
          <div class="animated fadeInUp">
            <form class="form-horizontal">

            <div class="form-group"><label class="col-sm-2 control-label box-label">Lugar</label>
              <div class="col-sm-10">
                <input id="territory_place" type="text" class="cool-input" placeholder="Lugar" style="padding:0px 2px 8px 2px" value="{{$municipality, $department}}"></input>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label box-label">Ubicación</label>
              <div class="col-sm-10">
                <input id="territory_location" type="text" class="cool-input" placeholder="Descripción del territorio intervenido" style="padding:0px 2px 8px 2px"></input>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label box-label">MSNM</label>
              <div class="col-sm-10">
                <input id="territory_masl" type="text" class="cool-input" placeholder="Metros sobre el nivel del mar del territorio intervenido" onkeypress="return isNumberKey(event)" style="padding:0px 2px 8px 2px"></input>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label box-label">Área superficial</label>
              <div class="col-sm-10">
                <input id="territory_surface" type="text" class="cool-input" placeholder="Área superficial del territorio intervenido en kilómetros cuadrados (km2)" onkeypress="return isNumberKey(event)" style="padding:0px 2px 8px 2px"></input>
              </div>
            </div>


            <div class="form-group"><label class="col-sm-2 control-label"></label>
              <div class="col-sm-10 iradio_square-green checked">
                <button type="button" id="save-button" class="cool-button hvr-grow">Guardar cambios</button>
                <button type="button" id="cancel-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
              </div>
            </div>
            </form>
          </div>
        </div>

        <div class="center-text-div animated fadeIn" id="options-matrix-1">
          <button type="button" id="matrix-1-button" class="cool-button hvr-grow" onclick="">Continuar</button>
        </div>
      </div>

      <!-- Add objectives view -->

      <div id="add-dialog-1" class="cool-form animated fadeInUp" style="display:none;">
        <div>
          <form class="form-horizontal">
          <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
            <div class="col-sm-10">
              <h2 id="title-level" style="font-weight:bold;">Here the title of the level</h2>
              <p id="description-level" style="color:#bbb">And here de description for the level</p>
            </div>
          </div>

          <!--New Level View-->

          <div id="view-new-objective" class="animated fadeInUp">
          <div class="form-group"><label class="col-sm-2 control-label box-label">Resumen narrativo</label>
            <div class="col-sm-10">
              <textarea id="narrative" class="box-taco field-numbered" placeholder="Define el resumen narrativo del nivel indicado" maxlength="160"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Indicadores</label>
            <div class="col-sm-10">
              <textarea id="indicators" class="box-taco field-bullet" placeholder="¿Cuáles son los indicadores que te ayudarán a medir lo que definiste en el resumen narrativo?" maxlength="512" rows="4"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Medios de verificación</label>
            <div class="col-sm-10">
              <textarea id="verification" class="box-taco field-bullet" placeholder="Escribe algunos medios de verificación. Estos pueden ser actas, listados de asistencia, fotografías, entre otros." maxlength="160" rows="3"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Supuestos</label>
            <div class="col-sm-10">
              <textarea id="assumptions" class="box-taco" placeholder="¿Cuáles son los supuestos para este nivel?" maxlength="160"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>
            <div class="col-sm-10 iradio_square-green checked">
              <button type="button" id="save-matrix-1-button" class="cool-button hvr-grow">Guardar</button>
              <button type="button" id="cancel-matrix-1-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
              <button type="button" class="cool-button-question hvr-grow" data-toggle="modal" data-target="#modal-info">?</button>
            </div>
          </div>
          </div>

          <!--Shared Objective View-->

          <div id="loader" style="display:none;height:500px"><div class="loader"></div></div>
          <div id="view-empty-shared-objectives" class="animated fadeInUp" style="display:none;height:500px">

            <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <div class="col-sm-10">
                <h2 style="font-size:64px;margin-top:64px;"><i class="fa fa-meh-o"></i></h2>
                <h1 style="font-weight:bold">No se han compartido objetivos en tu equipo o ya los agregaste todos</h1>
                <p style="font-size:14px;margin-right:96px;">¡Comparte uno! Haz clic en <i class="fa fa-plus"></i> <strong>Nuevo objetivo</strong> y cuando lo tengas selecciona <i class="fa fa-check-square"></i> <strong>Este objetivo es en equipo</strong>.<br><br>Si ya registraste uno y necesitas marcarlo como objetivo de equipo, haz clic en el botón de editar al lado del objetivo y selecciona la casilla antes mencionada.<br><br></p>
                <a onclick="returnToMain()" class="text-menu-report">Volver a la planificación</a>
              </div>
            </div>

          </div>
          <div id="view-shared-objectives" class="animated fadeInUp" style="display:none;height:1600px">

            <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <div class="col-sm-10">
                <p>A continuación se muestra una lista de los objetivos de equipo compartidos. Para agregar objetivos a tu planificación, marca la casilla al lado del objetivo y cuando termines selecciona la opción <strong>agregar a mi planificación</strong> al final de la lista.</p>
                <table id="table-shared-objectives" style="margin-bottom:24px;">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button type="button" id="save-from-shared" class="cool-button hvr-grow">Agregar a mi planificación</button>
                <button type="button" onclick="returnToMain()" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
              </div>
            </div>

          </div>

          <!--Objectives Followed Up View-->


          <div id="view-empty-followed-objectives" class="animated fadeInUp" style="display:none;height:500px">

            <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <div class="col-sm-10">
                <h2 style="font-size:64px;margin-top:64px;"><i class="fa fa-hourglass-half"></i></h2>
                <h1 style="font-weight:bold">Todavía no puedes usar esta opción</h1>
                <p style="font-size:14px;margin-right:96px;">Esta opción te será útil luego de tu primer informe de mes. Haz clic en <i class="fa fa-plus"></i> <strong>Nuevo objetivo</strong> para comenzar. También puedes intentar agregar uno desde <i class="fa fa-share-alt"></i><strong> Objetivos compartidos</strong>.<br><br></p>
                <a onclick="returnToMain()" class="text-menu-report">Volver a la planificación</a>
              </div>
            </div>

          </div>
          <div id="view-followed-objectives" class="animated fadeInUp" style="display:none;height:1600px">

            <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <div class="col-sm-10">
                <p>Acá tienes una lista de tus objetivos individuales pasados. Para dar seguimiento a un objetivo, marca la casilla al lado del objetivo y cuando termines selecciona la opción <strong>agregar a mi planificación</strong> al final de la lista.</p>
                <table id="table-followed-objectives" style="margin-bottom:24px;">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button type="button" id="save-from-followed" class="cool-button hvr-grow">Agregar a mi planificación</button>
                <button type="button" onclick="returnToMain()" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
              </div>
            </div>

          </div>
          </form>
        </div>
      </div>



      <!-- Edit dialog -->

      <div id="edit-dialog" class="cool-form">
        <div class="animated fadeInUp">
          <form class="form-horizontal">

          <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <label class="col-sm-10 title-form">Editar objetivo</label>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Objetivo</label>
            <div class="col-sm-10">
              <textarea id="objective-edit" class="box-taco" placeholder="Define un objetivo" maxlength="160"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Actividades</label>
            <div class="col-sm-10">
              <textarea id="todolist-edit" class="box-taco" placeholder="Lista las actividades que ayudarán a cumplir el objetivo" maxlength="512" rows="5"></textarea>
            </div>
          </div>

          <div id="results-dialog" class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <label class="col-sm-10 title-form"><i class="fa fa-arrow-up"></i> Resultados obtenidos</label>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Resultados</label>
            <div class="col-sm-2">
              <input id="result-amount" type="text" class="cool-input" placeholder="Cantidad" onkeypress="return isNumberKey(event)" style="text-align:center"></input>
            </div>
            <div class="col-sm-5">
              <div class="editable-select-arrow">
                <select id="results-select">

                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <button type="button" id="add-result" class="cool-button-secoundary">Agregar</button>
              <button type="button" id="clear-results" class="cool-button-option-record" onclick="" style="float:right"><i class="fa fa-undo"></i></button>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary"></label>
            <div class="col-sm-10" style="display:inline-block">
              <p style="color:#c3c3c3">Para agregar un resultado ingresa una cantidad, luego busca en los resultados propuestos y haz clic en <strong>Agregar</strong>. Si necesitas profundizar en la descripción de un resultado propuesto, solo sigue escribiendo en el campo de búsqueda. Para quitar resultados usa el botón <i class="fa fa-undo"></i></p>
            </div>
          </div>


          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary"></label>
            <div class="col-sm-10">
              <textarea id="results-edit" class="comment-table-corrections" placeholder="Los resultados que agregues se mostrarán en este espacio." maxlength="512" readonly style="margin-left:-2px;font-weight:bold"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Aciertos</label>
            <div class="col-sm-10">
              <textarea id="hits-edit" class="box-taco" placeholder="Aquí irán los aciertos" maxlength="246" rows="2"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Desaciertos</label>
            <div class="col-sm-10">
              <textarea id="failures-edit" class="box-taco" placeholder="Y por aquí desaciertos que se tuvieron para cumplir con el objetivo..." maxlength="243" rows="2"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>

            <div style="float:left; padding-left:16px">
              <label class="container">Este objetivo es en equipo
                <input id="isGroup-edit" type="checkbox" name="check-b">
                <span class="checkmark chk-yes"></span>
              </label>
            </div>
            <a class="info hvr-pop" style="float:left;padding-top:0px;font-size:20px;color:#d3d3d3"><i class="fa fa-info-circle"></i></a>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>
            <div class="col-sm-10 iradio_square-green checked">
              <button type="button" id="update-button" class="cool-button hvr-grow">Guardar cambios</button>
              <button type="button" id="cancel-edit-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
            </div>
          </div>
          </form>
        </div>
      </div>

      <!-- Record view -->

      <div id="record" style="display:none">
        <h1 style="font-weight:bold;text-align:center;margin-bottom:24px">Sucesos del objetivo</h1>
        <div id="loader-record" style="display:none;height:500px"><div class="loader"></div></div>
        <div id="timeline" class="timeline animated fadeInUp">
        </div>
        <div style="margin-left:262px">
          <button type="button" id="timeline-up-button" class="cool-button-option hvr-grow"><i class="fa fa-arrow-up"></i></button>
          <button type="button" onclick="returnToMain()" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Volver a la planificación</button>
        </div>
      </div>

      <div id="base" style="height:1200px;backgroundColor:blue"></div>

    </div>
  </div>
</div>

<button id="add-fab" class="cool-fab animated bounceIn">+</button>


<div class="modal inmodal" id="modal-info" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-question-circle-o modal-icon"></i>
        <h4 class="modal-title">Registro de informe diagnóstico</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Qué es el plan de trabajo?</strong> El plan de trabajo constituye un documento que brinda herramientas metodológicas necesarias para la formulación de proyectos y acciones que los equipos multidisciplinarios realizan. El mismo se lleva a cabo durante la fase de planificación y diseño de proyectos y parte del análisis participativo de los resultados del diagnóstico.</p>
        <p><strong>¿Qué contiene el plan de trabajo en esta plataforma?</strong> Algunas herramientas del plan de trabajo son:</p>
        <ul>
          <li>Árbol de problemas</li>
          <li>Matriz de marco lógico</li>
          <li>Matriz de seguimiento de indicadores</li>
          <li>Matriz de análisis participativo</li>
          <li>Perfiles de proyectos</li>
        </ul>
        <p><strong>¿Cómo sé que se ha completado el plan de trabajo?</strong> El plan de trabajo estará completo cuando se registren todos los puntos indicados en la respuesta anterior y hasta que el último perfil de proyecto monodisciplinario esté registrado. Hecho esto, tu supervisor podrá acceder al plan de trabajo del equipo para revisarlo y validarlo.</p>
        <p><strong>¿Por qué es importante detallarlo?</strong> Derivado del plan de trabajo, el equipo obtendrá objetivos, actividades e indicadores que podrán utilizar luego en informes mensuales e informe final dentro de esta plataforma.</p>
        <p><strong>¿Todos los integrantes del equipo pueden editar?</strong> Sí, este espacio es compartido y lo que tú ves tambien se muestra a tus compañeros de equipo.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="cool-button hvr-grow" data-dismiss="modal">¡Entendido!</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
  var numerator = 1;
  var team_count = {!! count($squad) !!};
  var current_dx = {!! $dx->id !!};
  var menu_bar = document.getElementById('sidebar');
  var username = '{!! $username !!}';
  var status = {!! $dx->edit_flag !!};
  console.log('COMPLETED:'+status);

  //initialize ui

  if(parseInt(status) === 0){
    document.getElementById('empty-box').style.display = 'block';
  }else{
    document.getElementById('dx-presentation').style.display = 'block';
    document.getElementById('edit-territory').style.display = 'block';

    updateProgress();
  }

  $('#start-button').click(function(){
    document.getElementById('empty-box').style.display = 'none';
    document.getElementById('edit-territory').style.display = 'block';
    $('html,body').animate({scrollTop: $("#edit-territory").offset().top-140},'slow');
  });

  $(".field-bullet").focus(function() {
      if($(this).val() === ''){
          $(this).val($(this).val() + '• ');
  	  }
  });

  $(".field-bullet").keyup(function(event){
  	var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
          $(this).val($(this).val() + '\n• ');
  	}
  	var txtval = $(this).val();
  	if(txtval.substr(txtval.length - 1) == '\n'){
  		$(this).val(txtval.substring(0,txtval.length - 1));
  	}
  });

  $(".field-numbered").focus(function(){
    if(flag_matrix_1 === LEVEL_COMPONENT && $(this).val() === ''){
      $(this).val($(this).val() + numerator + '. ');
    }

  });

  $("#save-matrix-1-button").click(function(){

    if(validateFields()){
      var re = new RegExp('• ','g');
      //var indicators_formatted = document.getElementById("indicators").value.replace(re,'');

      $.ajax({
          type: 'post',
          url: '{{asset("add/matrix/level")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'index': flag_matrix_1,
              'level' : current_level,
              'narrative_summary': $('#narrative').val(),
              'indicators': $('#indicators').val(),
              'means_of_verification': $('#verification').val(),
              'assumptions': $('#assumptions').val(),
              'working_plan' : parseInt(current_workplan),
              'user_create' : username,
              'user_update' : username
          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_REG_M1');
              } else {
                  console.log('SUCCESS_REG_M1');
                  updateTableMatrix1(data);
                  nextOptionMatrix1();
                  $('#matrix-1-table').show();
                  updateProgress();
              }
          },
      });
    }

  });

  $('#cancel-matrix-1-button').click(function(){
    returnToMatrix1();
  });

  function returnToMatrix1(){
    $('html,body').animate({scrollTop: $("#matrix-1").offset().top-140},'slow');
    document.getElementById('add-dialog-1').classList.remove("fadeInUp");
    document.getElementById('add-dialog-1').className += " fadeOutDown";
    document.getElementById('options-matrix-1').classList.remove("fadeOut");
    document.getElementById('options-matrix-1').className += " fadeIn";

    $('#narrative').val('');
    $('#indicators').val('');
    $('#verification').val('');
    $('#assumptions').val('');
  }





  function validateFields(){
    if(!$("#narrative").val() || !$("#indicators").val() || !$("#verification").val()){
        swal({
            title: "Falta información",
            text: "Verifica que has completado todos los campos",
            confirmButtonColor: "#2ebeef"
        });
        return false;
    }
    return true;
  }

  function updateProgress(){
    $('#dx-presentation').show();

    var completed_index = 9; //dx sections (territory, demography...)
    var completed = status;

    var progress = completed * 100 / completed_index;

    document.getElementById('bar').style.width = progress + "%";
    document.getElementById('progress-info').innerHTML = "Progreso de avance de registro de plan de trabajo: " + parseInt(progress) + "%";
  }

</script>

@endsection
