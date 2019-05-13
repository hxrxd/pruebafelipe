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

                        <div class="announcement animated fadeInDown">
                          <h1 style="font-weight:bold">{{($report->status == 0)?'VISTA PRELIMINAR':'FINALIZADO'}}</h1>
                          @if($report->status == 0)
                            <p>Esta vista te ayudará a verificar el contenido que enviarás a tu supervisor. Para más información <a data-toggle="modal" data-target="#modal-info" style="color:#fff;font-weight:bold">haz clic aquí</a>.</p>
                            <button type="button" id="show-button" class="cool-button hvr-grow bg-orange"><i class="fa fa-arrow-down"></i> Desplazar al contenido de informe</button>
                          @else
                            <p>Seguramente ya imprimiste y entregaste este informe a tu supervisor...</p>
                            <div>
                              <a type="button" href="{{ url('report/download/'.$report->id)}}" class="cool-button hvr-grow bg-orange" style="color:white"><i class="fa fa-download"></i> Descargar</a>
                              <a type="button" href="{{ url('monthly/report/preview/'.$report->nmonth)}}" class="cool-button hvr-grow bg-orange" style="color:white"><i class="fa fa-check"></i> Ver correcciones</a>
                              <button type="button" id="show-button" class="cool-button hvr-grow bg-orange"><i class="fa fa-arrow-down"></i> Desplazar al contenido de informe</button>
                            </div>
                          @endif
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

          <div id="summary-box" class="report-summary col-sm-3">
            <a id="menu-presentation" class="text-menu-report">Presentación</a><br>
            <a id="menu-report" class="text-menu-report">Informe narrativo</a><br>
            <a id="menu-activities" class="text-menu-report">Actividades</a><br><br><br>
            <h3>{{$student->name.' '.$student->fsurname.' '.$student->ssurname}}</h3>
            <p><strong>{{$student->carrer}}</strong>, {{$student->academicu}}</p><br>
            <h4>Informe {{$report_type}} de actividades</h4>
            <p>Período comprendido del {{($report_type == "mensual")?1:15}} al {{$how_many_days}} de {{$report->month}} de {{$year}}</p><br>
            <h4>{{$hq->name}}</h4>
            <p>{{$municipality->municipality}}, {{$department->departament}}</p><br>
            <button type="button" class="cool-button-question hvr-grow" data-toggle="modal" data-target="#modal-info" style="float:left">?</button>

            <div id="popup" class="popup-message animated bounceIn"></div>
          </div>
          <div id="experiences-box" class="col-sm-9">
            <h2 style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18">Informe narrativo de las experiencias aprehendidas en {{($report_type=="mensual")?"el mes":"la quincena"}} de {{$report->month}}</h2>
            <p id="experiences" class="experiences-input-corrections" style="display:block;white-space: pre-wrap;">{{$report->experiences}}</p>
            <br>

            <h2 id="activities" style="padding:96px 48px 0px 48px;font-weight:bold;font-size:18">Descripción de actividades ejecutadas durante el {{($student->practice == 1)?"EPS":"PPS"}}</h2>

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

                    <tr class="row-table-corrections-comment">
                      <td colspan="5"></td>
                    </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>

            @if($report->status == 0)
            <button type="button" id="send-button" class="cool-button hvr-grow" style="font-size:24px;margin-top:64px;">Enviar</i></button>
            <button type="button" id="to-edit" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:64px;margin-left:15px;" onclick="location.href='{{url('plan/month/'.$report->nmonth)}}'">Seguir editando</button>
            <button type="button" id="go-up" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:64px;margin-left:15px;"><i class="fa fa-arrow-up"></i> Ir al principio</button>
            @else
            <a type="button" href="{{ url('report/download/'.$report->id)}}" id="download" class="cool-button hvr-grow" style="font-size:24px;margin-top:48px; color:white">Descargar</i></a>
            <button type="button" id="go-up" class="cool-button-secoundary hvr-grow" style="font-size:24px;margin-top:48px;margin-left:15px;"><i class="fa fa-arrow-up"></i> Ir al principio</button>
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
        <h4 class="modal-title">Vista previa de informe</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Qué es la vista previa de informe?</strong> La vista previa de informe es un resumen del contenido que enviarás a tu supervisor para evaluar las actividades desarrolladas en el mes.</p>
        <p><strong>¿Si estoy viendo este resumen significa que ya envié mi informe a mi supervisor?</strong> No.Tu supervisor recibirá tu informe hasta que confirmes y hagas clic en <strong>Enviar</strong> (opción al final de esta previsualización).</p>
        <p><strong>¿Cómo puedo volver a la vista de edición para hacer cambios?</strong> Para volver a la vista de edición, selecciona la opción <strong>Seguir editando</strong> al final de esta previa.</p>
        <p><strong>¿Puedo seguir editando luego de haber enviado mi informe?</strong> No. Cuando envías tu informe, se cerrará la edición del mismo para ti y se habilitará para tu supervisor, quien luego de revisarlo te indicará si debes realizar correcciones.</p>
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
var menu_pres = document.getElementById('menu-presentation');
var menu_rep = document.getElementById('menu-report');
var menu_act = document.getElementById('menu-activities');
var experiences = document.getElementById('experiences');
var send_button = document.getElementById('send-button');
var num_correction = parseInt("{{$report->num_correction}}");

//positioning-bar
menu_bar.style.top = "0px";
var origOffsetY = 0;

function onScroll(e) {
  var pos = origOffsetY+window.scrollY-2;
  var bottom = document.getElementById('go-up').offsetTop;
  menu_bar.style.top = pos+"px";

  //positioning summary box
  if(window.scrollY > 720 && window.scrollY < bottom){
    var currentp = window.scrollY - 720; //612
    summary_box.style.top = currentp+"px";
  }

  /*if(window.scrollY > 0 && window.scrollY < 610){
    disableMenuSelected();
    menu_pres.className += " text-menu-report-active";
  }else if(window.scrollY > 610 && window.scrollY < 1582){
    disableMenuSelected();
    menu_rep.className += " text-menu-report-active";
  }else{
    disableMenuSelected();
    menu_act.className += " text-menu-report-active";
  }*/
}

document.addEventListener('scroll', onScroll);

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

$('#send-button').click(function(){
  updateStatus(1);
  updateNumCorrection();
  updateExperiencesCorrections('');
  notify(
    '{{asset("send/notification")}}', //url
    '{{$username}}', //title of notification
    'envió su informe de {{$report->month}}', //description
    null, //message for notification (optional)
    '{{$student->email}}', //email of emisor
    '{{$email_sup}}', //email of receptor
    '{{asset("monthly/report/".$report->id)}}'); //link for open from notification
  swal("¡Informe enviado!", "El informe fue enviado a tu supervisor", "success");
  setTimeout(function(){
    location.href="{{ url('plan/month/'.$report->nmonth)}}";
  }, 800);
});


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

function updateNumCorrection(){
  $.ajax({
      type: 'post',
      url: '{{asset("update/num_correction")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'id': '{{$report->id}}',
          'num_correction': (num_correction += 1)
      },
      success: function(data) {
          if (data.errors) {
              console.log('ERROR_REG_NUM_CORRECTION');
          } else {
              console.log('SUCCESS_REG_NUM_CORRECTION');
          }
      },
  });
}

function updateExperiencesCorrections(text){
  $.ajax({
      type: 'post',
      url: '{{asset("update/expcorrections")}}',
      data: {
          '_token': "{{ csrf_token() }}",
          'id': '{{$report->id}}',
          'experiences': text
      },
      success: function(data) {
          if (data.errors) {
              console.log('ERROR_UPD_EXPERIENCES_CORRECTIONS');
          } else {
              console.log('SUCCESS_UPD_EXPERIENCES_CORRECTIONS');
          }
      },
  });
}

$('#go-up').click(function(){
  $('html,body').animate({scrollTop: ($("#presentation").offset().top-100)},'slow');
  disableMenuSelected();
  menu_pres.className += " text-menu-report-active";
});

</script>

@endsection
