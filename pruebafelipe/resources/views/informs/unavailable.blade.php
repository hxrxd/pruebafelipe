@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins white-bg">

      <div style="width:600px;height:500px;margin:auto;padding:20px;text-align:center;">
        <h2 style="font-size:64px;margin-top:120px;"><i class="fa fa-frown-o"></i></h2>
        <h1 style="font-weight:bold">No hay nada que mostrar por aquí</h1>
        <p>Es posible que quieras acceder a un informe que no existe.</p>
        <a type="button" href="{{ url('plan')}}" class="cool-button hvr-grow bg-orange" style="color:white;margin-top:10px">Volver a informes</a>
      </div>

    </div>
  </div>
</div>



@endsection

@section('script')

@endsection
