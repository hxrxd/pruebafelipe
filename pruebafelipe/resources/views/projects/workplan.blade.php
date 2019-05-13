@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="workplan-section" class="ibox float-e-margins" class="animated fadeInUp">
      <div class="ibox-title">
        <h5 onclick="alert('{{Session::get('idpj')}}')">Proyectos / {{Session::get('project')->type}}</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['class'=>'form-horizontal','id'=>'wpcreate','method'=>'POST']) !!}
        {{ csrf_field() }}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2>Plan de Trabajo</h2>
            <h5><strong>Proyecto:</strong> {{Session::get('project')->name}}</h5>
          </div>
        </div>

        <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
          <div class="col-sm-10">
            <div class="hr-line-dashed"></div>
          </div>
        </div>
        <div class="form-group"><h3 class="col-sm-2 control-label" style="color:#1ab394">1</h3>
          <div class="col-sm-10">
            <h3 style="color:#1ab394;">Objetivo Específico</h3>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo</label>
          <div class="col-sm-10">
            {!!Form::textarea('objective_what',null,['class'=>'form-control','id'=>'objective_what','name'=>'objective_what','placeholder'=>'Define un objetivo específico para el proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Meta</label>
          <div class="col-sm-10">
            {!!Form::textarea('objective_what_for',null,['class'=>'form-control','id'=>'objective_what_for','name'=>'objective_what_for','placeholder'=>'Justifica la razón del objetivo planteado','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
          <div class="col-sm-10">
            <div class="hr-line-dashed"></div>
          </div>
        </div>
        <div class="form-group"><h3 class="col-sm-2 control-label" style="color:#1ab394">2</h3>
          <div class="col-sm-10">
            <h3 style="color:#1ab394;">Indicador</h3>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-2">
            <label class="control-label" style="font-size:11px">Cantidad</label>
          </div>
          <div class="col-sm-8">
            <label class="control-label" style="font-size:11px">Descripción</label>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-2">
            {!!Form::text('amount',null,['class'=>'form-control','id'=>'amount','name'=>'amount','placeholder'=>'Cantidad','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
          <div class="col-sm-8">
            {!!Form::text('goal',null,['class'=>'form-control','id'=>'goal','name'=>'goal','placeholder'=>'Descripción del indicador','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
            {!!Form::hidden('quality',".",['class'=>'form-control','id'=>'quality','name'=>'quality','placeholder'=>'Calidad','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
            {!!Form::hidden('project',Session::get('project')->id,['class'=>'form-control','id'=>'project','name'=>'project'])!!}
          </div>
        </div>

        <div class="form-group" style="padding-top:20px"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a id="showActsButton" type="submit" href="#activities" class="btn btn-primary add-acts">Agregar actividades</a>-

            <button type="button" class="btn btn-success btn-circle" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-question"></i></button>
          </div>
        </div>

        <!--FORM CLOSE-->

        <div id="activities" class="animated fadeInUp" style="display:none">

          <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
            <div class="col-sm-10">
              <div class="hr-line-dashed"></div>
            </div>
          </div>
          <div class="form-group" style="margin-top:70px;"><h3 class="col-sm-2 control-label" style="color:#1ab394">3</h3>
            <div class="col-sm-10">
              <h3 style="color:#1ab394;">Actividades</h3>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
            <div class="col-sm-10">
              {!!Form::textarea('activity',null,['class'=>'form-control','id'=>'activity','name'=>'activity','placeholder'=>'Escribe una descripción para la actividad..','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
            </div>
          </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Fecha de inicio</label>
          </div>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Fecha límite</label>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-3">
            {!!Form::date('startdate', \Carbon\Carbon::now(),['id'=>'startdate','name'=>'startdate','class'=>'form-control','required'=>'']); !!}
          </div>
          <div class="col-sm-3">
            {!!Form::date('deadline', \Carbon\Carbon::now(),['id'=>'deadline','name'=>'deadline','class'=>'form-control','required'=>'']); !!}
          </div>
          <div class="col-sm-4">
            <a id="addAct" href="#activities" type="submit" class="btn btn-primary alertmessage">Agregar actividad</a>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            {!!Form::hidden('team',null,['class'=>'form-control','id'=>'team'])!!}
            {!!Form::hidden('cohort',null,['class'=>'form-control','id'=>'cohort'])!!}
            {!!Form::hidden('file_path',null,['class'=>'form-control','id'=>'file_path'])!!}
          </div>
        </div>

        <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
          <div class="col-sm-10">
            <div class="table-responsive">

            <table id="acts" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th style="min-width:300px;">Actividad</th>
                <th>Fecha de inicio</th>
                <th>Fecha límite</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
                </div>
          </div>
        </div>

        <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
          <div class="col-sm-10">
            <div class="hr-line-dashed"></div>
          </div>
        </div>

        <div class="form-group" style="padding-bottom:500px"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            <a href="#workplan-section" type="button" class="btn btn-lg btn-primary" onclick="newObjective()">Registrar otro objetivo</a>
            @if(Session::get('idpj') == 1)
              <a href="{{url('project/cat/1')}}" type="button" class="btn btn-lg btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
            @elseif(Session::get('idpj') == 2)
              <a href="{{url('project/cat/2')}}" type="button" class="btn btn-lg btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
            @else
              <a href="{{url('project/cat/3')}}" type="button" class="btn btn-lg btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
            @endif
          </div>
        </div>

      </div>
      {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-question-circle-o modal-icon"></i>
        <h4 class="modal-title">Objetivos específicos</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Todos los campos son obligatorios?</strong> Sí. Asegurate de llenar toda la información solicitada para el registro.</p>
        <p><strong>¿Cómo agrego un objetivo específico?</strong> Para agregar un objetivo correctamente, sigue los pasos identificados para el registo:</p>
        <p><strong>1. </strong> Ingresa el qué y para qué del objetivo trazado</p>
        <p><strong>2. </strong> Agrega un indicador para medir el avance del objetivo, éste está divido en <strong>Cantidad</strong> y <strong>Descripción</strong>.</p>
        <p><strong>3. </strong> Haz clic en el botón <strong>Agregar actividades</strong> para registrar las actividades que ayudarán en la consecución del objetivo. Puedes ingresar tantas actividades como sean necesarias.</p>
        <p>Cuando termines puedes agregar otro objetivo haciendo clic en la opción <strong>Registrar otro objetivo.</strong> o puedes seleccionar <strong>Finalizar</strong> para terminar con el registro.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">¡Entendido!</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
  $(window).on('load',function(){
      $('#myModal').modal('show');
  });

  var currentDate = document.getElementById("startdate").value;
  document.getElementById("objective_what").setCustomValidity("Debes llenar este campo");
  document.getElementById("objective_what_for").setCustomValidity("Debes llenar este campo");
  document.getElementById("amount").setCustomValidity("Debes llenar este campo");
  document.getElementById("goal").setCustomValidity("Debes llenar este campo");

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };

  $(document).ready(function () {
    $(".add-acts").click(function() {
      if(validateWorkplanFields()){
      document.getElementById("activities").style.display = "block";
      document.getElementById("showActsButton").style.display = "none";
      console.log('OBJECTIVE: '+$('textarea[name=objective_what]').val());
      console.log('OBJECTIVE_2: '+$('textarea[name=objective_what_for]').val());
      console.log('AMOUNT: '+$('#amount').val());
      console.log('GOAL: '+$('#goal').val());
      console.log('PROJECT: '+$('#project').val());
      
      $.ajax({
          type: 'post',
          url: '{{asset("add/wp")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'objective_what': $('#objective_what').val(),
              'objective_what_for': $('#objective_what_for').val(),
              'amount': $('#amount').val(),
              'goal': $('#goal').val(),
              'project': $('#project').val()
          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
                  toastr.success('Error','No se pudo registrar la información');
              } else {
                  console.log('SUCCESS_FLAG');
                  toastr.success('Objetivo registrado','Se ha guardado la información');
              }
          },
      });

      document.getElementById("objective_what").readOnly = true;
      document.getElementById("objective_what_for").readOnly = true;
      document.getElementById("amount").readOnly = true;
      document.getElementById("goal").readOnly = true;
      }
    });
  });

  $(document).ready(function () {
    $(".alertmessage").click(function() {

      if(validateActivityFields()){
      console.log('activity: '+$('#activity').val());
      console.log('deadline: '+$('#deadline').val());

      $.ajax({
          type: 'post',
          url: '{{asset("add/activity")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'activity': $('#activity').val(),
              'startdate': $('#startdate').val(),
              'deadline': $('#deadline').val()

          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
              } else {
                  console.log('SUCCESS_FLAG');
                  console.log("act: "+data.activity);
                  console.log("deadline: "+data.deadline);

                  $('#acts').append('<tbody>');
                  $('#acts').append('<tr><td style="min-width:300px;">' + data.activity + "</td><td>" + data.startdate + "</td><td>"+data.deadline+"</td></tr>");
                  $('#acts').append('</tbody>');
              }
          },
      });
      $('#activity').val('');
      $('#time').val('');
      document.getElementById("deadline").value = currentDate;
      document.getElementById("startdate").value = currentDate;
      }
    });
  });

  $('#startdate').on('change', function(){
    var sdate = document.getElementById("startdate").value;
    console.log('current_date: '+sdate);

    document.getElementById("deadline").value = sdate;
    document.getElementById("deadline").min = sdate;
  });

  function validateActivityFields(){
    if(document.getElementById("activity").validity.valueMissing){
        swal({
            title: "Falta información",
            text: "Verifica que has llenado todos los campos"
        });
        return false;
    }else if(document.getElementById("startdate").value == document.getElementById("deadline").value){
        swal({
            title: "Fechas incorrectas",
            text: "Verifica que la fecha límite sea posterior a la de inicio."
        });
        return false;
    }else{
        document.getElementById("activity").setCustomValidity("");
        return true;
    }
  }

  function validateWorkplanFields(){
    if(document.getElementById("objective_what").validity.valueMissing || document.getElementById("objective_what_for").validity.valueMissing
        || document.getElementById("amount").validity.valueMissing || document.getElementById("goal").validity.valueMissing){
        swal({
            title: "Falta información",
            text: "Verifica que has llenado todos los campos"
        });
        return false;
    }else{
        return true;
    }
  }

  function newObjective(){
    document.getElementById("objective_what").readOnly = false;
    document.getElementById("objective_what_for").readOnly = false;
    document.getElementById("amount").readOnly = false;
    document.getElementById("goal").readOnly = false;

    $('#objective_what').val('');
    $('#objective_what_for').val('');
    $('#goal').val('');
    $('#amount').val('');
    $('#acts').empty();
    $('#acts').append('<thead><tr><th style="min-width:300px;">Actividad</th><th>Fecha de inicio</th><th>Fecha límite</th></tr></thead>');

    document.getElementById("activities").style.display = "none";
    document.getElementById("showActsButton").style.display = "block";
    document.getElementById("showActsButton").style.width = "150px";
  }

</script>
@endsection
