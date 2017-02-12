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
	@slot('page') Gallery @endslot
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.index') }}">{{ $pageName }}</a>
	</li>
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.edit', ['record' => $record->id]) }}">{{ $record->title }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
   		{!! Form::model($record, ['route' => ['piyes.'.$pageUrl.'.gallery.update', $record->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
   			{!! method_field('PUT') !!}
   			<input type="hidden" name="article_id" value="{{ $record->article_id }}">
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.'.$pageUrl.'.gallery', ['record' => $record->article_id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
		    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
		    </div>
		    <div class="col-lg-11">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="ibox float-e-margins">
				            <div class="ibox-title">
				                <h5>Define New Image <small></small></h5>
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
				                            <label for="cropMe" class="col-sm-3 control-label">Image</label>
				                            <div class="col-sm-9">
				                                <div class="row">
				                                    <div class="col-md-12 responsive-1024">
				                                        <img src="" id="cropMe" alt="No image has been selected" /><br>
				                                        <div class="fileinput fileinput-new" data-provides="fileinput">
				                                            <div class="fileinput-preview fileinput-exists thumbnail">
				                                            </div>
				                                            <div>
				                                                <input type="file" name="cropMe"> 
				                                            </div>
				                                        </div>
				                                    </div>
				                                    <hr>
				                                    <div class="col-md-12 responsive-1024">
				                                        <br><br>
				                                        <input type="hidden" id="crop_x" name="x" />
				                                        <input type="hidden" id="crop_y" name="y" />
				                                        <input type="hidden" id="crop_w" name="w" />
				                                        <input type="hidden" id="crop_h" name="h" />
				                                        <input type="hidden" id="main_image" name="main_image" />
				                                    </div>
				                                </div>
				                                @if($errors->has('main_image'))
				                                    <p class="help-block">*{{ $errors->first('main_image') }}</p>
				                                @endif
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
			                            @if($record->main_image)
			                            <div class="form-group">
			                                <label class="control-label col-sm-3">Current Image</label>
			                                <div class="input-group col-sm-9">
			                                    <img src="{{ url('public/storage/'.$record->main_image) }}" class="img-responsive" alt="">
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
	'route' => 'piyes.'.$pageUrl.'.gallery.delete', 
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