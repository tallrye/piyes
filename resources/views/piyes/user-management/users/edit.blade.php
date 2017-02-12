@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing User</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Edit Existing User @endslot
	<li>
		<a href="{{ route('piyes.user-management.users.index') }}">Users</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
   	{!! Form::model($user, ['route' => ['piyes.user-management.users.update', $user->id], 'class' => 'form-horizontal']) !!}
   		{!! method_field('PUT') !!}
	    <div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.user-management.users.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
	    	@if($user->settings->isLocked)
	    	<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#reactivateModal"><i class="fa fa-unlock"></i> Activate</button>
	    	@else
	    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#banModal"><i class="fa fa-ban"></i> Block</button>
	    	@endif
	    </div>
	    <div class="col-lg-11">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Edit Existing User <small>You can also add this user a role.</small></h5>
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
	                        	{!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<label class="col-sm-3 control-label">E-mail</label>
	                        <div class="col-sm-9">
	                        	{!! Form::text('email', null, ['class' => 'form-control', 'readonly']) !!}
	                    	</div>
	                    </div>
	                    <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Roles</label>
                            <div class="col-sm-9">
                                {{ Form::select('role_list[]', $roles, $user->roleList, ['id' => 'role_list', 'class' => 'form-control', 'multiple', 'style' => 'display: none; width: 100%;', 'tabindex' => '-1']) }}
                            </div>  
                        </div>
            		</div>
	            </div>
	        </div>
	    </div>
    {!! Form::close() !!}
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('piyes.user-management.users.ban', ['user' => $user->id]) }}" method="POST" >
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure about blocking this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Block the User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('piyes.user-management.users.reactivate', ['user' => $user->id]) }}" method="POST" >
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure about re-activating this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Re-activate the User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script>
		 $("#role_list").select2();
	</script>
@endsection