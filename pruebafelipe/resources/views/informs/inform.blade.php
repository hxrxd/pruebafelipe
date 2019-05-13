@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Ficha de Resultados / <small> Proyecto {{$ty}}</h5>
        <div class="ibox-tools">
        </div>
      </div>

      <div class="ibox-content">
        {!! Form::open(['route'=>'project.store','class'=>'form-horizontal','method'=>'POST']) !!}

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-10">
            <img src="{{asset('img/logo_vice.png')}}" alt="logo-vice" width="auto" height="7%" style="padding-bottom:0; cursor: pointer;">
            <img src="{{asset('img/logo_usac.png')}}" alt="logo-usac" width="auto" height="7%" style="padding-bottom:0; cursor: pointer;">
            <img src="{{asset('img/logo_epsum.png')}}" alt="logo-epsum" width="auto" height="7%" style="padding-bottom:0; cursor: pointer;">
          </div>
        </div>

        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h1>Proyecto {{$ty}}</h1>
            <p>Inicio: {{Session::get('pj')->startdate}}, Finalización: {{Session::get('pj')->deadline}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Nombre</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{Session::get('pj')->name}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Ubicación</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{Session::get('pj')->location}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo General</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{Session::get('pj')->objective}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivos Específicos</label>
          <div class="col-sm-10">
            @foreach ($allWorkplans as $wp)
              <p style="font-size:16px;">• {{$wp->objective_what}}</p>
            @endforeach
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Desarrollo Metodológico</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$final->methodology}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Línea de intervención</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$line->name}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Área de intervención</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$line->area}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Políticas asociadas</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$line->policy}}</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Metas</label>
          <div class="col-sm-10">
            @foreach ($allWorkplans as $wp)
              <p style="font-size:16px;">• {{$wp->objective_what_for}}</p>
            @endforeach
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Usuarios directos</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$final->direct_users}} personas</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Usuarios indirectos</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">{{$final->indirect_users}} personas</p>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Aporte económico técnico al proyecto</label>
          <div class="col-sm-10">
            <p style="font-size:16px;">Q.{{Session::get('pj')->budget}}</p>
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
            <a href="{{url('results/report')}}" type="button" class="btn btn-primary">Generar Reporte</a>
            <a href="{{ URL::previous() }}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Volver</a>
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
    document.getElementById("line").value = line_id;

    $.ajax({
      url: '/project/line/'+line_id,
      type:"GET",
      dataType:"json",

      success:function(data) {
        $('#description-line').text(data.description);
        $('#area').text(data.area);
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
