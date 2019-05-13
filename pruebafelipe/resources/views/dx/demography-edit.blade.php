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
        {!! Form::model($demography,['route'=>['dx.demography.update',$demography->id],'class'=>'form-horizontal','method'=>'PUT']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2">2</h1>
          <div class="col-sm-10">
            <h2>Demografía</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 project-completion">
            <div class="progress progress-mini">
              <div style="width: 14%;" class="progress-bar"></div>
            </div>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Descripción</label>
          <div class="col-sm-10">
            {!!Form::text('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Breve descripción acerca de la población del lugar'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población (0-14 años)</label>
          <div class="col-sm-10">
            {!!Form::text('population_0_to_14',null,['class'=>'form-control','id'=>'population_0_to_14','placeholder'=>'Población de 0 a 14 años de edad','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población (15-64 años)</label>
          <div class="col-sm-10">
            {!!Form::text('population_15_to_64',null,['class'=>'form-control','id'=>'population_15_to_64','placeholder'=>'Población de 15 a 64 años de edad','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población (65+ años)</label>
          <div class="col-sm-10">
            {!!Form::text('population_65_or_more',null,['class'=>'form-control','id'=>'population_65_or_more','placeholder'=>'Población de 65 años de edad o más','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población mujeres</label>
          <div class="col-sm-10">
            {!!Form::text('population_women',null,['class'=>'form-control','id'=>'population_women','placeholder'=>'Cantidad de mujeres en la población','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población hombres</label>
          <div class="col-sm-10">
            {!!Form::text('population_men',null,['class'=>'form-control','id'=>'population_men','placeholder'=>'Cantidad de hombres en la población','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población rural</label>
          <div class="col-sm-10">
            {!!Form::text('population_rural',null,['class'=>'form-control','id'=>'population_rural','placeholder'=>'Población rural','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población urbana</label>
          <div class="col-sm-10">
            {!!Form::text('population_urban',null,['class'=>'form-control','id'=>'population_urban','placeholder'=>'Población urbana','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población indígena</label>
          <div class="col-sm-10">
            {!!Form::text('population_indigenous',null,['class'=>'form-control','id'=>'population_indigenous','placeholder'=>'Población indígena','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población garífuna</label>
          <div class="col-sm-10">
            {!!Form::text('population_garifuna',null,['class'=>'form-control','id'=>'population_garifuna','placeholder'=>'Población garífuna','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Población xinca</label>
          <div class="col-sm-10">
            {!!Form::text('population_xinca',null,['class'=>'form-control','id'=>'population_xinca','placeholder'=>'Población xinca','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Actualizar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{url('dx/3/edit')}}" type="button" class="btn btn-primary" style="margin-left:5px;">Siguiente</a>
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
