@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing Permission</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Edit Existing Permission @endslot
	<li>
		<a href="{{ route('piyes.user-management.permissions.index') }}">Permissions</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
   	{!! Form::model($permission, ['route' => ['piyes.user-management.permissions.update', $permission->id], 'class' => 'form-horizontal']) !!}
   		{!! method_field('PUT') !!}
	    <div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.user-management.permissions.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
	    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
	    </div>
	    <div class="col-lg-11">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Edit Existing Permission <small>You can also add this permissions to a role.</small></h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="ibox-content clearfix">
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
    {!! Form::close() !!}
	</div>
</div>

<!-- Delete Modal -->
@include('piyes.includes.delete-modal', [
	'modal_id' => 'deleteModal', 
	'route' => 'piyes.user-management.permissions.delete', 
	'id' => ['permission' => $permission->id]
])
<!-- End Delete Modal -->

@endsection