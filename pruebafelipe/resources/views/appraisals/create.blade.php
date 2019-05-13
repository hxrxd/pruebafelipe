@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Evaluación</h5>
        <div class="ibox-tools">
        </div>
      </div>
      <div class="ibox-content">
        {!! Form::open(['route'=>'appraisals.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-4" style="text-align:right; color:#e2e2e2"><i class="fa fa-comments-o   modal-icon"></i></h1>
          <div class="col-sm-8">
            <h2>Evaluación del Supervisor</h2>
          </div>
        </div>

         {!!Form::hidden('supervisor',$supervisor->name)!!}
         {!!Form::hidden('student',$student->id_student )!!}


        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">Supervisor</label>
          <div class="col-sm-8">
            {!!Form::text('supervisor2',$supervisor->name,['class'=>'form-control','id'=>'introduction','placeholder'=>'Supervisor asignado', 'disabled'=>'','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")', 'maxlength'=>'1024'])!!}
          </div>
        </div>



        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Estudias en la jornada?</label>
          <div class="col-sm-8">
            {!!Form::select('journey',[0 => 'Única', 1 => 'Matutina',2 =>'Vespertina',3=>'Nocturna',4=>'Plan fin de semana'],null,['class'=>'form-control m-b','id'=>'journey'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál es tu estado civil?</label>
          <div class="col-sm-8">
            {!!Form::select('civil_status',[0 => 'Soltero', 1 => 'Casado',2 =>'Unido'],null,['class'=>'form-control m-b','id'=>'civil_status'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál es tu Ocupación?</label>
          <div class="col-sm-8">
            {!!Form::select('economic_activity',[0 => 'Desempleado', 1 => 'Trabajando',2 =>'Empresa propia', 3=>'No trabaja'],null,['class'=>'form-control m-b','id'=>'economic_activity'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Existía comunicación con el supervisor?</label>
          <div class="col-sm-8">
            {!!Form::select('comunication',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'comunication'])!!}
          </div>
        </div>
         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál era el médio más común en el cual se comenzaba la comunicación?</label>
          <div class="col-sm-8">
            {!!Form::select('desc_comunication',[0 => 'Usted lo contactaba', 1 => 'El supervisor lo contactaba',2=>'Ambas eran comúnes'],null,['class'=>'form-control m-b','id'=>'desc_comunication'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál era el tipo más frecuente de comunicación que recibía?</label>
          <div class="col-sm-8">
            {!!Form::select('type_comunication',[0 => 'Ninguna', 1 => 'Redes Sociales (Facebook, Whatsapp...)',2=>'Correo Electrónico',3=>'Teléfono'],null,['class'=>'form-control m-b','id'=>'type_comunication'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Con cuánta frecuencia esta se daba?</label>
          <div class="col-sm-8">
            {!!Form::select('lapse_comunication',[0 => 'Nunca', 1 => 'Semestral',2=>'Trimestral',3=>'Bimestral',4=>'Mensual',5=>'Quincenal',6=>'Semanal',7=>'Más de 3 veces a la semana',8=>'Diario'],null,['class'=>'form-control m-b','id'=>'lapse_comunication'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Era clara y comprensible la manera con la cual él se comunicaba con usted?</label>
          <div class="col-sm-8">
            {!!Form::select('understandable_comunication',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'understandable_comunication'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Se comunicaba él de una buena manera, siendo respetuosa y adecuada?</label>
          <div class="col-sm-8">
            {!!Form::select('respect_communication',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'respect_communication'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cumplía con los ofrecimientos, fechas e insumos qué él prometía?</label>
          <div class="col-sm-8">
            {!!Form::select('fulfillment',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'fulfillment'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la comunicación que tuvo su supervisor con usted?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_comunication',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_comunication'])!!}
          </div>
        </div>
         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Considera que su supervisor le brindaba un acompañamiento a conciencia?</label>
          <div class="col-sm-8">
            {!!Form::select('accompaniment',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'accompaniment'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Presentaba interés en sus problemáticas y proyectos que usted presentaba?</label>
          <div class="col-sm-8">
            {!!Form::select('interest',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'interest'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a sus proyectos, informes y diagnósticos?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_advisory',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_advisory'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál era el tipo de asosoría mas frecuente en sus proyectos, informes y diagnósticos?</label>
          <div class="col-sm-8">
            {!!Form::select('type_advisory',[0 => 'Ninguna', 1 => 'Ortográfica',2=>'Legal',3=>'Técnica'],null,['class'=>'form-control m-b','id'=>'type_advisory'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a su proyecto monodisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_mono',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_mono'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a su proyecto multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_multi',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_multi'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a su proyecto de convivencia?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_convivencia',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_convivencia'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a su diagnostico?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_dx',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_dx'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría la asesoría brindada a su plan de trabajo?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_wp',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_wp'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Resolvió las situaciones que usted le planteaba o buscaba soluciones?</label>
          <div class="col-sm-8">
            {!!Form::select('resolution',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'resolution'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría el acompañamiento recibido por su supervisor?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_accompaniment',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_accompaniment'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Considera que su supervisor lo respetó como estudiante y ser humano?</label>
          <div class="col-sm-8">
            {!!Form::select('respect',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'respect'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Fue comprensivo con usted en situaciones que consideraba que usted lo ameritaba?</label>
          <div class="col-sm-8">
            {!!Form::select('understandable',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'understandable'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cooperó con usted en momentos en que usted lo necesitaba?</label>
          <div class="col-sm-8">
            {!!Form::select('cooperation',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'cooperation'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Fue cortés y amable con usted?</label>
          <div class="col-sm-8">
            {!!Form::select('amiability',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'amiability'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo valoraría usted a su supervisor finalmente?</label>
          <div class="col-sm-8">
            {!!Form::select('assess_supervisor',[0 => 'Mala', 1 => 'Pobre',2=>'Aceptable',3=>'Buena',4=>'Excelente'],null,['class'=>'form-control m-b','id'=>'assess_supervisor'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Algún caso considerable que amerita denunciarse?</label>
          <div class="col-sm-8">
            {!!Form::select('complaint',[0 => 'No', 1 => 'Si'],null,['class'=>'form-control m-b','id'=>'complaint'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Desea aportar o valorar algo más de su supervisor?</label>
          <div class="col-sm-8">
           {!!Form::textarea('desc_appraisals',null,['class'=>'form-control','id'=>'desc_appraisals','placeholder'=>'Valoración del supervisor, favor aportar algo ya que es un campo obligatorio, si no existe nada para aportar favor escribir NO','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'3', 'resize'=>'none'])!!}
          </div>
        </div>
         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Desea escribir su nombre?</label>
          <div class="col-sm-8">
           {!!Form::text('name_student',null,['class'=>'form-control','id'=>'name_student','placeholder'=>'Si deseas puedes dejar tu nombre','rows'=>'3', 'resize'=>'none'])!!}
          </div>
        </div>




        

        <div class="form-group"><label class="col-sm-4 control-label"></label>
          <div class="col-sm-8 iradio_square-green checked">
            {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
           
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
        <i class="fa fa-comments-o modal-icon"></i>
        <h4 class="modal-title">Evaluación del Supervisor</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Aparecen mis datos como nombre o registro académico?</strong> No, la encuesta es totalmente anónima y unicamente si tú quieres puedes escribir tu nombre al final</p>
        <p><strong>Todas las preguntas son obligatorias de responder?</strong> Sí. Asegurate de llenar toda la información solicitada para un mejor control.</p>
        <p><strong>¿Cuánto tiempo tengo para llenar la encuesta?</strong> Tienes 15 minutos antes de que se cierre tu sesión por inactividad</p>
        <p><strong>¿Quién puede acceder a la información que proporciono?</strong> Sólo la coordinación tiene acceso a los datos que registrados</p>
        <p><strong>¿Qué sucede si califico negativamente a mi supervisor?</strong> Nada, esperamos que seas franco, la información servirá para mejorar la experiencia de supervisión en futuras cohortes.</p>
        <p><strong>Mi supervisor no es el que aparece al inicio</strong> Esto puede suceder si se dió un cambio de supervisor, envia un correo </p>
        <p><strong>Cerré sesión accidentalmente sin terminar la encuensta, ¿Debo comenzar de nuevo?</strong> Si, debes de llenar la encuesta nuevamente, si no te lo permite es por que tu encuesta fue guardada correctamente.</p></br>
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
