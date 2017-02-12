@extends('layouts.piyes')

@section('title') <title>Piyes | Forms</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Forms @endslot
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	            	@can('do_all')
            		<a href="{{ route('piyes.forms.create') }}" class="btn btn-sm btn-primary clearfix">
            			<i class="fa fa-plus-circle"></i> Add New Form
        			</a>
        			@endcan
	            </div>
	            <div class="ibox-content">
	                <div class="table-responsive">
	            		<table class="table table-striped table-bordered table-hover dataTable" >
	            			<thead>
					            <tr>
					                <th>Form ID</th>
					                <th>Name</th>
					                <th>To</th>
					                <th>Cc</th>
					                <th>Action</th>
					            </tr>
	            			</thead>
	            			<tbody>
	            				@foreach($forms as $form)
					            <tr>
					                <td>{{ $form->id }}</td>
					                <td>{{ $form->title }}</td>
					                <td>{{ $form->to }}</td>
					                <td>{{ $form->cc }}</td>
					                <td class="center actionsColumn">
					                	<a 	href="{{ route('piyes.forms.edit', ['form' => $form->id]) }}" 
					                		class="btn btn-sm btn-info">
					                		<i class="fa fa-edit"></i>
				                		</a>
				                		@can('do_all')
					                	<button type="button" 
					                			class="btn btn-danger btn-sm" 
				                				data-toggle="modal" 
				                				data-target="#deleteModal{{ $form->id }}"><i class="fa fa-trash"></i>
		                				</button>
					                	@include('piyes.includes.delete-modal', [ 
					                		'modal_id' => 'deleteModal'.$form->id, 
					                		'route' => 'piyes.forms.delete', 
					                		'id' => ['form' => $form->id]
			                			])
			                			@endcan
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