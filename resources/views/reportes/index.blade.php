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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Tiempo', 'Intensidad'],
              @foreach ($datos  as $dato )
                  [ {{ $dato->dia }} , {{ $dato->intensidad }} ],
              @endforeach 
            ]);

            var options = {
              title: 'Distribución de cuestionarios en el tiempo',
              hAxis: {title: 'Fecha', minValue: {{ $fini }}, maxValue: {{ $ffin }}},
              vAxis: {title: 'Intensidad', minValue: {{ $intmin }}, maxValue: {{ $intmax }} },
              legend: 'none'
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

            chart.draw(data, options);
          }
        </script>
    </head>
    <BODY >
        <header >
            <div class="row" style="width: 100%;height: 40px;background: #333;color: #fff;">
                <h3 style="margin: auto; padding: 5px;">SISMOS-SIStema de MOnitoreo de Sismos</h3> 
            </div>
        </header>
            <main>        
                <div id="chart_div" style="width: 1224px; height: 500px;"></div>
  @include('alerts.errors')
                Reporte de distribución de encuestas en el tiempo del ultimo sismo.
                <table class="table">
            <thead>
              <tr>
             <th>id</th>
             <th>Sismo</th>
             <th>Latitud</th>
             <th>Longitud</th>
             <th>intensidad</th>  
             <th>confianza</th>             
             <th>contestada</th>
             <th>sismo</th>             
             </tr>
            </thead>

            @foreach($datosenc as $encuesta)
            <tbody>              
              <td>{{$encuesta->id}}</td>
              <td>{{$encuesta->sismo_id}}</td>
              <td>{{$encuesta->latitud}}</td>
              <td>{{$encuesta->longitud}}</td>
              <td>{{$encuesta->intensidad}}</td>
              <td>{{$encuesta->confianza}}</td>
              <td>{{$encuesta->created_at}}</td>
              <td>{{$encuesta->fecha}}</td>
              <!-- Boton Editar -->

            </tbody>              
            @endforeach

        </table>
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

@section('cuerpo')

<div id="chart_div" style="width: 900px; height: 500px;"></div>
  @include('alerts.errors')
<div class="container">
    <div class="row">
        <div class="col-md-16">
            <div class="panel panel-default">
                <div class="panel-heading">Reportes Sismos</div>

                <div class="panel-body">
                   Lista de sismos registrados en la base de datos.!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-16">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>

                <div class="panel-body">
                    Lista de usuarios Usuarios Registrados.!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-16">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>

                <div class="panel-body">
                    Este será una opcion del menú de reportes general.!
                </div>
            </div>
        </div>
    </div>    
</div>
@stop