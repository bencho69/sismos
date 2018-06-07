@extends('layouts.admin')

@section('content')
  <section class="content">
    @include('alerts.success')
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3   class="box-title">Lista de Sismos</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
             <th>fecha</th>
             <th>magnitud</th>
             <th>Latitud</th>
             <th>Longitud</th>
             <th>Acciones</th>
             </tr>
            </thead>

            @foreach($sismos as $sismo)
            <tbody>              
              <td>{{$sismo->fecha}}</td>
              <td>{{$sismo->magnitud}}</td>
              <td>{{$sismo->latitud}}</td>
              <td>{{$sismo->longitud}}</td>
              <!-- Boton Editar -->
              <td>
                <div style="display: inline-block; padding: 0px; border: hidden; margin: 0px; ">
                  <div style="border: hidden; display: inline-block; border: none; color: white; padding: 0px 0px; text-decoration: none; margin: 4px 2px; cursor: pointer;">

                   <a href="{{ route('misismos.edit',['id'=>$sismo->id]) }}" class="btn btn-success" >Editar</a>
                  </div>
                  <!-- Boton Borrar -->
                  <div style="padding-left: 5px; border: hidden; display: inline-block; ">
                    {!!Form::open(['route'=>['misismos.destroy',$sismo->id],'method'=>'DELETE'])!!}
                       {!!Form::submit('Borrar', ['class'=>'btn btn-danger','onclick'=>'return confirm("Esta seguro de borrar este sismo ?")'])!!}
                    {!!Form::close()!!} 
                  </div>
                 </div>
              </td>
            </tbody>              
            @endforeach

        </table>
        </div>
        <!-- /.box-body -->
          <div class="box-footer">
              <div class="list-inline" > {!! $sismos->render() !!}</div> 
              <div><a href="{{ route('misismos.create') }}" class="btn btn-primary">Crear</a></div>
          </div>
        <!-- /.box-footer-->
      </div>
  </section>


@endsection

@section('content-header')
  <section class="content-header">
      <h1>
        Sismos que administrar <br>
        <small>Utilice esta sección para modificar, crear los sismo, en forma manual.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Admin</a></li>
        <li class="active">Sismos</li>
      </ol>
    </section>
@endsection