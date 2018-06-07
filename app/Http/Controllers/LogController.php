<?php

namespace Sismos\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;

use Sismos\Http\Requests;
use Sismos\Http\Requests\LoginRequest;  
use Sismos\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login'); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(loginRequest  $request)
    {
        //return $request["name"];
        Session::All();
        $request->flash();
        if (Auth::attempt(['email'=> $request['email'],'password'=> $request['password']])){
            return Redirect::to('usuarios');
        }else{
            Session::flash('message-error','Datos son incorrectos');
            return Redirect::to('log');
        }
    }

    public function logout(){
        Auth::logout();
        //$reque st->sess ion()->ref lash();
        return Redirect::to('/');
    }

}
