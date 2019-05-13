@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5></h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'inventory.store','class'=>'form-horizontal','method'=>'POST']) !!}
        {{ csrf_field() }}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2 style="color:#1ab394;">Compra</h2>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-7">
            <label class="control-label" style="font-size:11px">Proveedor</label>
          </div>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Factura No.</label>
          </div>
        </div>


        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
            <div class="col-sm-7">
              {!!Form::select('provider',$providers,null,['id'=>'provider','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2'])!!}
            </div>
            <div class="col-sm-3">
              {!!Form::text('number',null,['class'=>'form-control','id'=>'number','name'=>'number','placeholder'=>'No. de Factura','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
            </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Valor</label>
          </div>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Orden o Solicitud de Compra No.</label>
          </div>
          <div class="col-sm-4">
            <label class="control-label" style="font-size:11px">Fecha</label>
          </div>
        </div>


        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
            <div class="col-sm-3">
              {!!Form::text('value',null,['class'=>'form-control','id'=>'value','placeholder'=>'Valor en Q.','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
            </div>
            <div class="col-sm-3">
              {!!Form::text('oc_no','------',['class'=>'form-control','id'=>'oc_no','placeholder'=>'Orden o Solicitud de Compra No.'])!!}
            </div>
            <div class="col-sm-4">
              {!!Form::date('pdate', \Carbon\Carbon::now(),['id'=>'pdate','class'=>'form-control','required'=>'']); !!}
            </div></br>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            </br>
            {!! Form::Submit('Iniciar con el registro de inventario', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{url('inventory/articles')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Cancelar</a>
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
        <h4 class="modal-title">Registro de Inventario</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Todos los campos son obligatorios?</strong> Sí, asegúrese de completar todos los campos.</p>
        <p><strong>¿Puedo modificar la información autocompletada?</strong> Sí, verifique los campos autocompletados para mantener la consistencia de los datos registrados.</p>
        <p><strong>¿Como registro un bien en el registro del sistema?</strong></p>
        <p><strong>1. </strong>Ingrese la información del documento de compra a efecto de generar la tarjeta de responsabilidad.</p>
        <p><strong>2. </strong>Haga clic en Registrar para guardar la información. Se mostrará el formulario para registrar los bienes</p>
        <p><strong>3. </strong>Seleccione el bien a registrar (según el proveedor indicado) y complete la información para su registro. Repita este paso hasta ingresar todos los bienes indicados.</p>
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
  document.getElementById("number").setCustomValidity("Debes llenar este campo");
  document.getElementById("cost").setCustomValidity("Debes llenar este campo");

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };


</script>

<script>
      $('.chosen-select').chosen({width: "100%"});
      var elem = document.querySelector('.js-switch');
      var switchery = new Switchery(elem, { color: '#1AB394', size: 'small' });

</script>

@endsection
