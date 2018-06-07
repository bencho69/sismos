@extends('layouts.principal')

@section('content')
          <section id="blog">
            <div class="contenedor">
      
               <article>
                <a href="cuestionario"><img src="img/encuesta.jpg"> </a>
                <a href="cuestionario" class="btn btn-success">Reporta un Sismo.</a>
               </article>
               
             </div> 
           </section>
@endsection

@section('menu')
   @include('partes.menu')
@endsection

@section('pie')
        <footer>
            <div class="contenedor">
                <p class="copy"><a href="http://www.orionms.com.mx"><img src="img/LogoOMS.png" width="30" height="30"></a>Rubén Rodríguez Camargo &copy; 2017-2019</p>
                <div>
                <a href="http://www.conacyt.gob.mx"><img src="img/logoCONACYT.png" width="60" height="40"></a>
                <a href="http://www.uagro.mx"><img src="img/uagrologo.png" width="40" height="50"></a>
                </div>
                <div class="sociales">
                    <a class="fontawesome-facebook-sign" href="https://www.facebook.com/unidadingenieria/"></a>
                    <a class="fontawesome-twitter" href="https://twitter.com/uagrooficial?lang=es"></a>
                    <a class="fontawesome-camera-retro" href="http://www.conacyt.gob.mx"></a>
                    <a class="fontawesome-google-plus-sign" href="#"></a>
                </div>
            </div>
        </footer>
@endsection

@section('info')
            <section id="info">
                <h3>Actividades para saber el nivel de vulnerabilidad ante un sismo.</h3>
                <div class="contenedor">
                    <div class="info-tema">
                        <img src="img/sentisismo.jpg" alt="">
                        <h4>¿Sentiste un sismo?</h4>
                    </div>
                    <div class="info-tema">
                        <img src="img/curvaisosista.jpg" alt="">
                        <h4>¿Curvas isosistas?</h4>
                    </div>
                    <div class="info-tema">
                        <img src="img/zonavulnerable2.jpg" alt="">
                        <h4>¿Que zonas son vulnerables?</h4>
                    </div>
                    <div class="info-tema">
                        <img src="img/estoybien2.jpg" alt="">
                        <h4>¿Cómo estan las personas?</h4>
                    </div>                    
                </div>
            </section>
@endsection