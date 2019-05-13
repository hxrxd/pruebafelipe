@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="sheet" class="ibox float-e-margins white-bg">

      <!-- Title bar -->

      <div class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{ url('plan')}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">Plan de trabajo</h1>
                        <h4>{{$municipality->municipality.', '.$department->departament}} - {{(substr($cohort->name,0,1) === '1')?'Primera ':'Segunda '}} {{substr($cohort->name,2,14)}}</h4>
                    </div>
                </div>
          </div>
      </div>

      <!-- Workplan status -->

      <div id="workplan-presentation" class="center-text-div animated fadeInUp" style="display:none">
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
          <button type="button" class="cool-button-secoundary hvr-grow" onclick="nextOptionMatrix1()">Seguir editando</button>
          <button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:20px;">Equipo</button>
          <button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:20px;">Sucesos</button>
        </div>

      </div>

      <!-- No working_plan view-->

      <div id="empty-box" class="cool-empty animated fadeInUp" style="display:none">
        <div class="cool-empty-text">
          <p>No se ha comenzado a editar el plan de trabajo</p>
          <p style="font-size:14px;">Si estas viendo esto significa que tú y tu equipo han llegado a la fase de planificación y diseño de proyectos. Por ello, en este apartado te ayudaremos a realizar un plan de trabajo que te brindará las herramientas metodológicas necesarias para formular los programas, proyectos y acciones.</p>
          <p style="font-size:14px;">Este espacio es compartido, lo cual significa que todos los integrantes de tu equipo podrán acceder al mismo contenido que aquí se registre. <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a></p><br>
          <button type="button" id="start-button" class="cool-button bg-orange hvr-grow">Comenzar con la matriz de marco lógico</button>
        </div>
      </div>

      <!-- Matrix planning table -->

      <div id="matrix-1" class="animated fadeInUp" style="margin-top:60px;display:none">
        <h1 id="matrix-1-title" class="title-center">Matriz de marco lógico de intervención</h1>
        <p class="description-center">Es una herramienta que permite planificar con base a objetivos y la priorización de los mismos; describe los fines, propósitos, resultados y acciones, e indica los recursos  y costes necesarios para realizarlas.</p>
        <div class="table-responsive">
          <table id="matrix-1-table" class="table table-hover cool-table animated fadeIn">
            <thead>
              <tr>
                <th style="width:20%; padding-left:60px">Nivel</th>
                <th style="width:20%;">Resumen narrativo</th>
                <th style="width:20%;">Indicadores</th>
                <th style="width:20%;">Medios de verificación</th>
                <th style="width:20%;">Supuestos</th>
                <th style="width:10%;"></th>
              </tr>
            </thead>
            <tbody id="matrix-1-table-body">
              @foreach($matrix_planning as $m1)
              <tr>
                <td style="padding-left:60px"><strong>{{$m1->level}}</strong></td>
                <td>{{$m1->narrative_summary}}</td>
                <td>{{$m1->indicators}}</td>
                <td>{{$m1->means_of_verification}}</td>
                <td>{{$m1->assumptions}}</td>
                <td><button type="button" class="cool-button-option" onclick="toEdit({{$m1->id}})"><i class="fa fa-pencil"></i></button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="center-text-div animated fadeIn" id="options-matrix-1">
          <button type="button" id="matrix-1-button" class="cool-button hvr-grow" onclick="prepareAddLevelDialog()">Continuar</button>
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
        <h4 class="modal-title">Registro de plan de trabajo</h4>
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
  const LEVEL_GOAL = 0;
  const LEVEL_PURPOSE = 1;
  const LEVEL_COMPONENT = 2;
  const LEVEL_ACTIVITY = 3;
  var team_count = {!! count($squad) !!};
  var current_workplan = {!! $working_plan->id !!};
  var menu_bar = document.getElementById('sidebar');
  var username = '{!! $username !!}';
  var status = {!! $working_plan->status !!};
  var flag_matrix_1 = {!! (is_null($last_level))?-1:$last_level->index !!};
  var how_many_components = {!! ($how_many_components===0)?1:$how_many_components !!};
  var how_many_activities = {!! ($how_many_activities===0)?1:$how_many_activities !!};
  var current_level;
  console.log('last level: '+flag_matrix_1);
  console.log('components: '+{!! $how_many_components !!});
  console.log('activities: '+{!! $how_many_activities !!});
  //initialize ui


  if(parseInt(flag_matrix_1) === -1){
    document.getElementById('empty-box').style.display = 'block';
    flag_matrix_1 = LEVEL_GOAL;
  }else{
    document.getElementById('workplan-presentation').style.display = 'block';
    document.getElementById('matrix-1').style.display = 'block';
    document.getElementById('matrix-1-table').style.display = 'block';

    updateProgress();
    nextOptionMatrix1();
  }

  $('#start-button').click(function(){
    document.getElementById('empty-box').style.display = 'none';
    document.getElementById('matrix-1').style.display = 'block';
    $('html,body').animate({scrollTop: $("#matrix-1").offset().top-140},'slow');
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
      $(this).val($(this).val() + how_many_components + '. ');
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
                  $('html,body').animate({scrollTop: $("#matrix-1").offset().top-140},'slow');
              }
          },
      });
    }

  });

  $('#cancel-matrix-1-button').click(function(){
    $('html,body').animate({scrollTop: $("#matrix-1").offset().top-140},'slow');
    returnToMatrix1();
  });

  function returnToMatrix1(){
    document.getElementById('add-dialog-1').classList.remove("fadeInUp");
    document.getElementById('add-dialog-1').className += " fadeOutDown";
    document.getElementById('options-matrix-1').classList.remove("fadeOut");
    document.getElementById('options-matrix-1').className += " fadeIn";

    $('#narrative').val('');
    $('#indicators').val('');
    $('#verification').val('');
    $('#assumptions').val('');
  }

  function nextOptionMatrix1(){
    switch (flag_matrix_1) {
      case LEVEL_GOAL:
        flag_matrix_1 = LEVEL_PURPOSE;
        $('#options-matrix-1').empty();
        $('#options-matrix-1').append('<button type="button" id="matrix-1-button" class="cool-button hvr-grow" onclick="prepareAddLevelDialog()">Continuar con el propósito</button>');
        returnToMatrix1();
        break;
      case LEVEL_PURPOSE:
        flag_matrix_1 = LEVEL_COMPONENT;
        $('#options-matrix-1').empty();
        $('#options-matrix-1').append('<button type="button" id="matrix-1-button" class="cool-button hvr-grow" onclick="prepareAddLevelDialog()">Continuar con el componente 1</button>');
        returnToMatrix1();
        break;
      case LEVEL_COMPONENT:
        flag_matrix_1 = LEVEL_ACTIVITY;

        how_many_components += 1;
        $('#options-matrix-1').empty();
        $('#options-matrix-1').append('<button type="button" id="matrix-1-button-b" class="cool-button hvr-grow" onclick="anotherSameLevel()">Agregar componente '+how_many_components+'</button><button type="button" id="matrix-1-button" class="cool-button hvr-grow" onclick="prepareAddLevelDialog()" style="margin-left:20px">Continuar las actividades</button><br><p style="font-size:14px;padding:20px 70px">Usa la opción <strong>Continuar con las actividades</strong> sólo si haz terminado de ingresar los componentes.</p>');
        returnToMatrix1();
        break;
      case LEVEL_ACTIVITY:
        flag_matrix_1 = LEVEL_ACTIVITY;

        if(how_many_activities === how_many_components-1){
          $('#options-matrix-1').empty();
          $('#options-matrix-1').append('<h3 style="font-weight:bold;margin-top:64px;">¡Haz terminado la matriz de marco lógico!</h3><br><p style="font-size:14px;padding: 0px 70px">Ahora continúa la matriz de seguimiento de indicadores, ¿estás listo para comenzar con eso?<br>Si deseas continuar en otro momento o darle el turno a alguno de tus compañeros, puedes salir de este sitio sin problemas. Todos tus cambios han sido guardados.</p><br><button type="button" class="cool-button bg-orange hvr-grow" onclick="">Continuar con la matriz de seguimiento de indicadores</button>');
          returnToMatrix1();
          $('html,body').animate({scrollTop: $("#options-matrix-1").offset().top-120},'slow');
        }else{
          how_many_activities += 1;
          $('#options-matrix-1').empty();
          $('#options-matrix-1').append('<button type="button" id="matrix-1-button-b" class="cool-button hvr-grow" onclick="prepareAddLevelDialog()">Agregar actividades del componente '+how_many_activities+'</button>');
          returnToMatrix1();
        }
        break;
      default:
        break;
    }
  }

  function anotherSameLevel(){
    flag_matrix_1 -= 1;
    prepareAddLevelDialog();
  }

  function prepareAddLevelDialog(repeat){
    document.getElementById('add-dialog-1').style.display = 'block';
    document.getElementById('narrative').focus();
    document.getElementById('add-dialog-1').classList.remove("fadeOutDown");
    document.getElementById('add-dialog-1').className += " fadeInUp";
    document.getElementById('options-matrix-1').classList.remove("fadeIn");
    document.getElementById('options-matrix-1').className += " fadeOut";
    $('html,body').animate({scrollTop: $("#add-dialog-1").offset().top-40},'slow');

    switch (flag_matrix_1) {
      case LEVEL_GOAL:
        current_level = "Fin";
        document.getElementById('title-level').innerHTML = "¿Cuál es el fin?"
        document.getElementById('description-level').innerHTML = "En los siguientes campos defines cómo el proyecto contribuye en el largo plazo a la solución del problema o satisfacción de una necesidad que se ha diagnosticado. El proyecto puede no ser suficiente para alcanzar el fin pero si debe contribuir significativamente a ello."
        break;
      case LEVEL_PURPOSE:
        current_level = "Propósito";
        document.getElementById('title-level').innerHTML = "¿Cuál es el propósito?"
        document.getElementById('description-level').innerHTML = "Se refiere al resultado esperado al final del periodo de ejecución del proyecto. El proyecto debe tener un único propósito."
        break;
      case LEVEL_COMPONENT:
        current_level = how_many_components + ". Componente";
        document.getElementById('title-level').innerHTML = "Componente " + how_many_components;
        document.getElementById('description-level').innerHTML = "Son los productos o servicios reales que genera el proyecto. Se expresan como acciones terminadas que se entregarían en las fechas previstas durante la ejecución del proyecto. Cada componente debe ser necesario para lograr el propósito del proyecto."
        break;
      case LEVEL_ACTIVITY:
        current_level = how_many_activities + ". Actividades";
        document.getElementById('title-level').innerHTML = "Define las actividades del componente " + how_many_activities;
        document.getElementById('description-level').innerHTML = "Son el grupo de las principales actividades requeridas para producir cada componente, se deben indicar costos de los recursos para la realización de actividades."
        break;
      default:

    }
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

  function updateTableMatrix1(data){
    $('#matrix-1-table-body').append('<tr><td style="padding-left:60px"><strong>'+data.level+'</strong></td><td>'+data.narrative_summary+'</td><td>'+data.indicators+'</td><td>'+data.means_of_verification+'</td><td>'+data.assumptions+'</td><td><button type="button" class="cool-button-option" onclick="toEdit('+data.id+')"><i class="fa fa-pencil"></i></button></td></tr>');
  }

  function updateProgress(){
    $('#workplan-presentation').show();

    var completed_index = team_count + 2 + 4 + 4 + 1; //perfiles mono + perfiles multi-conv + level-matrix1 + level-matrix-2 + levels-matrix3
    var completed = flag_matrix_1; // to do

    var progress = completed * 100 / completed_index;

    document.getElementById('bar').style.width = progress + "%";
    document.getElementById('progress-info').innerHTML = "Progreso de avance de registro de plan de trabajo: " + parseInt(progress) + "%";
  }

</script>

@endsection
