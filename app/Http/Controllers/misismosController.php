<?php

namespace Sismos\Http\Controllers;

use Illuminate\Http\Request;
use Sismos\Http\Requests;
use Sismos\Http\Controllers\Controller;

use Closure;
Use Session;
Use Sismos\sismo;
use Auth;
use Illuminate\Http\Route;

class misismosController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    
        $this->Indice =3;

        $active = 2;
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

        $sismos = sismo::paginate($this->Indice);
        Session::all();
        $active = 2;
        $subm = 1;
        $subm2=0;        
        return view('sismos.index',['sismos' => $sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sismos = sismo::paginate($this->Indice);
        Session::all();
        $active = 2;
        $subm = 1;
        $subm2=0;        
        return view('sismos.create',['sismos' => $sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sismo = new sismo;

        $sismo->fecha = $request["fecha"];
        $sismo->latitud = $request["latitud"];
        $sismo->longitud = $request["longitud"];
        $sismo->magnitud = $request["magnitud"];

        $sismo->Save();

        Session::flash('message','Sismo Guardado correctamente.');

        $active=2;
        $subm=1;
        $subm2=0;

        $sismos = sismo::paginate($this->Indice);

        return view('sismos.index',['sismos'=>$sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sismos = sismo::paginate($this->Indice);
        Session::all();
        $active = 2;
        $subm = 1;
        $subm2=0;        
        return view('sismos.index',['sismos' => $sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sismos = sismo::find($id);
        Session::all();
        $active = 2;
        $subm = 1;
        $subm2=0;
 
        return view('sismos.edit',['sismos'=>$sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]); 
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
        $sismo = sismo::findOrFail($id);
        
        $sismo->fecha = $request["fecha"];
        $sismo->latitud = $request["latitud"];
        $sismo->longitud = $request["longitud"];
        $sismo->magnitud = $request["magnitud"];

        $sismo->save();
        Session::flash('message','Sismo Actualizado correctamente.');

        $active=2;
        $subm=1;
        $subm2=0;

        $sismos = sismo::paginate($this->Indice);
        
        return view('sismos.index',['sismos'=>$sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        sismo::destroy($id);

        $active=2;
        $subm=1;
        $subm2=0;
        $sismos = sismo::paginate($this->Indice);

        Session::flash('message','Sismo eliminado correctamente');
        return view('sismos.index',['sismos'=>$sismos, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }
}
