@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins white-bg">

      <div id="presentation" class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{URL::previous()}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
              <button type="button" class="search-button hvr-grow"><i class="fa fa-ellipsis-v"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">Informe {{$report_type}} de actividades</h1>
                        <h3>Período comprendido del {{($report_type == "mensual")?1:15}} al {{$how_many_days}} de {{$report->month}} de {{$year}}</h3><br>
                        <h2>{{$hq->name}}</h2>
                        <h3>{{$municipality->municipality}}, {{$department->departament}}</h3><br>
                        <h2>{{$student->name.' '.$student->fsurname.' '.$student->ssurname}}</h2>
                        <h3>{{$student->carrer}}</h3>
                        <h3>Registro académico No. {{$student->carne}}</h3>
                        <h3>{{$student->academicu}}</h3><br><br>
                        <button type="button" id="show-button" class="cool-button hvr-grow"><i class="fa fa-arrow-down"></i> Desplazar al contenido de informe</button><br><br>
                        <span class="badge badge-warning" style="font-size:16px">Correción #{{$report->num_correction}}</span>
                        <p style="color:#2ebeef"><strong>Entregado el {{$delivery_date}} a las {{$delivery_time}}</strong></p>
                    </div>
                </div>
          </div>
      </div>


      <div id="report" class="row">
        <div class="col-lg-12">

          <div id="summary-box" class="report-summary col-sm-3">
            <a id="menu-presentation" class="text-menu-report">Presentación</a><br>
            <a id="menu-report" class="text-menu-report">Informe narrativo</a><br>
            <a id="menu-activities" class="text-menu-report">Actividades</a><br><br><br>
            <h3>{{$student->name.' '.$student->fsurname.' '.$student->ssurname}}</h3>
            <p><strong>{{$student->carrer}}</strong>, {{$student->academicu}}</p><br>
            <span class="badge badge-info">Correción #{{$report->num_correction}}</span>
            <h4>Informe {{$report_type}} de actividades</h4>
            <p>Período comprendido del {{($report_type == "mensual")?1:15}} al {{$how_many_days}} de {{$report->month}} de {{$year}}</p><br>
            <h4>{{$hq->name}}</h4>
            <p>{{$municipality->municipality}}, {{$department->departament}}</p><br>
            <button type="button" class="cool-button-question hvr-grow" data-toggle="modal" data-target="#modal-info" style="float:left">?</button>

            <div id="popup" class="popup-message animated bounceIn"></div>
          </div>
          <div id="experiences-box" class="col-sm-9">
            <h2 style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18">Informe narrativo de las experiencias aprehendidas en {{($report_type=="mensual")?"el mes":"la quincena"}} de {{$report->month}}</h2>

            <div class="announcement animated fadeInDown">
              <h3>Mejoras en corrección de informe narrativo</h3>
              <p>Ahora verás las correcciones que hiciste, incluso si saliste del informe y vuelves a consultarlo en otro momento. Corrección de error de texto truncado. Este mensaje removido luego.</p>
            </div>

            <textarea id="experiences-original" class="experiences-input-corrections" maxlength="2000" rows="27">{{$report->experiences}}</textarea>
            <textarea id="experiences-correction" class="experiences-input-corrections" maxlength="2000">{{$report->experiences_corrections}}</textarea>
            <textarea id="experiences-edit" class="experiences-input-corrections" maxlength="2000" rows="27">{{$report->experiences}}</textarea>
            <p id="experiences" class="experiences-input-corrections" style="display:block;white-space: pre-wrap;">{{$report->experiences}}</p>
            <br>

            <div id="experiences-options" style= "display:none">
              <button type="button" id="save-corrections" class="cool-button hvr-grow" >Aplicar correcciones y comentarios realizados</button>
              <button type="button" id="cancel-edit-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Cancelar</button>
            </div>


            <h2 id="activities" style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18">Descripción de actividades ejecutadas durante el {{($student->practice == 1)?"EPS":"PPS"}}</h2>

            <div class="announcement animated fadeInDown">
              <h3>Novedades en la descripción de actividades</h3>
              <p>Para mayor confianza al guardar las correcciones, ahora tienes la opción <strong>Guardar corrección</strong> al lado del campo del comentario, por lo que debes tomar en cuenta que la corrección <strong>ya no se guarda automáticamente</strong>. Además, se agregó la opción <strong>Aprobar</strong>, que únicamente agrega el texto "APROBADO" en el campo de corrección. Si equivocadamente seleccionaste <strong>Aprobar</strong>, puedes borrar el texto. Recuerda que si no escribes una corrección en un campo, el estudiante verá el texto <strong>"No necesitas hacer correcciones para este objetivo"</strong> en la vista de correcciones de su informe.<br><br>Este mensaje es temporal y será removido pronto.</p>
            </div>

            <div>
              <div class="table-responsive">
                <table id="table-box" class="cool-table animated fadeInUp" style="margin-top:64px;display:block; overflow-x: hidden">
                  <thead>
                    <tr>
                      <th style="width:30%;padding-left:30px;padding-bottom:10px;">Objetivo</th>
                      <th style="width:30%;padding-bottom:10px;">Actividades</th>
                      <th style="width:15%;padding-bottom:10px;">Resultados</th>
                      <th style="width:20%;padding-bottom:10px;">Aciertos/Desaciertos</th>
                      <th style="width:5%;padding-bottom:10px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($objectives_count > 0)
                    @foreach($objective as $o)
                    <tr class="row-table-corrections">
                      <td style="padding-left:30px;"><strong>{{$o->objective}}</strong></td>
                      <td>{{$o->activities}}</td>
                      <td>{{$o->results}}</td>
                      <td><strong>Aciertos: </strong>{{$o->hits}} <br><br><strong>Desaciertos: </strong>{{$o->failures}}</td>
                      <td></td>
                    </tr>

                    <tr id="comment-{{$o->id}}" class="row-table-corrections-comment">
                      <td colspan="3"><textarea id="text-comment-{{$o->id}}" class="comment-table-corrections comment-correction" placeholder="Escribe algunas observaciones o comentarios" maxlength="1500" rows="1" onclick="expand(this)" onmouseover="setCommentLines(this)">{{$o->objective_corrections}}</textarea></td>
                      <td colspan="2"><button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;" onclick="saveObjectiveCorrection({{$o->id}},'#d4fcbc')">Guardar corrección</button><br><button type="button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;" onclick="validateObjective({{$o->id}},'#d5f6ff')">Aprobar</button></td>
                    </tr>

                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-sm-12">
              <h2 style="padding:48px 48px 0px 0px;font-weight:bold;font-size:16">Resumen de correcciones</h2>
              <textarea id="status-text" class="comment-table-corrections comment-correction" placeholder="No se han realizado correcciones" maxlength="512" rows="1" readonly></textarea>
            </div>

            <div class="col-sm-12">
              <div style="float:left;padding-left:16px;margin-top:24px;">
                <label class="container">Autorizar para imprimir
                  <input id="isValidated" type="checkbox" name="check">
                  <span class="checkmark chk-yes"></span>
                </label>
              </div>
            </div>

            <button type="button" id="send-corrections" class="cool-button hvr-grow" style="font-size:24px;margin-top:64px;">Enviar correcciones</i></button>
            <button type="button" id="go-up" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:64px;margin-left:15px;"><i class="fa fa-arrow-up"></i> Ir al principio</button>

          </div>

        </div>
      </div>

      <div id="base" style="height:100px;backgroundColor:#fff"></div>

    </div>
  </div>
</div>


<div class="modal inmodal" id="modal-info" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-question-circle-o modal-icon"></i>
        <h4 class="modal-title">Revisión de informes</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Cómo realizo una corrección en el informe narrativo?</strong> Haz doble clic en cualquier parte del resumen narrativo y se habilitará el modo edición, hecho esto podrás borrar o agregar texto. Cuando termines de editar, haz clic en el botón que aparece debajo del texto para guardar los cambios.</p>
        <p><strong>¿Cómo realizo comentarios en el informe narrativo?</strong> Para agregar un comentario dentro del informe narrativo, coloca el cursor al final de un párrafo (de preferencia) y luego presiona enter. Automáticamente se abrirán comillas que le indicarán al estudiante que se trata de un comentario.</p>
        <p><strong>¿Cómo hago observaciones en el informe de actividades?</strong> En la tabla de actividades aparecerá un espacio en blanco debajo de cada objetivo, haz clic en el espacio y podrás agregar observaciones o comentarios.</p>
        <p><strong>¿Se han guardado los cambios cuando hago clic en "Enviar correcciones"?</strong> Sí, los cambios que hayas realizado se han guardado previamente antes de hacer clic en dicha opción.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="cool-button hvr-grow" data-dismiss="modal">¡Entendido!</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{asset('js/htmldiff.js')}}"></script>
<script>
/*$('.navbar-minimalize').on('click', function () {
    $("body").toggleClass("mini-navbar");
    SmoothlyMenu();

});*/

$("body").toggleClass("mini-navbar");
SmoothlyMenu();

var menu_bar = document.getElementById('sidebar');
var summary_box = document.getElementById('summary-box');
var experiences_box = document.getElementById('experiences-box');
var menu_pres = document.getElementById('menu-presentation');
var menu_rep = document.getElementById('menu-report');
var menu_act = document.getElementById('menu-activities');
var fab = document.getElementById("corrections-fab");
var popup = document.getElementById('popup');
var experiences_original = document.getElementById('experiences-original');
var experiences_edit = document.getElementById('experiences-edit');
var experiences = document.getElementById('experiences');
var save_experiences_button = document.getElementById('save-corrections');
var cancel_experiences_button = document.getElementById('cancel-edit-button');
var current_comment_table = null;
var send_button = document.getElementById('send-corrections');
var status_text = document.getElementById('status-text');
var are_there_corrections = false;

//positioning-bar
menu_bar.style.top = "0px";
var origOffsetY = 0;

function onScroll(e) {
  var pos = origOffsetY+window.scrollY-2;
  var bottom = send_button.offsetTop;
  menu_bar.style.top = pos+"px";

  //positioning summary box
  if(window.scrollY > 612 && window.scrollY < bottom){
    var currentp = window.scrollY - 612;
    summary_box.style.top = currentp+"px";
  }

}
document.addEventListener('scroll', onScroll);

//init corrections
if(`{{$report->experiences_corrections}}` != ""){
  experiences.innerHTML = htmldiff($('#experiences-original').val(),$('#experiences-correction').val());
}

//go to from menu
$('#show-button').click( function(){
  $('html,body').animate({scrollTop: $("#report").offset().top},'slow');
  disableMenuSelected();
  menu_rep.className += " text-menu-report-active";
});

$('#menu-presentation').click( function(){
  $('html,body').animate({scrollTop: ($("#presentation").offset().top-100)},'slow');
  disableMenuSelected();
  menu_pres.className += " text-menu-report-active";
});

$('#menu-report').click( function(){
  $('html,body').animate({scrollTop: $("#report").offset().top},'slow');
  disableMenuSelected();
  menu_rep.className += " text-menu-report-active";
});

$('#menu-activities').click( function(){
  $('html,body').animate({scrollTop: $("#activities").offset().top},'slow');
  disableMenuSelected();
  menu_act.className += " text-menu-report-active";
});

function disableMenuSelected(){
  menu_pres.classList.remove("text-menu-report-active");
  menu_rep.classList.remove("text-menu-report-active");
  menu_act.classList.remove("text-menu-report-active");
}

//init corrections
/*if(`{{$report->experiences_corrections}}` != ""){
  experiences.innerHTML = htmldiff($('#experiences-original').val(),$('#experiences-correction').val());
  $('#experiences-edit').val($('#experiences-correction').val());
}*/

//expand the comments
<?php foreach ($objective as $o): ?>
  var id = <?php echo $o->id ?>;
  var row = document.getElementById('comment-'+id);
  var comment = row.childNodes[1].childNodes[0];

  comment.rows = Math.floor(comment.scrollHeight/20)-1;
<?php endforeach; ?>

$("#experiences-edit").keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
      var part1 = experiences_edit.value.substring(0,experiences_edit.selectionStart);
      var part2 = experiences_edit.value.substring(experiences_edit.selectionStart,experiences_edit.length);
      var current_selection = part1.length+2;
      experiences_edit.value = part1+'\n❝❞'+part2;
      experiences_edit.selectionStart = current_selection;
      experiences_edit.selectionEnd = current_selection;
  }
  var txtval = experiences_edit.value;
  if(txtval.substr(txtval.length - 1) == '\n'){
    experiences_edit.value = txtval.substring(0,txtval.length - 1);
  }
});

//make corrections
$('#experiences').click( function(){
  experiences.style.display = "none";
  experiences_edit.style.display = "block";
  experiences_edit.className += " experiences-input-corrections-active";
  document.getElementById('experiences-options').style.display = "block";

  //help-popup
  /*popup.style.display = "block";
  popup.classList.remove("bounceOut");
  popup.className += " bounceIn";
  popup.innerHTML = "<strong>Estás editando el informe narrativo. </strong>Al final del texto encontrarás la opción para guardar los cambios.";*/
});

$('#save-corrections').click( function(){
  experiences.innerHTML = htmldiff($('#experiences-original').val(),$('#experiences-edit').val());
  updateExperiences();
  closeEditMode();
  $('html,body').animate({scrollTop: $("#report").offset().top},'slow');
});

$('#cancel-edit-button').click( function(){
  closeEditMode();
});

function closeEditMode(){
  experiences.style.display = "block";
  experiences_edit.style.display = "none";
  experiences_edit.classList.remove("experiences-input-corrections-active");
  document.getElementById('experiences-options').style.display = "none";
  popup.classList.remove("bounceIn");
  popup.className += " bounceOut";
}

function updateExperiences(){
  $.ajax({
      type: 'post',
      url: '{{asset("update/expcorrections")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'id': '{{$report->id}}',
          'experiences': $('#experiences-edit').val()
      },
      success: function(data) {
          if (data.errors) {
              console.log('ERROR_UPD_EXPERIENCES_CORRECTIONS');
          } else {
              are_there_corrections = true;
              updateCorrectionsStatus("• Se hicieron correcciones en el informe narrativo");
              console.log('SUCCESS_UPD_EXPERIENCES_CORRECTIONS');
          }
      },
  });
}

function expand(item){
  current_comment_table = item;

  if(current_comment_table.value === ''){
      current_comment_table.value +='• ';
  }
}

$('.comment-correction').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        current_comment_table.value +='\n• ';
        //current_comment_table.rows = (current_comment_table.rows + 1);
        var lines = Math.floor(current_comment_table.scrollHeight/20);
        current_comment_table.rows = lines-1;
  }
  var txtval = current_comment_table.value;
  if(txtval.substr(txtval.length - 1) == '\n'){
    current_comment_table.value = txtval.substring(0,txtval.length - 1);
  }
});

function setCommentLines(item){
  var lines = Math.floor(item.scrollHeight/20);
  item.rows = lines-1;
}

function saveObjectiveCorrectionDeprecated(item,id){
  if(current_comment_table.value == "" || current_comment_table.value == "• "){
    current_comment_table.value = "";
  }else{
    $.ajax({
        type: 'post',
        url: '{{asset("add/objcorrection")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'id': id,
            'corrections': current_comment_table.value
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_UPD_OBJECTIVE_CORRECTIONS');
            } else {
                are_there_corrections = true;
                current_comment_table.style.backgroundColor = "#d4fcbc"
                updateCorrectionsStatus("• Observación en objetivo: " + "\"" + current_comment_table.value.substring(2,25) + "...\"");
                console.log('SUCCESS_UPD_OBJECTIVE_CORRECTIONS');
                logThis(4,data);
            }
        },
    });
  }

  item.rows = Math.floor(item.scrollHeight/20)-1;
}

function saveObjectiveCorrection(id,color){
  current_comment_table = document.getElementById('text-comment-'+id);
  if(current_comment_table.value == "" || current_comment_table.value == "• "){
    current_comment_table.value = "";
  }else{
    $.ajax({
        type: 'post',
        url: '{{asset("add/objcorrection")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'id': id,
            'corrections': current_comment_table.value
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_UPD_OBJECTIVE_CORRECTIONS');
            } else {
                are_there_corrections = true;
                current_comment_table.style.backgroundColor = color;
                updateCorrectionsStatus("• Observación en objetivo: " + "\"" + current_comment_table.value.substring(2,25) + "...\"");
                console.log('SUCCESS_UPD_OBJECTIVE_CORRECTIONS');
                logThis(4,data);
            }
        },
    });
  }

  var item = document.getElementById('text-comment-'+id);
  item.rows = Math.floor(item.scrollHeight/20)-1;
}

function logThis(type,objective){
  $.ajax({
      type: 'post',
      url: '{{asset("log/obj")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'type': type,
          'description': objective.objective,
          'month' : '{{$report->month}}',
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

function updateCorrectionsStatus(description){
  if(status_text.value === ''){
    status_text.value += description;
  }else{
    status_text.value += '\n'+description;
  }

  var lines = Math.floor(status_text.scrollHeight/20);
  status_text.rows = lines-1;
}

$('#send-corrections').click(function(){

  if($('#isValidated').is(":checked")){
    $.ajax({
        type: 'post',
        url: '{{asset("validated")}}',
        data: {
            '_token': "{{ csrf_token() }}",
            'id': '{{$report->id}}',
            'validated': 1
        },
        success: function(data) {
            if (data.errors) {
                console.log('ERROR_UPD_VALIDATION_STATUS');
            } else {
                console.log('SUCCESS_UPD_VALIDATION_STATUS');
            }
        },
    });
  }

  if(are_there_corrections){
    updateStatus(2);
    makeNotification();
    swal("¡Informe revisado!", "El informe fue devuelto al estudiante", "success");

    setTimeout(function(){
      location.href="{{ url('plan/monthly/all')}}";
    }, 1000);
  }else{
    swal({
        title: "¿Estás seguro de que este infome no necesita correcciones?",
        text: "El informe será enviado sin correcciones",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function () {
        updateStatus(2);
        makeNotification();
        swal("¡Informe revisado!", "El informe fue devuelto al estudiante", "success");

        setTimeout(function(){
          location.href="{{ url('plan/monthly/all')}}";
        }, 1000);
    });
  }

});

function makeNotification(){
  notify(
    '{{asset("send/notification")}}', //url
    'Informe de {{$report->month}} devuelto', //title of notification
    (are_there_corrections)?'con correcciones':'sin correcciones', //description
    null, //message for notification (optional)
    '{{$email_user}}', //email of emisor
    '{{$student->email}}', //email of receptor
    '{{asset("monthly/report/reviewed/".$report->nmonth)}}'); //link for open from notification
}

function updateStatus(status){
  $.ajax({
      type: 'post',
      url: '{{asset("update/plan/status")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'id': '{{$report->id}}',
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

function validateObjective(id,color){
  document.getElementById('text-comment-'+id).value = '• APROBADO';
  saveObjectiveCorrection(id,color);
}

$('#go-up').click(function(){
  $('html,body').animate({scrollTop: ($("#presentation").offset().top-100)},'slow');
  disableMenuSelected();
  menu_pres.className += " text-menu-report-active";
});

</script>

@endsection
