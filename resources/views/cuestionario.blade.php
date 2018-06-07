@extends('layouts.info')

@section('content')  

    <section id="imagen">
        <div align="center">
                <h3>
                ... Mueve el raton por la imagen y da click en tu ubicación  ...
                </h3>
                                                                                                                              
                <img src="img/mapachilpo.png" onclick="coordenadas()" onmouseover="mostrar()" onmousemove="mover()" onmouseout="ocultar()" id="recuadro"
                >
                <img src="img/dark-dark-blue-pin.svg" style = "position:absolute; z-index:1;top:450px;left:660px;height: 50px; width: 50px; visibility:hidden;" alt = "" id="globo">
                <button onclick="miPosicion()" class="btn btn-success">Obtener su geolocalización</button>
                <p id="demo"></p>                                                                                          
        </div>
    </section>
<script>
    var xXx = document.getElementById("demo");

function miPosicion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(miPosition, showError);
    } else { 
        xXx.innerHTML = "Geolocalización no soportada por el navegador.";
    }
}

function miUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(fmiUbicacion, showError);
    } else { 
        xXx.innerHTML = "Geolocalización no soportada por el navegador.";
    }
}

function miPosition(position) {
    document.getElementById("latitud").value = position.coords.latitude;
    document.getElementById("longitud").value = position.coords.longitude;
}

function fmiUbicacion(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
    +latlon+"&zoom=14&size=400x300&key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU";
    document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            xXx.innerHTML = "El usuario denego la solicitud de Geolocalización.";
            break;
        case error.POSITION_UNAVAILABLE:
            xXx.innerHTML = "Información de Loclización no disponible.";
            break;
        case error.TIMEOUT:
            xXx.innerHTML = "Excedio el tiempo para obtener la localización.";
            break;
        case error.UNKNOWN_ERROR:
            xXx.innerHTML = "Error desconocido.";
            break;
    }
} 

</script>

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
            <h2>Conteste los datos que se solicitan correctamente:</h2>  
            <p class="importante">La información que proporcione será tratada con confidencialidad y será utilizada únicamente para estimar los daños producidos por el temblor, con fines cientificos unicamente.</p><br>
            <form ACTION="guardaENC" METHOD="post" name="registro" onsubmit="return validaForm()" class="formulario">
                <h3>Su ubicación durante el sismo</h3>
                <div class="form-group">
                    <p style="text-align: center;">De clic en la imagen para obtener su ubicación o en el botón 'Obtener su geolocalicación'</p>
                    <p id='mensaje'></p>
                    <label class="control-label col-sm-2">Latitud:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="latitud" placeholder="Da clic en la imagen." id='latitud' required> &nbsp; &nbsp; &nbsp;
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Longitud:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="longitud" placeholder="Da clic en la imagen." id='longitud' required>  &nbsp; &nbsp; &nbsp;
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="control-label col-sm-2">Elija el sismo que reporta:</label> 
                    <div class="col-sm-10">
                    <select name="sismo" class="form-control"> 
                      @foreach($sismos as $sismo)
                        <option value="{{$sismo->id}}">{{$sismo->fecha}}</option>
                      @endforeach
                    </select><br>  
                    </div> 
                </div>
            <h3>El estado en que estaba al ocurrir el sismo:</h3>
            <div class="campo">¿Sintió el sismo?</div>
            <p class="">
                <span class="espacio">
                <input name="p1" value="Sí" class="sb" type="radio" id="r1" required  "> Sí &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p1" value="No" class="sb" type="radio" id="r1"> No 
                </span>
            </p>
            <div class="campo">¿Estaba usted ?</div>
            <p class="" id="p2">
                <span class="espacio">
                <input name="p2" value="dormido" class="sb" type="radio" id="r2" required> Dormido. &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p2" value="despierto" class="sb" type="radio" id="r2"> Despierto. 
                </span>
            </p>
            <div class="campo">¿Estaba usted ?</div>
            <p class="">
                <span class="espacio">
                <input name="p3" value="reposo" class="sb" type="radio" id="r3" required> En reposo. &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p3" value="movimiento" class="sb" type="radio" id="r3"> En movimiento. 
                </span>
            </p>
            <div class="campo">¿Otras personas cercanas a usted, lo sintieron?</div>
            <p class="">
              <span class="espacio">
                <input name="p4" value="1" class="sb" type="radio" required> Nadie lo sintió. &nbsp; &nbsp;
                <input name="p4" value="2" class="sb" type="radio" required> No, solo yo lo sentí. &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p4" value="3" class="sb" type="radio"> Algunas lo sintieron, la mayoría no. &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p4" value="4" class="sb" type="radio"> La mayoría lo sintió. &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p4" value="5" class="sb" type="radio"> Todos lo sintieron. &nbsp; &nbsp; &nbsp; &nbsp;
              </span>
            </p>
                        
            <br>
          <h3>Su experiencia del sismo</h3>
            <div class="campo">¿Cuando ocurrió el sismo en que situación se encontraba?</div>
            <p class="">
              <span class="espacio">
                <input name="p5" value="1" class="sb" type="radio"> En un vehículo estacionado o en reposo. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p5" value="2" class="sb" type="radio"> En un vehículo en movimiento. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p5" value="3, ligero" class="sb" type="radio"> En el interior de una casa/edificio. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p5" value="4" class="sb" type="radio"> En el exterior.  
              </span>
            </p>

            <div class="campo">¿Despertó por el sismo?</div>
            <p class="">
              <span class="espacio">
                <input name="p6" value="1" class="sb" type="radio"> No, seguí durmiendo. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p6" value="2" class="sb" type="radio"> Desperté pero no me alarme. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p6" value="3, ligero" class="sb" type="radio"> Desperté y me levante, pero no salí. 
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input name="p6" value="4" class="sb" type="radio"> Desperté y me dirigí hacia la puerta. 
              </span>
            </p>
            <div class="campo">¿Cómo describiría el movimiento?</div>
            <p class="">
              <span class="espacio">
                <input name="p7" value="1" class="sb" type="radio"> No se sintió. 
                &nbsp; &nbsp;
                <input name="p7" value="2" class="sb" type="radio"> Muy débil. 
                &nbsp; &nbsp;
                <input name="p7" value="3" class="sb" type="radio"> Leve. 
                &nbsp; &nbsp;
                <input name="p7" value="4" class="sb" type="radio"> Moderado. 
                &nbsp; &nbsp;
                <input name="p7" value="5" class="sb" type="radio"> Fuerte. 
                &nbsp; &nbsp;
                <input name="p7" value="6" class="sb" type="radio"> Violento. 
              </span>
            </p>

            <div class="campo">¿Cual fue su reacción?</div>
            <p class="">
              <span class="espacio">
                <input name="p8" value="1" class="sb" type="radio"> No reaccioné, no lo sentí. 
                &nbsp; &nbsp;
                <input name="p8" value="2" class="sb" type="radio"> Reacción muy leve. 
                &nbsp; &nbsp;
                <input name="p8" value="3" class="sb" type="radio"> Emoción, excitación. 
                &nbsp; &nbsp;
                <input name="p8" value="4" class="sb" type="radio"> De alguna forma asustado. 
                &nbsp; &nbsp;
                <input name="p8" value="5" class="sb" type="radio"> Muy asustado. 
                &nbsp; &nbsp;
                <input name="p8" value="6" class="sb" type="radio"> Extremadamente asustado. 
              </span>
            </p>

            <div class="campo">¿Que ocurrió en su entorno?</div>
            <p class="">
            <table class="table" style="width:97%">
            <tbody><tr>
            <td width="40%">
              <span class="espacio">
                <input name="p9" value="1" class="sb" type="radio"> Los objetos colgados oscilaban levemente. 
              </span>
              <span class="espacio">
                <input name="p9" value="2" class="sb" type="radio"> Los objetos colgados oscilaban visiblemente. 
              </span>
              <span class="espacio">
                <input name="p9" value="3" class="sb" type="radio"> Los líquidos se movían y se podían derramar. 
              </span>
              <span class="espacio">   
                <input name="p9" value="4" class="sb" type="radio"> Los muebles se movían y algunos de cayeron. 
              </span>
            </td>
            <td width="40%">
              <span class="espacio">
                <input name="p9" value="5" class="sb" type="radio"> La paredes de agrietaron, las tejas se cayeron.
              </span>
              <span class="espacio">
                <input name="p9" value="6" class="sb" type="radio"> Hubo grietas en el terreno.
              </span>
              <span class="espacio">
                <input name="p9" value="7" class="sb" type="radio"> Algunas casas de material se cayeron. 
              </span>
              <span class="espacio"> 
                <input name="p9" value="8" class="sb" type="radio"> La mayoría de las construcciones fueron dañadas.
              </span>
              </td>
            </tr>
            </tbody>
            </table>
            </p>
            <div class="campo">¿Tuvo alguna dificultad para mantenerse en pie o caminar?</div>
            <p class="">
              <span class="espacio">
                <input name="p10" value="1" class="sb" type="radio"> No, caminaba perfectamente. 
                &nbsp; &nbsp;
                <input name="p10" value="2" class="sb" type="radio"> Caminaba pero no estable, tenia que sostenerme. 
                &nbsp; &nbsp;
                <input name="p10" value="3" class="sb" type="radio"> Tuve dificultad para sostenerme en pie. 
                &nbsp; &nbsp;
                <input name="p10" value="4" class="sb" type="radio"> No pude caminar tuve que agacharme o sentarme. 
              </span>
            </p>

            <div class="campo">¿Sí usted estaba en un vehículo?</div>
            <p class="">
              <span class="espacio">
                <input name="p11" value="1" class="sb" type="radio"> No sentí el sismo. 
                &nbsp; &nbsp;
                <input name="p11" value="2" class="sb" type="radio"> Ví que los vehículos estacionados se bamboleaban. 
                &nbsp; &nbsp;
                <input name="p11" value="3" class="sb" type="radio"> Percibí el sismo con el vehículo en marcha. 
                &nbsp; &nbsp;
                <input name="p11" value="4" class="sb" type="radio"> Se dificultaba conducir el vehículo. 
              </span>
            </p>

            <div class="campo">¿De los objetos a su alrededor, algunos sufrieron alguna de estas acciones?</div>
            <p class="">
            <table class="table" style="width:97%">
            <tbody><tr>
            <td width="40%">
              <span class="espacio">
                <input name="p12" value="1" class="sb" type="radio"> No, se movieron.
              </span>
              <span class="espacio">  
                <input name="p12" value="2" class="sb" type="radio"> Ruido de puertas, ventanas, vidrios o porcelanas.
              </span>
              <span class="espacio">
                <input name="p12" value="3" class="sb" type="radio"> Golpeteo de porcelana, frascos o vasos.
              </span>
              <span class="espacio">
                <input name="p12" value="4" class="sb" type="radio"> Vaivén de puertas o ventanas.
              </span>
            </td>
            <td width="40%">
              <span class="espacio">
                <input name="p12" value="5" class="sb" type="radio"> Oscilación o derrame de líquidos. 
              </span>
              <span class="espacio">
                <input name="p12" value="6" class="sb" type="radio"> Caída o desplazamiento de objetos pequeños.
              </span>
              <span class="espacio">
                <input name="p12" value="7" class="sb" type="radio"> Desplazamiento o volcamiento de objetos pesados o muebles.
              </span>
              <span class="espacio">
                <input name="p12" value="8" class="sb" type="radio"> Caída de objetos pesados como televisores, computadores, refrigeradores, etc.
              </span>
            </td>
            </tr>
            </tbody>
            </table> 
            </p>

            <div class="campo">¿Las edificaciones sufrieron alguno o más de los siguientes daños?</div>
            <p class="">
              <table class="table" style="width:97%">
            <tbody><tr>
            <td width="40%">
              <span class="espacio">
                <input name="p13" value="1" xclass="sb" type="radio"> Algunas grietas pequeñas en paredes. 
              </span>
              <span class="espacio">
                <input name="p13" value="2" class="sb" type="radio"> Pocas grietas en paredes de calidad intermedia. 
              </span>
              <span class="espacio">
                <input name="p13" value="3" class="sb" type="radio"> Muchas grietas grandes en paredes.
              </span>
              <span class="espacio">
                <input name="p13" value="4" class="sb" type="radio"> Caida de algún revoqué. 
              </span>
              </td><td width="40%">
              <span class="espacio">
                <input name="p13" value="5" class="sb" type="radio"> Caida de revoque y de algunas paredes de mampostería.
              </span>
              <span class="espacio">
                <input name="p13" value="6" class="sb" type="radio"> La mayoría de las construcciones de mampostería y algunas a base de marcos destruidas
              </span>
              </td>
            </tr>
          </tbody></table> 
            </p>
            <div class="campo">¿Observó alguna de estas situaciones?</div>
            <p class="">
              <table class="table" style="width:97%">
            <tbody><tr>
            <td width="40%">
              <span class="espacio">
                <input name="p14" value="1" xclass="sb" type="radio"> Grietas en terreno húmedo y en taludes inclinados.
              </span> 
              <span class="espacio">
                <input name="p14" value="3" class="sb" type="radio"> Ruptura de tuberías enterradas. 
              </span>  
              <span class="espacio">
                <input name="p14" value="4" class="sb" type="radio"> Grietas significativas en el terreno. 
              </span>  
              </td><td width="40%">
              <span class="espacio">
                <input name="p14" value="5" class="sb" type="radio"> Grandes desplazamiento de tierra. 
              </span>
              </td>
            </tr>
          </tbody></table><br>
            </p>

            <br>
                <button type="submit" class="btn btn-default">Enviar</button>
                <button type="reset" class="btn btn-default">Reset</button>
                {{ csrf_field() }}
                <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" name="sismo_fecha" value="{{ $sismo->fecha }}">
            </form>
        </div>
    </section>
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