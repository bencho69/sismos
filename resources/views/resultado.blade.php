@extends('layouts.info')

@section('content')
      <section id="info"></section> 

      <section id="blog">
        <div class="container" id="cuestionario">
            <h2><strong>!Muchas gracias por contestar nuestro cuestionario.!</strong> <br> 
              Su ayuda nos permitirá mejorar nuestro conocimiento del comportamiento de los sismos.</h2>  
            <p class="importante">Según la información que nos proporcionó, el sismo {{$sismo_fecha}} para la ubicación geográfica ({{$latitud}},{{$longitud}}) fue de una intensidad en la escala de Mercalli de {{$intensidad}}.</p><br>
<style type="text/css">
.mimapa{width:100%;height:600px;}
</style>
<?php $apikey = "AIzaSyAInBMEf5ljVpYeBFLDAidiXOCPGNTWaio"; ?>
<div id="map" class="mimapa"></div>
<script type="text/javascript">
  var mimapa;
  var gmarkers = new Array();
 
function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        <?php foreach ($encuestas as $key => $punto): ?>
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map
        });
        <?php endforeach ?>
      }

</script>
 
<?php echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=".$apikey."&callback=initMap'></script>"; ?>

        </div>
      </section>
      <section id="info"></section> 
@endsection
       
