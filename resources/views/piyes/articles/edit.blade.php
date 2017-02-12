@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing {{ $pageItem }}</title> @endsection

@section('content')

@section('styles')
	<link href="{{ asset('public/piyes/js/plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('public/piyes/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
	<link href="{{ asset('public/piyes/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('public/piyes/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@component('piyes.components.breadcrumb') 
	@slot('page') Edit Existing {{ $pageItem }} @endslot
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.index') }}">{{ $pageName }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	   	{!! Form::model($record, ['route' => ['piyes.'.$pageUrl.'.update', $record->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
	   		{!! method_field('PUT') !!}
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.'.$pageUrl.'.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
		    	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
		    	<hr>
		    	<h5><i class="fa fa-info-circle" style="float:none;"></i> More...</h5>
		    	<hr>
		    	<a href="{{ route('piyes.articles.gallery', ['record' => $record->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-picture-o"></i>  Gallery</a>
		    	<a href="{{ route('piyes.articles.materials', ['record' => $record->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-file-o"></i>  Docs</a>
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
	                            <label for="cropMe" class="col-sm-3 control-label">Main Image</label>
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
	            			<div class="form-group">
		                    	<label class="col-sm-3 control-label">Title</label>
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
		                    	<label class="col-sm-3 control-label">Caption</label>
		                        <div class="col-sm-9">
		                        	{!! Form::textarea('caption', null, ['class' => 'form-control', 'rows' => '3', 'required']) !!}
		                        	@if($errors->has('caption'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('caption') }}</strong>
				                        </span>
				                    @endif
		                    	</div>
		                    </div>
		                    <div class="form-group">
	                            <label for="title" class="col-sm-3 control-label">Tags</label>
	                            <div class="col-sm-9">
	                                {{ Form::select('tag_list[]', $tags, $record->tagList, ['id' => 'tag_list', 'class' => 'form-control', 'multiple', 'style' => 'display: none; width: 100%;', 'tabindex' => '-1']) }}
	                            </div>  
	                        </div>
		                    <div class="form-group">
		                    	<label class="col-sm-3 control-label">Body</label>
		                        <div class="col-sm-9">
		                        	{!! Form::textarea('description', null, ['class' => 'form-control summernote', 'rows' => '3', 'required']) !!}
		                        	@if($errors->has('description'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('description') }}</strong>
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
							<div class="form-group">
                                <label class="control-label col-sm-3">Publish At</label>
                                <div class="input-group date col-sm-9">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="publish_at" value="{{ $record->publish_at ? convertDate($record->publish_at) : '' }}" autocomplete="off">
                                    {{ $errors->first('publish_at') }}
                                </div>
                            </div>
		                    <div class="form-group">
                                <label class="control-label col-sm-3">Publish Until</label>
                                <div class="input-group date col-sm-9">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="publish_until" value="{{ $record->publish_until ? convertDate($record->publish_until) : '' }}" autocomplete="off">
                                    {{ $errors->first('publish_until') }}
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
                            @if($record->main_file)
                            <div class="form-group">
                                <label class="control-label col-sm-3">Current File</label>
                                <div class="input-group col-sm-9">
                                   	<a target="_blank" class="btn btn-success" href="{{ url('public/storage/'.$record->main_file) }}">
                                   		<i class="fa fa-eye"></i> View On New Tab
                                   	</a>
                                   	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalFile"><i class="fa fa-trash"></i></button>
                                   	
                                </div>
                            </div>
                            @endif
	            		</div>
		            </div>
		        </div>
		    </div>
	    {!! Form::close() !!}
	</div>
</div>

<!-- Delete File Modal -->
@include('piyes.includes.delete-modal', [
	'modal_id' => 'deleteModalFile', 
	'route' => 'piyes.'.$pageUrl.'.delete-file', 
	'id' => ['record' => $record->id]
])
<!-- End Delete File Modal -->

<!-- Delete Modal -->
@include('piyes.includes.delete-modal', [
	'modal_id' => 'deleteModal', 
	'route' => 'piyes.'.$pageUrl.'.delete', 
	'id' => ['role' => $record->id]
])
<!-- End Delete Modal -->

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
			$("#tag_list").select2();

            $('.summernote').summernote({height: 400});

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

			$('.input-group.date').datepicker({
                todayBtn: "linked",
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                startDate: "{{ todayWithFormat('d/m/Y') }}"
            });
        });
	</script>
@endsection