@extends('layouts.piyes')

@section('title') <title>Piyes | Users</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Users @endslot
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
            		<a 	href="{{ route('piyes.user-management.users.create') }}" class="btn btn-sm btn-primary clearfix">
        				<i class="fa fa-plus-circle"></i> Invite New User
        			</a>
	            </div>
	            <div class="ibox-content">
	                <div class="table-responsive">
	            		<table class="table table-striped table-bordered table-hover dataTable" >
	            			<thead>
					            <tr>
					                <th>Name</th>
					                <th>Role</th>
					                <th>Status</th>
					                <th>Action</th>
					            </tr>
	            			</thead>
	            			<tbody>
	            				@foreach($users as $user)
					            <tr>
					                <td>{{ $user->name }}</td>
					                <td>{{ $user->role->name }}</td>
					             
					                <td>{{ ($user->user) ? (($user->user->settings->isLocked) ? 'Blocked' : 'Active') : 'Not Registered' }}</td>
					                <td class="center actionsColumn">
					                	@if($user->user)
					                		<a 	href="{{ route('piyes.user-management.users.edit', ['role' => $user->user->id]) }}" 
					                			class="btn btn-sm btn-info">
					                			<i class="fa fa-edit"></i>
				                			</a>
					                	@else
					                		<button disabled class="btn btn-sm btn-info">Pending</a>
					                	@endif
					                </td>
					            </tr>
					            @endforeach
	            			</tbody>
	            		</table>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
</div>

@endsection

@section('scripts')
	<script>
        $(document).ready(function(){
           initializeDatatable('.dataTable');
        });
    </script>
@endsection