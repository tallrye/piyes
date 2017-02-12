@extends('layouts.piyes')

@section('title') <title>Piyes | {{ $pageName }}</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') {{ $pageName }} @endslot
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
            		<a href="{{ route('piyes.'.$pageUrl.'.create') }}" class="btn btn-sm btn-primary clearfix">
            			<i class="fa fa-plus-circle"></i> Add New {{ $pageItem }}
        			</a>
        			<a href="{{ route('piyes.'.$pageUrl.'.sort') }}" class="btn btn-sm btn-primary btn-outline clearfix pull-right">
            			<i class="fa fa-sort"></i> Sort {{ $pageName }}
        			</a>
	            </div>
	            <div class="ibox-content">
	                <div class="table-responsive">
	            		<table class="table table-striped table-bordered table-hover dataTable" >
	            			<thead>
					            <tr>
					                {{ $tHead }}
					            </tr>
	            			</thead>
	            			<tbody>
	            				{{ $tBody }}
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