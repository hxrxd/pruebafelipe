@extends('statstemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">
    <div style="padding-right:150px;padding-left:150px;padding-top:90px;margin:auto;">
      <p style="font-size:48px;text-align:center;"><i class="fa fa-bar-chart-o modal-icon"></i></p>
      <h1>¡Bienvenido a Estadísticas de EPSUM!</h1>


      <h2 style="text-align:center;margin-top:25px;">Conoce el Programa EPSUM de la USAC ¡en cifras!</h2>
      <p style="text-align:center;">Estadísticas de EPSUM es un proyecto basado en los datos registrados en el Sistema MiE 2.0, mismos que son ingresados por los estudiantes como parte de su trabajo realizado con EPSUM, desde su proceso de registro en la plataforma, hasta el ingreso de sus informes diagnósticos y de proyectos.</p>
      <p style="text-align:center;"><strong>Estadísticas de EPSUM continuará mejorando, por tal razón, pueden existir cambios en la distribución de información sin previo aviso.</strong></p>
      <a href="{{url('stats/students')}}" class="btn btn-primary btn-outline" style="margin:auto;margin-top:25px;"> Comenzar con las estadísticas de estudiantes </a>
    </div>

  </div>

@endsection

@section('script')

<script type="text/javascript">


  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 100);

</script>

<style>

  h1{
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 0px;
    padding-bottom: opx;
  }
  h2{
    color: #02556e;
    margin-top:35px;
    text-transform: uppercase;
    text-align: center;
  }
  h3{
    text-align: center;
    text-transform: uppercase;
    margin-top:0px;
    margin-bottom: 18px;
  }
  h4{
    text-align: center;
    color: #f68628;
    font-size: 18px;
    font-weight: normal;
    text-transform: uppercase;
    margin-top:0px;
    margin-bottom: 18px;
  }
  h5{
    text-align: left;
    color: #2ebeef;
    font-size: 16px;
    font-weight: normal;
    margin-top:0px;
  }
  p{
    text-align : justify;
  }

  tr:nth-child(even){
    background-color: #f5f5dc;
  }
  th, td {
    text-align: left;
    padding-right: 15px;
    padding-left: 15px;
  }
  .contenido{
    font-size: 20px;
  }
  .frame{
    padding: 40px;
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 12px;
  }

  .subtitle{
    font-weight: bold;
    font-size: 14px;
  }
  .logos{
    width: 60%;
    margin: 0 auto;
  }

  .numbers{
    text-align: left;
    font-weight: bold;
    font-size: 24px;
    margin-bottom: 0px;
    padding-bottom: 5px;
    padding-bottom: 7px;
  }

  .color-indico{
    color:white;
    background-color: #02556e;
  }

  .color-indico-2{
    font-weight: bold;
    color:white;
    background-color: #95b1c2;
  }
  .color-blue{
    color:white;
    background-color: #2ebeef;
  }
  .color-blue-2{
    font-weight: bold;
    color:white;
    background-color: #abe1fa;
  }
  .color-red{
    color:white;
    background-color: #a03522;
  }
  .color-red-2{
    font-weight: bold;
    color:white;
    background-color: #d6acaa;
  }
  .color-orange{
    color:white;
    background-color: #f68628;
  }
  .color-orange-2{
    font-weight: bold;
    color:white;
    background-color: #fdcdab;
  }

  #segundo{
    color:#44a359;
  }
  #tercero{
    text-decoration:line-through;
  }

  .custom-legend {
    position: absolute;
    top: 130%;
    left: 53%;

    margin-bottom: 0px;
    font-size: 16px;
    min-width: 75px;
  }


  /*for radio buttons*/

  /* The container */
  .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 16px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
  }

  /* Hide the browser's default radio button */
  .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
      background-color: #ccc;
  }

  /* When the radio button is checked, add a blue background */
  .container input:checked ~ .checkmark {
      background-color: #2ebeef;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
      content: "";
      position: absolute;
      display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .container input:checked ~ .checkmark:after {
      display: block;
  }

  /* Style the indicator (dot/circle) */
  .container .checkmark:after {
   	top: 9px;
  	left: 9px;
  	width: 8px;
  	height: 8px;
  	border-radius: 50%;
  	background: white;
  }

  .select {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
    width: 100%;
  }
  .select select {
    display: inline-block;
    width: 100%;
    cursor: pointer;
    padding: 10px 15px;
    outline: 0;
    border: 0;
    border-radius: 0;
    background: #e6e6e6;
    color: #7b7b7b;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }
  .select select::-ms-expand {
    display: none;
  }
  .select select:hover,
  .select select:focus {
    color: #000;
    background: #ccc;
  }
  .select select:disabled {
    opacity: 0.5;
    pointer-events: none;
  }
  .select__arrow {
    position: absolute;
    top: 16px;
    right: 15px;
    width: 0;
    height: 0;
    pointer-events: none;
    border-style: solid;
    border-width: 8px 5px 0 5px;
    border-color: #7b7b7b transparent transparent transparent;
  }
  .select select:hover ~ .select__arrow,
  .select select:focus ~ .select__arrow {
    border-top-color: #000;
  }
  .select select:disabled ~ .select__arrow {
    border-top-color: #ccc;
  }

  /*for loading*/
  #loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    margin-top:210px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  /*for loading*/
  #loader-modal {
    position: absolute;
    left: 50%;
    bottom: 5%;
    z-index: 1;
    width: 40px;
    height: 40px;
    margin: -30px 0 0 -30px;
    border: 8px solid #f3f3f3;
    border-radius: 50%;
    border-top: 8px solid #f68628;
    width: 50px;
    height: 50px;
    margin-top:210px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Add animation to "page content" */
  .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
  }

  @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 }
    to { bottom:0px; opacity:1 }
  }

  @keyframes animatebottom {
    from{ bottom:-100px; opacity:0 }
    to{ bottom:0; opacity:1 }
  }

  #frame {
    display: none;
    text-align: center;
  }
</style>

@endsection
