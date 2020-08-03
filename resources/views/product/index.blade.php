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
          <div><h3>Lista Productos</h3></div>
          <div>

            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="pull-right">
                    <div class="btn-group">
                    <form action="{{ route('product.index')}}" method="get" accept-charset="utf-8">
                        <div class="btn-group">
                          <input name="search" id="search" type="text" class="form-control">
                        </div>
                        <div class="btn-group">
                          <button type="submit" class="btn btn-info">Buscar por Código de producto</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>

            <div class="btn-group">
              <a href="{{ route('product.create') }}" class="btn btn-info" >Añadir Producto</a>
            </div>
          </div>
          <div class="table-container">
            <table class="table table-condensed table-bordered table-hover">
             <thead>
               <th>Tienda</th>
               <th>Código</h>
               <th>Nombre</th>
               <th>Descripción</th>
               <th>Valor</th>
               <th>Imagen</th>
               <th class="text-center">Ver</th>
               <th class="text-center">Editar</th>
               <th class="text-center">Eliminar</th>
             </thead>
             <tbody>
                @if($products->count())  
                  @foreach($products as $product)
                    <tr>
                      <td>{{$product->store->name}}</td>
                      <td>{{$product->sku}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{number_format($product->value, 0)}}</td>
                      <td><img src="{{$product->image}}" height="50"></td>
                      <td class="text-center">  
                        <a class="btn btn-primary btn-xs" href="{{ route('product.show', $product->sku) }}"><span class="glyphicon glyphicon-eye-open"></span></a>
                      </td>
                    @if($product->user_id == $user)
                      <td class="text-center">
                        <a class="btn btn-primary btn-xs" href="{{action('ProductController@edit', $product->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td class="text-center">
                        <form action="{{action('ProductController@destroy', $product->id)}}" method="post">
                          {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                        </form> 
                      </td>
                    @else
                    <td class="text-center">No<br>autorizado</td>
                    <td class="text-center">No<br>autorizado</td>  
                    @endif
                    </tr>
                  @endforeach 
               @else
                <tr>
                  <td colspan="8">No hay registro !!</td>
                </tr>
              @endif
            </tbody>
 
          </table>
        </div>
      </div>
      {{ $products->links() }}
    </div>
  </div>
</section>
 
@endsection