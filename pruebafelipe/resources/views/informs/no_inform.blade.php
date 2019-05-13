@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins white-bg">
      <div class="ibox-title">
        <h5>Ficha final</h5>
        <div class="ibox-tools">
        </div>
      </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="wrapper wrapper-content animated fadeInUp">
                  <div class="">
                      <div class="ibox-content">

                        <div class="row">
                            <div class="col-lg-12">
                                  <div class="float-e-margins">
                                      <div class=" text-center p-md">
                                          <h2><span class="text-navy">Aún no es posible obtener la ficha de resultados</span>
                                          <br/><h3></h3></h2>
                                          <p>
                                            El proyecto no se ha finalizado
                                          </p>
                                          </br>
                                          <a href="{{ url('project/cat/'.$idpj)}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i> Ir al Proyecto</a>
                                      </div>
                                  </div>
                            </div>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div>
  </div>
</div>



@endsection

@section('script')


@endsection
