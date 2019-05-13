@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Proyecto / <small>{{$team->name}}</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'project.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2>Registro de Proyecto {{$ty}}</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Nombre</label>
          <div class="col-sm-10">
            {!!Form::textarea('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Nombre del proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Ubicación</label>
          <div class="col-sm-10">
            {!!Form::textarea('location',null,['class'=>'form-control','id'=>'location','placeholder'=>'Ingresa una breve descripción acerca de la ubicación del proyecto...','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Descripción</label>
          <div class="col-sm-10">
            {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Escribe una breve descripción del proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'3', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo General</label>
          <div class="col-sm-10">
            {!!Form::textarea('objective',null,['class'=>'form-control','id'=>'objective','placeholder'=>'Objetivo General del proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Justificación</label>
          <div class="col-sm-10">
            {!!Form::textarea('justification',null,['class'=>'form-control','id'=>'justification','placeholder'=>'Justificación del proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'3', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <div class="hr-line-dashed"></div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Línea de Intervención</label>
            <div class="col-sm-10">

            <select id="lineid" name="lineid" class="form-control m-b " >
              <option value="ALL_LINES">--- Seleccionar línea de intervención ---</option>
              @foreach ($lines as $line => $value)
                <option value="{{ $line }}"> {{ $value }}</option>
              @endforeach
            </select>
            </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Descripción de línea de interv.</label>
          <div class="col-sm-10">
            {!!Form::textarea('description-line',null,['class'=>'form-control','id'=>'description-line','placeholder'=>'Descripciones de línea de intervención','rows'=>'2', 'resize'=>'none','readonly'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Área</label>
          <div class="col-sm-10">
            {!!Form::textarea('area',null,['class'=>'form-control','id'=>'area','placeholder'=>'Área','rows'=>'1','readonly'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Políticas asociadas</label>
          <div class="col-sm-10">
            {!!Form::textarea('policy',null,['class'=>'form-control','id'=>'policy','placeholder'=>'Políticas asociadas','rows'=>'2','readonly'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <div class="hr-line-dashed"></div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Fecha de inicio de ejecución de proyecto</label>
           <div class="col-sm-10">
               {!! Form::date('startdate', \Carbon\Carbon::now(),['id'=>'startdate','class'=>'form-control','required'=>'']); !!}
           </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Fecha de finalización de ejecución de proyecto</label>
           <div class="col-sm-10">
               {!! Form::date('deadline', \Carbon\Carbon::now(),['id'=>'deadline','class'=>'form-control','required'=>'']); !!}
           </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Actores involucrados</label>
          <div class="col-sm-10">
            {!!Form::textarea('stakeholders',null,['class'=>'form-control','id'=>'stakeholders','placeholder'=>'Lista de nombres de personas o instituciones involucradas en el proyecto (separa por comas)','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'4', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Valor económico (Q.)</label>
          <div class="col-sm-10">
            {!!Form::text('budget',null,['class'=>'form-control','id'=>'budget','placeholder'=>'Valor económico estimado para el proyecto..','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            {!!Form::hidden('type',$ty,['class'=>'form-control','id'=>'type'])!!}
            {!!Form::hidden('team',null,['class'=>'form-control','id'=>'team'])!!}
            {!!Form::hidden('cohort',null,['class'=>'form-control','id'=>'cohort'])!!}
            {!!Form::hidden('line',null,['class'=>'form-control','id'=>'line'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{ URL::previous() }}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Cancelar</a>
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
        <h4 class="modal-title">Registro de Proyecto</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Todos los campos son obligatorios?</strong> Sí. Asegurate de llenar toda la información solicitada para el registro.</p>
        <p><strong>¿Cómo sé cual línea de intervención seleccionar?</strong> Los proyectos realizados siguen áreas específicas. Selecciona una línea de intervención para ver la descripción, área y políticas asociadas.</p>
        <p><strong>¿Debo agregar el símbolo de moneda para el valor económico del proyecto?</strong> No, el sistema lo procesará automáticamente.</p></br>
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
  document.getElementById("name").setCustomValidity("Debes llenar este campo");
  document.getElementById("objective").setCustomValidity("Debes llenar este campo");

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };

  $('#lineid').on('change', function(){
    var line_id = $(this).val();
    console.log('LINE:'+line_id);
    document.getElementById("line").value = line_id;

    $.ajax({
      url: '{{asset("project/line/id")}}'.replace('id',line_id),
      type:'GET',
      dataType:'json',

      success:function(data) {
        $('#description-line').text(data.description);
        $('#area').text(data.area);
        console.log('Hi');
        $('#policy').text(data.policy);

      },
    });

  });

  $('#startdate').on('change', function(){
    var sdate = document.getElementById("startdate").value;
    console.log('current_date: '+sdate);

    document.getElementById("deadline").value = sdate;
    document.getElementById("deadline").min = sdate;
  });
</script>

@endsection
