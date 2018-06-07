<?php

namespace Sismos\Http\Controllers;

use Illuminate\Http\Request;

use Sismos\Http\Requests;
use Sismos\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

use Sismos\User;
use DB;
use Auth;

class reportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    
        $this->Indice =3;

        $active = 1;
        $subm  = 0;
        $subm2 =0;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

        $active = 1;
        $subm = 2;
        $subm2=0;
 
        return view('reportes.index', ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    public function ReporteA()
    {
        $user = User::find(Auth::user()->id);

        $active = 1;
        $subm = 2;
        $subm2=0; 
        $sismo = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->first();   
        $encuestas = DB::Select('select encuestas.intensidad, encuestas.latitud, encuestas. longitud from encuestas left join sismos on encuestas.sismo_id=sismos.id where sismos.id=:no', [$sismo->id]);
        return view('reportes.mapapuntos', ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'encuestas'=>$encuestas,'sismo'=>$sismo]);
    }

    public function reporteB()
    {
        $user = User::find(Auth::user()->id);

        $active = 1;
        $subm = 2;
        $subm2=0; 
        $sismo = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->first();

        $encuestas = DB::table('encuestas')
                   ->join('sismos','encuestas.sismo_id','=','sismos.id')     
                  ->select('encuestas.*','sismos.fecha')
                   ->where('encuestas.sismo_id', '=', $sismo->id)
                   ->get();  

        $datos = DB::Select('select encuestas.intensidad, dayofmonth(encuestas.created_at) + (hour(encuestas.created_at) /24) + (minute(encuestas.created_at) / 60 *.1 ) + second(encuestas.created_at) /60 *.01 as dia, dayofmonth(encuestas.created_at) as DiaI from encuestas left join sismos on encuestas.sismo_id=sismos.id where sismos.id=:no', [$sismo->id]);
//select encuestas.intensidad, dayofmonth(sidmos.fecha)+ (hour(sismos.fecha) /12) *0.6 as dia, sismos.fecha from encuestas
//left join sismos on encuestas.sismo_id=sismos.id
//where sismos.id=3        
        $Fini = date("d", strtotime($sismo->fecha));  
        $ultimoDia = DB::Select('Select max(dayofmonth(encuestas.created_at)) as dia_maximo from encuestas  where encuestas.sismo_id=:no', [$sismo->id]);
        $ud = $ultimoDia[0]->dia_maximo;

        $valint = DB::Select('select min(encuestas.intensidad) as int_minima, max(encuestas.intensidad) as int_maximo from encuestas  where encuestas.sismo_id=:no', [$sismo->id]);
        $InIni = $valint[0]->int_minima;
        $IntMax= $valint[0]->int_maximo;
        return view('reportes.index',  ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'datos'=>$datos,'sismo'=>$sismo,'fini'=>$Fini,"ffin"=>$ud,'intmin'=>$InIni,'intmax'=>$IntMax,'datosenc'=>$encuestas]);


        $pdf = PDF::loadview('reportes.index',  ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'encuestas'=>$encuestas,'sismo'=>$sismo]);
        return $pdf->stream('pruebaPDF.pdf');
        return $pdf->download('pruebaPDF.pdf');
    }

    
    public function reporteC()
    {
        return "Estoy en el reportes Estoy Bien, donde mostraré la lista de usuarios que contestaron que estaban bien.";
    }

    
    public function reporteD()
    {
        return "Estoy en el reportes D";
    }

    public function cual($id)
    {
        $user = User::find(Auth::user()->id);

        $active = 1;
        $subm = 2;
        $subm2=0; 
        $sismo = DB::table('sismos')
                ->where('id','=',$id)
                ->orderBy('fecha', 'desc')
                ->first();

        $encuestas = DB::table('encuestas')
                   ->join('sismos','encuestas.sismo_id','=','sismos.id')     
                  ->select('encuestas.*','sismos.fecha')
                   ->where('encuestas.sismo_id', '=', $id)
                   ->get();  

        $datos = DB::Select('select encuestas.intensidad, dayofmonth(encuestas.created_at) + (hour(encuestas.created_at) /24) + (minute(encuestas.created_at) / 60 *.1 ) + second(encuestas.created_at) /60 *.01 as dia, dayofmonth(encuestas.created_at) as DiaI from encuestas left join sismos on encuestas.sismo_id=sismos.id where sismos.id=:no', [$id]);
//select encuestas.intensidad, dayofmonth(sidmos.fecha)+ (hour(sismos.fecha) /12) *0.6 as dia, sismos.fecha from encuestas
//left join sismos on encuestas.sismo_id=sismos.id
//where sismos.id=3        
        $Fini = date("d", strtotime($sismo->fecha));  
        $ultimoDia = DB::Select('Select max(dayofmonth(encuestas.created_at)) as dia_maximo from encuestas  where encuestas.sismo_id=:no', [$id]);
        $ud = $ultimoDia[0]->dia_maximo;

        $valint = DB::Select('select min(encuestas.intensidad) as int_minima, max(encuestas.intensidad) as int_maximo from encuestas  where encuestas.sismo_id=:no', [$id]);
        $InIni = $valint[0]->int_minima;
        $IntMax= $valint[0]->int_maximo;
        return view('reportes.index',  ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'datos'=>$datos,'sismo'=>$sismo,'fini'=>$Fini,"ffin"=>$ud,'intmin'=>$InIni,'intmax'=>$IntMax,'datosenc'=>$encuestas]);

        $pdf = PDF::loadview('reportes.index',  ['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'datos'=>$datos,'sismo'=>$sismo,'fini'=>$Fini,"ffin"=>$ud,'intmin'=>$InIni,'intmax'=>$IntMax,'datosenc'=>$encuestas]);
        //return $pdf->stream('pruebaPDF.pdf');
        return $pdf->download('pruebaPDF.pdf');
    }

}
