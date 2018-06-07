@extends('layouts.info')


@section('content') 
  


   <section id="info"></section>
   <section class="content">
      @include('alerts.request')
      @include('alerts.errors')
     <section id="blog">
      <div class="container">
        <div class="box-header with-border">
            <h3  class="box-title">Inicio de Sesión de Usuarios</h3>
        </div>
        <div class="box-body">
         	<form action="{{ route('log.store') }}" method="post" class="form-horizontal">
             <div class="form-group">
             	   <label class="control-label col-sm-2">Correo Electrónico</label>
                 <div class="col-sm-10">
                   <input type="text" name="email" class="form-control" placeholder="Escribe tu email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                 </div>
             </div> 	   
             <div class="form-group">
             	   <label class="control-label col-sm-2">Contraseña:</label>
                 <div class="col-sm-10">
                   <input type="password" name="password" class="form-control" placeholder="Escribe tus credenciales">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                 </div>
             </div> 
             {{ csrf_field() }}  
             <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">  
                  <button class="btn btn-primary">Iniciar</button>
                </div>
             </div>   
         	</form>
        </div>
      </div>
     </section>
    </section>
   <section id="info"></section> 
@endsection