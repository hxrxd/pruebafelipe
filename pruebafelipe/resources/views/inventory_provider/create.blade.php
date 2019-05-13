@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Registro de Proveedores</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'inventory.provider.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2>Nuevo Proveedor</h2>
          </div>
        </div>



        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Nombre *</label>
          <div class="col-sm-10">
            {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Ingrese el nombre del proveedor','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">NIT</label>
          <div class="col-sm-10">
            {!!Form::text('nit',null,['class'=>'form-control','id'=>'nit','placeholder'=>'Número de NIT del proveedor'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Teléfono</label>
          <div class="col-sm-10">
            {!!Form::text('phone',null,['class'=>'form-control','id'=>'phone','placeholder'=>'Número de teléfono del proveedor'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Correo electrónico</label>
          <div class="col-sm-10">
            {!!Form::text('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Correo electrónico del proveedor'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{url('inventory/providers')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Cancelar</a>
            <a href="{{url('inventory/providers')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
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
        <h4 class="modal-title">Registro de Proveedor</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Todos los campos son obligatorios?</strong> No, únicamente el campo del nombre es obligatorio.</p>
        <p>Es todo lo que necesitas saber</p>
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
</script>

@endsection
