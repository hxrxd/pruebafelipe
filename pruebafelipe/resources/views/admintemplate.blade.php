<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiE </title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/bootstrap.css')!!}
    {!!Html::style('font-awesome/css/font-awesome.css')!!}
    {!!Html::style('css/plugins/sweetalert/sweetalert.css')!!}
    {!!Html::style('css/plugins/toastr/toastr.min.css')!!}
    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/checkbox.css')!!}
    {!!Html::style('css/hover.css')!!}
    {!!Html::style('css/cool-tabs.css')!!}
    {!!Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
    {!!Html::style('css/plugins/switchery/switchery.css') !!}

    @section('style')
    @show

    <!-- Facebook Open Graph -->
      <meta property="og:type" content="website"/>
      <meta property="og:title" content="MiE 2.0"/>
      <meta property="og:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta property="og:image" content="{{asset('img/card-2.png')}}"/>

    <!-- Twitter Cards -->
      <meta name="twitter:card" content="summary_large_image"/>
      <meta name="twitter:title" content="MiE 2.0"/>
      <meta name="twitter:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta name="twitter:image" content="{{asset('img/card-2.png')}}">

      <meta name="_token" content="{{csrf_token()}}">

</head>
<body  class="md-skin fixed-nav no-skin-config">

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('template/sidebar')
        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('template/header')

            <!-- Main view  -->
            <div class="wrapper wrapper-content animated fadeInRight">
            @yield('place')
            </div>


        <!-- Footer -->
        @include('template/footer')
        </div>
    </div>

    @include('template/scripts')

    @section('script')
    @show

</body>
</html>
