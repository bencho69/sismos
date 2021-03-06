@extends('layouts.info')

@section('content')

<script language="JavaScript">
                                                                                                              
var ns4 = (document.layers)? true:false
var ie4 = (document.all)? true:false
var ns6 = (document.getElementById && !document.all) ? true: false;
var coorX, coorY, iniX, iniY;
var X=356-334; x2=924-334; y=78-60; y2=366-60;  // puntos de control IMG
var pcx=17.211245; pcy=-99.781452; pc2x=17.312541; pc2y=-99.254578;
                                                                                            
if (ns6) document.addEventListener("mousemove", mouseMove, true)
if (ns4) {document.captureEvents(Event.MOUSEMOVE); document.mousemove = mouseMove;}
                                                                                                              
function mouseMove(e)
{
        if (ns4||ns6)   {coorX = e.pageX; coorY = e.pageY;}
        if (ie4)        {coorX = event.x; coorY = event.y;}
        return true;
}
                                                                                                              
function ini()  {
        if (ie4)        document.body.onmousemove = mouseMove;
        iniX = document.getElementById("recuadro").offsetLeft;
        iniY = document.getElementById("recuadro").offsetTop;
}
                                                                                                              
function coordenadas()  {
        Xa = pcx+(((coorX-iniX)/(x2-X))*(pc2x-pcx));
        yA = pcy+(((coorY-iniY)/(y2-y))*(pc2y-pcy));
        //alert ("Pinchó las siguientes coordenadas:\nx:" + Xa + "\ny: " + yA);
        document.getElementById("latitud").value = Xa;
        document.getElementById("longitud").value = yA;
}
                                                                                                              
function mostrar()      {
        document.getElementById("ayuda").style.top = coorY + 10;
        document.getElementById("ayuda").style.left = coorX + 10;
        document.getElementById("ayuda").style.visibility = "visible";
        document.getElementById("ayuda").innerHTML = "x = " + coorX +"<br>y = " + coorY;
}
                                                                                                              
function ocultar()      {
        document.getElementById("ayuda").style.visibility = "hidden";
}

function mover()        {
        document.getElementById("ayuda").style.top = coorY + 10;
        document.getElementById("ayuda").style.left = coorX + 10;
        document.getElementById("ayuda").style.visibility = "visible";
        document.getElementById("ayuda").innerHTML = "x = " + coorX +"<br>y = " + coorY;
}
                                                                                                              
</script>
    <section id="imagen">
        <div align=center>
                <h3>
                ... Mueve el raton por la imagen y da click en tu ubicación  ...
                </h3>
                                                                                                                              
                <img src="img/encabezadoenc.jpg" onclick="coordenadas()" onmouseover="mostrar()" onmousemove="mover()"
                onmouseout="ocultar()" id="recuadro"
                >                                                                                                    
        </div>
    </section>
        <div id="ayuda" style=" visibility:hidden;
                position:absolute;
                background:yellow;
                font:normal 10px/10px verdana;
                color:black;
                border:solid 1px black;
                text-align:justify;
                padding:10px 10px 10px 10px;">
        </div>
      <section id="blog">
        <div class="container" id="cuestionario">
            <h2>Llene los datos sobre su ubicación cuando sintió el sismos</h2>  
            <p class="importante">La información que proporcione será para ubicar sobre que sismos ésta reportando y su ubicación cuando esté ocurrio.</p><br>
            <form ACTION="guardaENC" METHOD="post" name="registro" onsubmit="return validaForm()" class="formulario">
                <div class="form-group">
                    <label>Latitud:</label>
                    <input type="text" class="form-control" name="latitud" placeholder="Da clic en la imagen." id='latitud' required>
                    <label >Longitud:</label>
                    <input type="text" class="form-control" name="longitud" placeholder="Da clic en la imagen." id='longitud' required>   
                </div>
                <div class="form-group">
                    <label>Elija el sismo que reporta:</label>   
                </div>
                <button type="submit" class="btn btn-primary">Enviar cuestionario.</button>
            </form>
        </div>
      </section>

@endsection
       
