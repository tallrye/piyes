@extends('layouts.piyes')

@section('title') <title>Piyes | Create New Role</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Create New Role @endslot
	<li>
		<a href="{{ route('piyes.user-management.roles.index') }}">Roles</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	{!! Form::open(['route' => 'piyes.user-management.roles.store', 'class' => 'form-horizontal']) !!}
	    <div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.user-management.roles.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
	    </div>
	    <div class="col-lg-11">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Define New Role <small>Once you've created the role, you can give this role new permissions.</small></h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<div class="form-group">
		                    	<label class="col-sm-3 control-label">Name</label>
		                        <div class="col-sm-9">
		                        	{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
		                        	@if($errors->has('name'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('name') }}</strong>
				                        </span>
				                    @endif
		                    	</div>
		                    </div>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
    {!! Form::close() !!}
	</div>
</div>
@endsection