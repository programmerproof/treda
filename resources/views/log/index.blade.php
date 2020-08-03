@extends('layouts.app')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          @if(session('success'))
            @if(session('action')=='create')
             <div class="alert alert-success alert-dismissible">
            @endif
            @if(session('action')=='edit'||session('action')=='destroy')
              <div class="alert alert-info alert-dismissible">
            @endif
                <button type="button" class="close" data-dismiss="alert" aria-hiddem="true"></button>
                <h4><i class="icon fa fa-check"></i> {{session('success')}} </h4>
            </div>
          @endif
          @if(session('errorAccess'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hiddem="true"></button>
              <h4><i class="icon fa fa-ban"></i> {{session('errorAccess')}} </h4>
            </div>
          @endif
          <div style="text-align:center;"><h2>Log de eventos (Peticiones que se han realizado en el servicio).</h2></div>
          <div class="table-container">
            <table class="table table-condensed table-bordered table-hover" id="log">
             <thead>
               <th>Fecha</th>
               <th>Mensaje</h>
               <th>Id solicitado</th>
               <th>IP</th>
               <th>Host</th>
               <th>Browser</th>
               <th>OS</th>
             </thead>
             <tbody>
             @foreach($content as $cont)  
              <tr>
                @foreach((array)json_decode($cont, true) as $key=>$value)
                    @switch($key)                  
                      @case('date') <td>{{$value}}</td> @break
                      @case('message') <td>{{$value}}</td> @break
                      @case('store_id') <td>{{$value}}</td> @break
                      @case('ip') <td>{{$value}}</td> @break
                      @case('host') <td>{{$value}}</td> @break
                      @case('browser_detect') <td>{{$value}}</td> @break
                      @case('os') <td>{{$value}}</td> @break
                    @endswitch
                @endforeach
              </tr>
             @endforeach
            </tbody>
 
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection