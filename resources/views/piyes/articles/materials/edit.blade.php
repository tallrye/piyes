@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing {{ $pageItem }}</title> @endsection

@section('content')

@section('styles')
	<link href="{{ asset('public/piyes/js/plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('public/piyes/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
	<link href="{{ asset('public/piyes/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('public/piyes/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/piyes/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
@endsection

@component('piyes.components.breadcrumb') 
	@slot('page') Materials @endslot
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.index') }}">{{ $pageName }}</a>
	</li>
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.edit', ['record' => $record->id]) }}">{{ $record->title }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
   		{!! Form::model($record, ['route' => ['piyes.'.$pageUrl.'.materials.update', $record->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
   			{!! method_field('PUT') !!}
   			<input type="hidden" name="article_id" value="{{ $record->article_id }}">
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.'.$pageUrl.'.materials', ['record' => $record->article_id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
		    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
		    </div>
		    <div class="col-lg-11">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="ibox float-e-margins">
				            <div class="ibox-title">
				                <h5>Edit Existing Material <small></small></h5>
				                <div class="ibox-tools">
				                    <a class="collapse-link">
				                        <i class="fa fa-chevron-up"></i>
				                    </a>
				                </div>
				            </div>
				            <div class="ibox-content">
				            	<div class="row">
				            		<div class="col-lg-7">
				            			<div class="form-group">
					                    	<label class="col-sm-3 control-label">Title</label>
					                        <div class="col-sm-9">
					                        	{!! Form::text('title', null, ['class' => 'form-control']) !!}
					                        	@if($errors->has('title'))
							                        <span class="help-block">
							                            <strong>{{ $errors->first('title') }}</strong>
							                        </span>
							                    @endif
					                    	</div>
					                    </div>
				            			<div class="form-group">
					                    	<label class="col-sm-3 control-label">Main File</label>
					                    	<div class="col-sm-9">
							                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
					                                <div class="form-control" data-trigger="fileinput">
					                                	<i class="glyphicon glyphicon-file fileinput-exists"></i> 
					                                	<span class="fileinput-filename"></span>
				                                	</div>
					                                <span class="input-group-addon btn btn-default btn-file">
					                                	<span class="fileinput-new">Select file</span>
					                                	<span class="fileinput-exists">Change</span>
					                                	<input type="file" name="main_file">
				                                	</span>
					                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				                            	</div>
				                            </div>
			                            </div>
				            		</div>
				            		<div class="col-lg-5">
				                        <div class="form-group">
				                            <label class="col-sm-3 control-label" for="publish">Publish</label>
				                            <div class="col-sm-9">
				                                <input type="checkbox" name="publish" class="js-switch" {{ $record->publish ? 'checked' : '' }} />
				                            </div>
				                        </div>
			                            @if($record->main_file)
			                            <div class="form-group">
			                                <label class="control-label col-sm-3">Current File</label>
			                                <div class="input-group col-sm-9">
			                                   	<a target="_blank" class="btn btn-success" href="{{ url('public/storage/'.$record->main_file) }}">
			                                   		<i class="fa fa-eye"></i> View On New Tab
			                                   	</a>
			                                   	
			                                </div>
			                            </div>
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
@include('piyes.includes.delete-modal', [
	'modal_id' => 'deleteModal', 
	'route' => 'piyes.'.$pageUrl.'.materials.delete', 
	'id' => ['role' => $record->id]
])
@endsection

@section('scripts')
	<!-- Jasny -->
    <script src="{{ asset('public/piyes/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/piyes/js/plugins/jcrop/js/jquery.Jcrop.min.js') }}"></script>
    <script src="{{ asset('public/piyes/js/plugins/jcrop/js/bootstrap-fileinput.js') }}"></script>
    <!-- Switchery -->
   	<script src="{{ asset('public/piyes/js/plugins/switchery/switchery.js') }}"></script>
   	<!-- Data picker -->
   	<script src="{{ asset('public/piyes/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
   	<!-- blueimp gallery -->
    <script src="{{ asset('public/piyes/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
    <!-- jQuery UI -->
	<script src="{{ url('public/piyes/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script>
		var cropOptions = {
            fileInput : '#cropMe',
            targetInput: '#main_image',
            aspectRatio:1.4,
            cropX: '#crop_x',
            cropY: '#crop_y',
            cropW: '#crop_w',
            cropH: '#crop_h',
        }
		$(document).ready(function(){
            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });
        });
	</script>
@endsection