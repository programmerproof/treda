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
				<div class="alert alert-success alert-dismissible">
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
					<h3 class="panel-title">Nueva Sucursal</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form id="create_store" method="POST" action="{{ route('store.store') }}"  role="form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Nombre:
										<input type="text" name="name" id="name" class="form-control" placeholder=""
											   value="{{old('name')??''}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										* Fecha Apertura:
										<span style="position: relative;display: inline-block;border: 1px solid #a9a9a9;height: 24px;width: 500px">
										<input type="date" class="xDateContainer" onchange="setCorrect(this,'opening_date');" style="position: absolute; opacity: 0.0;height: 100%;width: 100%;">
										<input type="text" id="opening_date" name="opening_date" value="{{old('opening_date')??'dd-mm-yyyy'}}" style="border: none;height: 90%;" tabindex="-1">
										<span style="display: inline-block;width: 20px;z-index: 2;float: right;padding-top: 3px;" tabindex="-1">&#9660;</span>
										</span>
									</div>
								</div>
							</div>
 
							<div class="row">
 
								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit" value="Guardar" class="btn btn-success btn-block">
									<a href="{{ route('store.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
 
							</div>
						</form>
					</div>
				</div>
 
			</div>
		</div>
	</section>
@endsection