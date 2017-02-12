@extends('layouts.piyes')

@section('title') <title>Piyes | Create New User</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Create New User @endslot
	<li>
		<a href="{{ route('piyes.user-management.users.index') }}">Users</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	{!! Form::open(['route' => 'piyes.user-management.users.store', 'class' => 'form-horizontal']) !!}
	    <div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.user-management.users.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-envelope"></i> Invite</button>
	    </div>
	    <div class="col-lg-11">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Invite New User <small>When you invite a user, invitation mail will be sent automatically.</small></h5>
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
		                    <div class="form-group">
		                    	<label class="col-sm-3 control-label">E-mail</label>
		                        <div class="col-sm-9">
		                        	{!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
			                    	@if($errors->has('email'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('email') }}</strong>
				                        </span>
				                    @endif
		                    	</div>
		                    </div>
		                    <div class="form-group">
	                            <label for="title" class="col-sm-3 control-label">Role</label>
	                            <div class="col-sm-9">
	                                <select class="select2 form-control" required name="role_id" tabindex="-1" style="display: none; width: 100%">
	                                    <option></option>
	                                    <optgroup label="Roles">
	                                        @foreach($roles as $role)
	                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
	                                        @endforeach
	                                    </optgroup>
	                                </select>
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

@section('scripts')
	<script>
		$(".select2").select2({placeholder: 'Select a Role'});
	</script>
@endsection