<!--

MIT License

Copyright (c) 2019 Carlos Paiz.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

-->

@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="sheet" class="ibox float-e-margins white-bg">

      <!-- Experiences view -->

      <div id="send-box" class="search-box">
        <h1 id="send-title" class="send-box-title">Informe {{$report_type}} de actividades</h1>
        <p id="send-subtitle" class="send-box-subtitle"></p>
        <label id="send-box-counter" class="send-box-counter">1500</label>
        <textarea id="experiences-input" class="experiences-input animated fadeInDown" placeholder="Redacta un resumen sobre las experiencias aprehendidas durante el mes. Recuerda mencionar el mes dentro de tu narrativa y toma en cuenta que este espacio está limitado a un promedio de 250 palabras. El contador en la parte superior te indica los caracteres disponibles." maxlength="1500" rows="25">{{$plan->experiences}}</textarea>
        <button id="send-close-button" type="button" class="search-close-button animated rotateIn"><i class="fa fa-close"></i></button>
        <button id="send-button" type="button" class="send-button hvr-grow"><i class="fa fa-paper-plane-o"></i></button>
      </div>

      <!-- Title bar -->

      <div class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{ url('plan')}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">{{$inform}} de {{$plan->month}}</h1>
                        <h4>{{($report_type == "quincenal")?15:1}} al {{$how_many_days}} de {{$plan->month}} de {{$year}}</h4>
                    </div>
                </div>
          </div>
      </div>

      <!-- Announcement -->

      @if($plan->status === 1)
      <div class="announcement animated fadeInDown">
        <h3>Tu informe está ahora en proceso de correcciones.</h3>
        <p>Cuando tu supervisor lo haya revisado se te notificará para que puedas hacer cambios, si los hay.</p>
      </div>
      @endif

      <!-- No objectives view-->

      <div id="empty-box" class="cool-empty animated fadeInUp">
        <div class="cool-empty-text">
          <p>Aquí aparecerán los objetivos que guardes.</p>
          <p style="font-size:14px;">Para comenzar haz clic en el botón <strong>+</strong></p>
          <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a>
        </div>
      </div>

      <!-- Add objectives view -->

      <div id="add-dialog" class="cool-form">
        <div class="animated fadeInUp">
          <form class="form-horizontal">
          <div class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <label class="col-sm-10 title-form"><a id="add-o" class="text-menu-report"><i class="fa fa-plus"></i> Nuevo objetivo</a><a hidden id="add-followed-up" class="text-menu-report" style="margin-left:20px"><i class="fa fa-refresh"></i> Seguimiento de objetivo</a><a id="add-shared-o" class="text-menu-report" style="margin-left:20px"><i class="fa fa-share-alt"></i> Objetivos en equipo</a></label>
          </div>

          <!--New Objective View-->

          <div id="view-new-objective" class="animated fadeInUp">

          <div class="form-group"><label class="col-sm-2 control-label box-label">Objetivo</label>
            <div class="col-sm-10">
              <textarea id="objective" class="box-taco-line" placeholder="Define un objetivo" maxlength="400" rows="1" onkeyup="autosizeText(this)"></textarea>
              <!--<input id="objective1" type="text" class="cool-input" placeholder="Define un objetivo"></input>-->
              <h4 id="autocomplete-objective" class="hvr-grow animated fadeIn" onclick="autocompleteObjective()"><a style="color:#aaa"><i class="fa fa-bolt"></i> Completar este campo con un objetivo sugerido de la metodología de EPSUM</a></h4>
              <p id="autocomplete-objective-info" style="display:none;font-size:14px;color:#f68628"><i class="fa fa-warning"></i> Asegúrate de que vas a usar este objetivo en la fase correcta de tu intervención y que no lo agregaste antes. Si lo usaste antes y necesitas darle seguimiento, búscalo en <strong>seguimiento de objetivo</strong> para actualizarlo.</p>
            </div>
          </div><br>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Actividades</label>
            <div class="col-sm-10">
              <textarea id="todolist" class="box-taco todolist" placeholder="• Lista las actividades que ayudarán a cumplir el objetivo" maxlength="1024" rows="5" onfocusout="resetText()"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>

            <div style="float:left; padding-left:16px">
              <label class="container">Este objetivo es en equipo
                <input id="isGroup" type="checkbox" name="check">
                <span class="checkmark chk-yes"></span>
              </label>
            </div>
            <a class="info hvr-pop" style="float:left;padding-top:0px;font-size:20px;color:#d3d3d3"><i class="fa fa-info-circle"></i></a>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>
            <div class="col-sm-10 iradio_square-green checked">
              <button type="button" id="save-button" class="cool-button hvr-grow">Guardar</button>
              <button type="button" id="cancel-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
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
                <p style="font-size:14px;margin-right:96px;">Esta opción te será útil luego de tu primer informe de mes. Haz clic en <i class="fa fa-plus"></i> <strong>Nuevo objetivo</strong> para comenzar. También puedes intentar agregar uno desde <i class="fa fa-share-alt"></i><strong> Objetivos en equipo</strong>.<br><br></p>
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

      <!-- Main objectives table -->

      <div>
        <div class="table-responsive">
          <div id="table-loader" style="display:none;height:500px"><div class="loader"></div></div>
          <table id="table-box" class="table table-hover cool-table animated fadeIn" >
            <thead>
              <tr>
                <th style="width:30%; padding-left:60px">Objetivo</th>
                <th style="width:30%;">Actividades</th>
                <th style="width:15%;">Resultados</th>
                <th style="width:15%;">Aciertos/Desaciertos</th>
                <th style="width:10%;"></th>
              </tr>
            </thead>
            <tbody>
            @if($objectives_count > 0)
              @foreach($objective as $o)
              <tr class="animated">
                <td style="padding-left:60px;"><strong>{{$o->objective}} @if($o->isGroup === 1)<p style="color:#ccc">• Objetivo de equipo</p>@endif</strong></td>
                <td>{{$o->activities}}</td>
                @if($o->results == null)
                <td colspan="2"><button type="button" class="cool-button-secoundary hvr-grow" onclick="toResults({{$o->id}})">Tengo los resultados</button></td>
                @else
                <td>{{$o->results}}</td>
                <td><strong>Aciertos: </strong>{{$o->hits}} <br><br><strong>Desaciertos: </strong>{{$o->failures}}</td>
                @endif

                @if($plan->status === 0)
                  @if($o->isGroup)
                  <td><button type="button" class="cool-button-option" onclick="toEdit({{$o->id}})"><i class="fa fa-pencil"></i></button></br><button type="button" class="cool-button-option-record" onclick="showRecord({{$o->id}})"><i class="fa fa-history"></i></button></br><button type="button" class="cool-button-option-delete" onclick="removeRow(this,{{$o->id}})"><i class="fa fa-close"></i></button></br></td>
                  @else
                  <td><button type="button" class="cool-button-option" onclick="toEdit({{$o->id}})"><i class="fa fa-pencil"></i></button></br><button type="button" class="cool-button-option-delete" onclick="removeRow(this,{{$o->id}})"><i class="fa fa-close"></i></button></br></td>
                  @endif
                @else
                <td></td>
                @endif
              </tr>
              @endforeach
            @endif
            </tbody>
          </table>
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
              <textarea id="objective-edit" class="box-taco" placeholder="Define un objetivo" maxlength="400"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label">Actividades</label>
            <div class="col-sm-10">
              <textarea id="todolist-edit" class="box-taco" placeholder="Lista las actividades que ayudarán a cumplir el objetivo" maxlength="1024" rows="5"></textarea>
            </div>
          </div>

          <div id="results-dialog" class="form-group"><label class="col-sm-2 control-label box-label"></label>
              <label class="col-sm-10 title-form"><i class="fa fa-arrow-up"></i> Resultados</label>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Resultado/Indicador</label>
            <div class="col-sm-1">
              <input id="result-amount" type="text" class="cool-input" placeholder="Cant." onkeypress="return isNumberKey(event)" style="text-align:center;padding:0px 2px 8px 2px"></input>
            </div>
            <div class="col-sm-3">
              <div><!--<div class="editable-select-arrow">-->
                <input type="hidden" id="result-id">
                <select id="results-select">
                  @foreach($results as $result)
                    <option data-id="{{$result->id}}">{{$result->description}}</option>
                  @endforeach
                  <option data-id="1">Otro...</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <input id="result-description" type="text" class="cool-input" placeholder="Descripción"></input>
            </div>
            <div class="col-sm-2">
              <button type="button" id="add-result" class="cool-button-secoundary">Agregar</button>
              <!--<button type="button" id="clear-results" class="cool-button-option-record" onclick="" style="float:right"><i class="fa fa-undo"></i></button>-->
            </div>
          </div>


          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary"></label>
            <div class="col-sm-10" style="display:inline-block">
              <p style="color:#aaa"><strong style="color:#2ebeef">Ayuda:</strong> Si tu resultado es <strong>cuantitativo</strong>, ingresa una cantidad (si no lo es, deja el campo Cant. en blanco), selecciona el resultado/indicador propuesto, ingresa una descripción complementaria y luego haz clic en <strong>Agregar</strong>. Si tu resultado no encaja en ninguna clasificación, selecciona <strong>"Otro..."</strong> al final de la lista y especifica en la descripción tu resultado. <strong style="color:#2ebeef">Ejemplo:</strong> Cantidad: <strong>2</strong>, Clasificación del resultado: <strong>Talleres de capacitación</strong>, Descripción: <strong>en la Municipalidad de San Juan Cotzal.</strong></p>
            </div>
          </div>


          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary"></label>
            <div class="col-sm-10">
              <textarea id="results-edit" maxlength="1024" readonly style="margin-left:-2px;font-weight:bold;display:none"></textarea>
              <table style="width:100%">
                <tbody id="table-results-content">
                  <tr id="empty-row">
                    <td colspan="4" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9; font-size:16px;font-weight:bold; border-radius:10px">Los resultados o indicadores que agregues se mostrarán en este espacio</td>
                  </tr>
                </tbody>
              </table>
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
      <input id="username" type="hidden" value="{{$username}}">
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
        <h4 class="modal-title">Registro de planificación</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Por qué debo registrar el plan mensual?</strong> La planificación te ayudará a ti y a tu equipo a cumplir con metas en base a objetivos para realizar actividades. Además, cuando hayas cumplido con los objetivos, podrás ingresar los resultados para que puedas generar tu informe mensual que será revisado por tu supervisor.</p>
        <p><strong>¿Cómo guardo objetivos de equipo?</strong> Para guardar un objetivo que se realiza en equipo sólo debes marcar la casilla <strong>"Este objetivo es en equipo"</strong>, hecho esto, el objetivo estará disponible para otros miembros de tu equipo y podrán agregarlo a sus planes mensuales, de lo contrario, el objetivo se guardará solo para tu planificación.</p>
        <p><strong>¿Puedo agregar más objetivos en otro momento?</strong> Sí, puedes entrar desde la opción de informes mensuales y agregarlos al mes correspondiente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="cool-button hvr-grow" data-dismiss="modal">¡Entendido!</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{asset('js/jquery-editable-select.js')}}"></script>
<script>
  var menu_bar = document.getElementById('sidebar');
  var current_view = null;
  var objectives_count = parseInt("{{$objectives_count}}");
  var planId = "{{$plan->id}}";
  var fab = document.getElementById("add-fab");
  var is_group = 0;
  var current_objective_to_edit = 0;
  var finished_objectives = 0;
  var send_box = document.getElementById("send-box");
  var send_close_button = document.getElementById("send-close-button");
  var send_button = document.getElementById("send-button");
  var experiences_input = document.getElementById("experiences-input");
  var send_box_is_visible = false;
  var sheet = document.getElementById('sheet');
  var auto_save_flag = 250;
  var results_text = document.getElementById('results-edit');
  var menu_new_objective = document.getElementById('add-o');
  var menu_followed_objective = document.getElementById('add-followed-up');
  var menu_shared_objective = document.getElementById('add-shared-o');
  var from_results_button = true;
  var shared_objectives = [];
  var list_from_shared = [];
  var followed_objectives = [];
  var list_from_followed = [];
  var suggestions = {!! json_encode($objectives_suggests) !!};
  var suggestion_index = 0;
  var objective_autor = $('#username').val();
  var results = {!! json_encode($results) !!};

  $("body").toggleClass("mini-navbar");
  SmoothlyMenu();

  //initialize gui elements

  menu_bar.style.top = "0px";
  var h = $(window).height();
  var bar = 61;
  var button_height = 100;
  var pos_y = h-bar-button_height;
  fab.style.display = "block";
  fab.style.top = pos_y+"px";
  var origOffsetY = fab.offsetTop;
  var origBar = 0;

  function onScroll(e) {
    var pos = origOffsetY+window.scrollY;
    var posBar = origBar+window.scrollY;
    menu_bar.style.top = posBar+"px";
    fab.style.top = pos+"px";
  }

  document.addEventListener('scroll', onScroll);
  document.getElementById("base").style.height = "600px";

  if(parseInt('{{$plan->status}}') === 1){
    fab.style.display = "none";
    send_button.style.display = "none";
  }

  if(objectives_count == 0){
    current_view = document.getElementById('empty-box');
  }else{
    current_view = document.getElementById('table-box');
  }

  current_view.style.display = "block";

  //actions for controls

  $('#add-fab').click( function(){
      document.getElementById('add-dialog').style.display = "block";
      menu_new_objective.className += " text-menu-report-active";
      current_view.style.display = "none";
      document.getElementById('objective').focus();
      $('html,body').animate({scrollTop: $("#add-dialog").offset().top},'slow');

      fab.classList.remove("bounceIn");
      fab.className += " bounceOut";
      return false;
  });

  $(".todolist").focus(function() {
      if(document.getElementById('todolist').value === ''){
          document.getElementById('todolist').value +='• ';
  	  }
  });

  $(".todolist").keyup(function(event){
  	var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
          document.getElementById('todolist').value +='\n• ';
  	}
  	var txtval = document.getElementById('todolist').value;
  	if(txtval.substr(txtval.length - 1) == '\n'){
  		document.getElementById('todolist').value = txtval.substring(0,txtval.length - 1);
  	}
  });

  $("#results-edit").keyup(function(event){
  	var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
          document.getElementById('results-edit').value +='\n\n';
  	}
  	var txtval = document.getElementById('results-edit').value;
  	if(txtval.substr(txtval.length - 1) == '\n'){
  		document.getElementById('results-edit').value = txtval.substring(0,txtval.length - 1);
  	}
  });

  $("#save-button").click(function(){
    if(validateFields()){
      var re = new RegExp('• ','g');
      var activities_formatted = document.getElementById("todolist").value.replace(re,'');

      $.ajax({
          type: 'post',
          url: '{{asset("add/obj")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'objective': $('#objective').val(),
              'activities': activities_formatted,
              'isGroup': $('#isGroup').is(":checked")?1:0,
              'student': "{{ $student->id_student }}",
              'plan': "{{ $plan->id }}",
              'user_create' : objective_autor,
              'user_update' : $('#username').val()
          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_REG_OBJECTIVE');
              } else {
                  console.log('SUCCESS_REG_OBJECTIVE');
                  assignObjectiveToPlan(planId,data);
                  logThis(0,data);
              }
          },
      });

      objectives_count += 1;
      current_view = document.getElementById('table-box');

      returnToMain();
    }
  });

  $('#add-o').click( function(){
    menu_shared_objective.classList.remove("text-menu-report-active");
    menu_followed_objective.classList.remove("text-menu-report-active");
    menu_new_objective.className += " text-menu-report-active";

    document.getElementById('view-new-objective').style.display = "block";
    document.getElementById('view-shared-objectives').style.display = "none";
    document.getElementById('view-empty-shared-objectives').style.display = "none";
    document.getElementById('view-followed-objectives').style.display = "none";
    document.getElementById('view-empty-followed-objectives').style.display = "none";
  });

  $('#add-shared-o').click( function(){
    $('html,body').animate({scrollTop: $("#add-dialog").offset().top},'slow');
    menu_new_objective.classList.remove("text-menu-report-active");
    menu_followed_objective.classList.remove("text-menu-report-active");
    menu_shared_objective.className += " text-menu-report-active";

    document.getElementById('view-new-objective').style.display = "none";
    document.getElementById('view-followed-objectives').style.display = "none";
    document.getElementById('view-empty-followed-objectives').style.display = "none";
    document.getElementById('loader').style.display = "block";

    setTimeout(function(){
      document.getElementById('loader').style.display = "none";
    }, 300);

    $.get('{{asset("list/shared/objectives/plan")}}'.replace('plan',planId), function (data) {
      $('#table-shared-objectives').empty();

      if(data.length === 0){
        document.getElementById('view-empty-shared-objectives').style.display = "block";
      }else{
        shared_objectives = data;
        document.getElementById('view-shared-objectives').style.display = "block";
        $('#table-shared-objectives').append('<tbody>');

        data.forEach(function(data){
          $('#table-shared-objectives').append('<tr><td rowspan="3"><div style="float:left; padding-left:16px"><label class="container" style="width:0"><input onclick="addObjectiveToList(this,'+data.id+')" type="checkbox" name="check-c"><span class="checkmark chk-yes"></span></label></div></td><td style="font-size:18px;font-weight:bold;padding-top:20px;">'+data.objective+'</td></tr><tr><td style="font-size:14px;color:#9a9a9a">Autor(a): <strong>'+data.user_create+'</strong>. Última modificación por: <strong>'+data.user_update+'</strong></td></tr><tr class="row-table-corrections-comment"><td style="font-size:14px;color:#9a9a9a;padding-bottom:20px;">Planificado en <strong>'+data.month+'</strong></td></tr>');
        });
        $('#table-shared-objectives').append('</tbody>');
      }
    });

  });

  $('#add-followed-up').click( function(){
    $('html,body').animate({scrollTop: $("#add-dialog").offset().top},'slow');
    menu_new_objective.classList.remove("text-menu-report-active");
    menu_shared_objective.classList.remove("text-menu-report-active");
    menu_followed_objective.className += " text-menu-report-active";

    document.getElementById('view-new-objective').style.display = "none";
    document.getElementById('view-shared-objectives').style.display = "none";
    document.getElementById('view-empty-shared-objectives').style.display = "none";
    document.getElementById('loader').style.display = "block";

    setTimeout(function(){
      document.getElementById('loader').style.display = "none";
    }, 300);

    $.get('{{asset("list/followed/objectives/plan")}}'.replace('plan',planId), function (data) {
      $('#table-followed-objectives').empty();

      if(data.length === 0){
        document.getElementById('view-empty-followed-objectives').style.display = "block";
      }else{
        shared_objectives = data;
        document.getElementById('view-followed-objectives').style.display = "block";
        $('#table-followed-objectives').append('<tbody>');

        data.forEach(function(data){
          $('#table-followed-objectives').append('<tr><td rowspan="3"><div style="float:left; padding-left:16px"><label class="container" style="width:0"><input onclick="addObjectiveToList(this,'+data.id+')" type="checkbox" name="check-c"><span class="checkmark chk-yes"></span></label></div></td><td style="font-size:18px;font-weight:bold;padding-top:20px;">'+data.objective+'</td></tr><tr><td style="font-size:14px;color:#9a9a9a">Autor(a): <strong>'+data.user_create+'</strong>. Última modificación por: <strong>'+data.user_update+'</strong></td></tr><tr class="row-table-corrections-comment"><td style="font-size:14px;color:#9a9a9a;padding-bottom:20px;">Planificado en <strong>'+data.month+'</strong></td></tr>');
        });
        $('#table-followed-objectives').append('</tbody>');
      }
    });

  });

  $('#save-from-shared').click( function(){
    list_from_shared.forEach(function(objectiveID) {
      var objective = shared_objectives.find(item => item.id === objectiveID);
      assignObjectiveToPlan(planId,objective);
    });

    objectives_count += 1;
    current_view = document.getElementById('table-box');

    returnToMain();
  });

  $('#save-from-followed').click( function(){
    list_from_shared.forEach(function(objectiveID) {
      var objective = shared_objectives.find(item => item.id === objectiveID);
      assignObjectiveToPlan(planId,objective);
    });

    objectives_count += 1;
    current_view = document.getElementById('table-box');

    returnToMain();
  });

  $("#cancel-button").click(function(){
      returnToMain();
  });

  $(".info").click(function(){
    swal({
      title:"Objetivos de equipo",
      text:"Cuando marcas la casilla de objetivo de equipo, el resto de integrantes de tu mismo equipo podrán verlo y agregarlo a sus planes mensuales. De otra forma, el objetivo se guardará como individual.",
      confirmButtonColor: "#2ebeef"
    });
  })

  $('#result-amount').click(function(){
    $('html,body').animate({scrollTop: $("#results-dialog").offset().top-50},'slow');
  });

  $('#results-select').editableSelect('holder','Clasificación del resultado').on('select.editable-select', function (e, el) {
		$('#result-id').val(el.data('id'));
    //pass the focus to the next input
    setTimeout(function(){
      $('#result-description').focus();
    },200);
	});;

  $('#timeline-up-button').click( function(){
    $('html,body').animate({scrollTop: $("#title").offset().top+20},'slow');
  });

  $("#update-button").click(function(){
    if($("#objective-edit").val() && $("#todolist-edit").val()){

      var re = new RegExp('• ','g');
      var activities_formatted = document.getElementById("todolist-edit").value.replace(re,'');

      $.ajax({
          type: 'post',
          url: '{{asset("update/obj")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'id': current_objective_to_edit,
              'objective': $('#objective-edit').val(),
              'activities': activities_formatted,
              'results': $('#results-edit').val(),
              'hits': $('#hits-edit').val(),
              'failures': $('#failures-edit').val(),
              'isGroup': $('#isGroup-edit').is(":checked")?1:0,
              'student': "{{ $student->id_student }}",
              'plan': "{{ $plan->id }}",
              'user_create' : $('#username').val(),
              'user_update' : $('#username').val()
          },
          success: function(data) {
              if (data.errors) {
                  console.log('ERROR_UPD_OBJECTIVE');
              } else {
                  (from_results_button)?logThis(2,data):logThis(3,data);
                  console.log('SUCCESS_UPD_OBJECTIVE');

                  $.get('{{asset("list/objectives/plan")}}'.replace('plan',planId), function (data) {
                    $('#table-box').empty();

                    if(data.length == 0){
                      console.log("NO_DATA_FROM_DATABASE:03");
                    }else{
                      $('#table-box').append('<thead><tr><th style="width:30%; padding-left:60px">Objetivo</th><th style="width:30%;">Actividades</th><th style="width:15%;">Resultados</th><th style="width:15%;">Aciertos/Desaciertos</th><th style="width:10%;"></th></tr></thead>');
                      $('#table-box').append('<tbody>');

                      data.forEach(function(data){
                        updateTableView(data);
                      });
                      $('#table-box').append('</tbody>');

                      toastr.success('Se actualizó el objetivo','¡Hecho!');
                    }
                  });
              }
          },
      });

      document.getElementById('edit-dialog').style.display = "none";
      document.getElementById('table-loader').style.display = "block";
      setTimeout(function(){
        document.getElementById('table-loader').style.display = "none";
        current_view.style.display = "block";
      }, 700);

      fab.classList.remove("bounceOut");
      fab.className += " bounceIn";

      returnToMain();
    }else{
      swal({
          title: "Falta información",
          text: "Verifica que has llenado todos los campos",
          confirmButtonColor: "#2ebeef"
      });
    }
  });

  $('#experiences-input').keyup(function(){
    $('#send-box-counter').text(1500-($(this).val().length));
    $(this).val().length == 0 ? send_button.disabled = true : send_button.disabled = false;
    if($(this).val().length == auto_save_flag){
      updateExperiences();
      var d = new Date();
      document.getElementById("send-subtitle").innerHTML = 'Guardado automáticamente por última vez a las '+d.getHours()+':'+d.getMinutes();
      auto_save_flag += 250;
    }
  });

  $("#cancel-edit-button").click(function(){
    document.getElementById('edit-dialog').style.display = "none";
    current_view.style.display = "block";

    fab.classList.remove("bounceOut");
    fab.className += " bounceIn";
    $('html,body').animate({scrollTop: $("#sheet").offset().top-100},'slow');
  });

  $('#send-close-button').click( function(){
      showSendBox(send_box_is_visible);
  });

  $('#send-button').click( function(){
    if(send_box_is_visible){
      updateExperiences();
      setTimeout(function(){
        location.href="{{ url('monthly/report/preview/'.$plan->nmonth)}}";
      }, 400);
    }else{
      if(objectives_count == 0){
        swal({
            title: "Aún no puedes enviarlo :(",
            text: "Usa esta opción cuando hayas ingresado los objetivos y tengas los resultados.",
            confirmButtonColor: "#2ebeef"
        });
      }else{
        $.get('{{asset("finished/objs/plan")}}'.replace('plan',planId), function (data) {
          if(data == objectives_count){
            showSendBox(send_box_is_visible);
          }else{
            swal({
                title: "Todavía no puedes enviarlo :(",
                text: "¡Asegúrate de completar los resultados, aciertos y desaciertos!",
                confirmButtonColor: "#2ebeef"
            });
          }
        });
      }
    }
  });

  $('#add-result').click(function(){
    //defines if a result is cuantitative (1) or not (cualitative, 0)
    var is_cuantitative = ($('#result-amount').val() === '')?0:1;
    var result_text = ($('#result-id').val() === '1')?'' + (($('#result-amount').val()==='0')?'':$('#result-amount').val()) + ' ' + $('#result-description').val():'' + (($('#result-amount').val()==='0')?'':$('#result-amount').val()) + ' ' + $('#results-select').val() + ' ' + $('#result-description').val();

    if($('#results-select').val() === ''){
      swal({
          title: "Falta información",
          text: "Ingresa por lo menos una clasificación de resultado y una descripción.",
          confirmButtonColor: "#2ebeef"
      });
    }else{
      $.ajax({
          type: 'post',
          url: '{{asset("add/result")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'objective': current_objective_to_edit,
              'result': $('#result-id').val(),
              'amount': $('#result-amount').val(),
              'description': $('#result-description').val(),
              'cuantitative': is_cuantitative
          },
          success: function(data) {
              if (data.errors) {
                  console.log('ERROR_REG_RESULT');
              } else {
                  console.log('SUCCESS_REG_RESULT');

                  updateTableResults(data,result_text);
                  updateResultsField();
              }
          },
      });

      $('#results-select').editableSelect('clean');
      $('#results-select').editableSelect('filter');
      $('#result-description').val('');
      document.getElementById('result-amount').value = '';
      document.getElementById('result-amount').focus();
    }

  });

  //operations for report/plan

  function assignObjectiveToPlan(plan,objective){
    $.ajax({
        type: 'post',
        url: '{{asset("assign/obj")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'objective': objective.id,
            'plan': plan,
            'user_create' : $('#username').val(),
            'user_update' : $('#username').val()
        },
        success: function(data_assignment) {
            if ((data_assignment.errors)) {
                console.log('ERROR_ASSING_OBJECTIVE_TO_PLAN');
            } else {
                console.log('SUCCESS_ASSING_OBJECTIVE_TO_PLAN');
                $('#table-box').append('<tbody>');
                updateTableView(objective);
                $('#table-box').append('</tbody>');

                logThis(1,objective);
                toastr.success('Se agregó el objetivo a tu plan','¡Objetivo guardado!');
            }
        },
    });
  }

  function toEdit(id){
    document.getElementById('edit-dialog').style.display = "block";
    current_view.style.display = "none";
    document.getElementById('objective-edit').focus();
    $('html,body').animate({scrollTop: $("#edit-dialog").offset().top},'slow');

    getObjective(id);

    fab.classList.remove("bounceIn");
    fab.className += " bounceOut";
    current_objective_to_edit = id;
    from_results_button = false;
  }

  function validateFields(){
    if(!$("#objective").val() || !$("#todolist").val()){
        swal({
            title: "Falta información",
            text: "Verifica que has llenado todos los campos",
            confirmButtonColor: "#2ebeef"
        });
        return false;
    }
    return true;
  }

  function removeRow(btn,id_obj){

    swal({
        title: "¿Deseas desasignar este objetivo?",
        text: "Si el objetivo es compartido será removido sólo de tu planificación",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "¡Sí, quiero quitarlo!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function () {

      $.ajax({
          type: 'post',
          url: '{{asset("unasign/obj")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'plan': planId,
              'objective': id_obj
          },
          success: function(data) {
              objectives_count -= 1;
              console.log("ITEM_DELETED");
              //logThis(6,data);
          }
        });

        var row = btn.parentNode.parentNode;
        row.className += " bounceOutRight";

        var interval = setInterval(function() {
          if(row != null){
            row.parentNode.removeChild(row);
            row = null;
          }
        }, 400);

        swal("¡Registro eliminado!", "El objetivo fue removido de tu plan", "success");
    });
  }

  function updateTableView(data){
    var is_group_label = (data.isGroup === 1)?'<p style="color:#ccc">• Objetivo de equipo</p>':'';
    if(data.results == null || data.results == ''){
      $('#table-box').append('<tr class="animated"><td style="padding-left:60px;"><strong>'+data.objective+is_group_label+'</strong></td><td>'+data.activities+'</td><td colspan="2"><button type="button" class="cool-button-secoundary hvr-grow" onclick="toResults('+data.id+')">Tengo los resultados</button></td><td><button type="button" class="cool-button-option" onclick="toEdit('+data.id+')"><i class="fa fa-pencil"></i></button></br><button type="button" class="cool-button-option-record" onclick="showRecord('+data.id+')"><i class="fa fa-history"></i></button></br><button type="button" class="cool-button-option-delete" onclick="removeRow(this,'+data.id+')"><i class="fa fa-close"></i></button></br></td></tr>');
    }else{
      $('#table-box').append('<tr class="animated"><td style="padding-left:60px;"><strong>'+data.objective+is_group_label+'</strong></td><td>'+data.activities+'</td><td>'+data.results+'</td><td><strong>Aciertos: </strong>'+data.hits+'<br><br><strong>Desaciertos: </strong>'+data.failures+'</td><td><button type="button" class="cool-button-option" onclick="toEdit('+data.id+')"><i class="fa fa-pencil"></i></button></br><button type="button" class="cool-button-option-record" onclick="showRecord('+data.id+')"><i class="fa fa-history"></i></button></br><button type="button" class="cool-button-option-delete" onclick="removeRow(this,'+data.id+')"><i class="fa fa-close"></i></button></br></td></tr>');
    }

  }

  function toResults(id){
      current_objective_to_edit = id;
      document.getElementById('edit-dialog').style.display = "block";
      current_view.style.display = "none";
      $('html,body').animate({scrollTop: $("#results-dialog").offset().top-50},'slow');

      getObjective(id);

      document.getElementById('result-amount').focus();
      fab.classList.remove("bounceIn");
      fab.className += " bounceOut";
      from_results_button = true;
      return false;
  };

  function getObjective(id){
    $.get('{{asset("get/obj/id")}}'.replace('id',id), function (data) {
      if(data.length == 0){
        console.log("NO_DATA_FROM_DATABASE:04");
      }else{
        $('#objective-edit').val(data.objective);
        $('#todolist-edit').val(data.activities);
        $('#results-edit').val(data.results);
        $('#hits-edit').val(data.hits);
        $('#failures-edit').val(data.failures);

        getResults();

        if(data.isGroup == 0){
          $('#isGroup-edit').prop("checked",false);
        }else{
          $('#isGroup-edit').prop("checked",true);
        }
      }
    });
  }

  function getResults(){
    $('#table-results-content').empty();

    $.get('{{asset("list/results/obj")}}'.replace('obj',current_objective_to_edit), function (data) {
      if(data.length === 0){
        $('#table-results-content').append('<tr id="empty-row"><td colspan="4" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9; font-size:16px;font-weight:bold; border-radius:10px">Los resultados o indicadores que agregues se mostrarán en este espacio</td></tr>');
      }else{
        data.forEach(function(data){
          var res = (data.result === 1)?''+((data.amount===0)?'':data.amount)+' '+data.description:''+((data.amount===0)?'':data.amount)+' '+data.type+' '+data.description;
          updateTableResults(data,res);
        });
      }
    });

  }

  function updateTableResults(data,result){
    $('#empty-row').hide();
    $('#table-results-content').append('<tr class="row-dotted-line"><td>' + result + '</td><td><button type="button" class="cool-button-option-delete" onclick="removeResult(this,'+data.id+')" style="float:right"><i class="fa fa-close"></i></button></td></tr>');
  }

  function removeResult(btn,id){

      $.ajax({
          type: 'post',
          url: '{{asset("remove/result")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'id': id
          },
          success: function(data) {
              console.log("RESULT_DELETED");

              var row = btn.parentNode.parentNode;
              row.parentNode.removeChild(row);

              //update the results objective field
              updateResultsField();
          }
      });

  }

  function updateResultsField(){
    $.get('{{asset("list/results/obj")}}'.replace('obj',current_objective_to_edit), function (data) {
      $('#results-edit').val('');

      if(data.length === 0){
        // to do
      }else{
        data.forEach(function(data){
          var res = (data.result === 1)?''+((data.amount===0)?'':data.amount)+' '+data.description:''+((data.amount===0)?'':data.amount)+' '+data.type+' '+data.description;
          $('#results-edit').val($('#results-edit').val()+res+'\n\n');
        });
      }
    });
  }

  function updateExperiences(){
    $.ajax({
        type: 'post',
        url: '{{asset("update/experiences")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'id': planId,
            'experiences': $('#experiences-input').val()
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_UPD_EXPERIENCES');
            } else {
                console.log('SUCCESS_UPD_EXPERIENCES');
            }
        },
    });
  }

  function updateStatus(status){
    $.ajax({
        type: 'post',
        url: '{{asset("update/plan/status")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'id': planId,
            'status': status
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_UPD_PLAN_STATUS');
            } else {
                console.log('SUCCESS_UPD_PLAN_STATUS');
            }
        },
    });
  }

  function returnToMain(){
    document.getElementById('add-dialog').style.display = "none";
    current_view.style.display = "block";


    $('#objective').val('');
    $('#todolist').val('');
    $('#isGroup').prop("checked",false);
    is_group = 0;

    fab.classList.remove("bounceOut");
    fab.className += " bounceIn";
    $('html,body').animate({scrollTop: $("#sheet").offset().top-100},'slow');
    //restore the add view
    menu_shared_objective.classList.remove("text-menu-report-active");
    menu_followed_objective.classList.remove("text-menu-report-active");

    document.getElementById('view-new-objective').style.display = "block";
    document.getElementById('view-shared-objectives').style.display = "none";
    document.getElementById('view-empty-shared-objectives').style.display = "none";
    document.getElementById('view-followed-objectives').style.display = "none";
    document.getElementById('view-empty-followed-objectives').style.display = "none";
    document.getElementById('record').style.display = "none";
    document.getElementById('objective').rows = 1;

    //restore the suggestions
    document.getElementById('autocomplete-objective').innerHTML = "<a style='color:#aaa'><i class='fa fa-bolt'></i> Completar este campo con un objetivo sugerido de la metodología de EPSUM</a>";
    document.getElementById('autocomplete-objective-info').style.display = "none";
    document.getElementById('autocomplete-objective').style.display = "block";
    document.getElementById('objective').disabled = false;
    suggestion_index = 0;

    list_from_shared = [];
    shared_objectives = [];
  }

  function logThis(type,objective){
    $.ajax({
        type: 'post',
        url: '{{asset("log/obj")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'type': type,
            'description': objective.objective,
            'month' : '{{$plan->month}}',
            'objective' : objective.id
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_REG_LOG');
            } else {
                console.log('SUCCESS_REG_LOG');
            }
        },
    });
  }  

  function addObjectiveToList(check,objective){

    if(check.checked){
      list_from_shared.push(objective);
    }else{
      var index = list_from_shared.indexOf(objective);
      if(index > -1){
        list_from_shared.splice(index,1);
      }
    }
  }

  function showRecord(id){
    var subtitle,icon,date;
    $('html,body').animate({scrollTop: $("#title").offset().top+20},'slow');
    current_view.style.display = "none";
    fab.classList.remove("bounceIn");
    fab.className += " bounceOut";

    document.getElementById('view-new-objective').style.display = "none";
    document.getElementById('record').style.display = "block";
    document.getElementById('loader-record').style.display = "block";

    setTimeout(function(){
      document.getElementById('loader-record').style.display = "none";
    }, 400);

    $.get('{{asset("record/obj")}}'.replace('obj',id), function (data) {

      if(data.length === 0){
        $('#timeline').empty();
        $('#timeline').append('<div class="entry"><div class="title"><h3></h3></div><div class="body"><h3 style="font-weight:bold;">No hay nada que ver por aquí...</h3></div>');
      }else{
        $('#timeline').empty();

        data.forEach(function(data){
          date = $.datepicker.formatDate("dd.mm.yy", new Date(data.created_at));

          switch(data.type) {
            case 0:
              subtitle = "Se creó el objetivo";
              icon = "<i class='fa fa-bookmark'></i>";
              break;
            case 1:
              subtitle = "El objetivo se asignó a un plan";
              icon = "<i class='fa fa-plus'></i>";
              break;
            case 2:
              subtitle = "Se agregaron los resultados del objetivo";
              icon = "<i class='fa fa-refresh'></i>";
              break;
            case 3:
              subtitle = "Registro de cambios en objetivo";
              icon = "<i class='fa fa-pencil'></i>";
              break;
            case 4:
              subtitle = "El supervisor hizo algunas observaciones";
              icon = "<i class='fa fa-commenting-o'></i>";
              break;
            case 5:
              subtitle = "Se hicieron los cambios solicitados a partir de la revisión del supervisor";
              icon = "<i class='fa fa-check'></i>";
              break;
            case 6:
              subtitle = "El objetivo fue removido de una planificación";
              icon = "<i class='fa fa-close'></i>";
              break;
            default:
              subtitle = "";
              icon = "";
          }
          $('#timeline').append('<div class="entry"><div class="title"><div><h3>'+icon+'</h3><p>'+date+'</p></div></div><div class="body"><h3>'+data.activity+'</h3><p>'+subtitle+'</p><ul>'+data.description+'</ul></div></div>');
        });
      }
    });

    document.getElementById('timeline').style.display = "block";
  }

  function showSendBox(is_visible){
    if(is_visible){
      send_box.style.height = "0px";
      send_button.classList.remove("send-button-active");
      send_button.innerHTML = '<i class="fa fa-paper-plane-o"></i>';
      send_button.disabled = false;
      experiences_input.style.display = "none";
      experiences_input.classList.remove("fadeInDown");
      experiences_input.className += " fadeOutUp";
      send_close_button.style.display = "none";
      document.getElementById("send-title").style.display = "none";
      document.getElementById("send-subtitle").style.display = "none";
      document.getElementById("send-box-counter").style.display = "none";
      fab.classList.remove("bounceOut");
      fab.className += " bounceIn";
      send_box_is_visible = false;
    }else{
      send_box.style.width = sheet.offsetWidth+"px";
      send_box.style.height = "720px";
      send_button.className += " send-button-active";
      send_button.innerHTML = "GUARDAR";
      experiences_input.textLength == 0 ? send_button.disabled = true:send_button.disabled = false;
      experiences_input.style.display = "block";
      experiences_input.classList.remove("fadeOutUp");
      experiences_input.className += " fadeInDown";
      send_close_button.style.display = "block";
      document.getElementById("send-title").style.display = "block";
      document.getElementById("send-subtitle").style.display = "block";
      document.getElementById("send-box-counter").style.display = "block";
      fab.classList.remove("bounceIn");
      fab.className += " bounceOut";
      experiences_input.focus();
      send_box_is_visible = true;
    }
  }

  function resetText(){
    if(document.getElementById('todolist').value == '• '){
      document.getElementById('todolist').value = '';
    }
  }

  function autosizeText(textarea){
    var lines = Math.floor(textarea.scrollHeight/20);
    textarea.rows = lines-1;

    if(textarea.value.length === 0){
      document.getElementById('autocomplete-objective').style.display = "block";
    }else{
      document.getElementById('autocomplete-objective').style.display = "none";
    }
  }

  function autocompleteObjective(){
    if(suggestion_index === suggestions.length){
      document.getElementById('autocomplete-objective').innerHTML = "<a style='color:#aaa'><i class='fa fa-bolt'></i> Completar este campo con un objetivo sugerido de la metodología de EPSUM</a>";
      document.getElementById('autocomplete-objective-info').style.display = "none";

      document.getElementById('objective').value = '';
      document.getElementById('objective').disabled = false;
      document.getElementById('objective').focus();
      objective_autor = $('#username').val();
    }else{
      document.getElementById('autocomplete-objective').innerHTML = "<a style='color:#aaa'><i class='fa fa-bolt'></i> Fase: "+suggestions[suggestion_index].phase_name+". Clic de nuevo para ver el siguiente...</a>";
      document.getElementById('autocomplete-objective-info').style.display = "block";

      document.getElementById('objective').value = suggestions[suggestion_index].objective_suggest;
      document.getElementById('objective').disabled = true;
      objective_autor = "Programa EPSUM";
    }

    document.getElementById('objective').rows = 1;
    document.getElementById('objective').rows = Math.floor(document.getElementById('objective').scrollHeight/20)-1;

    (suggestion_index > suggestions.length-1)?suggestion_index = 0:suggestion_index += 1;
  }

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  }

</script>

<style>
input.es-input{width:100%;padding-right:10px!important;padding-bottom: 8px;padding-left: 10px;outline: none;border: 0px;border-bottom: 3px solid #c3c3c3;background-color:transparent;font-size: 20px;}
input.es-input:hover,
input.es-input:focus{border-bottom: 3px solid #2ebeef;}
input.es-input.open{-webkit-border-bottom-left-radius:0;-moz-border-radius-bottomleft:0;border-bottom-left-radius:0;-webkit-border-bottom-right-radius:0;-moz-border-radius-bottomright:0;border-bottom-right-radius:0}
.es-list{position:absolute;padding:0;margin:0;border:1px solid #d1d1d1;display:none;z-index:1000;background:#fff;max-height:256px;overflow-y:auto;-moz-box-shadow:0 2px 3px #ccc;-webkit-box-shadow:0 2px 3px #ccc;box-shadow:0 2px 3px #ccc;font-size:16px}
.es-list li{display:block;padding:5px 10px;margin:0}
.es-list li.selected{background:#f3f3f3}
.es-list li[disabled]{opacity:.5}
</style>
@endsection
