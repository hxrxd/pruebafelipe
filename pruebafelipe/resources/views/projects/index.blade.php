@extends('admintemplate')

@section('place')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Proyecto {{$ty}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">{{$team->name}}</a>
            </li>
            <li class="active">
                <strong>{{substr($cohort->cohorte,0,14)}}</strong>
            </li>
        </ol>
    </div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="">
                <div class="ibox-content">

                  @if($pj == null)

                  <div class="row">
                      <div class="col-lg-12">
                            <div class="float-e-margins">
                                <div class=" text-center p-md">
                                    <h2><span class="text-navy">Aún no se ha registrado el proyecto {{$ty}}</span>
                                    <br/><h3></h3></h2>
                                    <p>
                                      Comienza a editar el proyecto haciendo clic en el siguiente botón
                                    </p>
                                    </br>
                                    <a href="{{ url('project/create/'.$idpj)}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Registrar Proyecto {{$ty}}</a>
                                </div>
                            </div>
                      </div>
                  </div>

                  @else

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <!--<button class="btn btn-white pull-right" type="button" style="margin-left:5px" onclick="showMessage('Opción no habilitada','Aún no puedes subir el documento de tu perfil de proyecto.')"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Subir</span></button>-->
                                <a href="{{ url('project/edit')}}" class="btn btn-white pull-right" type="button"><i class="fa fa-edit"></i> Editar información</a>
                                <h2>Informe</h2>
                            </div>
                            <dl class="dl-horizontal">
                                @if($pj->status == 1)
                                  <dt>Estado</dt> <dd><span class="label label-primary">Activo</span></dd>
                                @else
                                  <dt>Estado</dt> <dd><span class="label label-primary">Finalizado</span></dd>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">

                                <dt>Equipo:</dt> <dd>{{$team->name}}</dd>
                                <dt>Cohorte:</dt> <dd>  {{substr($cohort->cohorte,0,14)}}</dd>
                                <dt>Municipio:</dt> <dd>{{$municipality->municipality}} </dd>
                                <dt>Departamento:</dt> <dd> 	{{$department->departament}} </dd>

                            </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >
                                <dt>Nombre del proyecto:</dt> <dd>{{$pj->name}}</dd>
                                <dt>Tipo de proyecto: </dt> <dd>{{$pj->type}}</dd>
                                <dt>Línea de intervención</dt> <dd>{{$line->name}}</dd>
                                <dt>Fecha de inicio:</dt> <dd>{{$pj->startdate}}</dd>
                                <dt>Fecha de finalización:</dt> <dd>{{$pj->deadline}}</dd>
                                <dt>Valor económico:</dt> <dd>Q. {{$pj->budget}}</dd>
                                @if($idpj == 1)
                                <dt>Participantes:</dt>
                                <dd class="project-people">
                                  @foreach ($participants as $participant)
                                    <a href="">
                                      <img
                                      alt="avatar"
                                      class="img-circle"
                                      avatar="{{substr($participant->name,0,1).' '.$participant->fsurname}}"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="{{$participant->name.' '.$participant->fsurname}}">
                                    </a>
                                  @endforeach
                              </dd>
                              @endif
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Tiempo</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div id="bar" class="progress-bar"></div>
                                    </div>
                                    <small id="progress-text">Tiempo de ejecución del proyecto <strong>0%</strong></small>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Completado</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div id="bar-real-progress" class="progress-bar progress-bar-success"></div>
                                    </div>
                                    <small id="real-progress-text">Porcentaje de avance <strong>0%</strong></small>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <!--HERE THE TABS-->
                    <div>
                      <p>Hola</p>
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                        <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class=""><a href="#tab-0" data-toggle="tab">Objetivos</a></li>
                                    <li class="active"><a href="#tab-1" data-toggle="tab">Actividades</a></li>
                                    <li class=""><a href="#tab-2" data-toggle="tab">Sucesos</a></li>
                                    @if($idpj == 1 || $idpj == 3)
                                    <li class=""><a href="#tab-3" data-toggle="tab">Equipo</a></li>
                                    @endif
                                    <button type="button" class="btn btn-primary btn-outline" style="margin-left:5px;float:right;" data-toggle="modal" data-target="#addActivityModal">Agregar actividad</button>
                                    <button type="button" class="btn btn-primary btn-outline" style="float:right;" data-toggle="modal" data-target="#addObjectiveModal">Agregar Objetivo</button>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                        <div class="tab-content">

                          <div class="tab-pane table-responsive" id="tab-0">



                            <div class="text-center">
                                <div class="m-b-md">
                                     <h2 class="m-xs">Objetivo General</h2>
                                     <br>
                                    <h5 class="font-bold no-margins">
                                      {{ $pj->objective }}
                                    </h5>
                                    <small></small>
                                </div>
                            </div>


                            <table class="table table-striped">
                              <thead>
                                <tr>
                                    <th>Específicos</th>
                                    <th></th>
                                    <th>Indicador</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                              <tr>
                                  <th>Objetivo</th>
                                  <th>Meta</th>
                                  <th>Cantidad</th>
                                  <th>Descripción</th>
                                  <th>Resultado</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($allWorkplans as $w)
                                <tr>
                                    <td>{{ $w->objective_what }}</td>
                                    <td>{{ $w->objective_what_for }}</td>
                                    <td>{{ $w->amount}}</td>
                                    <td>{{ $w->goal }}</td>
                                    <td>-</td>
                                    <td>
                                      <button id="{{$w->id}}" class="btn btn-info btn-sm" onclick="fillEditObjective('{{$w->id}}','{{$w->objective_what}}','{{$w->objective_what_for}}','{{$w->amount}}','{{$w->goal}}')" data-toggle="modal" data-target="#editObjectiveModal"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>

                          </div>


                        <div class="tab-pane active table-responsive" id="tab-1">

                          <table class="table table-striped">
                              <thead>
                              <tr>
                                  <th>Hecho</th>
                                  <th>Actividad</th>
                                  <th>Estado</th>
                                  <th style="min-width:100px;">Fecha de inicio</th>
                                  <th style="min-width:100px;">Fecha límite</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($allActivities as $act)
                                <tr>
                                  @if($act->status == 0)
                                    <td><label class="container"><input type="checkbox" value="{{$act->id}}" class="check-act" checked><span class="checkmark"></span></label></td>
                                    <td id="{{'act-'.$act->id}}" style="min-width:300px; text-decoration:line-through;">{{ $act->activity }}</td>
                                    <td><span class="label label-primary" id="{{'status-'.$act->id}}">Hecho</span></td>
                                  @else
                                    <td><label class="container"><input type="checkbox" value="{{$act->id}}" class="check-act"><span class="checkmark"></span></label></td>
                                    <td id="{{'act-'.$act->id}}" style="min-width:300px;">{{ $act->activity }}</td>
                                    <td><span class="label label-primary" id="{{'status-'.$act->id}}">En espera</span></td>
                                  @endif
                                    <td>{{ $act->startdate }}</td>
                                    <td>{{ $act->deadline}}</td>
                                    <td>
                                      <!--<button class="btn btn-info btn-sm" onclick="showMessage('Opción no disponible','Esta opción fue habilitada solo para el supervisor. Cualquier cambio en la actividad deberás solicitarlo.')"><i class="fa fa-edit"></i></button>-->
                                      <button id="{{$act->id}}" class="btn btn-info btn-sm" onclick="fillEdit('{{$act->id}}','{{$act->activity}}','{{$act->startdate}}','{{$act->deadline}}')" data-toggle="modal" data-target="#editActivityModal"><i class="fa fa-edit"></i></button>
                                      <button id="{{$act->id}}" class="btn btn-danger btn-sm" onclick="removeActivity({{$act->id}})"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                                @endforeach

                                @if($allActivities2 != null)
                                <tr>
                                    <td></td>
                                    <td><h2>Anteriores</h2></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endif

                                @foreach($allActivities2 as $act)
                                <tr>
                                  @if($act->status == 0)
                                    <td><label class="container"><input type="checkbox" value="{{$act->id}}" class="check-act" checked><span class="checkmark"></span></label></td>
                                    <td id="{{'act-'.$act->id}}" style="min-width:300px; text-decoration:line-through;">{{ $act->activity }}</td>
                                    <td><span class="label label-primary" id="{{'status-'.$act->id}}">Hecho</span></td>
                                  @else
                                    <td><label class="container"><input type="checkbox" value="{{$act->id}}" class="check-act"><span class="checkmark"></span></label></td>
                                    <td id="{{'act-'.$act->id}}" style="min-width:300px;">{{ $act->activity }}</td>
                                    <td><span class="label label-primary" id="{{'status-'.$act->id}}">En espera</span></td>
                                  @endif
                                    <td>{{ $act->startdate }}</td>
                                    <td>{{ $act->deadline}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                              </tbody>
                          </table>

                        </div>

                        <div class="tab-pane" id="tab-2">
                            <div class="feed-activity-list">
                              @foreach($logs as $log)
                                <div class="feed-element">
                                    <a href="" class="pull-left">
                                      <img
                                      alt="image"
                                      class="img-circle"
                                      avatar="{{$log->fname}}"
                                      data-toggle="tooltip"
                                      data-placement="top">
                                    </a>
                                    <div class="media-body ">
                                        <!--<small class="pull-right">2h ago</small>-->
                                        {{$log->desc}} <br>
                                        <small class="text-muted">{{$log->created_at}}</small>
                                    </div>
                                </div>
                              @endforeach
                            </div>

                        </div>

                        @if($idpj == 1 || $idpj == 3)

                        <div class="tab-pane table-responsive" id="tab-3">
                          <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Carné</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Facultad/Unidad Académica</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach($participants as $p)
                              <tr>
                                  <td>{{ $p->carne }}</td>
                                  <td>{{ $p->fsurname.' '.$p->ssurname.', '.$p->name }}</td>
                                  <td>{{ $p->career}}</td>
                                  <td>{{ $p->academicu }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>

                        </div>

                        @endif

                        </div>

                        </div>

                        </div>
                        </div>
                    </div>

                    <!--END TABS-->

                    <div class="modal inmodal" id="addActivityModal" tabindex="-1" role="dialog"  aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Agregar Actividad</h4>
                            </br>
                            <h5>Seleccionar Objetivo</h5>
                            <select id="wp-select" class="form-control m-b chosen-select" >
                              @foreach ($allWorkplans as $wp)
                                <option value="{{ $wp->id }}"> {{ $wp->objective_what }} </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-lg-12">


                            <div>
                              {!! Form::open(['class'=>'form-horizontal','id'=>'wpcreate','method'=>'POST']) !!}
                              {{ csrf_field() }}
                              <div class="form-group">
                                <div class="col-sm-12">
                                  {!!Form::textarea('activity',null,['class'=>'form-control','id'=>'activity','name'=>'activity','placeholder'=>'Escribe una descripción para la actividad..','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-4">
                                  <label class="control-label" style="font-size:11px">Fecha de inicio</label>
                                </div>
                                <div class="col-sm-4">
                                  <label class="control-label" style="font-size:11px">Fecha límite</label>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-4">
                                  {!!Form::date('startdate', \Carbon\Carbon::now(),['id'=>'startdate','name'=>'startdate','class'=>'form-control','required'=>'']); !!}
                                </div>
                                <div class="col-sm-4">
                                  {!!Form::date('deadline', \Carbon\Carbon::now(),['id'=>'deadline','name'=>'deadline','class'=>'form-control','required'=>'']); !!}
                                </div>
                                <div class="col-sm-4">
                                  <a id="addAct" type="submit" class="btn btn-primary alertmessage">Agregar actividad</a>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-12">
                                  <div class="table-responsive">

                                  <table id="acts" class="table table-striped table-bordered table-hover dataTables-example" >
                                  <thead>
                                  <tr>
                                      <th style="min-width:300px;">Actividad</th>
                                      <th>Fecha de inicio</th>
                                      <th>Fecha límite</th>
                                  </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                  </table>
                                      </div>
                                </div>
                              </div>

                            </div>

                          </div>
                      </div>


                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary btn-outline" style="margin-left:5px;" data-dismiss="modal" onclick="location.reload();">Terminar</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- objective modal-->

                    <div class="modal inmodal" id="addObjectiveModal" tabindex="-1" role="dialog"  aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Agregar Objetivo Específico</h4>
                            </br>



                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-lg-12">


                            <div>
                              {!! Form::open(['class'=>'form-horizontal','id'=>'objcreate','method'=>'POST']) !!}
                              {{ csrf_field() }}
                              <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo</label>
                                <div class="col-sm-10">
                                  {!!Form::textarea('objective_what',null,['class'=>'form-control','id'=>'objective_what','name'=>'objective_what','placeholder'=>'Define un objetivo específico para el proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </br>
                                </div>
                              </div>

                              <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Meta</label>
                                <div class="col-sm-10">
                                  {!!Form::textarea('objective_what_for',null,['class'=>'form-control','id'=>'objective_what_for','name'=>'objective_what_for','placeholder'=>'Justifica la razón del objetivo planteado','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-12">
                                  <div class="hr-line-dashed"></div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <h3 style="color:#1ab394;">Indicador</h3>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label class="control-label" style="font-size:11px">Cantidad</label>
                                </div>
                                <div class="col-sm-10">
                                  <label class="control-label" style="font-size:11px">Descripción</label>
                                </div>

                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  {!!Form::text('amount',null,['class'=>'form-control','id'=>'amount','name'=>'amount','placeholder'=>'Cantidad','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
                                </div>
                                <div class="col-sm-10">
                                  {!!Form::text('goal',null,['class'=>'form-control','id'=>'goal','name'=>'goal','placeholder'=>'Descripción del indicador','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
                                  {!!Form::hidden('project',Session::get('pj')->id,['class'=>'form-control','id'=>'project','name'=>'project'])!!}
                                </br>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-12">
                                  <a id="addAct" type="submit" class="btn btn-primary modal-objective">Agregar Objetivo</a>
                                </div>
                              </div>

                            </div>

                          </div>
                      </div>


                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary btn-outline" style="margin-left:5px;" data-dismiss="modal" onclick="location.reload();">Terminar</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--Edit Activity-->
                    <div class="modal inmodal" id="editActivityModal" tabindex="-1" role="dialog"  aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Editar actividad</h4>
                            </br>

                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-lg-12">


                            <div>
                              {!! Form::open(['class'=>'form-horizontal','id'=>'wpedit','method'=>'POST']) !!}
                              {{ csrf_field() }}
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class="control-label" style="font-size:11px">Descripción de la actividad:</label>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  {!!Form::textarea('activity',null,['class'=>'form-control','id'=>'edit_activity','name'=>'activity','placeholder'=>'Escribe una descripción para la actividad..','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-6">
                                  <label class="control-label" style="font-size:11px">Fecha de inicio</label>
                                </div>
                                <div class="col-sm-6">
                                  <label class="control-label" style="font-size:11px">Fecha límite</label>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-6">
                                  {!!Form::date('startdate', \Carbon\Carbon::now(),['id'=>'edit_startdate','name'=>'startdate','class'=>'form-control','required'=>'']); !!}
                                </div>
                                <div class="col-sm-6">
                                  {!!Form::date('deadline', \Carbon\Carbon::now(),['id'=>'edit_deadline','name'=>'deadline','class'=>'form-control','required'=>'']); !!}
                                </div>
                                {!!Form::hidden('id',null,['class'=>'form-control','id'=>'edit_id'])!!}
                              </div>

                            </div>

                          </div>
                      </div>


                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary edit-act" style="margin-left:5px;" data-dismiss="modal">Guardar cambios</a>
                            <button type="button" class="btn btn-primary btn-outline" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--Edit Objective-->
                    <div class="modal inmodal" id="editObjectiveModal" tabindex="-1" role="dialog"  aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Editar Objetivo Específico</h4>
                            </br>



                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-lg-12">


                            <div>
                              {!! Form::open(['class'=>'form-horizontal','id'=>'objcreate','method'=>'POST']) !!}
                              {{ csrf_field() }}
                              <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Objetivo</label>
                                <div class="col-sm-10">
                                  {!!Form::textarea('objective_what',null,['class'=>'form-control','id'=>'edit_objective_what','name'=>'objective_what','placeholder'=>'Define un objetivo específico para el proyecto','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </br>
                                </div>
                              </div>

                              <div class="form-group"><label class="col-sm-2 control-label" style="font-size:11px">Meta</label>
                                <div class="col-sm-10">
                                  {!!Form::textarea('objective_what_for',null,['class'=>'form-control','id'=>'edit_objective_what_for','name'=>'objective_what_for','placeholder'=>'Justifica la razón del objetivo planteado','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','rows'=>'2', 'resize'=>'none'])!!}
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-12">
                                  <div class="hr-line-dashed"></div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <h3 style="color:#1ab394;">Indicador</h3>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label class="control-label" style="font-size:11px">Cantidad</label>
                                </div>
                                <div class="col-sm-10">
                                  <label class="control-label" style="font-size:11px">Descripción</label>
                                </div>

                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  {!!Form::text('amount',null,['class'=>'form-control','id'=>'edit_amount','name'=>'amount','placeholder'=>'Cantidad','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")','onkeypress'=>'return isNumberKey(event)'])!!}
                                </div>
                                <div class="col-sm-10">
                                  {!!Form::text('goal',null,['class'=>'form-control','id'=>'edit_goal','name'=>'goal','placeholder'=>'Descripción del indicador','required'=>'','onchange'=>'this.setCustomValidity(validity.valueMissing ? "Debes llenar este campo" : "")'])!!}
                                  {!!Form::hidden('id',null,['class'=>'form-control','id'=>'edit_id_obj'])!!}
                                  {!!Form::hidden('project',Session::get('pj')->id,['class'=>'form-control','id'=>'project','name'=>'project'])!!}
                                </br>
                                </div>
                              </div>
                            </div>

                          </div>
                      </div>


                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary edit-obj" style="margin-left:5px;" data-dismiss="modal">Guardar cambios</a>
                            <button type="button" class="btn btn-primary btn-outline" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <script>
                    function updateProgress(){
                      totalPending = {{($allActivities == null)? 0 : count($allActivities)}};
                      totalDone = {{($allActivities2 == null)? 0 : count($allActivities2)}};
                      totalActs = totalDone + totalPending;

                      console.log('TOTAL_DONE: '+totalDone);
                      console.log('TOTAL_ PENDING: '+totalPending);
                      console.log('TOTAL '+totalActs);
                      console.log('PROGRESO: '+prog);

                      var prog = totalDone * 100 / totalActs;
                      document.getElementById("bar-real-progress").style.width = prog+'%';
                      $('#real-progress-text').html('Porcentaje de avance '+Math.round(prog * 100) / 100+'%');
                    }
                    </script>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div></div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-meh-o modal-icon"></i>
        <h4 class="modal-title">Parece que alguien más está editando...</h4>
        <h5>Un integrante de tu equipo está trabajando en este momento, trata de editar más tarde.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

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
<script src="http://momentjs.com/downloads/moment.min.js"></script>

<script>
  var totalDone;
  var totalPending;
  var totalActs;
  var currentDate = document.getElementById("startdate").value;
  $('.chosen-select').chosen({width: "100%"});
  $(window).on('load',function(){
    var progress;
    var today = moment(new Date().toISOString().slice(0, 10));
    var date1 = moment('{{($pj == null)? "" : $pj->startdate}}');
    var date2 = moment('{{($pj == null)? "" : $pj->deadline}}');
    var dif = date2.diff(date1, 'days');
    var dif_today = today.diff(date1, 'days');

    if(!isNaN(date1) || !isNaN(date2)){
      if(dif_today > dif){
        progress = 100;
      }else{
        progress = dif_today * 100/dif;
      }
      document.getElementById("bar").style.width = progress + "%";
      if(progress >= 0)
        $("#progress-text").html("Tiempo de ejecución del proyecto " + Math.round(progress * 100) / 100 + "%");
      else {
        $("#progress-text").html("Tiempo de ejecución del proyecto 0%");
      }
      updateProgress();
    }

  });

  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
  };
//'{{asset("teams/info/point/cohort")}}'.replace('point/cohort',point.team+'/'+current_cohort),
  $(document).ready(function () {
      $('.check-act').click(function(){
          var idd = $(this).val();
          var activity = $('#act-'+idd).html();
          if($(this).prop('checked')){
            console.log("FLAAAG!"+idd);
            //$('#act-'+idd).html('<del style="background-color:transparent;">'+activity+'</del>');
            $('#act-'+idd).css("text-decoration","line-through");
            $('#status-'+idd).html("Hecho");
            $.get('{{asset("check/activity/id")}}'.replace('id',idd), function (data) {
              console.log('DONE!');

              totalDone = totalDone+1;
              var prog = (totalDone) * 100 / totalActs;
              document.getElementById("bar-real-progress").style.width = prog+'%';
              $('#real-progress-text').html('Porcentaje de avance '+Math.round(prog * 100) / 100+'%');
            });

          }else{
            console.log("___FLAG");
            console.log(activity);
            $('#act-'+idd).css("text-decoration","none");
            $('#status-'+idd).html("En espera");
            $.get('{{asset("uncheck/activity/id")}}'.replace('id',idd), function (data) {
              console.log('UNDONE!');

              totalDone = totalDone-1;
              var prog = (totalDone) * 100 / totalActs;
              document.getElementById("bar-real-progress").style.width = prog+'%';
              $('#real-progress-text').html('Porcentaje de avance '+Math.round(prog * 100) / 100+'%');
            });
          }
      });
  });

  $(document).ready(function () {
    $(".alertmessage").click(function() {

      if(validateActivityFields()){
      console.log('activity: '+$('#activity').val());
      console.log('deadline: '+$('#deadline').val());

      $.ajax({
          type: 'post',
          url: '{{asset("add/activity-from-project")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'activity': $('#activity').val(),
              'startdate': $('#startdate').val(),
              'deadline': $('#deadline').val(),
              'workplan': $('#wp-select').val()
          },
          success: function(data) {
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
              } else {
                  console.log('SUCCESS_FLAG');
                  $('#acts').append('<tbody>');
                  $('#acts').append('<tr><td style="min-width:300px;">' + data.activity + "</td><td>" + data.startdate + "</td><td>"+data.deadline+"</td></tr>");
                  $('#acts').append('</tbody>');
              }
          },
      });
      $('#activity').val('');
      document.getElementById("deadline").value = currentDate;
      document.getElementById("startdate").value = currentDate;
      }
    });
  });

  $(document).ready(function () {
    $(".modal-objective").click(function() {

      if(validateObjectiveFields()){

      $.ajax({
          type: 'post',
          url: '{{asset("add/wp")}}',
          data: {
            '_token': "{{ csrf_token() }}",
            'objective_what': $('#objective_what').val(),
            'objective_what_for': $('#objective_what_for').val(),
            'amount': $('#amount').val(),
            'goal': $('#goal').val(),
            'project': $('#project').val()
          },
          success: function(data) {
              if ((data.errors)) {
                console.log('ERROR_FLAG');
                toastr.success('Error','No se pudo registrar la información');
              } else {
                console.log('SUCCESS_FLAG');
                toastr.success('Objetivo registrado','Se ha guardado la información');
              }
          },
      });
      $('#objective_what').val('');
      $('#objective_what_for').val('');
      $('#amount').val('');
      $('#goal').val('');
      }
    });
  });

  $(document).ready(function () {
    $(".edit-act").click(function() {

      //if(validateActivityFields()){
      console.log('activity: '+$('#activity').val());
      console.log('deadline: '+$('#deadline').val());
      console.log("ID_AC: "+$('#edit_id').val());

      $.ajax({
          type: 'post',
          url: '{{asset("editact")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'id': $('#edit_id').val(),
              'activity': $('#edit_activity').val(),
              'startdate': $('#edit_startdate').val(),
              'deadline': $('#edit_deadline').val(),

          },
          success: function(data) {
              location.reload();
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
              } else {
                  console.log('SUCCESS_FLAG');

              }
          },
      });

      //}
    });
  });

  $(document).ready(function () {
    $(".edit-obj").click(function() {

      //if(validateObjectiveFields()){
      console.log("ID_WP: "+$('#edit_id_obj').val());

      $.ajax({
          type: 'post',
          url: '{{asset("edtobj")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'id': $('#edit_id_obj').val(),
              'objective_what': $('#edit_objective_what').val(),
              'objective_what_for': $('#edit_objective_what_for').val(),
              'amount': $('#edit_amount').val(),
              'goal': $('#edit_goal').val(),
          },
          success: function(data) {
              location.reload();
              if ((data.errors)) {
                  console.log('ERROR_FLAG');
              } else {
                  console.log('SUCCESS_FLAG');

              }
          },
      });

      //}
    });
  });

  $('#startdate').on('change', function(){
    var sdate = document.getElementById("startdate").value;
    console.log('current_date: '+sdate);

    document.getElementById("deadline").value = sdate;
    document.getElementById("deadline").min = sdate;
  });

  function validateActivityFields(){
    if(document.getElementById("activity").validity.valueMissing){
        swal({
            title: "Falta información",
            text: "Verifica que has llenado todos los campos"
        });
        return false;
    }else if(document.getElementById("startdate").value == document.getElementById("deadline").value){
        swal({
            title: "Fechas incorrectas",
            text: "Verifica que la fecha límite sea posterior a la de inicio."
        });
        return false;
    }else{
        document.getElementById("activity").setCustomValidity("");
        return true;
    }
  }

  function validateObjectiveFields(){
      if(document.getElementById("objective_what").validity.valueMissing || document.getElementById("objective_what_for").validity.valueMissing ||
          document.getElementById("amount").validity.valueMissing || document.getElementById("goal").validity.valueMissing){
            swal({
                title: "Falta información",
                text: "Verifica que has llenado todos los campos"
            });
            return false;
      }else{
        return true;
      }
  }

  function showMessage(title,description){
    swal({
        title: title,
        text: description
    });
  }

  function fillEdit(id,activity,date1,date2){
    $('#edit_id').val(id);
    $('#edit_activity').val(activity);
    document.getElementById("edit_startdate").value = date1;
    document.getElementById("edit_deadline").value = date2;
  }

  function fillEditObjective(id,ob,ob_w_f,amount,goal){
    $('#edit_id_obj').val(id);
    $('#edit_objective_what').val(ob);
    $('#edit_objective_what_for').val(ob_w_f);
    $('#edit_amount').val(amount);
    $('#edit_goal').val(goal);
  }

  function removeActivity(idact){
    console.log("ID_ACT_TO_DELETE:"+idact);
    swal({
        title: "¿Estás seguro?",
        text: "La actividad será eliminada del sistema",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "¡Sí, quiero borrarla!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function () {

      $.ajax({
          type: 'post',
          url: '{{asset("rmvAct")}}',
          data: {
              '_token': "{{ csrf_token() }}",
              'id': idact
          },
          success: function(data) {
              //$('.item' + $('.did').text()).remove();
              //document.getElementById("activity-table").deleteRow($(this).parentNode.rowIndex);
              location.reload();
          }
        });

        swal("¡Registro eliminado!", "La actividad fue removida con éxito", "success");
    });
  }


</script>
@endsection
