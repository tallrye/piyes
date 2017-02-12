@extends('layouts.piyes')

@section('title') <title>Piyes | Search Results</title> @endsection

@section('content')

@component('piyes.components.breadcrumb') 
	@slot('page') Search @endslot
@endcomponent

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>
                        {{ $results->count() }} results found for: <span class="text-navy">“{{$keyword}}”</span>
                    </h2>

                    <div class="search-form">
                        <form role="search" action="{{ route('piyes.search') }}">
                            <div class="input-group">
                                <input type="text" placeholder="Search something else..." name="keyword" class="form-control input-lg" autocomplete="off">
                                <div class="input-group-btn">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="hr-line-dashed"></div>
                    @if($results->count())
	                    @foreach($results as $result)
	                    <div class="search-result">
	                        <h3><a href="{{ url('piyes/'.$result->folder.'/'.$result->key.'/edit') }}">{{ $result->keyword }} <small>({{$result->folder}})</small></a></h3>
	                        <a href="{{ url('piyes/'.$result->folder.'/'.$result->key.'/edit') }}" class="search-link">{{ url('piyes/'.$result->folder.'/'.$result->key.'/edit') }}</a>
	                        
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    @endforeach
                    @else
                    	<h4>Nothing found.</h4>
                    	<div class="hr-line-dashed"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection