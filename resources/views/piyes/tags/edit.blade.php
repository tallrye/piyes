@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing {{ $pageItem }}</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Edit Existing {{ $pageItem }} @endslot
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.index') }}">{{ $pageName }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	   	{!! Form::model($record, ['route' => ['piyes.'.$pageUrl.'.update', $record->id], 'class' => 'form-horizontal']) !!}
	   		{!! method_field('PUT') !!}
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.'.$pageUrl.'.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
		    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
		    </div>
		    <div class="col-lg-11">
		        <div class="ibox float-e-margins">
		            <div class="ibox-title">
		                <h5>Edit Existing {{ $pageItem }} <small>Make your changes</small></h5>
		                <div class="ibox-tools">
		                    <a class="collapse-link">
		                        <i class="fa fa-chevron-up"></i>
		                    </a>
		                </div>
		            </div>
		            <div class="ibox-content clearfix">
	                    <div class="col-lg-7">
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
	'route' => 'piyes.'.$pageUrl.'.delete', 
	'id' => ['role' => $record->id]
])
<!-- End Delete Modal -->

@endsection