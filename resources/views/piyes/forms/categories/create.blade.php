@extends('layouts.piyes')

@section('title') <title>Piyes | Create New Category</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Create New Category @endslot
	<li>
		<a href="{{ route('piyes.forms.index') }}">Forms</a>
	</li>
	<li>
		<a href="{{ route('piyes.forms.edit', ['form' => $form->id]) }}">{{ $form->title }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
		{!! Form::open(['route' => 'piyes.forms.categories.store', 'class' => 'form-horizontal']) !!}
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.forms.edit', ['form' => $form->id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
		    </div>
		    <div class="col-lg-11">
		        <div class="ibox float-e-margins">
		            <div class="ibox-title">
		                <h5>Define New Category</h5>
		                <div class="ibox-tools">
		                    <a class="collapse-link">
		                        <i class="fa fa-chevron-up"></i>
		                    </a>
		                </div>
		            </div>
		            <div class="ibox-content">
		            	<div class="row">
		            		<div class="col-lg-6">
		            			<input type="hidden" name="contact_form_id" value="{{ $form->id }}">
		            			<div class="form-group">
			                    	<label class="col-sm-3 control-label">Related Form</label>
			                        <div class="col-sm-9">
			                        	{!! Form::text('related_form', $form->title, ['class' => 'form-control', 'readonly']) !!}
			                        	@if($errors->has('related_form'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('related_form') }}</strong>
					                        </span>
					                    @endif
			                    	</div>
			                    </div>
		            			<div class="form-group">
			                    	<label class="col-sm-3 control-label">Category Name</label>
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
		    </div>
	    {!! Form::close() !!}
	</div>
</div>
@endsection