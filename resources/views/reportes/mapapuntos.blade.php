@extends('layouts.reportes')

@section('content')
    <head>
        <meta charset="UTF-8"> 
        <title> SisMOS </title> 
        <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
        <style>
            .copy {font-size: 16px;}
            .sociales {width: 100%;text-align: center;font-size: 28px;}
            .contenedor {margin: auto;}
        </style>
    </head>
    <BODY>
        <header >
            <div class="row" style="width: 100%;height: 40px;background: #333;color: #fff;">
                <h3 style="margin: auto; padding: 5px;">SISMOS-SIStema de MOnitoreo de Sismos</h3> 
            </div>
        </header>
            <main>
 
<style type="text/css">
.mimapa{width:100%;height:600px;}
</style>
<?php $apikey = "AIzaSyAInBMEf5ljVpYeBFLDAidiXOCPGNTWaio"; ?>

<div id="map" class="mimapa"></div>
<script type="text/javascript">
  var mimapa;
  var gmarkers = new Array();
  var labelIndex = 0;
 
  function initMap() {
        var uluru = {lat: 17.552152, lng: -99.501442};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uluru
        });

        <?php foreach ($encuestas as $key => $punto): ?>
        var marker = new google.maps.Marker({
          position: {lat: {{$punto->latitud}}, lng: {{$punto->longitud}} },
          map: map,
          title: 'Punto('+labelIndex.toString()+'): Lat: =  {{$punto->latitud}} , lng: {{$punto->longitud}}',
          label: labelIndex.toString()
        });
        labelIndex++;
        <?php endforeach ?>  
  }

</script>
 
 <?php echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=".$apikey."&callback=initMap'></script>"; ?>

            </main>
       <div  class="row" style="width: 100%;height: 5px;background: #333;color: #fff;">
       </div>
        <footer>
            <div class="contenedor" style="display: inline;">
                <p class="copy" style="min-width: 100;">
                  <div style="min-width: 100;"></div><img src="img/LogoOMS.png" width="30" height="30">Rubén Rodríguez Camargo &copy; 2017-2019
                  <img src="img/logoCONACYT.png" width="60" height="40">
                  <img src="img/uagrologo.png" width="40" height="50">
                </p>  
            </div>
        </footer>
       
    </body>

@endsection
