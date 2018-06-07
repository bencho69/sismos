<html>
<head>
    <meta charset="UTF-8"> 
    <title>
        SisMOS
    </title> 
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
<script>
                                                                                                              
var ns4 = (document.layers)? true:false;
var ie4 = (document.all)? true:false;
var ns6 = (document.getElementById && !document.all) ? true: false;
var coorX, coorY, iniX, iniY;                                                                    

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
 var X=28; 
var y=38; 
var x2=518; 
var y2=494;  // puntos de control IMG   
var LatControl=17.597089;   // Latitud de Control Punto A
var LongControl=-99.544610; // Longitud de Control Punto A
var LatControlB=17.522237;  // Latitud de control Punto B
var LongControlB=-99.460125;// Longitud de control Punto B 
    var  Porc = ((coorX-iniX-X)*100)/(x2-X);
    var  Fraccion = (LatControlB-LatControl) * Porc / 100;
    var  Xa = LatControl + Fraccion;
        Porc = (coorY - iniY - y)*100/(y2-y);
        Fraccion = (LongControlB - LongControl) * Porc / 100;
    var yA =  LongControl + Fraccion;
        //alert ("Pinchó las siguientes coordenadas:\nx:" + Xa + "\ny: " + yA);
    document.getElementById("latitud").value = Xa;
    document.getElementById("longitud").value = yA;
    document.getElementById("globo").style.top = coorY - 50 + 5;
    document.getElementById("globo").style.left = coorX - 15; 
    document.getElementById("globo").style.visibility = "visible";          
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
 var X=28; 
var y=38; 
var x2=518; 
var y2=494;  // puntos de control IMG   
var LatControl=17.597089;   // Latitud de Control Punto A
var LongControl=-99.544610; // Longitud de Control Punto A
var LatControlB=17.522237;  // Latitud de control Punto B
var LongControlB=-99.460125;// Longitud de control Punto B 
     var   Porc = ((coorX-iniX-X)*100)/(x2-X);
     var   Fraccion = (LatControlB-LatControl) * Porc / 100;
     var   Xa = LatControl + Fraccion;
        Porc = (coorY-iniY-y)*100/(y2-y);
        Fraccion = (LongControlB-LongControl) * Porc / 100;
     var   yA =  LongControl + Fraccion;
        document.getElementById("ayuda").style.top = coorY + 10;
        document.getElementById("ayuda").style.left = coorX + 10;
        document.getElementById("ayuda").style.visibility = "visible";
        document.getElementById("ayuda").innerHTML = "x1 = " + Xa +"<br>y = " + yA;
}

</script>

</head>
<BODY onload="ini()">
    
    @include('partes.menu')

        <main>        
            @yield('content')
        </main>

    @include('partes.footer')    

</body>
</html>