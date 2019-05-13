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
        {!! Form::open(['route'=>'partnerrating.store','class'=>'form-horizontal','method'=>'POST']) !!}
        <div class="form-group"><h1 class="col-sm-4" style="text-align:right; color:#e2e2e2"><i class="fa fa-comments-o   modal-icon"></i></h1>
          <div class="col-sm-8">
            <h2>Evaluación de la Sede</h2>
          </div>
        </div>

         {!!Form::hidden('headquarter',$hq->id_headquarters)!!}
         {!!Form::hidden('student',$student->id_student )!!}


        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">Sede</label>
          <div class="col-sm-8">
            {!!Form::text('hq2',$hq->name,['class'=>'form-control','id'=>'introduction','placeholder'=>'Sede asignada', 'disabled'=>'','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")', 'maxlength'=>'1024'])!!}
          </div>
        </div>



        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Existe espacio físico en la institución para que el equipo multidisciplinario pueda realizar su ejercicio profesional supervisado en equipo? (Ejemplo: las oficinas, cubículos, escritorios o espacios que dispone el estudiante)</label>
          <div class="col-sm-8">
            {!!Form::select('space',['1' => 'Sí hay espacio disponible dentro de la institución para el equipo.', '0.5' => 'Sí hay especio disponible para parte del equipo multidisciplinario.','0' =>'No hay espacio disponible dentro de la institución para el equipo multidisciplinario.',],null,['class'=>'form-control m-b','id'=>'space', 'style'=>'align:center'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Las condiciones físicas de la institución donde estará el equipo multidisciplinario se encuentran ubicadas en una sola sede,  cuentan con espacio con condiciones higiénicas y óptimas? (Ejemplo: ventilación, iluminación, hacinamiento)</label>
          <div class="col-sm-8">
            {!!Form::select('desc_space',['1' => 'Sí se cumplen con condiciones físicas para la recepción del equipo multidisciplinario', '0.5' => 'Se cumple con las condiciones físicas parcialmente (estar ubicado en un solo edificio) (condiciones higiénicas y óptimas)','0' =>'No se cumplen con las condiciones físicas ',],null,['class'=>'form-control m-b','id'=>'desc_space', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Hay mobiliario y equipo dentro de la institución para el ejercicio profesional supervisado del  equipo multidisciplinario siendo este? (Ejemplo: equipos de cómputo, equipo de reproducción, equipo de visualización y sonido, además de  equipo ad hoc para una tarea especializada: arquitectura, medicina, agronomía y demás) </label>
          <div class="col-sm-8">
            {!!Form::select('equipment',['1' => 'Sí existe disponibilidad de inmobiliario y equipo para el ejercicio profesional supervisados del equipo multidisciplinario, incluyendo equipo ad hoc para tareas ', '0.5' => 'Sí existe disponibilidad de inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario, aunque no hay equipo ad hoc para tareas especializadas.','0' =>'No existe disponibilidad  de inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario',],null,['class'=>'form-control m-b','id'=>'equipment', 'style'=>'align:center'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Las condiciones del mobiliario y equipo existente dentro de la institución se encuentran en buen estado y están debidamente actualizadas? (Ejemplo: equipo de cómputo, equipo de reproducción, equipo de visualización y sonido, además hay  equipo ad hoc para una tarea especializada: arquitectura, medicina, agronomía y demás)</label>
          <div class="col-sm-8">
            {!!Form::select('desc_equipment',['1' => 'Las condiciones del inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario, incluyendo equipo ad hoc para tareas especializadas están en óptimas condiciones y debidamente actualizada.',' 0.75' => ' Las condiciones del inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario, incluyendo equipo ad hoc para tareas especializadas están en óptimas condiciones aunque no están debidamente actualizadas.','0.5'=>'Las condiciones del inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario son buenas y actualizadas, aunque no hay equipo ad hoc para tareas especializadas.','0.25 '=>'Las condiciones del inmobiliario y equipo para el ejercicio profesional supervisado del equipo multidisciplinario son buenas aunque no están actualizadas y no hay equipo ad hoc para tareas especializadas','0' =>'No hay espacio disponible dentro de la institución para el equipo multidisciplinario.'],null,['class'=>'form-control m-b','id'=>'desc_equipment', 'style'=>'align:center'])!!}
          </div>
        </div>

         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Los miembros del equipo multidisciplinario se encontraban cercanos dentro de la sede de práctica?</label>
          <div class="col-sm-8">
            {!!Form::select('location',['1' => 'Se estaba cerca de los demás miembros del equipo, todos estábamos en un mismo edificio', '0.5' => 'Se estaba en distintos edificios que posee la institución, aunque en la misma localidad.','0' =>'El equipo estaba localizado en varias localidades a varios kilómetros de distancia. ',],null,['class'=>'form-control m-b','id'=>'location', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Se le fue asignada una comunidad por parte de la sede de práctica al equipo multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('community',['1' => 'Fue asignada una comunidad específica por parte de la sede durante los primeros ocho días hábiles de estancia en la sede.', '0.5' => 'Se asignó una comunidad después de los primeros ocho días hábiles de estancia en la sede','0' =>'No se asignó ninguna comunidad por parte de la sede',],null,['class'=>'form-control m-b','id'=>'community', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿La sede de práctica le permitía al equipo multidisciplinario el tiempo necesario para el desarrollo del proyecto multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('team_time',['1' => 'El socio daba 3 días a la semana para la realización del proyecto',' 0.75' => ' El socio daba 2 1/2 días a la semana para la realización del proyecto','0.5'=>'El socio daba 2 días a la semana para la realización del proyecto','0.25 '=>'El socio daba 1 día a la semana para la realización del proyecto.','0' =>' El socio daba menos de 1 día a la semana para la realización del proyecto.'],null,['class'=>'form-control m-b','id'=>'team_time', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cómo fueron utilizadas las capacidades de cada miembro del equipo multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('capabilities',['1' => 'Desarrollé plenamente mis capacidades dentro de las funciones asignadas por parte del socio.',' 0.75' => 'Creo que pude haber desarrollado más mis capacidades dentro de las funciones asignadas por parte del socio.','0.5'=>'No desarrollé tanto mis capacidades como hubiera deseado en las funciones que me asignó el socio','0.25' =>'Mis capacidades fueron infravaloradas en las funciones que me asignó el socio','0'=>'No desarrollé mis capacidades en las funciones asignadas por el socio'],null,['class'=>'form-control m-b','id'=>'capabilities', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Valore el desarrollo de las capacidades del equipo multidisciplinario por parte del socio?</label>
          <div class="col-sm-8">
            {!!Form::select('asses_capabilities',['1' => 'Se desarrollaron plenamente las capacidades del equipo dentro en las asignaciones por parte del socio',' 0.75' => 'Creo que se pudieron haber desarrollado más las capacidades del equipo dentro de las asignaciones de parte del socio','0.5'=>'No se desarrollaron tanto las capacidades del equipo como hubiéramos deseado','0.25' =>'Las capacidades del equipo fueron infravaloradas por las asignaciones del socio','0'=>'No se utilizaron las capacidades del equipo por parte de las asignaciones del socio'],null,['class'=>'form-control m-b','id'=>'asses_capabilities', 'style'=>'align:center'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Valore el trato recibido por parte del socio hacía el equipo multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('relationship',['1' => 'Se nos trató con mucho respeto en lo individual y como equipo, no hay incidentes que reportar por parte del personal del socio',' 0.75' => 'Se nos trató con respeto en lo individual y como equipo, aunque hubieron algunos incidentes que reportar, por parte del personal del socio.','0.5'=>'No se nos trató siempre con respeto en lo individual y como equipo, habiendo que reportar incidentes por parte del personal del socio.','0.25' =>'No se nos trató con respeto, habiendo que reportar frecuentes incidentes por parte del personal del socio.','0'=>'No se nos trató con respeto y hay demasiados incidentes que reportar, por parte del personal del socio.'],null,['class'=>'form-control m-b','id'=>'relationship', 'style'=>'align:center'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Cuál es el conocimiento y aceptación que tiene el socio de la metodología del Programa EPSUM?</label>
          <div class="col-sm-8">
            {!!Form::select('knowledge',['1' => 'El socio sí conoce la metodología utilizada por el Programa EPSUM y la acepta plenamente.',' 0.75' => 'El socio tiene algunas nociones de la metodología utilizada por el Programa EPSUM y la acepta plenamente.','0.5'=>'El socio tiene algunas nociones de la metodología utilizada por el Programa EPSUM, aunque no propicia el cumplimiento de la misma en ocasiones.','0.25' =>'El socio tiene algunas nociones de la metodología utilizada por el Programa EPSUM, pero no propicia el cumplimiento de la misma.','0'=>'No se conoce la metodología del Programa EPSUM por parte del socio.'],null,['class'=>'form-control m-b','id'=>'knowledge', 'style'=>'align:center'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Le brindó al equipo multidisciplinario facilidades la sede para movilizarse dentro del área geográfica de influencia de la sede?</label>
          <div class="col-sm-8">
            {!!Form::select('transport',['1' => 'El socio otorgó transporte todas las veces que se hacía necesario ir a la comunidad o sí se iba de comisión a un lugar específico.',' 0.75' => 'El socio otorgó transporte la mayoría de las veces que se hacía necesario ir a la comunidad o sí se iba de comisión a un lugar específico.','0.5'=>'El socio no otorgó transporte las veces que se hacía necesario ir a la comunidad pero sí otorgó el mismo sí se iba de comisión a un lugar específico.','0.25' =>'El socio no otorgó transporte las veces que se hacía necesario ir a la comunidad y otorgó algunas veces el mismo sí se iba de comisión a un lugar específico.','0'=>'El socio no otorgó transporte las veces que se hacía necesario ir a la comunidad y tampoco  otorgó sí se iba de comisión a un lugar específico.'],null,['class'=>'form-control m-b','id'=>'transport', 'style'=>'align:center'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Se le brindó estipendio económico en forma de viáticos al equipo multidisciplinario para realizar tareas que la sede le requiriera?</label>
          <div class="col-sm-8">
            {!!Form::select('stipend',['1' => 'El socio brindó estipendio económico en la forma de viáticos en comisiones asignadas., incluyendo equipo ad hoc para tareas ', '0.5' => 'El socio brindó algunas veces estipendio económico en forma de viáticos en comisiones asignadas','0' =>'No se asignó ningún estipendio económico en forma de viáticos por parte del socio en las comisiones asignadas',],null,['class'=>'form-control m-b','id'=>'stipend', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Les brindó la sede  oportunidades para recibir capacitaciones al equipo multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('materials',['1' => 'El socio brindó materiales y enseres en comisiones asignadas., incluyendo equipo ad hoc para tareas ', '0.5' => 'El socio brindó algunas veces emateriales y enseres en comisiones asignadas','0' =>'No se asignó ningún material y enser por parte del socio en las comisiones asignadas',],null,['class'=>'form-control m-b','id'=>'materials', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Le otorgó la sede materiales y enseres que haya solicitado el equipo multidisciplinario para realizar el proyecto multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('trainings',['1' => 'El socio propició y facilitó que el equipo recibiera capacitaciones por parte de organismos nacionales, internacionales o conferencistas invitados por parte de la sede', '0.5' => 'El socio propició y facilitó que algunos miembros del equipo recibiera capacitaciones por parte de organismos nacionales, internacionales o conferencistas invitados por parte de la sede','0' =>' No se propició o facilitó que el equipo recibiera capacitaciones por parte de organismo o conferencistas invitados por parte de la sede',],null,['class'=>'form-control m-b','id'=>'trainings', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Hubo disposición del socio para otorgar permisos para  realización del proyecto multidisciplinario del equipo multidisciplinario?</label>
          <div class="col-sm-8">
            {!!Form::select('permission',['1' => 'Se otorgaron siempre los permisos que solicitó el equipo para la realización del proyecto multidisciplinario', '0.5' => 'No se otorgaron algunos permisos que solicitó el equipo para la realización del proyecto multidisciplinario','0' =>'No se otorgaron los permisos que solicitó el equipo para la realización del proyecto multidisciplinario',],null,['class'=>'form-control m-b','id'=>'permission', 'style'=>'align:center'])!!}
          </div>
        </div>

        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Se percibieron factores de riesgo sociales en el ámbito geográfico de la sede del socio?</label>
          <div class="col-sm-8">
            {!!Form::select('social_risk',['1' => 'No hay factores de riesgo sociales', '0.75' => ' Hay algunos factores de riesgo sociales pero no son muy graves','0' =>'Hay factores de riesgo ',],null,['class'=>'form-control m-b','id'=>'social_risk', 'style'=>'align:center'])!!}
          </div>
        </div>
         <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Se percibieron factores de riesgo ambientales en el ámbito geográfico de la sede del socio?</label>
          <div class="col-sm-8">
            {!!Form::select('ambiental_risk',['1' => 'No hay factores de riesgo ambientales', '0.75' => ' Hay algunos factores de riesgo ambientales pero no son muy graves','0' =>'Hay factores de riesgo ',],null,['class'=>'form-control m-b','id'=>'ambiental_risk', 'style'=>'align:center'])!!}
          </div>
        </div>
        <div class="form-group"><label class="col-sm-4 control-label" style="font-size:11px">¿Desea aportar o valorar algo más del socio?</label>
          <div class="col-sm-8">
           {!!Form::textarea('desc_partner',null,['class'=>'form-control','id'=>'desc_partner','placeholder'=>'Valoración del socio, favor aportar algo ya que es un campo obligatorio, si no existe nada para aportar favor escribir NO','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'3', 'resize'=>'none'])!!}
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
        <h4 class="modal-title">Evaluación de la sede</h4>
        <h5>Preguntas frecuentes</h5>
      </div>
      <div class="modal-body">
        <p><strong>¿Aparecen mis datos como nombre o registro académico?</strong> No, la encuesta es totalmente anónima y unicamente si tú quieres puedes escribir tu nombre al final</p>
        <p><strong>Todas las preguntas son obligatorias de responder?</strong> Sí. Asegurate de llenar toda la información solicitada para un mejor control.</p>
        <p><strong>¿Cuánto tiempo tengo para llenar la encuesta?</strong> Tienes 15 minutos antes de que se cierre tu sesión por inactividad</p>
        <p><strong>¿Quién puede acceder a la información que proporciono?</strong> Sólo la coordinación tiene acceso a los datos que registrados</p>
        <p><strong>¿Qué sucede si califico negativamente a mi sede?</strong> Nada, esperamos que seas franco, la información servirá para mejorar la experiencia dentro de las sedes en futuras cohortes.</p>
        <p><strong>Mi sede no es la que aparece al inicio</strong> Esto puede suceder si se dió un cambio de sede, envia un correo para solventarlo</p>
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
