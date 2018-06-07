<?php

namespace Sismos\Http\Controllers;

use Sismos\Http\Requests;
use Sismos\Http\Requests\UserCreateRequest;
use Sismos\Http\Requests\UserUpdateRequest;
use Sismos\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\contracts\Auth\Guard;
use Closure;
Use Session;
Use Sismos\User;
Use DB;
use Auth;

use Illuminate\Http\Route;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only'=>['create','show','edit','update','destroy']]);
    
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
        $users = User::paginate($this->Indice);
        Session::all();
        $active = 1;
        $subm = 1;
        $subm2=0;
        $query = DB::Select('Select count(*) As NoSismos from sismos');
        foreach ($query as $Valor) {
            $NoSismos = $Valor->NoSismos; 
        }
        $query = DB::select('select count(*) As NoAdmin from users Where tipo="ADMIN"');
        foreach ($query as $Valor) {
            $NoAdmin = $Valor->NoAdmin; 
        }
        $query = DB::select('select count(*) As NoUsr from users Where tipo="USR"');
        foreach ($query as $Valor) {
            $NoUsr = $Valor->NoUsr; 
        }
        $query = DB::select('select count(*) As NoEnc from encuestas');
        foreach ($query as $Valor) {
            $NoEnc = $Valor->NoEnc; 
        }
        $query = DB::select('select count(*) As NoEncP from encuestas Where confianza=1');
        foreach ($query as $Valor) {
            $NoEncP = $Valor->NoEncP; 
        }
        $query = DB::select('select count(*) As NoEncI from encuestas Where confianza<>1');
        foreach ($query as $X_Valor => $Valor) {
            $NoEncI = $Valor->NoEncI; 
        }    

        //$Datos = ['NoSismos' => $NoSismos->NoSismos, 'NoAdmin' => $NoAdmin->NoAdmin];
        //return $Otro;
        return view('usuarios.index',['users' => $users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2, 'NoSismos'=>$NoSismos,'NoAdmin'=>$NoAdmin, 'NoUsr'=>$NoUsr,'NoEnc'=>$NoEnc, 'NoEncP'=>$NoEncP, 'NoEncI'=>$NoEncI]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::paginate($this->Indice);
        Session::all();
        $active = 1;
        $subm = 1;
        $subm2=0;        
        return view('usuarios.create',['users' => $users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $usr = new User;

        $usr->name  = $request['name'];
        $usr->email = $request['email'];
        $usr->tipo  = $request['tipo'];
        $usr->password = bcrypt($request['password']);

        $usr->Save();

        Session::flash('message','Usuario Guardado correctamente.');

        $active=1;
        $subm=1;
        $subm2=0;

        $users = User::paginate($this->Indice);

        return view('usuarios.lista',['users'=>$users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = user::paginate($this->Indice);
        Session::all();
        $active = 1;
        $subm = 2;
        $subm2=0;
 
        return view('usuarios.lista',['users'=>$users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        Session::all();
        $active = 1;
        $subm = 2;
        $subm2=0;
 
        return view('usuarios.edit',['user'=>$user, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $userOLD = User::findOrFail($id);
        //$user->f ill($req uest->all());
        //Cambiamos
        $user->name  = $request['name'];
        if ($user->email <>$userOLD->email){
            $user->email = $request['email'];
        }
        
        $user->tipo = $request['tipo'];
        
        if (!empty($request['password'])){
            $user->password = $request['password'];
            $user->password = \Hash::make($user->password);
        }
        if (Auth::user()->tipo == "ADMIN"){
            $user->tipo = $request['tipo'];
        }else{
           $user->tipo = $userOLD->tipo;
        }

        $user->save();
        Session::flash('message','Usuario Actualizado correctamente.');

        $active=1;
        $subm=1;
        $subm2=0;

        $users = User::paginate($this->Indice);
        if (Auth::user()->tipo == "ADMIN"){
            return view('usuarios.lista',['users'=>$users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
        }else{
           return redirect()->to('/perfil');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        User::destroy($id);

        $active=1;
        $subm=2;
        $subm2=0;
        $users = user::paginate($this->Indice);

        Session::flash('message','Usuario eliminado correctamente');
        return view('usuarios.lista',['users'=>$users, 'active'=>$active,'subm'=>$subm,'subm2'=>$subm2]);
    }



}
