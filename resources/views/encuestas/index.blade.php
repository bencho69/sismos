@extends('layouts.admin')

@section('content')
  <section class="content">
    @include('alerts.success')
      <div class="box" style="min-height: 75px">
          {!!Form::open(['route'=>['encuestas.sel_sismo', $prim_sis],'method'=>'GET'])!!}                    
                <div class="form-group">
                    <label class="control-label col-sm-2">Sismo a mostrar:</label> 
                    <div class="col-sm-10">
                    <select name="sismo" class="form-control" onchange="this.form.action+this.value; this.disable = true; this.form.submit();"> 
                      @foreach($sismos as $sismo)
                        @if ($sismo->id==$prim_sis)
                           <option value="{{$sismo->id}}" selected>{{$sismo->fecha}}</option> 
                        @else
                           <option value="{{$sismo->id}}">{{$sismo->fecha}}</option>
                        @endif
                      @endforeach
                    </select>
                     Tipo Encuesta :
                     @if ($tipo=='perfecta')
                       <input type="radio" name="tipo" value="perfecta" onchange="this.form.action+this.value; this.disable = true; this.form.submit();" checked> Perfecta 
                     @else
                       <input type="radio" name="tipo" value="perfecta" onchange="this.form.action+this.value; this.disable = true; this.form.submit();"> Perfecta   
                     @endif
                     @if ($tipo=="imperfecta")
                       <input type="radio" name="tipo" value="imperfecta" onchange="this.form.action+this.value; this.disable = true; this.form.submit();" checked> Todas
                    @else
                       <input type="radio" name="tipo" value="imperfecta" onchange="this.form.action+this.value; this.disable = true; this.form.submit();"> Todas 
                    @endif 
                    </div> 
                </div>
          {!!Form::close()!!} 
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3   class="box-title">Lista de Encuestas</h3>
        </div>        
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
             <th>id</th>
             <th>Sismo</th>
             <th>Latitud</th>
             <th>Longitud</th>
             <th>intensidad</th>  
             <th>confianza</th>             
             <th>Acciones</th>
             </tr>
            </thead>

            @foreach($encuestas as $encuesta)
            <tbody>              
              <td>{{$encuesta->id}}</td>
              <td>{{$encuesta->sismo_id}}</td>
              <td>{{$encuesta->latitud}}</td>
              <td>{{$encuesta->longitud}}</td>
              <td>{{$encuesta->intensidad}}</td>
              <td>{{$encuesta->confianza}}</td>
              <!-- Boton Editar -->
              <td>
                <div style="display: inline-block; padding: 0px; border: hidden; margin: 0px; ">
                  <div style="border: hidden; display: inline-block; border: none; color: white; padding: 0px 0px; text-decoration: none; margin: 4px 2px; cursor: pointer;">

                   <a href="{{ route('encuestas.edit',['id'=>$encuesta->id]) }}" class="btn btn-success" >Editar</a>
                  </div>
                  <!-- Boton Borrar -->
                  <div style="padding-left: 5px; border: hidden; display: inline-block; ">
                    {!!Form::open(['route'=>['encuestas.destroy',$encuesta->id],'method'=>'DELETE'])!!}
                       {!!Form::submit('Borrar', ['class'=>'btn btn-danger','onclick'=>'return confirm("Esta seguro de borrar esta encuesta ?")'])!!}
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
              <div class="list-inline" > {!! $encuestas->render() !!}</div> 
          </div>
          <div class="box-footer">
              <div class="list-inline" > Encuestas : ( {!! $encuestas->total() !!} )</div> 
              {!!Form::open(['route'=>['reportes.cual',$prim_sis],'method'=>'GET'])!!}
                       {!!Form::submit('Reportar', ['class'=>'btn btn-danger'])!!}
                    {!!Form::close()!!}
          </div>
          
        <!-- /.box-footer-->
      </div>
  </section>


@endsection

@section('content-header')
  <section class="content-header">
      <h1>
        Encuestas que administrar <br>
        <small>Utilice esta sección para ver y administrar las encuestas, que contestan los usuarios.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Admin</a></li>
        <li class="active">Encuestas</li>
      </ol>
    </section>
@endsection