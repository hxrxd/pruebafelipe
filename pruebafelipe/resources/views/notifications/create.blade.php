@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="sheet" class="ibox float-e-margins white-bg">

      <!-- Title bar -->

      <div class="row">
          <div class="col-lg-12">
              <button onclick="location.href='{{ url('/')}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 id="title" class="title">Nueva notificación</h1>
                        <h4>Alertas de Plataforma MiE</h4>
                    </div>
                </div>
          </div>
      </div>

      <!-- content -->

      <div id="edit-dialog" class="cool-form" style="display:block">
        <div class="animated fadeInUp">
          <form class="form-horizontal">

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Para</label>
            <div class="col-sm-10">
              <div><!--<div class="editable-select-arrow">-->
                <input type="hidden" id="to-id">
                <select id="to-select">
                  @foreach($supervisors_mails as $mail)
                    <option>{{$mail->mail}}</option>
                  @endforeach
                  <option>Todos los supervisores</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Asunto</label>
            <div class="col-sm-10">
              <input id="subject" type="text" class="cool-input" placeholder="Motivo de la alerta. Ejemplo: Cambio en x funcionalidad" maxlength="160"></input>
            </div>
          </div><br>

          <div class="form-group"><label class="col-sm-2 control-label box-label-secoundary">Mensaje</label>
            <div class="col-sm-10">
              <textarea id="message" class="box-taco" placeholder="Escribe tu mensaje..." maxlength="512" rows="9"></textarea>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-2 control-label"></label>
            <div class="col-sm-10 iradio_square-green checked">
              <button type="button" id="send-button" class="cool-button hvr-grow">Enviar alerta</button>
              <button type="button" id="clean-button" class="cool-button-secoundary hvr-grow" style="margin-left:10px;">Limpiar campos</button>
            </div>
          </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>






@endsection

@section('script')
<script src="{{asset('js/jquery-editable-select.js')}}"></script>
<script>
var recipients = {!! json_encode($supervisors_mails) !!};

$('#to-select').editableSelect('holder','Email del destinatario o seleccione "Todos los supervisores"');

$('#send-button').click(function(){

  if($('#to-select').val() === 'Todos los supervisores'){
    recipients.forEach(function(recipient){
      notify(
        '{{asset("send/notification")}}', //url
        'Aviso importante', //title of notification
        $('#subject').val(), //description
        document.getElementById('message').value, //message for notification (optional)
        'miepsum@gmail.com', //email of emisor
        recipient.mail, //email of receptor
        'no-link', //link for open from notification
        '1' //type
      );
    });
    swal("¡Alerta enviada!", "El mensaje fue enviado correctamente a todos los supervisores", "success");
  }else{
    notify(
      '{{asset("send/notification")}}', //url
      'Aviso importante', //title of notification
      $('#subject').val(), //description
      document.getElementById('message').value, //message for notification (optional)
      'miepsum@gmail.com', //email of emisor
      $('#to-select').val(), //email of receptor
      'no-link', //link for open from notification
      '1' //type
    );
    swal("¡Alerta enviada!", "El mensaje fue enviado correctamente", "success");
  }
});

$('#clean-button').click(function(){
  document.getElementById('message').value = '';
  $('#subject').val('');
  $('#to-select').editableSelect('clean');
  $('#to-select').editableSelect('filter');
})

</script>
<style>
input.es-input{width:100%;padding-right:10px!important;padding-bottom: 8px;padding-left: 10px;outline: none;border: 0px;border-bottom: 3px solid #c3c3c3;background-color:transparent;font-size: 20px;}
input.es-input:hover,
input.es-input:focus{border-bottom: 3px solid #2ebeef;}
input.es-input.open{-webkit-border-bottom-left-radius:0;-moz-border-radius-bottomleft:0;border-bottom-left-radius:0;-webkit-border-bottom-right-radius:0;-moz-border-radius-bottomright:0;border-bottom-right-radius:0}
.es-list{position:absolute;padding:0;margin:0;border:1px solid #d1d1d1;display:none;z-index:1000;background:#fff;max-height:256px;overflow-y:auto;-moz-box-shadow:0 2px 3px #ccc;-webkit-box-shadow:0 2px 3px #ccc;box-shadow:0 2px 3px #ccc;font-size:16px}
.es-list li{display:block;padding:5px 10px;margin:0}
.es-list li.selected{background:#f3f3f3}
.es-list li[disabled]{opacity:.5}
</style>
@endsection
