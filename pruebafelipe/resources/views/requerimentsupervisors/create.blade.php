@extends('admintemplate')

@section('place')
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresar solicitud de disciplina <small>Solo Ingresar solicitudes no agregadas</h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            {!! Form::open(['route'=>'requestdisciplines.store','class'=>'form-horizontal','method'=>'POST']) !!}

                                <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                                    <div class="col-sm-10">
                                    
                                        
                                    {!!Form::select('dp',$departament,null,['id'=>'dp','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2', 'required'=>''])!!}
                                    
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>

                                    <div class="col-sm-10">
                                        <div id='mun'>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Equipo</label>

                                    <div class="col-sm-10">
                                        <div id='team'>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Sede</label>

                                    <div class="col-sm-10">
                                        <div id='sde'></div>
                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Disciplina</label>

                                    <div class="col-sm-10">

                                    
                                   {!!Form::select('meta',$metadisciplinas,null,['id'=>'meta','class'=>'form-control m-b chosen-select', 'tablaindex'=>'2', 'required'=>''])!!}


                                    </div>
                                    
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Unidad Académica</label>

                                    <div class="col-sm-10">
                                    
                                        <div id='UAdiv'></div>
                                        
                                    </div>
                                    
                                </div>
                               

                                {!! Form::Submit('Guardar', ['id'=>'guardar','class'=>'btn btn-primary']) !!}
                       
                                </div>


                                
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>




@endsection


@section('script')
<link href="../css/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="../js/plugins/select2/select2.full.min.js"></script>
<script src="../js/plugins/chosen/chosen.jquery.js"></script>
<script src="../js/plugins/switchery/switchery.js"></script>



<script>
      $('.chosen-select').chosen({width: "100%"});
      
</script>
<script>
    function getmun() {
        var va = jQuery("#dp").val()
        console.log(va);
        jQuery.ajax({
            url: '{{asset("request/getmunicipality/value")}}'.replace('value', va),
            type:"GET",
            dataType:"json",
            success:function(data){
                //console.log('console:'+data['result']);
                jQuery("#mun").html(data['html']);
                jQuery('#script1').html('<script> $(document).ready(function(){jQuery("#municipal").change(getteam); $("#municipal").chosen({width: "100%"});});');
                getteam();
            },error:function(){
                console.log('ERROR');
                toastr.success('Se ha producido un error, contactar con los desarrolladores','¡ERROR!');
            }
        });
    }
    function getteam() {
        var vo = jQuery("#municipal").val()
        console.log(vo);
        jQuery.ajax({
            url: '{{asset("request/getteam/value")}}'.replace('value', vo),
            type:"GET",
            dataType:"json",
            success:function(data){
                //console.log('console:'+data['result']);
                jQuery("#team").html(data['html']);
                jQuery('#script').html('<script> $(document).ready(function(){jQuery("#tm").change(getsede); $("#tm").chosen({width: "100%"});});');
                getsede();
            },error:function(){
                console.log('ERROR');
                toastr.success('Se ha producido un error, contactar con los desarrolladores','¡ERROR!');
            }
        });
    }
    function getsede() {
        var vo = jQuery("#tm").val()
        console.log(vo);
        jQuery.ajax({
            url: '{{asset("request/getsede/value")}}'.replace('value', vo),
            type:"GET",
            dataType:"json",
            success:function(data){
                //console.log('console:'+data['result']);
                jQuery("#sde").html(data['html']);
                jQuery('#script').html('<script> $(document).ready(function(){ $("#sd").chosen({width: "100%"});});');
            },error:function(){
                console.log('ERROR');
                toastr.success('Se ha producido un error, contactar con los desarrolladores','¡ERROR!');
            }
        });
    }
    function getUA() {
        var vi = jQuery('select[id="meta"] option:selected').text();
        console.log(vi);
        
        jQuery.ajax({
            url: '{{asset("request/getUA/value")}}'.replace('value', vi),
            type:"GET",
            dataType:"json",
            success:function(data){
                //console.log('console:'+data['result']);
                jQuery("#UAdiv").html(data['html']);
                jQuery('#script2').html('<script> $(document).ready(function(){ jQuery(".js-example-basic-multiple").select2({placeholder: "Seleccione",allowClear: true});});');
            },error:function(){
                console.log('ERROR');
                toastr.success('Se ha producido un error, contactar con los desarrolladores','¡ERROR!');
            }
        });
    }
    $(document).ready(function(){
        getmun();
        getUA();
        jQuery('#dp').change(getmun);
        jQuery('#municipal').change(getteam);
        jQuery('#sd').change(getsede);
        jQuery('#meta').change(getUA);
        jQuery('.js-example-basic-multiple').select2({placeholder: "Seleccione",allowClear: true});
    });
</script>
<div id='script'></div>
<div id='script1'></div>
<div id='script2'></div>

@endsection