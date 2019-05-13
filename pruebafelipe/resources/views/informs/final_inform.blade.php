@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Ficha de Resultados</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'inform.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-2" style="text-align:right; color:#e2e2e2"></h1>
          <div class="col-sm-10">
            <h2>Proyecto {{$ty}}</h2>
            <h4>Solo faltan algunas cosas que completar para generar tu ficha de resultados</h4>
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Desarrollo Metodológico</label>
          <div class="col-sm-10">
            {!!Form::textarea('methodology',null,['class'=>'form-control','id'=>'methodology','placeholder'=>'Breve descripción de la metodología aplicada para le proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'5', 'resize'=>'none'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Usuarios directos</label>
          <div class="col-sm-10">
            {!!Form::text('direct_users',null,['class'=>'form-control','id'=>'direct_users','placeholder'=>'Número de usuarios directos beneficiados con el proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Usuarios indirectos</label>
          <div class="col-sm-10">
            {!!Form::text('indirect_users',null,['class'=>'form-control','id'=>'indirect_users','placeholder'=>'Número de usuarios indirectos beneficiados con el proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
            {!!Form::hidden('project',Session::get('pj')->id,['class'=>'form-control','id'=>'project'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-10 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
            <a href="{{ URL::previous() }}" type="button" class="btn btn-primary btn-outline" style="margin-left:5px;">Cancelar</a>
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
        <i class="fa fa-check-circle-o modal-icon"></i>
        <h4 class="modal-title">Ficha final</h4>
        <h5>Solo falta registrar algunas cosas para completar tu ficha de resultados</h5>
      </div>
      <div class="modal-body">
        <p>Cuando termines de llenar los campos solicitados haz clic en Guardar para generar tu ficha.</p></br>
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
