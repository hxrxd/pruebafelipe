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
        {!! Form::open(['route'=>'inventory.article.store','class'=>'form-horizontal','method'=>'POST']) !!}
        {{ csrf_field() }}

        <div id="inv-reg" class="animated fadeInUp">

        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-7">
            <h2 style="color:#1ab394;">Registro de Activos Fijos</h2>
            <h5 style="color:#c0c0c0">Proveedor: {{$provider->name}}</h5>
          </div>
          <div class="col-sm-3">
            <p>Factura No. </p><h3>{{$purchase->number}}</h3>
          </div>
        </div>


        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-6">
            <label class="control-label" style="font-size:11px"></label>
          </div>
          <div class="col-sm-4">
            <label class="control-label" style="font-size:11px">No. Inventario</label>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Bien mueble</label>
            <div class="col-sm-6">
              {!!Form::select('article',$articles,null,['id'=>'article','class'=>'form-control m-b chosen-select art-select', 'tablaindex'=>'2'])!!}
            </div>
            <div class="col-sm-4">
              {!!Form::text('inv_number',null,['class'=>'form-control','id'=>'inv_number','placeholder'=>'Número de inventario'])!!}
            </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Descripción</label>
          <div class="col-sm-10">
            {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Ingrese una descripción para el bien mueble','rows'=>'2','readonly'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">Valor (Q.)</label>
          </div>
          <div class="col-sm-3">
            <label class="control-label" style="font-size:11px">No. Tarjeta de responsabilidad</label>
          </div>
          <div class="col-sm-4">
            <label class="control-label" style="font-size:11px">Fecha de apertura</label>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px"></label>
          <div class="col-sm-3">
            {!!Form::text('value',null,['class'=>'form-control art-cost','id'=>'value','placeholder'=>'Valor del bien', 'readOnly'])!!}
          </div>
          <div class="col-sm-3">
            {!!Form::text('resp_target_number',null,['class'=>'form-control','id'=>'resp_target_number','placeholder'=>'Número de tarjeta de responsabilidad'])!!}
          </div>
          <div class="col-sm-4">
            {!!Form::date('open_date', \Carbon\Carbon::now(),['id'=>'open_date','class'=>'form-control','required'=>'']); !!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Encargado</label>
            <div class="col-sm-10">
              {!!Form::select('employee',$employees,null,['id'=>'employee','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2'])!!}
            </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label">Observaciones</label>
            <div class="col-sm-10">
              {!!Form::text('observations',null,['class'=>'form-control','id'=>'observations','placeholder'=>'Notas para el bien a registrar'])!!}
              {!!Form::hidden('purchase',$purchase->id,['class'=>'form-control','id'=>'purchase'])!!}
            </div>
        </div>


        <div class="form-group"><label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <a  type="button" class="btn btn-primary reg-art" style="margin-left:5px; float:right;">Registrar bien</a>
            </div>
        </div>



        <div class="form-group"><h3 class="col-sm-2 control-label"></h3>
          <div class="col-sm-10">
            <div class="table-responsive">

            <table id="acts" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th style="min-width:200px;">No. de Inventario</th>
                <th>No. Tarjeta de Responsabilidad</th>
                <th>Fecha de apertura</th>
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


        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            <a href="{{url('inventory/create')}}" type="button" class="btn btn-lg btn-primary" style="margin-left:5px;">Registrar otra factura</a>
            <a href="{{url('inventory/articles')}}" type="button" class="btn btn-lg btn-primary btn-outline" style="margin-left:5px;">Finalizar</a>
            <button type="button" class="btn btn-success btn-circle" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-question"></i></button>
          </div>
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
  var pid;

  $(document).ready( function(){
      pid = "{{$purchase->id}}";
      $('#inv_number').val(generateInvCorrelative(pid));
      $('#resp_target_number').val(pad(pid,4));
  });

  $('.chosen-select').chosen({width: "100%"});

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };

  function generateInvCorrelative(index){
      var d = new Date();
      var year = d.getFullYear();

      const INV = '4.33.5-C-';
      var correlative = INV + pad(index,4) + '-' + year;
      console.log(correlative);
      return correlative;
  }

  $(document).ready(function () {
    $(".reg-art").click(function() {
      if(validateFields()){

        /*console.log('---------------------');
        console.log($('#purchase').val());
        console.log($('#article').val());
        console.log($('#inv_number').val());
        console.log($('#open_date').val());
        console.log($('#resp_target_number').val());
        console.log($('#observations').val());
        console.log('---------------------');*/

      $.ajax({
          type: 'post',
          url: '{{asset("reg/article")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'purchase': $('#purchase').val(),
              'article': $('#article').val(),
              'inv_number': $('#inv_number').val(),
              'open_date': $('#open_date').val(),
              'resp_target_number': $('#resp_target_number').val(),
              'employee': $('#employee').val(),
              'observations': $('#observations').val()
          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
                  toastr.success('Error','No se pudo registrar la información');
              } else {
                  console.log('SUCCESS_FLAG');
                  toastr.success('Bien mueble registrado','Se ha guardado la información');

                  $('#acts').append('<tbody>');
                  $('#acts').append('<tr><td style="min-width:200px;">' + data.inv_number + "</td><td>" + data.resp_target_number + "</td><td>"+data.open_date+"</td></tr>");
                  $('#acts').append('</tbody>');
              }
          },
      });

      pid = Number(pid) + 1;

      $('#inv_number').val(generateInvCorrelative(pid));
      $('#resp_target_number').val(pad(pid,4));
      $('#observations').val();

      }
    });
  });

  function validateFields(){
    if(document.getElementById("resp_target_number").validity.valueMissing
    || document.getElementById("inv_number").validity.valueMissing){
        swal({
            title: "Falta información",
            text: "Verifica que has llenado todos los campos"
        });
        return false;
    }else{
        return true;
    }
  }

  function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }

  $('.art-select').on('change', function(){
    var article_id = $(this).val();

    $.ajax({
      url: '{{asset("regis/fill/id")}}'.replace('id',article_id),
      type:'GET',
      dataType:'json',

      success:function(data) {
        $('#description').val(data.description);
        $('.art-cost').val(data.cost);
        console.log('desc: '+data.description+' cost: '+data.cost);
      },
    });


  });
</script>

@endsection
