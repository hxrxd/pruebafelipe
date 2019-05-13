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
        {!! Form::open(['route'=>'dx.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2">0</h1>
          <div class="col-sm-10">
            <h2>Registro</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 project-completion">
            <h6>Completado: 0%</h6>
            <div class="progress progress-mini">
              <div style="width: 0%;" class="progress-bar"></div>
            </div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Introducción</label>
          <div class="col-sm-10">
            {!!Form::textarea('introduction',null,['class'=>'form-control','id'=>'introduction','placeholder'=>'Ingresa una breve introducción para el diagnóstico...','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'4', 'resize'=>'none', 'maxlength'=>'1024'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo General</label>
          <div class="col-sm-10">
            {!!Form::textarea('objective',null,['class'=>'form-control','id'=>'objective','placeholder'=>'Objetivo general del diagnóstico.','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'3', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{URL::previous()}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Seguir editando más tarde</a>
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
        <p><strong>¿La opción <strong>Seguir editando más tarde</strong> guarda los cambios que he realizado?</strong> Sí, los cambios se registran hasta el último punto que seleccionaste <strong>Guardar</strong>. Dicha opción te permite seguir trabajando en otro momento o dar la oportunidad a que un integrante de tu equipo continúe con el registro del diagnóstico.</p>
        <p><strong>¿Debo escribir símbolos especiales como el de porcentaje (%) o de moneda?</strong> No, el sistema los procesará automáticamente.</p>
        <p><strong>Cerré sesión accidentalmente sin guardar los cambios, ¿Debo comenzar de nuevo?</strong> No necesariamente, se registrarán los cambios hasta el último punto donde seleccionaste <strong>Guardar</strong>.</p></br>
        <p>Puedes volver a consultar esta información haciendo clic en el botón <strong><i class="fa fa-question-circle-o" style="font-size:14px"></i></strong></p>
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
  document.getElementById("introduction").setCustomValidity("Debes llenar este campo");
  document.getElementById("objective").setCustomValidity("Debes llenar este campo");
</script>

@endsection
