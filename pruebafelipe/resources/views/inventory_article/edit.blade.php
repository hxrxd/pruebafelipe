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
        {!! Form::model($art,['route'=>['inventory.article.update',$art->id],'class'=>'form-horizontal','method'=>'PUT']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2>Editar información de bien</h2>
          </div>
        </div>



        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Nombre</label>
          <div class="col-sm-10">
            {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Nombre del bien mueble'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Descripción</label>
          <div class="col-sm-10">
            {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Ingrese una descripción para el bien mueble','rows'=>'2'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Proveedor</label>
            <div class="col-sm-10">
           {!!Form::select('provider',$providers,null,['id'=>'provider','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2'])!!}
            </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Valor (Q.)</label>
          <div class="col-sm-10">
            {!!Form::text('cost',null,['class'=>'form-control','id'=>'cost','placeholder'=>'Ingrese el valor del bien'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{url('inventory/articles')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Cancelar</a>
            <a href="{{url('inventory/articles')}}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
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
