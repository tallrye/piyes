@extends('layouts.piyes')

@section('title') <title>Piyes | Change Profile Photo</title> @endsection

@section('styles')
	<link href="{{ asset('piyes/js/plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Change Profile Photo @endslot
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
   	<div class="row">
	{!! Form::open(['route' => 'piyes.change-profile-photo.store', 'class' => 'form-horizontal', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
	    <div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.home') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    	<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
	    </div>
	    <div class="col-lg-11">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Crop &amp; Upload New Photo <small></small></h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<div class="row">
	            		<div class="col-lg-9">
	                        <div class="form-group">
	                            <label for="cropMe" class="col-sm-3 control-label">Profile Photo</label>
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
	                                        <input type="hidden" id="theFile" name="theFile" />
	                                    </div>
	                                </div>
	                                @if($errors->has('main_image'))
	                                    <p class="help-block">*{{ $errors->first('main_image') }}</p>
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

@section('scripts')
	<script src="{{ asset('piyes/js/plugins/jcrop/js/jquery.Jcrop.min.js') }}"></script>
    <script src="{{ asset('piyes/js/plugins/jcrop/js/bootstrap-fileinput.js') }}"></script>
    <script>

    	var cropOptions = {
            fileInput : '#cropMe',
            targetInput: '#theFile',
            aspectRatio:1,
            cropX: '#crop_x',
            cropY: '#crop_y',
            cropW: '#crop_w',
            cropH: '#crop_h',
        }
    </script>
@endsection