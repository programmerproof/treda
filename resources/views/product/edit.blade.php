@extends('layouts.app')

@section('content')
<div class="row">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info alert-dismissible">
				{{Session::get('success')}}
			</div>
			@endif
			@if(session('errorAccess'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hiddem="true"></button>
              <h4><i class="icon fa fa-ban"></i> {{session('errorAccess')}} </h4>
            </div>
          	@endif
 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Actualizar Tienda</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form id="edit_product" method="POST" action="{{ route('product.update', $products[0]->id) }}" enctype="multipart/form-data" role="form" files="true">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Código:
										<input type="text" name="sku" id="sku" class="form-control" placeholder=""
											   value="{{old('sku')??$products[0]->sku}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Nombre:
										<input type="text" name="name" id="name" class="form-control" placeholder=""
											   value="{{old('name')??$products[0]->name}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Descripción:
										<textarea name="description" id="description" rows="10" cols="50" value="">{{old('description')??$products[0]->description}}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Valor:
										<input type="number" name="value" id="value" class="form-control" placeholder=""
											   value="{{old('value')??$products[0]->value}}">
									</div>
								</div>
							</div>
 
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									* Tienda:
										<div class="form-group">
											<select name="store_id" id="store_id" class="form-control">
												<option value="">-- Seleccionar --</option>
														@foreach($stores as $store){{$store->id}}
														<option value="{{$store->id}}"
																@if(''.(old('store_id')??$products[0]->store_id).'' == $store->id )
																		selected="selected"
																@endif
																> {{ $store->name }} </option>
														@endforeach
											</select>
										</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										Imagen: <img src="{{$products[0]->image}}" height="50">
										<input type="file" name="image" id="image">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit" value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('product.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							</div>
						</form>
					</div>
				</div>
 
			</div>
		</div>
	</section>	
@endsection