<?php

namespace Sismos\Http\Controllers;

use Illuminate\Http\Request;

use Sismos\Http\Requests;
use Sismos\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

use Closure;
use Session;
use DB;
use Sismos\encuesta;
use Auth;
use Illuminate\Http\Route;

class encuestaController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    
        $this->Indice =5;

        $active = 3;
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
        $encuestas = encuesta::paginate($this->Indice);
        Session::all(); 

        $sismo = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->first();

        $sismos = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->get();
        $tipo = "imperfecta";
        return view('encuestas.index', ['encuestas' => $encuestas, 'active'=>3, 'subm'=>1, 'subm2'=>0, 'sismos'=>$sismos, 'prim_sis'=>$sismo->id, 'tipo' => $tipo]); 
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
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        Session::all();
        $sismo = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->first();

        $encuestas = DB::table('encuestas')
                   ->where('sismo_id', '=', $sismo->id)
                   ->paginate($this->Indice);        

        $sismos = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->get();

        return view('encuestas.index',['encuestas' => $encuestas, 'active'=>3, 'subm'=>1, 'subm2'=>0, 'sismos'=>$sismos, 'prim_sis'=>$sismo->id, 'tipo'=>'imperfecta']); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $encuestas = encuesta::find($id);
        Session::all();
      
        return view('encuestas.edit',['encuestas' => $encuestas, 'active'=>3,'subm'=>1,'subm2'=>0]);
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
        $encuesta = encuesta::findOrFail($id);
        
        $encuesta->confianza = $request["confianza"];
        $encuesta->latitud = $request["latitud"];
        $encuesta->longitud = $request["longitud"];
        $encuesta->intensidad = $request["intensidad"];
        $tipo = $request["tipo"];

        $encuesta->save();
        Session::flash('message', 'Encuesta actualizada correctamente.');

        $prim = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->first();

        $encuestas = encuesta::paginate($this->Indice);
        $sismos = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->get();

        return view('encuestas.index', ['encuestas'=>$encuestas, 'active'=>3, 'subm'=>1,'subm2'=>0, 'sismos'=>$sismos, 'prim_sis'=>$prim->id, 'tipo'=>$tipo]); 
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

    public function sel_sismo(request $request){
        // Selecciona el numero de sismo a mostrar...
        $sismo = $request["sismo"];

        $tipo = $request["tipo"];

        if ($tipo=="perfecta"){
            $encuestas = DB::table('encuestas')
                   ->where('sismo_id', '=', $sismo)
                   ->where('confianza', '=', 1.0)
                   ->paginate($this->Indice);        
        }
        else {
            $encuestas = DB::table('encuestas')
                   ->where('sismo_id', '=', $sismo)
                   ->paginate($this->Indice);        
        }
        $sismos = DB::table('sismos')
                ->orderBy('fecha', 'desc')
                ->get();
       $encuestas->appends(['sismo'=>$sismo, 'tipo'=>$tipo]);
        return view('encuestas.index',['encuestas' => $encuestas, 'active'=>3, 'subm'=>1, 'subm2'=>0, 'sismos'=>$sismos, 'prim_sis'=>$sismo, 'tipo'=>$tipo]); 
    }
}
