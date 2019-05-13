@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Editar Diagnóstico <small>{{Session::get('team')->name}}</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::model($municipalmanagement,['route'=>['dx.municipalmanagement.update',$municipalmanagement->id],'class'=>'form-horizontal','method'=>'PUT']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2">7</h1>
          <div class="col-sm-10">
            <h2>Gestión Municipal</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 project-completion">
            <div class="progress progress-mini">
              <div style="width: 84%;" class="progress-bar"></div>
            </div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Índice de gestión municipal</label>
          <div class="col-sm-10">
            {!!Form::text('municipal_management_index',null,['class'=>'form-control','id'=>'municipal_management_index','placeholder'=>'Índice de gestión municipal','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Actualizar y finalizar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin")
              <a href="{{url('dx/all')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Volver a diagnósticos</a>
            @else              
              <a href="{{url('dx/close')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
            @endif
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
        <i class="fa fa-info-circle modal-icon"></i>
        <h4 class="modal-title">Editar Diagnóstico</h4>
      </div>
      <div class="modal-body">
        <p><strong>Modifica la información sólo si es necesario.</strong> Ingresa la información en los campos que se requieran y luego haz clic en <strong>Actualizar.</strong></p>
        <p>Si no deseas actualizar cambios para el apartado mostrado, haz clic en <strong>Siguiente</strong> hasta llegar al apartado que necesites modificar.</p>
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

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };
</script>

@endsection
