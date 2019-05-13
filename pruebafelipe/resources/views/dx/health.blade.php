@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Diagnóstico <small>{{Session::get('team')->name}}</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'dx.health.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2">4</h1>
          <div class="col-sm-10">
            <h2>Salud</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 project-completion">
            <h6>Completado: 42%</h6>
            <div class="progress progress-mini">
              <div style="width: 42%;" class="progress-bar"></div>
            </div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Atención primaria</label>
          <div class="col-sm-10">
            {!!Form::text('rate_access_primary_health_care',null,['class'=>'form-control','id'=>'rate_access_primary_health_care','placeholder'=>'Tasa de acceso a atención primaria en salud','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Enfermedades vinculada al consumo de agua contaminada</label>
          <div class="col-sm-10">
            {!!Form::text('rate_diseases_by_contaminated_water',null,['class'=>'form-control','id'=>'rate_diseases_by_contaminated_water','placeholder'=>'Tasa de enfermedades vinculadas al consumo de agua no apta y mala disposición de excretas','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Desnutrición crónica</label>
          <div class="col-sm-10">
            {!!Form::text('rate_chronic_malnutrition',null,['class'=>'form-control','id'=>'rate_chronic_malnutrition','placeholder'=>'Tasa de desnutrición crónica en niños menores de 5 años','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <h5>Enfermedades frecuentes en niños menores de 5 años</h5>
            Seleccionar las enfermedades identificadas en el lugar
            {!!Form::hidden('diseases',null,['class'=>'form-control','id'=>'diseases','placeholder'=>'Lista de enfermedades encontradas (separa por comas)','rows'=>'2'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <label class="container">Infecciones respiratorias
              <input type="checkbox" id="chk-1" value="Infecciones respiratorias">
              <span class="checkmark"></span>
            </label>
            <label class="container">Síndrome diarreico agudo
              <input type="checkbox" id="chk-2" value="Síndrome diarreico agudo">
              <span class="checkmark"></span>
            </label>
            <label class="container">Parasitismo instestinal
              <input type="checkbox" id="chk-3" value="Parasitismo instestinal">
              <span class="checkmark"></span>
            </label>
            <label class="container">Infección urinaria o ITU
              <input type="checkbox" id="chk-4" value="Infección urinaria o ITU">
              <span class="checkmark"></span>
            </label>
            <label class="container">Dermatitis
              <input type="checkbox" id="chk-5" value="Dermatitis">
              <span class="checkmark"></span>
            </label>
            <label class="container">Otitis media aguda
              <input type="checkbox" id="chk-6" value="Otitis media aguda">
              <span class="checkmark"></span>
            </label>
            <label class="container">Bronquitis aguda
              <input type="checkbox" id="chk-7" value="Bronquitis aguda">
              <span class="checkmark"></span>
            </label>
            <label class="container">Enfermedades transmitidas por vectores (Ej. Malaria, Zika, Dengue, etc.)
              <input type="checkbox" id="chk-8" value="Enfermedades transmitidas por vectores">
              <span class="checkmark"></span>
            </label>
            <label class="container">Desnutrición aguda moderada o severa
              <input type="checkbox" id="chk-9" value="Desnutrición aguda moderada o severa">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <h5>Otras enferemedades (Si fuera el caso)</h5>
            {!!Form::text('others',null,['class'=>'form-control','id'=>'others','placeholder'=>'Lista otras enfermedades identificadas (separa por comas)','rows'=>'2'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{url('dx/close')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Seguir editando más tarde</a>
            <button type="button" class="btn btn-success btn-circle" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-question"></i></button>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-question-circle-o modal-icon"></i>
        <h4 class="modal-title">Registro de Diagnóstico</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Todos los campos son obligatorios?</strong> Sí. Asegurate de llenar toda la información solicitada para el registro.</p>
        <p><strong>¿La opción 'Seguir editando más tarde' guarda los cambios que he realizado?</strong> Sí, los cambios se registran hasta el último punto que seleccionaste 'Guardar'. Dicha opción te permite seguir trabajando en otro momento o dar la oportunidad a que un integrante de tu equipo continúe con el registro del diagnóstico.</p>
        <p><strong>¿Debo escribir símbolos especiales como del porcentaje (%) o de moneda?</strong> No, el sistema lo procesará automáticamente.</p>
        <p><strong>Cerré sesión accidentalmente sin guardar los cambios...</strong> Se registrarán los cambios hasta el último punto donde seleccionaste 'Guardar'.</p>
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
  var diseases_list = "";
  document.getElementById("rate_access_primary_health_care").setCustomValidity("Debes llenar este campo");
  document.getElementById("rate_chronic_malnutrition").setCustomValidity("Debes llenar este campo");
  document.getElementById("rate_diseases_by_contaminated_water").setCustomValidity("Debes llenar este campo");

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };

  $(document).ready(function () {
      $('#chk-1').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-2').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-3').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-4').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-5').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-6').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-7').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-8').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });

      $('#chk-9').click(function(){
          if($(this).prop('checked')){
            diseases_list  += $(this).val() + ', ';
            $('#diseases').val(diseases_list);
          }else{
            var dis_temp = $(this).val() + ', ';
            diseases_list = diseases_list.replace(dis_temp,'');
            $('#diseases').val(diseases_list);
          }
      });
  });
</script>

<style>
/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-left: 0px;
    margin-bottom: 12px;
    max-width: 500px;
    cursor: pointer;
    font-size: 12px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #1ab394;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>

@endsection
