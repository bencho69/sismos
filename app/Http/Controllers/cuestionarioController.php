<?php

namespace Sismos\Http\Controllers;

use Illuminate\Http\Request;

use Sismos\Http\Requests;
use Sismos\Http\Controllers\Controller;

use Sismos\sismo;
use Sismos\encuesta;
use DB;

class cuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cuestionario()
    {
         $sismos = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->get();
         return view('cuestionario',['sismos'=>$sismos]);
    }

    public function encuesta(request $request)
    {
        $valor=0;  $dormido=0; 
        // Obtenemos valores de la encuesta.
        $p1=$request["p1"];       $p2=$request["p2"];
        $p3=$request["p3"];       $p4=$request["p4"];
        $p5=$request["p5"];       $p6=$request["p6"];
        $p7=$request["p7"];       $p8=$request["p8"];
        $p9=$request["p9"];       $p10=$request["p10"];
        $p11=$request["p11"];     $p12=$request["p12"];
        $p13=$request["p13"];     $p14=$request["p14"];
        // Evaluamos las respuestas
        $men= "Respuesta p1 " . $p1 . "    P2 " . $p2 . "<br>P3 " . $p3 . "    P4 " . $p4 . "<br>p5 =" . $p5 . "    P6 " . $p6 . "<br>P7 " . $p7 . "    P8 " . $p8 . "<br>p9 " . $p9 . "    P10 " . $p10 . "<br>P11 " . $p11 . "    P12 " . $p12 . "<br> p13 " . $p13 . "    P14 " . $p14;
        // Revisamos el nivel.
        // P1=¿Sintió un Sismo? R= No, Si
        // 1 - El sismo solo es detectado por instrumentos sismicos.
        $p1=="No" ? $valor=1 : $valor=2;
        // p2=¿Estaba usted ? R=dormido o despierto
        // 2 - El movimiento es sentido por personas en reposo
        // 5 - Personas dormidas se despiertan.
        if ($p1=="Sí") {
            $p2=="dormido" ? $valor=5 : $valor=2;
        }
        else{
           $valor=1;  // No fue sentido y estaba ?
           $p2=="dormido" ? $valor=1 : $valor=1; 
        }
        // p3=¿Estaba en Reposo? R=reposo, movimiento
        // 2 - El movimiento es sentido por personas en reposo
        if ($p1="Sí"){
            $p3=="reposo" ? $valor=2 : $valor=3;
        }
        //El valor de la pregunta 4 es el valor de su posición.
        
        // 3 No fue sentido pero iba en un vehículo
        if ($p1=="No" and $p5=2) $valor=3;
        // 5= Personas dormidas se despiertan.
        switch ($p5) {
            case 1:
                // Una persona en movimiento no siente el sismo, menores de intensidad III 
                // 4.Los vehiculos estacionados se bambolean  
                // Si estaba despierto puede detectarlo, si estaba dormido
                if ($p2='despierto'){ $valor = 3;}else{$valor=5;}
                break;
            case 2:
                $valor=2;
                break;
            case 3:
                $valor=1;
                break;
            case 4:
                $valor=1;
                break;
        }
        $minimo=0;
        $maximo=0;
        if ($p4!="")  $valor=$p4;     // El valor de la respuesta es el valor de la intensidad.
        // Inicializamos el nivel de confianza
        $confianza=1;
        //Si P2 = Dormido y P3=En movimiento, Grado confianza 50%
        if ($p2=="dormido" ){
           if ($p3=="movimiento") {
             $confianza = 0.5;
             $dormido=1;
           }
           if ($p4>3){
             if ($confianza<>0){
               $confianza = 0.4;
             }  
             else{
               $confianza = 0.6;
             }  
           }
           if ($p6<>0){
               // El valor empieza en 4 hasta 7
               $valor=3+$p4;
           }
           // Si hay un valor en las otras preguntas baja el nivel de confianza.
           if (isset($p5)) $confianza = $confianza - 0.071;
           if (isset($p7) and $p7>1) $confianza = $confianza - 0.071;
           if (isset($p8) and $p8>2) $confianza = $confianza - 0.071; 
           if (isset($p9)) $confianza = $confianza - 0.071;
           if (isset($p10)) $confianza = $confianza - 0.071;
           if (isset($p11)) $confianza = $confianza - 0.071; 
           if (isset($p12)) $confianza = $confianza - 0.071; 
           if (isset($p13)) $confianza = $confianza - 0.071; 
           if (isset($p14)) $confianza = $confianza - 0.071;  
        }else {
           // Opciones para estaba despierto
           if (isset($p6) ) $confianza = $confianza - 0.071; 
           if (isset($p5)){
              // Opciones estaba en un Vehiculo.
              if ($p5>0 and $p5<3){
                // Estaba en un vehiculo.
                if (isset($p9)) $confianza = $confianza - 0.071; 
                if (isset($p10)) $confianza = $confianza - 0.071; 
                if (isset($p12)) $confianza = $confianza - 0.071; 
                if (isset($p9)) $confianza = $confianza - 0.071; 
              }else{
                if ($p5==3){
                   if (isset($p11)) $confianza = $confianza - 0.071;
                   if (isset($p14)) $confianza = $confianza - 0.071;  
                }else {
                    if ($p4==4){
                        if (isset($p11)) $confianza = $confianza - 0.071;
                    }
                } 
              }
           }   
        } 
        if (isset($p5)){
            // El valor empieza en 4 hasta 7
            $valor=1+$p4;
        }
       if ($p6<>0){
           // El valor empieza en 4 hasta 7
           $valor=3+$p4;
       }
       if ($p7<>0){
        // Como describirias el movimiento
        switch ($p7) {
            case 1:
                // Una persona en movimiento no siente el sismo, menores de intensidad III 
                // 4.Los vehiculos estacionados se bambolean  
                // Si estaba despierto puede detectarlo, si estaba dormido
                $valor = 2;
                break;
            case 2:
                $valor=3;
                break;
            case 3:
                $valor=5;
                break;
            case 4:
                $valor=6;
                break;
            case 5:
                $valor=8;
                break;
            case 6:
                $valor=10;
                break;
        }
       }
       if ($p8<>0){
        // Como describirias el movimiento
        switch ($p8) {
            case 1:
                // Una persona en movimiento no siente el sismo, menores de intensidad III 
                // 4.Los vehiculos estacionados se bambolean  
                // Si estaba despierto puede detectarlo, si estaba dormido
                $valor = 2;
                break;
            case 2:
                $valor=4;
                break;
            case 3:
                $valor=5;
                break;
            case 4:
                $valor=7;
                break;
            case 5:
                $valor=9;
                break;
            case 6:
                $valor=10;
                break;
        }
       }
       if ($p9<>0){
        switch ($p9) {
            case 1:
                $valor = 2;
                break;
            case 2:
                $valor=4;
                break;
            case 3:
                $valor=5;
                break;
            case 4:
                $valor=7;
                break;
            case 5:
                $valor=9;
                break;
            case 6:
                $valor=10;
                break;
            case 7:
                $valor=10;
                break;
            case 8:
                $valor=10;
                break;
        }
       }
       if ($p10<>0){
        switch ($p10) {
            case 1:
                $valor = 4;
                break;
            case 2:
                $valor=6;
                break;
            case 3:
                $valor=8;
                break;
            case 4:
                $valor=9;
                break;
        }
       }
       if ($p11<>0){
        switch ($p11) {
            case 1:
                $valor = 3;
                break;
            case 2:
                $valor=6;
                break;
            case 3:
                $valor=7;
                break;
            case 4:
                $valor=8;
                break;
        }
       }
       if ($p12<>0){
        switch ($p12) {
            case 1:
                $valor = 3;
                break;
            case 2:
                $valor=4;
                break;
            case 3:
                $valor=4;
                break;
            case 4:
                $valor=5;
                break;
            case 5:
                $valor=5;
                break;
            case 6:
                $valor=5;
                break;
            case 7:
                $valor=6;
                break;
            case 8:
                $valor=7;
                break;
        }
       }
       if ($p13<>0){
        switch ($p13) {
            case 1:
                $valor = 6;
                break;
            case 2:
                $valor=7;
                break;
            case 3:
                $valor=8;
                break;
            case 4:
                $valor=8;
                break;
            case 5:
                $valor=9;
                break;
            case 6:
                $valor=10;
                break;
            case 7:
                $valor=10;
                break;
        }
       }
       if ($p14<>0){
        switch ($p14) {
            case 1:
                $valor = 8;
                break;
            case 2:
                $valor=9;
                break;
            case 3:
                $valor=9;
                break;
            case 4:
                $valor=10;
                break;
        }
       }

        // Almacenamos los datos enviados por la encuesta
        $intensidad = $valor;
        $sismo=$request["sismo"];
        $query = DB::table('sismos')
                ->select('fecha')
                ->where('id','=',$request["sismo"])
                ->get();
        $sismo_fecha= $query[0]->fecha;
        $latitud=$request["latitud"]; 
        $longitud=$request["longitud"];
        // Creamos una encuesta y la guardamos
        $encuesta = new encuesta;
        $encuesta->latitud = $latitud;
        $encuesta->longitud = $longitud;
        $encuesta->intensidad = $intensidad;
        $encuesta->sismo_id = $sismo;
        $encuesta->confianza = $confianza;
        $encuesta->save();
        
        $encuestas = DB::Select('select encuestas.intensidad, encuestas.latitud, encuestas. longitud from encuestas left join sismos on encuestas.sismo_id=sismos.id where sismos.id=:no', [$sismo]);
        return view("resultado",['sismo'=>$sismo,'sismo_fecha'=>$sismo_fecha,'latitud'=>$latitud,'longitud'=>$longitud,'intensidad'=>$intensidad,'encuestas'=>$encuestas]);

    }
}
