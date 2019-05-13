@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins white-bg">

      <div id="presentation" class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{url('plan')}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
              <button type="button" class="search-button hvr-grow"><i class="fa fa-ellipsis-v"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">Informe {{$report_type}} de actividades</h1>
                        <h3>Período comprendido del {{($report_type == "mensual")?1:15}} al {{$how_many_days}} de {{$report->month}} de {{$year}}</h3><br>

                        <div class="announcement-blue animated fadeInDown">
                          <h1 style="font-weight:bold">REVISADO</h1>
                          <p>Tu informe fue revisado y devuelto con correcciones.</p>
                          <button type="button" id="show-button" class="cool-button hvr-grow"><i class="fa fa-arrow-down"></i> Desplazar al contenido de informe</button>
                        </div>

                        <h2>{{$hq->name}}</h2>
                        <h3>{{$municipality->municipality}}, {{$department->departament}}</h3><br>
                        <h2>{{$student->name.' '.$student->fsurname.' '.$student->ssurname}}</h2>
                        <h3>{{$student->carrer}} en {{$student->academicu}}</h3>
                        <h3>Registro académico No. {{$student->carne}}</h3><br><br>
                    </div>
                </div>
          </div>
      </div>


      <div id="report" class="row">
        <div class="col-lg-12">

          <h2 style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18;text-align:center;">Informe narrativo de las experiencias aprehendidas en {{($report_type=="mensual")?"el mes":"la quincena"}} de {{$report->month}}</h2>

          <p id="indications" style="text-align:center;padding:60px;font-size:14px;"><strong>Indicaciones: </strong>a la izquierda encontrarás el texto corregido por tu supervisor y a la derecha el texto original para editar. El texto <del>con este formato</del> significa que debe ser borrado de tu resumen y el texto <ins>con este color</ins>, significa que debe ser agregado o cambiado. <ins>❝Las líneas entre comillas, como esta❞</ins>, son comentarios de tu supervisor. Los cambios que realices se guardarán automáticamente.</p>

          <div class="col-sm-6">
            <p id="experiences" class="experiences-input-corrections" style="display:block;white-space: pre-wrap;">{{$report->experiences}}</p>
          </div>
          <div id="experiences-box" class="col-sm-6" style="margin-bottom:96px;">
            <textarea id="experiences-original" class="experiences-input-corrections" maxlength="2000" rows="27">{{$report->experiences}}</textarea>
            <textarea id="experiences-correction" class="experiences-input-corrections" maxlength="2000">{{$report->experiences_corrections}}</textarea>
            <textarea id="experiences-edit" class="experiences-input-corrections experiences-input-corrections-active" maxlength="2000" rows="35" style="display:block;" onfocusout="updateExperiences()">{{$report->experiences}}</textarea>
          </div>

          <h2 id="activities" style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18;text-align:center;">Descripción de actividades ejecutadas durante el {{($student->practice == 1)?"EPS":"PPS"}}</h2>

          <p id="indications" style="text-align:center;padding:20px 60px 0px 60px;font-size:14px;"><strong>Indicaciones: </strong>a continuación se muestran los resultados que enviaste, seguidos por algunas observaciones de tu supervisor (si las hay). Haz clic en cualquier lugar donde necesites corregir algo y comienza a escribir, los cambios se guardarán automáticamente.</p>

          <div>
            <div class="table-responsive">
              <table id="table-box" class="cool-table animated fadeInUp" style="margin-top:64px;display:block; overflow-x: hidden">
                <thead>
                  <tr>
                    <th style="width:30%;padding-left:60px;padding-bottom:10px;">Objetivo</th>
                    <th style="width:25%;padding-bottom:10px;">Actividades</th>
                    <th style="width:20%;padding-bottom:10px;">Resultados</th>
                    <th style="width:10%;padding-bottom:10px;">Aciertos</th>
                    <th style="width:10%;padding-bottom:10px;">Desaciertos</th>
                    <th style="width:5%;padding-bottom:10px;"></th>
                  </tr>
                </thead>
                <tbody>
                @if($objectives_count > 0)
                  @foreach($objective as $o)
                  <tr class="row-table-corrections" onclick="toEdit(this,{{$o->id}})" onfocusout="updateObjective({{$o->isGroup}})">
                    <td style="padding-left:60px;font-weight:bold">{{$o->objective}}</td>
                    <td>{{$o->activities}}</td>
                    <td>{{$o->results}}</td>
                    <td>{{$o->hits}}</td>
                    <td>{{$o->failures}}</td>
                    <td></td>
                  </tr>

                  <tr id="comment-{{$o->id}}" class="row-table-corrections-comment">
                    @if($o->objective_corrections)
                      <td colspan="6" style="padding: 0px 60px 0px 60px"><textarea class="comment-table-corrections comment-correction" maxlength="512" readonly>{{$o->objective_corrections}}</textarea></td>
                    @else
                      <td colspan="6" style="padding: 0px 60px 0px 60px"><textarea class="comment-table-corrections comment-correction" maxlength="512" readonly>• No tienes correcciones para este objetivo</textarea></td>
                    @endif
                  </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div>


            <div class="col-sm-12">
              <h2 style="margin-top:64px;font-weight:bold;text-align:center">¡Parece que has terminado de hacer correcciones!</h2>
              @if($report->validated == 1)
                <p style="margin:20px 100px 0px 100px;font-size:16px;text-align:center">Tu informe fue aprobado para ser impreso, por lo que puedes descargarlo ahora.</p>
                <div style="text-align:center;">
                  <a type="button" href="{{ url('report/download/'.$report->id)}}" id="download" class="cool-button hvr-grow" style="font-size:24px;margin-top:48px; color:white" onclick="finishedReport()">Descargar</i></a>
                  <button type="button" id="go-up" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:48px;margin-left:15px;"><i class="fa fa-arrow-up"></i> Ir al principio</button>
                </div>

                <div id="download-notification" class="animated fadeInUp" style="display:none;">
                  <h2 style="margin:64px 200px 0px 250px;font-weight:bold;">Se ha descargado un documento que puedes ver en Word...</h2>
                  <p style="margin:24px 200px 0px 250px;font-size:24px;color:#f68628"><i class="fa fa-warning"></i> <strong>Toma en cuenta las siguientes indicaciones</strong></p>
                  <p style="margin:10px 200px 0px 285px;font-size:16px;"><strong>1.</strong> No modifiques algo si no es necesario.</p>
                  <p style="margin:10px 200px 0px 285px;font-size:16px;"><strong>2.</strong> Revisa que tu información en la carátula es correcta.</p>
                  <p style="margin:10px 200px 0px 285px;font-size:16px;"><strong>3.</strong> Verifica que la información contenida es la que registraste.</p>
                  <p style="margin:10px 200px 0px 285px;font-size:16px;"><strong>4.</strong> Asegúrate que las firmas al final del cuadro de actividades no queden en una hoja en blanco.</p>
                  <button onclick="location.href='{{url('plan')}}'" type="button" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin:24px 200px 0px 230px"><i class="fa fa-arrow-left"></i>  Ir a informes mensuales</button>
                </div>
              @else
                <p style="margin:20px 100px 0px 100px;font-size:16px;text-align:center">Tu informe no ha sido aprobado para ser impreso, aún. Envía de nuevo los cambios a tu supervisor para que pueda revisarlos, es muy probable que con las correcciones que hiciste te lo devuelva como aprobado :)</p>
                <div style="text-align:center;">
                  <button type="button" id="send-corrections" class="cool-button hvr-grow" style="font-size:24px;margin-top:48px;">Enviar correcciones</i></button>
                  <button type="button" id="go-up" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:48px;margin-left:15px;"><i class="fa fa-arrow-up"></i> Ir al principio</button>
                </div>
              @endif
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
        <h4 class="modal-title">Corrección de informes</h4>
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
$("body").toggleClass("mini-navbar");
SmoothlyMenu();

var menu_bar = document.getElementById('sidebar');
var summary_box = document.getElementById('summary-box');
var experiences_original = document.getElementById('experiences-original');
var experiences_edit = document.getElementById('experiences-edit');
var experiences = document.getElementById('experiences');
var current_objective_id = 0;
var current_row = null;
var current_comment = null;
var current_comment_row = null;
var send_button = document.getElementById('send-corrections');
var are_there_corrections = false;

//positioning-bar
menu_bar.style.top = "0px";
var origOffsetY = 0;

function onScroll(e) {
  var pos = origOffsetY+window.scrollY-2;
  menu_bar.style.top = pos+"px";
}

document.addEventListener('scroll', onScroll);

//expand the comments
<?php foreach ($objective as $o): ?>
  var id = <?php echo $o->id ?>;
  var row = document.getElementById('comment-'+id);
  var comment = row.childNodes[1].childNodes[0];

  comment.rows = Math.floor(comment.scrollHeight/20)-1;
<?php endforeach; ?>

//init corrections
if(`{{$report->experiences_corrections}}` != ""){
  experiences.innerHTML = htmldiff($('#experiences-original').val(),$('#experiences-correction').val());
}

$('#show-button').click( function(){
  $('html,body').animate({scrollTop: $("#report").offset().top},'slow');
});

$('#go-up').click(function(){
  $('html,body').animate({scrollTop: ($("#presentation").offset().top-100)},'slow');
});

function updateExperiences(){
  $.ajax({
      type: 'post',
      url: '{{asset("update/experiences")}}',
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
              toastr.success('Se guardaron los cambios en tu informe narrativo','¡Hecho!');
              console.log('SUCCESS_UPD_EXPERIENCES_CORRECTIONS');
          }
      },
  });
}

$('#send-corrections').click(function(){

  if(are_there_corrections){
    updateStatus(1);
    makeNotification();
    swal("¡Correcciones enviadas!", "Tu informe con correcciones fue enviado a tu supervisor", "success");

    setTimeout(function(){
      location.href="{{ url('plan/month/'.$report->nmonth)}}";
    }, 700);
  }else{
    swal("Parece que no has hecho ninguna corrección", "Tu informe no puede ser devuelto sin haber realizado las correcciones indicadas", "warning");
  }

});

function makeNotification(){
  notify(
    '{{asset("send/notification")}}', //url
    '{{$username}}', //title of notification
    'hizo las correcciones de su informe de {{$report->month}}', //description
    null, //message for notification (optional)
    '{{$student->email}}', //email of emisor
    '{{$email_sup}}', //email of receptor
    '{{asset("monthly/report/".$report->id)}}'); //link for open from notification
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

//to edit objectives and results
function toEdit(row, id){
  current_objective_id = id;
  current_row = row;
  current_row.className += " row-table-corrections-edit";
  current_row.contentEditable = "true";
  current_row.focus();

  current_comment_row = document.getElementById("comment-"+id);
  current_comment_row.style.backgroundColor = "#f9f9f9";
  current_comment = current_comment_row.childNodes[1].childNodes[0];
  current_comment.style.backgroundColor = "#d4fcbc";

  var lines = Math.floor(current_comment.scrollHeight/20);
  current_comment.rows = lines-1;
}

function updateObjective(isGroup){
  current_row.classList.remove("row-table-corrections-edit")
  current_comment_row.style.backgroundColor = "transparent";
  current_comment.style.backgroundColor = "#f9f9f9";

  $.ajax({
      type: 'post',
      url: '{{asset("update/obj")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'id': current_objective_id,
          'objective': current_row.cells[0].innerHTML,
          'activities': current_row.cells[1].innerHTML,
          'results': current_row.cells[2].innerHTML,
          'hits': current_row.cells[3].innerHTML,
          'failures': current_row.cells[4].innerHTML,
          'isGroup' : isGroup,
          'student': "{{ $student->id_student }}",
          'plan': "{{ $report->id }}",
      },
      success: function(data) {
          if (data.errors) {
              console.log('ERROR_UPD_OBJECTIVE');
          } else {
              are_there_corrections = true;
              console.log('SUCCESS_UPD_OBJECTIVE');
              logThis(5,data);
          }
      },
  });

}

function finishedReport(){
  if(!are_there_corrections){
    swal({
        title: "No hiciste correcciones",
        text: "El informe se descargó, pero recuerda que debes hacer las correcciones en esta plataforma para guardar registro.",
        type: "warning",
        //showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Entendido",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
    });
  }

  updateStatus(3);
  document.getElementById('download-notification').style.display = "block";
  $('html,body').animate({scrollTop: ($("#download-notification").offset().top+200)},'slow');
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

</script>

@endsection
