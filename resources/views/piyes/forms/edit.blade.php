@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing Form</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Edit Existing Form @endslot
	<li>
		<a href="{{ route('piyes.forms.index') }}">Forms</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	   	{!! Form::model($form, ['route' => ['piyes.forms.update', $form->id], 'class' => 'form-horizontal']) !!}
	   		{!! method_field('PUT') !!}
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.forms.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
		    	@can('do_all')
		    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
		    	@endcan
		    </div>
		    <div class="col-lg-11">
		        <div class="ibox float-e-margins">
		            <div class="ibox-title">
		                <h5>Edit Existing Form <small>You can also add categories and recipients for this form.</small></h5>
		                <div class="ibox-tools">
		                    <a class="collapse-link">
		                        <i class="fa fa-chevron-up"></i>
		                    </a>
		                </div>
		            </div>
		            <div class="ibox-content clearfix">
	                    <div class="col-lg-6">
	            			<div class="form-group">
		                    	<label class="col-sm-3 control-label">Form Name</label>
		                        <div class="col-sm-9">
		                        	{!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
		                        	@if($errors->has('title'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('title') }}</strong>
				                        </span>
				                    @endif
		                    	</div>
		                    </div>
		                    <div class="form-group">
		                    	<label class="col-sm-3 control-label">Recipient (To)</label>
		                        <div class="col-sm-9">
		                        	{!! Form::text('to', null, ['class' => 'form-control', 'required']) !!}
		                        	@if($errors->has('to'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('to') }}</strong>
				                        </span>
				                    @endif
		                    	</div>
		                    </div>
		                    <div class="form-group">
		                    	<label class="col-sm-3 control-label">Recipient (Cc)</label>
		                        <div class="col-sm-9">
		                        	{!! Form::text('cc', null, ['class' => 'form-control']) !!}
		                        	@if($errors->has('cc'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('cc') }}</strong>
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
	<div class="row">
		<div class="col-lg-11 col-lg-offset-1">
			<div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Categories</h5>
	                <div class="ibox-tools">
	                    <a href="{{ route('piyes.forms.categories.create', ['form' => $form->id]) }}" class="btn btn-sm btn-primary clearfix">
	                    	<i class="fa fa-plus-circle"></i> New Category
                    	</a>
	                </div>
	            </div>
	            <div class="ibox-content clearfix">
	            	<div class="table-responsive">
	            		<table class="table table-striped table-bordered table-hover categoriesTable" >
	            			<thead>
					            <tr>
					                <th>Name</th>
					                <th>To</th>
					                <th>Cc</th>
					                <th>Action</th>
					            </tr>
	            			</thead>
	            			<tbody>
	            				@foreach($form->categories as $category)
					            <tr>
					                <td>{{ $category->title }}</td>
					                <td>{{ $category->to }}</td>
					                <td>{{ $category->cc }}</td>
					                <td class="center actionsColumn">
					                	<a 	href="{{ route('piyes.forms.categories.edit', ['category' => $category->id]) }}" 
					                		class="btn btn-sm btn-info">
					                		<i class="fa fa-edit"></i>
				                		</a>
					                	<button type="button" 
					                			class="btn btn-danger btn-sm" 
				                				data-toggle="modal" 
				                				data-target="#deleteModal{{ $category->id }}"><i class="fa fa-trash"></i>
		                				</button>
					                	@include('piyes.includes.delete-modal', [ 
					                		'modal_id' => 'deleteModal'.$category->id, 
					                		'route' => 'piyes.forms.categories.delete', 
					                		'id' => ['category' => $category->id]
			                			]) 
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
@can('do_all')
	<!-- Delete Modal -->
	@include('piyes.includes.delete-modal', [
		'modal_id' => 'deleteModal', 
		'route' => 'piyes.forms.delete', 
		'id' => ['form' => $form->id]
	])
	<!-- End Delete Modal -->
@endcan
@endsection

@section('scripts')
	<script>
        $(document).ready(function(){
        	initializeDatatable('.categoriesTable');
        });
    </script>
@endsection