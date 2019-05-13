@extends('admintemplate')

@section('style')

    {!!Html::style('css/plugins/fullcalendar/fullcalendar.css')!!}
    {!!Html::style('css/plugins/fullcalendar/fullcalendar.print.css', ['media'=>'print'])!!}

     <style type="text/css">

        .nice-event{
            background-color:#2ebeef;

        }

        .epsum-event{
            background-color:#2f4050;
        }

        .fc-listMonth-view td:hover{
            color: #000;
        }

        .fc-listMonth-view a:hover{
            color: #000;
        }


        .fc-list-item {
            color: #FFF;
        }

        .fc-event-dot {
            background: : #FFF;
        }






    </style>




@endsection

@section('place')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Aviso</strong> {{Session::get('message')}}
</div>
@endif

<div class="border-bottom white-bg page-heading">
  <div class="row" >
        <div class="col-lg-12">
            <div class="animated fadeInUp">
                <div class="ibox-content">
                    <!--<img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="23%" height="8%" style="padding-bottom:0;">-->
                    <h2><span class="text-navy title">¡Te damos la bienvenida {{Auth::user()->fname}}!</span></h2>
                    <h3>Portal del Programa Ejercicio Profesional Supervisado Multidisciplinario</h3>
                    <p>Esta es una aplicación desarrollada con el objetivo de apoyar con la información de los estudiantes, sedes y equipos que integra el Programa EPSUM.</p>
                </div>
            </div>
        </div>
</div>


</div class="header-home" >
    @if($student!=null)
    @if(Auth::user()->rol == "Estudiante")
            <div class="row" style="padding-top:15px;">
              @if($student->cohorte <= 8)

                <div class="col-lg-6" >
                <div class="widget widget-custom red-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-bullhorn fa-4x"></i>
                         <h2 class="m-xs">2a. Cohorte 2018</h2>
                        <h2 class="font-bold no-margins">
                         Registro de Diagnósticos y Proyectos
                        </h2>
                        <small>¡Nuevo! Ya puedes editar tus objetivos y actividades</small>
                    </div>
                </div>
                </div>

              @else
                <a href="https://www.facebook.com/programaepsum/posts/925185151003602">
                <div class="col-lg-6">
                <div class="widget widget-custom red-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-bullhorn fa-4x"></i>
                         <h2 class="m-xs">2a. Cohorte 2018</h2>
                        <h2 class="font-bold no-margins">
                         Playeras para todos
                        </h2>
                        <small>Vota aquí</small>
                    </div>
                </div>
                </div>
              </a>
              @endif
                <a href="infostudent">
                <div class="col-lg-3">
                <div class="widget widget-custom lazur-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-user fa-4x"></i>
                        <h1 class="m-xs">Datos</h1>
                        <h2 class="font-bold no-margins">
                            Consulta tu información
                        </h2>
                        <small>Datos ingresados</small>
                    </div>
                </div>
                </div>
                </a>
                <a href="infopay">
                <div class="col-lg-3">
                <div class="widget widget-custom yellow-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-money fa-4x"></i>
                        <h1 class="m-xs">Pago</h1>
                        <h2 class="font-bold no-margins">
                            Trámite de Ayuda becaria
                        </h2>
                        <small>Consulta de proceso</small>
                    </div>
                </div>
            </div>
            </a>




        </div>
        @endif
   @else

    <div class="row" >

  <div class="col-lg-6" style="padding-top:15px;">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Calendario Programa EPSUM </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>


                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar" class="fc fc-ltr fc-bootstrap3"></div>


                        <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"></button>
                                Actividades EPSUM
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger m-r-sm"></button>
                               Actividades DIGEU
                            </td>
                            <td>
                                <button type="button" class="btn m-r-sm" style="background-color:#2ebeef;"></button>
                               Días Festivos
                            </td>


                        </tr>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>


                <div class="col-lg-6" style="padding-top:15px;">
                    <a href="https://www.facebook.com/programaepsum/posts/925185151003602">
                    <div class="widget lazur-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-bullhorn fa-4x"></i>
                         <h1 class="m-xs">2 Cohorte 2018</h1>
                        <h2 class="font-bold no-margins">
                         Concurso de playeras
                        </h2>
                    </div>
                    </div>
                    </a>

                    <a href="https://www.instagram.com/programaepsum">
                    <div class="widget navy-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-instagram fa-4x"></i>
                         <h1 class="m-xs">Fotos de Estudiantes</h1>
                        <h2 class="font-bold no-margins">
                         Instagram
                        </h2>
                        <p>Todas las fotos con el #VoyConEPSUM se publicarán aqui</p>
                    </div>
                    </div>
                    </a>

                    <a href="{{ url('statuses')}}">
                    <div class="widget yellow-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-warning fa-4x"></i>
                         <h1 class="m-xs">Estado del expediente</h1>
                        <h2 class="font-bold no-margins">
                         Proceso para primer pago
                        </h2>
                        <p>Muestra el estado del expediente de ayuda becaria de los estudiantes</p>
                    </div>
                    </div>
                    </a>

            </div>
    </div>


    @endif


    <!--<div class="row">
        <div class="col-lg-4">
            <div class="ibox-content widget-custom-x">
                <h2 class="text-navy">Diagnóstico</h2>
                <small>¡Has completado el registro!</small>
                <div class="todo-list m-t" >
                  <i class="fa fa-check-circle-o" style="font-size:128px;position:relative;text-align: center; display:table-cell;vertical-align:middle;"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="ibox-content widget-custom-x">
                <h2>Actividades</h2>
                <small>Mira algunas tareas próximas de tus proyectos</small>
                <ul class="todo-list m-t">
                    <li>
                        <input type="checkbox" value="" name="" class="i-checks"/>
                        <span class="m-l-xs">Mira algunas tareas próximas de tus proyectos. Mira algunas tareas próximas de tus proyectos. Mira algunas tareas próximas de tus proyectos</span>
                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                    </li>
                    <li>
                        <input type="checkbox" value="" name="" class="i-checks" checked/>
                        <span class="m-l-xs">Go to shop and find some products. Go to shop and find some products. Go to shop and find some products.</span>
                        <small class="label label-info"><i class="fa fa-clock-o"></i> 3 mins</small>
                    </li>
                    <li>
                        <input type="checkbox" value="" name="" class="i-checks" />
                        <span class="m-l-xs">Send documents to Mike. Go to shop and find some products.Go to shop and find some products. Go to shop and find some products.</span>
                        <small class="label label-warning"><i class="fa fa-clock-o"></i> 2 mins</small>
                    </li>
                    <li>
                        <input type="checkbox" value="" name="" class="i-checks"/>
                        <span class="m-l-xs">Go to the doctor dr Smith. Go to shop and find some products. Go to shop and find some products. Go to shop and find some products.</span>
                        <small class="label label-danger"><i class="fa fa-clock-o"></i> 42 mins</small>
                    </li>
                </ul>
            </div>
        </div>

    </div>-->


<div class="row" style="padding-bottom:20px;">

</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Taller de Inducción 1C-2019</h5>
                            <div class="ibox-tools">
                               
                            </div>
                        </div>
                        <div class="ibox-content" style=" position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <figure>
                                <iframe  width="560" height="315"  style="position: absolute; top:0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/CcFK2XQGS9A" frameborder="0" allowfullscreen></iframe>
                            </figure>
                        </div>
                    </div>
                </div>
                        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>¿Qué estamos haciendo?</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content ">
                            <h4><strong>Marco del convenio interinstitucional</strong></h4>

                            <p>
                            La firma del convenio en referencia, ha generado una plataforma de vinculación social entre la Universidad de San Carlos y el Gobierno, en un esfuerzo inédito en Centroamérica, donde Academia y Gobierno Central unen esfuerzos para impactar en la calidad de vida de la población de los municipios más pobres del país. En tal sentido, es importante destacar el interés de la comunidad universitaria: <br>
                            Consejo Superior Universitario, Rector, Decanos, Directores de Escuelas, Directores de Centros Universitarios, Coordinadores de Carrera Coordinadores, Supervisores y Docentes de EPS quienes decididamente han apoyado el Programa EPSUM. <br>

                            Es importante resaltar el acompañamiento de la Vicepresidencia de la República, por medio de un equipo de trabajoconsolidado que facilita una serie de alianzas con otros niveles de instituciones del Estado. Esto ha dinamizado la calidad de la intervención en el territorio, por cuanto una multiplicidad de actores que trabajan uniendo esfuerzos en pro de los proyectos desarrollados por los estudiantes y las comunidades.


                            </p>
                            <div class="row m-t-md">

                            </div>
                        </div>
                    </div>
                </div>

</div>

@endsection

@section('script')

    <!-- Full Calendar -->

    {!! HTML::script('js/plugins/fullcalendar/moment.min.js') !!}
    {!! HTML::script('js/plugins/fullcalendar/fullcalendar.min.js') !!}
    {!! HTML::script('js/plugins/fullcalendar/lang/es.js') !!}

    <script src='js/plugins/fullcalendar/gcal.js'></script>
    <script src="js/plugins/video/responsible-video.js"></script>

    <script>
    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange', function (e){
        $('body').hasClass('fullscreen-video') ? $('body').removeClass('fullscreen-video') : $('body').addClass('fullscreen-video')
    });
    </script>



    <script>



        $(document).ready(function() {

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });

            /* initialize the external events
             -----------------------------------------------------------------*/


            $('#external-events div.external-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1111999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                googleCalendarApiKey: 'AIzaSyBBhORQSkTS-6NBjTo0llqLNubL3lQIPPM',
                 themeSystem: 'bootstrap4',

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'

                },

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                eventLimit: true, // allow "more" link when too many events
                drop: function() {
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },


                eventSources: [
                          {
                            googleCalendarId: 'miepsum@gmail.com',
                            className: 'epsum-event'
                          },
                          {
                            googleCalendarId: 'es.gt#holiday@group.v.calendar.google.com',
                            className: 'nice-event'
                          }
    ]
            });


        });

    </script>

@endsection
