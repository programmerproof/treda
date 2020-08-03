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
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif
 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>Tienda</strong>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Sku:</strong>
									<div class="form-group">
										{{$products[0]->sku}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Nombre:</strong>
									<div class="form-group">
										{{$products[0]->name}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Descripción:</strong>
									<div class="form-group">
										{{$products[0]->description}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Valor:</strong>
									<div class="form-group">
										{{number_format($products[0]->value, 0)}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Tienda:</strong>
									<div class="form-group">
										{{$products[0]->store->name}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<strong>Imagen:</strong>
									<div class="form-group">
										<img src="{{$products[0]->image}}" height="100">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
								    <a href="{{ route('product.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							</div>
					</div>
				</div>
 
			</div>
		</div>
	</section>
	@endsection