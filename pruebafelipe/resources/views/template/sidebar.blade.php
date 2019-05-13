<nav id="sidebar" class="navbar-default navbar-static-side" role="navigation" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, .5);">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element">
          <span>
            <img id="avatar" alt="" class="img-circle animated fadeIn" avatar="{{substr(Auth::user()->fname,0,1).' '.substr(Auth::user()->lname,0,1)}}"/>
          </span>
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear"> <span class="block m-t-xs" style="font-size:14px"><strong><?php  echo Auth::user()->fname  ?></strong>
          </span> <span class="text-muted text-xs block"><?php echo Auth::user()->rol; ?> </span> </span> </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a href="{{ url('logout')}}">Cerrar Sesión</a></li>
          </ul>

        </div>
        <div class="logo-element">
          MiE
        </div>
      </li>

      <li>
        <a href="{{ url('home')}}"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
      </li>

      @if(Auth::user()->rol != "Estudiante")

      <li >
        <a href="#"><i class="fa fa-users "></i> <span class="nav-label">Oficina</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('inbox')}}">Correspondencia Recibida</a></li>
            <li><a href="{{ url('correlatives')}}">Correspondencia Enviada</a></li>
          </ul>
      </li>

      @endif


      @if(Auth::user()->rol == "Estudiante"|| Auth::user()->rol == "Admin")

      <li >
        <a href="#"><i class="fa fa-users "></i> <span class="nav-label">Estudiantes</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('studentcreate')}}">Inscribirme</a></li>
            <li><a href="{{ url('infostudent')}}">Datos Registrados</a></li>
            <li><a href="{{ url('studentficha')}}">Generar Ficha</a></li>
            <li><a href="{{ url('studentcarta')}}">Generar Carta de Presentación</a></li>

            <li>
              <a href="#" id="damian">Editar Referencias <span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li><a href="padre">Padre</a></li>
                  <li><a href="madre">Madre</a></li>
                  <li><a href="supervisoru">Supervisor de Carrera</a></li>
                  <li><a href="supervisorh">Encargado de Sede</a></li>
                </ul>
            </li>
          </ul>
      </li>


      <li >
        <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Informes</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li><a href="{{ url('plan')}}">Mensual </a></li>
          <li><a href="{{ url('dx/')}}">Diagnóstico</a></li>
          <li><a href="#">Plan de Trabajo <span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
              <li><a href="{{ url('project/cat/1')}}">Proyecto Multidisciplinario</a></li>
              <li><a href="{{ url('project/cat/2')}}">Proyecto Monodisciplinario</a></li>
              <li><a href="{{ url('project/cat/3')}}">Proyecto de Convivencia</a></li>
            </ul>
          </li>


          <li>
            <a href="#" id="damian">Ficha de resultados <span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
              <li><a href="{{ url('inform/project/1')}}">Proyecto Multidisciplinario</a></li>
              <li><a href="{{ url('inform/project/2')}}">Proyecto Monodisciplinario</a></li>
              <li><a href="{{ url('inform/project/3')}}">Proyecto de Convivencia</a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li >
        <a href="#"><i class="fa fa-comments-o"></i> <span class="nav-label">Evaluaciones</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('appraisals/create')}}">Evaluación del Supervisor</a></li>
            <li><a href="{{ url('partnerrating/create')}}">Evaluación de la Sede</a></li>
          </ul>
      </li>

      @endif

      @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin")
      <li><a href="{{ url('plan/monthly/all')}}"><i class="fa fa-inbox"></i> <span class="nav-label">Recibido</span></a></li>

      <li >
        <a href="#"><i class="fa fa-user-circle "></i> <span class="nav-label">Supervisor</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('supervisorstudent')}}">Estudiantes</a></li>
            <li><a href="{{ url('teams')}}">Equipos</a></li>
            <li><a href="{{ url('headquarters')}}">Sedes</a></li>
            <li><a href="{{ url('settlement')}}">Finiquitos <p class="badge badge-success">Nuevo</p></a></li>
            <li><a href="{{ url('statuses')}}">Estado del Expediente</a></li>
            <li><a href="{{ url('check')}}">Cheques</a></li>
            settlement
          </ul>
      </li>

      <li >
        <a href="#"><i class="fa fa-eye"></i><span class="nav-label">Seguimiento de Informes</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('dx/all')}}">Diagnóstico</a></li>
            <li><a href="{{url('projects/all')}}" id="damian">Plan de Trabajo</span></a></li>
          </ul>
      </li>

      <li >
        <a href="#"><i class="fa fa-pie-chart"></i><span class="nav-label">Estadísticas</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li><a href="{{ url('stats/students')}}">Estudiantes</a></li>
          <li><a href="{{ url('stats/financing')}}">Financiamiento</a></li>
          <li><a href="{{ url('stats/teams')}}">Equipos</a></li>
          <li><a href="{{ url('stats/diagnostics')}}">Diagnósticos</a></li>
          <li><a href="{{ url('stats/projects')}}">Proyectos</span></a></li>
        </ul>
      </li>
      @endif


      @if(Auth::user()->rol == "Coordinador" ||  Auth::user()->rol == "Gestor" || Auth::user()->rol == "Admin" ||  Auth::user()->rol == "Tesorero" || Auth::user()->rol == "Secretaria")

      <li >
        <a href="#"><i class="fa fa-paperclip"></i> <span class="nav-label">Gestor</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('studentg')}}">Estudiantes</a></li>
            <li><a href="{{ url('contract')}}">Contratos</a></li>
            <li><a href="{{ url('engagement')}}">Getiones</a></li>
            <li><a href="{{ url('pays')}}">Pagos</a></li>
            <li><a href="{{ url('statuses')}}">Estado del Expediente</a></li>
          </ul>
      </li>

      @endif


      @if(Auth::user()->rol == "Coordinador" ||  Auth::user()->rol == "Admin" ||  Auth::user()->rol == "Tesorero" || Auth::user()->rol == "Secretaria" )

      <li >
        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Tesoreria</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li><a href="{{ url('pays')}}">Pagos</a></li>
          <li><a href="{{ url('check')}}">Cheques</a></li>
          <li><a href="{{ url('statuses')}}">Estado del Expediente</a></li>
        </ul>

        <li>
          <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Inventario</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li><a href="{{ url('inventory/providers')}}">Proveedores</a></li>
              <li><a href="{{ url('inventory/articles')}}">Bienes</a></li>
              <li><a href="{{ url('inventory/purchases')}}">Compras</a></li>
              <li><a href="{{ url('inventory/regs')}}">Registros de inventario</a></li>
            </ul>
        </li>
      </li>

      @endif

      @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin")

      <li>
        <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Coordinación</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ url('supervisore')}}">Gestión de Supervisores</a></li>
            <li><a href="{{ url('users')}}">Gestión de Usuarios</a></li>
            <li><a href="{{ url('cohortes')}}">Gestión de Cohortes</a></li>
            <li><a href="{{ url('agreement')}}">Gestión de Acuerdos</a></li>
            <li><a href="{{ url('log')}}">Sucesos</a></li>
            <li><a href="{{ url('getacuerdo')}}">Generar Listado Acuerdo</a></li>
            <li><a href="{{ url('getAppraisals')}}">Evaluación de Supervisores</a></li>
            <li><a href="municipality">Ingresar Municipalidad</a></li>
          </ul>
      </li>

      <li><a href="{{ url('create/notification')}}" style="background-color:#2ebeef;color:#fff"><i class="fa fa-bullhorn"></i> <span class="nav-label">Notificar</span></a></li>

      @endif

    </ul>
  </div>
</nav>

<script>
/*
     * LetterAvatar
     *
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d){


        function LetterAvatar (name, size) {

            name  = name || '';
            size  = size || 60;

            var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
                ],

                nameSplit = String(name).toUpperCase().split(' '),
                initials, charIndex, colourIndex, canvas, context, dataURI;


            if (nameSplit.length == 1) {
                initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
            } else {
                initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
            }

            if (w.devicePixelRatio) {
                size = (size * w.devicePixelRatio);
            }

            charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
            colourIndex   = charIndex % 20;
            canvas        = d.createElement('canvas');
            canvas.width  = size;
            canvas.height = size;
            context       = canvas.getContext("2d");

            context.fillStyle = colours[colourIndex - 1];
            context.fillRect (0, 0, canvas.width, canvas.height);
            context.font = Math.round(canvas.width/2)+"px Arial";
            context.textAlign = "center";
            context.fillStyle = "#FFF";
            context.fillText(initials, size / 2, size / 1.5);

            dataURI = canvas.toDataURL();
            canvas  = null;

            return dataURI;
        }

        LetterAvatar.transform = function() {

            Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
                name = img.getAttribute('avatar');
                img.src = LetterAvatar(name, img.getAttribute('width'));
                img.removeAttribute('avatar');
                img.setAttribute('alt', name);
            });
        };


        // AMD support
        if (typeof define === 'function' && define.amd) {

            define(function () { return LetterAvatar; });

        // CommonJS and Node.js module support.
        } else if (typeof exports !== 'undefined') {

            // Support Node.js specific `module.exports` (which can be a function)
            if (typeof module != 'undefined' && module.exports) {
                exports = module.exports = LetterAvatar;
            }

            // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
            exports.LetterAvatar = LetterAvatar;

        } else {

            window.LetterAvatar = LetterAvatar;

            d.addEventListener('DOMContentLoaded', function(event) {
                LetterAvatar.transform();
            });
        }

    })(window, document);
</script>
