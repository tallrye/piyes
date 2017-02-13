@extends('layouts.piyes')

@section('title') <title>Piyes | Edit Existing {{ $pageItem }}</title> @endsection

@section('content')

@section('styles')
	<link href="{{ asset('piyes/js/plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('piyes/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
	<link href="{{ asset('piyes/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('piyes/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('piyes/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
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
   		{!! Form::open(['route' => 'piyes.'.$pageUrl.'.gallery.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
   			<input type="hidden" name="article_id" value="{{ $record->id }}">
		    <div class="col-lg-1 formActions">
		    	<a href="{{ route('piyes.'.$pageUrl.'.edit', ['route' => $record->id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
		    	<button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
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
				                                <input type="checkbox" name="publish" class="js-switch" />
			                                </div>
			                            </div>
				            		</div>
				            	</div>
				            </div>
				            
				        </div>
		    		</div>
		    	</div>
		    </div>
	    {!! Form::close() !!}
	</div>
	<div class="row">
		<div class="col-lg-1 formActions"></div>
		<div class="col-lg-11">
			<div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Image Gallery <small><i class="fa fa-hand-o-up"></i> Drag items to sort</small></h5>
	            </div>
            </div>
	    	<div class="row" id="sort-list">
	    		@foreach($record->images->sortBy('position') as $image)
	    		<div class="col-md-3" id="{{ $image->id }}">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <a href="{{ url('storage/'.$image->main_image) }}" title="{{ $image->title }}" data-gallery>
                            	<img src="{{ url('storage/'.$image->main_image) }}" class="img-responsive" alt="">
                        	</a>
                            <div class="product-desc">
                                <span class="product-price">
                                    Click on image to enlarge
                                </span>
                                <a href="{{ route('piyes.'.$pageUrl.'.gallery.edit', ['record' => $image->id]) }}" class="product-name"> {{ ($image->title) ?: 'No Caption' }}</a>
                                <div class="small m-t-xs">
                                    {{ ($image->publish) ? 'Published' : 'Not Published' }}
                                </div>
                                <div class="m-t text-righ">
                                    <a href="{{ route('piyes.'.$pageUrl.'.gallery.edit', ['record' => $image->id]) }}" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-edit"></i> Edit  </a>
                                    <a data-toggle="modal" data-target="#deleteModal" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"></i> Delete  </a>
                                    @include('piyes.includes.delete-modal', [
										'modal_id' => 'deleteModal', 
										'route' => 'piyes.'.$pageUrl.'.gallery.delete', 
										'id' => ['role' => $image->id]
									])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
	    	</div>
	    </div>
	</div>
</div>
<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

@endsection

@section('scripts')
	<!-- Jasny -->
    <script src="{{ asset('piyes/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
	<script src="{{ asset('piyes/js/plugins/jcrop/js/jquery.Jcrop.min.js') }}"></script>
    <script src="{{ asset('piyes/js/plugins/jcrop/js/bootstrap-fileinput.js') }}"></script>
    <!-- Switchery -->
   	<script src="{{ asset('piyes/js/plugins/switchery/switchery.js') }}"></script>
   	<!-- Data picker -->
   	<script src="{{ asset('piyes/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
   	<!-- blueimp gallery -->
    <script src="{{ asset('piyes/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
    <!-- jQuery UI -->
	<script src="{{ url('piyes/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
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

            $("#sort-list").sortable({
		        update: function( event, ui ) {
		            var records = $( "#sort-list" ).sortable( "toArray" );
		            $.ajax({
		                data: { ids : window.JSON.stringify(records), _token: window.Laravel.csrfToken},
		                type: 'POST',
		                url: globalBaseUrl + '/piyes/'+'{{ $pageUrl }}'+'/gallery/sort-records',
		                success: function(response) {
		                    toastr.success('Items sorted');
		                },
		            });
		        }        
		    }).disableSelection();
        });
	</script>
@endsection