<header>
    <div class="contenedor" id="ancho">
        <h1 class="icon-dog" style="margin: auto;"><P id="oculto"></P></h1>
        <script> 
          var x;
          if( typeof( window.innerWidth ) == 'number' ) {
    //No-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  } 
          if (myWidth >= 1400) {
            x =  "SisMOS-Sistema de MOnitoreo de Sismos"
          }else{
            x=  "SisMOS";
          }
          document.getElementById("oculto").innerHTML =x;
        </script> 
        
        <input type="checkbox" id="menu-bar">
        <label class="fontawesome-align-justify" for="menu-bar"></label>
        <nav class="menu">
            <a href="/">Inicio</a>
            <a href="cuestionario">Reportar un Sismo</a>
            <a href="quienes_somos">Quienes somos?</a>
            <a href="log">Área Administración</a>
        </nav>
    </div>
</header>