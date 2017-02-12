@extends('layouts.piyes')

@section('title') <title>Piyes | Sort {{ $pageName }}</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Sort {{ $pageName }} @endslot
	<li>
		<a href="{{ route('piyes.'.$pageUrl.'.index') }}">{{ $pageName }}</a>
	</li>
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    	<div class="col-lg-1 formActions">
	    	<a href="{{ route('piyes.'.$pageUrl.'.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	    </div>
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Sort {{ $pageName }}</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag records to sort</p>
                    <div id="currentTaskList">
	                    <ul class="sortable-list connectList agile-list" id="sort-list">
	                        @foreach($records->sortBy('position') as $record)
	                        <li class="warning-element" id="{{ $record->id }}">
	                            <form action="{{ route('piyes.tasks.store') }}" method="POST" class="form-horizontal updateTaskForm">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="id" value="{{ $record->id }}">
	                            <input class="input form-control editTaskInput" type="text" name="description" value="{{ $record->name }}" autocomplete="off">
	                            <span class="currentTaskDescription">{{ $record->name }}</span>
	                            <div class="agile-detail">
	                                <i class="fa fa-calendar"></i> {{ $record->created_at->format('d-m-Y') }} <i class="fa fa-user"></i> {{ $record->createdby->name }}
	                            </div>
	                        </li>
	                        </form>
	                        @endforeach
	                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
	<!-- jQuery UI -->
	<script src="{{ url('public/piyes/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script>
        $(document).ready(function(){
            $("#sort-list").sortable({
		        update: function( event, ui ) {
		            var records = $( "#sort-list" ).sortable( "toArray" );
		            $.ajax({
		                data: { ids : window.JSON.stringify(records), _token: window.Laravel.csrfToken},
		                type: 'POST',
		                url: globalBaseUrl + '/piyes/'+'{{ $pageUrl }}'+'/sort-records',
		                success: function(response) {
		                    toastr.success('Items sorted');
		                },
		            });
		        }        
		    }).disableSelection();
        });
    </script>
@endsection