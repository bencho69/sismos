@extends('layouts.admin')

@section('content')  
   @include('alerts.request')
   <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3  class="box-title">Modifica una encuesta</h3>
      </div>
      <div class="box-body">
         {!! Form::model($encuestas, ['route' => ['encuestas.update', $encuestas->id], 'method' => 'PUT', 'class'=>'form-horizontal']) !!}
           <div class="form-group">
           	   <label class="control-label col-sm-2">Confianza:</label>
               <div class="col-sm-10">
           	      <input type="text" name="confianza" class="form-control" placeholder="Escribe en nivel de confianza de la encuesta" value="{{$encuestas->confianza}}">
               </div>
           </div>
           <div class="form-group">
           	   <label class="control-label col-sm-2" for="email">Intensidad:</label>
               <div class="col-sm-10">
           	      <input type="text" name="intensidad" class="form-control" placeholder="introduce la intensidad del sismo" value="{{$encuestas->intensidad}}">
               </div>
           </div>
           <div class="form-group">
               <label class="control-label col-sm-2" for="email">Latitud:</label>
               <div class="col-sm-10">
                  <input type="text" name="latitud" class="form-control" placeholder="Escribe la latitud" value="{{$encuestas->latitud}}">
               </div>
           </div>
           <div class="form-group">
               <label class="control-label col-sm-2" for="email">Longitud:</label>
               <div class="col-sm-10">
                  <input type="text" name="longitud" class="form-control" placeholder="Escribe la longitud" value="{{$encuestas->longitud}}">
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