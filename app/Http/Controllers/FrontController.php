<?php

namespace Sismos\Http\Controllers;


use Sismos\Http\Requests;
use Sismos\Http\Controllers\Controller;
use Sismos\Http\Requests\perfilUpdateRequest;
use Illuminate\contracts\Auth\Guard;
use Closure;
use Session;
use Sismos\User;
use Auth;
use Sismos\encuesta;
use DB;

use Illuminate\Http\Request;
use Illuminate\Http\Route;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['perfil','admin','edit','update']]);
    }

    public function index()
    {
        return view('welcome');
    }

    public function quienes_somos(){
        return view('quienes_somos');
    }

    public function perfil(request $id)
    {
        $user = User::find(Auth::user()->id);

        $active = 1;
        $subm = 2;
        $subm2=0;
 
        return view('auth.perfil',['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    public function admin(){
        return view('admin.index');
    }

    public function edit($id) {
        $user = User::find($id);
        Session::all();
        $active = 1;
        $subm = 2;
        $subm2=0;
 
        return view('auth.edit',['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);  
    }

    public function  update(PerfilUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $userOLD = User::findOrFail($id);
        $user->fill($request->all());
        //Cambiamos
        //$user->n ame  = $requ est['name'];
        //if ($request['email'] <> $User->email){
        //  $user->email = $request['email'];
        //}
        
        if ($request['cambiar']==1){
            $user->password = $request['password'];
            $user->password = \Hash::make($user->password);
        }
        else{
            $user->password = $userOLD->password;
        }

        $user->save();
        Session::flash('message','Usuario Actualizado correctamente.');

        $active=1;
        $subm=1;
        $subm2=0;

        return view('auth.perfil',['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }  


}
