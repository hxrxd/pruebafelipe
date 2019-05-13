@extends('admintemplate')

@section('place')

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins white-bg">

      <div class="row">
          <div class="col-lg-12">
                <div class="float-e-margins">
                    <div class="text-center p-md">
                        <h1 style="font-weight:bold">Informes mensuales</h1>
                    </div>
                </div>
          </div>
      </div>

      <div class="row month-div">
        <div class="col-lg-12">

          @foreach($plans as $plan)

            @if($plan->nmonth === (int)$current_month)
            <a href="{{($plan->status==0 || $plan->status==1)?url('plan/month/'.$plan->nmonth):url('monthly/report/reviewed/'.$plan->nmonth)}}"><div class="col-lg-3">
              <div class="month-card hvr-sweep-to-right p-lg text-center animated bounceIn">
                <div class="m-b-md">
                  <h2 class="font-bold no-margins">
                    {{$plan->month}}
                    @if($plan->status == 0 || $plan->status == 1)
                      <p><span class="badge badge-info">{{($plan->status == 0)?'EDITANDO':'EN REVISIÓN'}}</span></p>
                    @else
                      <p><span class="badge badge-info">{{($plan->status == 2)?'REVISADO':'FINALIZADO'}}</span></p>
                    @endif
                  </h2>
                </div>
              </div>
            </div></a>
            @else
            <a href="{{($plan->status==0 || $plan->status==1)?url('plan/month/'.$plan->nmonth):url('monthly/report/reviewed/'.$plan->nmonth)}}"><div class="col-lg-3">
              <div class="month-card-validated hvr-grow p-lg text-center">
                <div class="m-b-md">
                  <h2 class="font-bold no-margins">
                    {{$plan->month}}
                    @if($plan->status == 0 || $plan->status == 1)
                      <p><span class="badge badge-primary">{{($plan->status == 0)?'EDITANDO':'EN REVISIÓN'}}</span></p>
                    @else
                      <p><span class="badge badge-primary">{{($plan->status == 2)?'REVISADO':'FINALIZADO'}}</span></p>
                    @endif
                  </h2>
                </div>
              </div>
            </div></a>
            @endif

          @endforeach


          @foreach($wich_months_missing as $index => $month)

            @if($index === (int)$current_month)
            <a href="{{url('plan/month/'.$index)}}"><div class="col-lg-3">
              <div class="month-card hvr-sweep-to-right p-lg text-center animated bounceIn">
                <div class="m-b-md">
                  <h2 class="font-bold no-margins">
                    {{$month}}
                    <p><span class="badge badge-info">¡Puedes comenzar a editar!</span></p>
                  </h2>
                </div>
              </div>
            </div></a>
            @else
            <div class="col-lg-3">
              <div class="month-card-disabled p-lg text-center">
                <div class="m-b-md">
                  <h2 class="font-bold no-margins">
                    {{$month}} <i class="fa fa-lock"></i>
                    <p><span class="badge badge-plain">Aún no disponible</span></p>
                  </h2>
                </div>
              </div>
            </div>
            @endif

          @endforeach

        </div>
      </div>

    </div>
  </div>
</div>



@endsection

@section('script')

@endsection
