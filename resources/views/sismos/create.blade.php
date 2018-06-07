@extends('layouts.admin')

@section('content')  
   @include('alerts.request')
   <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3  class="box-title">Crear sismos/Proceso Manual</h3>
      </div>
      <div class="box-body">
       	<form action="{{route('misismos.store')}}" method="post" class="form-horizontal">
           <div class="form-group">
           	   <label class="control-label col-sm-2">Fecha:</label>
               <div class="col-sm-10">
           	      <input type="text" name="fecha" class="form-control" placeholder="Escribe la fecha y hora, como nombre del sismo">
               </div>
           </div>
           <div class="form-group">
           	   <label class="control-label col-sm-2" for="email">Magnitud:</label>
               <div class="col-sm-10">
           	      <input type="text" name="magnitud" class="form-control" placeholder="introduce la magnitud del sismo">
               </div>
           </div>
           <div class="form-group">
               <label class="control-label col-sm-2" for="email">Latitud:</label>
               <div class="col-sm-10">
                  <input type="text" name="latitud" class="form-control" placeholder="Escribe la latitud">
               </div>
           </div>
           <div class="form-group">
               <label class="control-label col-sm-2" for="email">Longitud:</label>
               <div class="col-sm-10">
                  <input type="text" name="longitud" class="form-control" placeholder="Escribe la longitud">
               </div>
           </div> 
          
           {{ csrf_field() }} 

           <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
           </div>
       	</form>
      </div>
    </div>
   </section>
@endsection