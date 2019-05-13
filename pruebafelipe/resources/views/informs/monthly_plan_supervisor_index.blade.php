@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div id="sheet" class="ibox float-e-margins white-bg">

      <div id="search-box" class="search-box">
        <input id="search-input" type="text" class="search-input animated fadeInDown" placeholder="Buscar en informes recibidos"></input>
        <button id="search-close-button" type="button" class="search-close-button animated rotateIn"><i class="fa fa-close"></i></button>
      </div>

      <div class="row">
          <div class="col-lg-12">
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 style="font-weight:bold">Recepción de informes mensuales</h1>
                    </div>
                </div>
                <button onclick="location.href='{{URL::previous()}}'" id="back-button" type="button" class="back-button hvr-grow"><i class="fa fa-arrow-left"></i></button>
                <button id="search-button" type="button" class="search-button hvr-grow"><i class="fa fa-search"></i></button>
          </div>
      </div>

      <div class="announcement animated fadeInDown">
        <h3>Novedades en este apartado</h3>
        <p>Ahora puedes llevar el control de número de correcciones realizadas a los informes.<br>Mira los estudiantes con informes pendientes de envío en la nueva pestaña <strong>Pendientes</strong>.<br>Recuerda que puedes buscar un informe con el botón <i class="fa fa-search"></i>, según la categoría en la que te encuentres.</p>
        <p><strong>IMPORTANTE</strong><br>Algunos cambios, como el control de número de corrección, se aplicarán únicamente para informes nuevos (a partir del 11 de marzo de 2019), por tal razón, algunas mejoras no se apreciarán en informes anteriores a la fecha especificada.<br><br>Este mensaje será removido pronto.</p>
      </div>

      <div class="tab-container">
      		<header>
      				<div id="material-tabs">
      						<a id="tab1-tab" href="#tab1" class="active">RECIBIDO <span class="badge badge-warning">{{count($not_reviewed)}}</span></a>
      						<a id="tab2-tab" href="#tab2">REVISADO</a>
                  <a id="tab0-tab" href="#tab0">PENDIENTES</a>
      						<a id="tab3-tab" href="#tab3">HISTORIAL</a>
      						<span class="yellow-bar"></span>
      				</div>
      		</header>

      		<div class="tab-content">

      				<div id="tab1">

                <div id="empty-nr-box" class="cool-empty animated fadeInUp">
                  <div class="cool-empty-text">
                    <p>Parece que no hay nada para revisar... aún.</p>
                    <p style="font-size:14px;">Aquí aparecerán los informes que tus estudiantes envíen.</p>
                    <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="table-not-reviewed" class="table table-hover cool-table animated fadeIn" style="width:auto;">
                    <thead>
                      <tr>
                        <th style="width:45%; padding-left:60px">Estudiante</th>
                        <th style="width:15%">Equipo</th>
                        <th style="width:10%">Mes</th>
                        <th style="width:15%">Corrección No.</th>
                        <th style="width:15%">Fecha de recibido</th>
                        <th style="width:10%"></th>
                      </tr>
                    </thead>
                    <tbody id="table-not-reviewed-b">

                      @foreach($not_reviewed as $plan)

                      <tr style='cursor: pointer;' onclick="location.href='{{url('monthly/report/'.$plan->id)}}'">
                        <td style="width:45%;vertical-align:middle; padding-left:60px;"><strong>{{$plan->fsurname.' '.$plan->lsurname}}, </strong>{{$plan->name}}</td>
                        <td style="width:15%;vertical-align:middle;">{{$plan->team}}</td>
                        <td style="width:10%; vertical-align:middle;">{{ucfirst($plan->month)}}    </td>
                        <td style="width:15%;vertical-align:middle;">{{$plan->num_correction}}</td>
                        <td style="width:15%;vertical-align:middle;">{{$plan->updated}}</td>
                        <td style="width:5%;vertical-align:middle;"></td>
                        <!--<td style="width:10%;vertical-align:middle;"><button type="button" class="cool-button-option" onclick="location.href='{{url('monthly/report/'.$plan->id)}}'"><i class="fa fa-external-link-square"></i></button></td>-->
                      </tr>

                      @endforeach

                      <tr id="last-row-1"><td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Eso es todo, al menos por ahora.</strong></td></tr>

                    </tbody>
                  </table>
                </div>

      				</div>

      				<div id="tab2">

                <div id="empty-r-box" class="cool-empty animated fadeInUp">
                  <div class="cool-empty-text">
                    <p>Todavía no hay informes revisados...</p>
                    <p style="font-size:14px;">Aquí se mostrarán los informes que revises y/o corrijas.</p>
                    <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="table-reviewed" class="table table-hover cool-table animated fadeIn" style="width:auto;">
                    <thead>
                      <tr>
                        <th style="width:45%; padding-left:60px">Estudiante</th>
                        <th style="width:15%">Equipo</th>
                        <th style="width:10%">Mes</th>
                        <th style="width:15%">Corrección No.</th>
                        <th style="width:15%">Fecha de recibido</th>
                        <th style="width:10%"></th>
                      </tr>
                    </thead>
                    <tbody id="table-reviewed-b">

                      @foreach($reviewed as $plan)

                      <tr style='cursor: pointer;' onclick="location.href='{{url('monthly/report/'.$plan->id)}}'">
                          <td style="width:45%;vertical-align:middle; padding-left:60px;"><strong>{{$plan->fsurname.' '.$plan->lsurname}}, </strong>{{$plan->name}}</td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->team}}</td>
                          <td style="width:10%; vertical-align:middle;">{{ucfirst($plan->month)}}    </td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->num_correction}}</td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->updated}}</td>
                          <td style="width:5%;vertical-align:middle;"></td>
                      </tr>

                      @endforeach

                      <tr id="last-row-2"><td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Nada más que mostrar.</strong></td></tr>

                    </tbody>
                  </table>
                </div>

      				</div>

              <div id="tab0">

                <div id="empty-m-box" class="cool-empty animated fadeInUp">
                  <div class="cool-empty-text">
                    <p>Informes aún no entregados</p>
                    <p style="font-size:14px;">Aquí se mostrarán los informes que aún no han sido enviados por los estudiantes.</p>
                    <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="table-missed" class="table table-hover cool-table animated fadeIn" style="width:auto;">
                    <thead>
                      <tr>
                        <th style="width:55%; padding-left:60px">Estudiante</th>
                        <th style="width:15%">Equipo</th>
                        <th style="width:5%">Mes</th>
                        <th style="width:15%">Estado</th>
                        <th style="width:10%"></th>
                      </tr>
                    </thead>
                    <tbody id="table-missed-b">

                      @foreach($missed as $plan)

                      <tr>
                        <td style="width:55%;vertical-align:middle; padding-left:60px;"><strong>{{$plan->fsurname.' '.$plan->lsurname}}, </strong>{{$plan->name}}</td>
                        <td style="width:15%;vertical-align:middle;">{{$plan->team}}</td>
                        <td style="width:5%; vertical-align:middle;">{{ucfirst($plan->month)}}    </td>
                        <td style="width:15%;vertical-align:middle;">Editando</td>
                        <td></td>
                      </tr>

                      @endforeach

                      <tr id="last-row-0"><td colspan="5" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Informes pendientes a la fecha.</strong></td></tr>

                    </tbody>
                  </table>
                </div>

              </div>

      				<div id="tab3">

                <div id="empty-historial-box" class="cool-empty animated fadeInUp">
                  <div class="cool-empty-text">
                    <p>Informes archivados</p>
                    <p style="font-size:14px;">En este espacio aparecerán todos los informes que has revisado y que ya fueron entregados en físico.</p>
                    <a class="hvr-pop" style="font-size:12px;color:#2ebeef" data-toggle="modal" data-target="#modal-info">Más información</a>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="table-historial" class="table table-hover cool-table animated fadeInLeft" style="width:auto;">
                    <thead>
                      <tr>
                        <th style="width:45%; padding-left:60px">Estudiante</th>
                        <th style="width:15%">Equipo</th>
                        <th style="width:10%">Mes</th>
                        <th style="width:15%">Corrección No.</th>
                        <th style="width:15%">Fecha de recibido</th>
                        <th style="width:10%"></th>
                      </tr>
                    </thead>
                    <tbody id="table-historial-b">

                      @foreach($historial as $plan)

                      <tr style='cursor: pointer;' onclick="location.href='{{url('monthly/report/'.$plan->id)}}'">
                          <td style="width:45%;vertical-align:middle; padding-left:60px;"><strong>{{$plan->fsurname.' '.$plan->lsurname}}, </strong>{{$plan->name}}</td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->team}}</td>
                          <td style="width:10%; vertical-align:middle;">{{ucfirst($plan->month)}}    </td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->num_correction}}</td>
                          <td style="width:15%;vertical-align:middle;">{{$plan->updated}}</td>
                          <td style="width:5%;vertical-align:middle;"></td>
                      </tr>

                      @endforeach

                      <tr id="last-row-3"><td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Llegaste al final.</strong></td></tr>

                    </tbody>
                  </table>
                </div>

      				</div>
      		</div>
      </div>
          <div style="height:3000px;"></div>
    </div>
  </div>
</div>



@endsection

@section('script')

<script>

  var search_box_is_visible = false;
  var search_box = document.getElementById('search-box');
  var sheet = document.getElementById('sheet');
  var search_button = document.getElementById('search-button');
  var search_input = document.getElementById('search-input');
  var search_close_button = document.getElementById('search-close-button');
  flag_tab = 1;
  var current_view = null;
  var missed_count = '{{count($missed)}}';
  var reviewed_count = '{{count($reviewed)}}';
  var not_reviewed_count = '{{count($not_reviewed)}}';
  var historial_count = '{{count($historial)}}';

  console.log("REVIEWED: "+reviewed_count);
  console.log("NOT_REVIEWED: "+not_reviewed_count);

  if(missed_count == 0){
    document.getElementById('empty-m-box').style.display = "block";
  }else{
    document.getElementById('table-missed').style.display = "block";
  }

  if(not_reviewed_count == 0){
    current_view = document.getElementById('empty-nr-box');
  }else{
    current_view = document.getElementById('table-not-reviewed');
  }

  current_view.style.display = "block";

  if(reviewed_count == 0){
    document.getElementById('empty-r-box').style.display = "block";
  }else{
    document.getElementById('table-reviewed').style.display = "block";
  }

  if(historial_count == 0){
    document.getElementById('empty-historial-box').style.display = "block";
  }else{
    document.getElementById('table-historial').style.display = "block";
  }

$('#search-button').click( function(){
    showSearchBox(search_box_is_visible);
});

$('#search-close-button').click( function(){
    showSearchBox(search_box_is_visible);
    console.log("CLOSE BUTTON FLAG!");
});

$('#tab1-tab').click( function(){
  $("#search-input").attr("placeholder","Buscar en informes recibidos");
  flag_tab = 1;
});

$('#tab2-tab').click( function(){
  $("#search-input").attr("placeholder","Buscar en informes revisados");
  flag_tab = 2;
});

$('#tab3-tab').click( function(){
  $("#search-input").attr("placeholder","Buscar en registro histórico");
  flag_tab = 3;
});

$('#tab0-tab').click( function(){
  $("#search-input").attr("placeholder","Buscar en informes pendientes de entrega");
  flag_tab = 0;
});

$(document).ready(function(){
  $("#search-input").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    switch (flag_tab) {
      case 0:
        $('#last-row-0').html('');

        $("#table-missed-b tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });


        if($("#table-missed-b tr:visible").length === 0){
          $('#last-row-0').show();
          $('#last-row-0').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>No se encontraron coincidencias para "'+search_input.value+'"... Intenta buscando otro nombre, equipo o mes de informe.</strong></td>');
        }else{
          $('#last-row-0').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Informes pendientes a la fecha.</strong></td>');
        }
        break;
      case 1:
        $('#last-row-1').html('');

        $("#table-not-reviewed-b tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });


        if($("#table-not-reviewed-b tr:visible").length === 0){
          $('#last-row-1').show();
          $('#last-row-1').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>No se encontraron coincidencias para "'+search_input.value+'"... Intenta buscando otro nombre, equipo o mes de informe.</strong></td>');
        }else{
          $('#last-row-1').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Eso es todo, al menos por ahora.</strong></td>');
        }
        break;
      case 2:
        $('#last-row-2').html('');

        $("#table-reviewed-b tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        if($("#table-reviewed-b tr:visible").length === 0){
          $('#last-row-2').show();
          $('#last-row-2').html('<td colspan="5" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>No se encontraron coincidencias para "'+search_input.value+'"... Intenta buscando otro nombre, equipo o mes de informe.</strong></td>');
        }else{
          $('#last-row-2').html('<td colspan="5" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Nada más que mostrar.</strong></td>');
        }
        break;
      case 3:
        $('#last-row-3').html('');

        $("#table-historial-b tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        if($("#table-historial-b tr:visible").length === 0){
          $('#last-row-3').show();
          $('#last-row-3').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>No se encontraron coincidencias para "'+search_input.value+'"... Intenta buscando otro nombre, equipo o mes de informe.</strong></td>');
        }else{
          $('#last-row-3').html('<td colspan="6" style="vertical-align:middle; text-align:center; height:60px; background-color:#f9f9f9"><strong>Llegaste al final del registro de informes entregados.</strong></td>');
        }
        break;
      default:
    }
  });
});


function showSearchBox(is_visible){
  if(is_visible){
    search_box.style.height = "0px";
    search_button.classList.remove("search-button-active");
    search_input.style.display = "none";
    search_input.classList.remove("fadeInDown");
    search_input.className += " fadeOutUp";
    search_close_button.style.display = "none";
    search_box_is_visible = false;
  }else{
    search_box.style.width = sheet.offsetWidth+"px";
    search_box.style.height = "120px";
    search_button.className += " search-button-active";
    search_input.style.display = "block";
    search_input.classList.remove("fadeOutUp");
    search_input.className += " fadeInDown";
    search_close_button.style.display = "block";
    search_input.focus();
    search_box_is_visible = true;
  }
}

$(document).ready(function() {
		$('#material-tabs').each(function() {

				var $active, $content, $links = $(this).find('a');

				$active = $($links[0]);
				$active.addClass('active');

				$content = $($active[0].hash);

				$links.not($active).each(function() {
						$(this.hash).hide();
				});

				$(this).on('click', 'a', function(e) {

						$active.removeClass('active');
						$content.hide();

						$active = $(this);
						$content = $(this.hash);

						$active.addClass('active');
						$content.show();

            if(search_box_is_visible){
              showSearchBox(search_box_is_visible);
            }

						e.preventDefault();
				});
		});
});
</script>

@endsection
