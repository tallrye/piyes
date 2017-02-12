@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section class="articles">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $article->title }} <small>( by {{ $article->createdby->name }} )</small></h3>
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 singleArticle">
                            @if($article->main_image)
                            <img src="{{ url('public/storage/'.$article->main_image) }}" class="img-responsive fullWidth" alt="">
                            @else
                            <img src="{{ url('public/piyes/img/default.png') }}" class="img-responsive fullWidth" alt="">
                            @endif
                            <div class="brief clearfix">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><span class="date"><i class="fa fa-calendar"></i> {{ $article->created_at->format('d.m.Y') }}</span></h4>
                                        <div class="tags">
                                            @foreach($article->tags as $tag)
                                            <span><i class="fa fa-tag"> {{ $tag->name }}</i></span>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($article->main_file)
                                    <div class="col-md-6">
                                        <a class="btn btn-sm btn-primary pull-right" download href="{{ url('public/storage/'.$article->main_file) }}"><i class="fa fa-download"></i> Download Main File</a>
                                    </div>
                                    @endif
                                </div>
                                
                                <hr>
                                <div class="gallery row">
                                    @foreach($article->materials->where('publish', true)->sortBy('position') as $material)
                                    <div class="col-md-4">
                                        <a class="btn btn-sm btn-info" download href="{{ url('public/storage/'.$material->main_file) }}"><i class="fa fa-download"></i> {{ $material->title }}</a>
                                    </div>
                                    @endforeach
                                </div>
                                <p>{!! $article->description !!}</p>
                                <hr>
                                <div class="gallery row">
                                    @foreach($article->images->where('publish', true)->sortBy('position') as $image)
                                    <div class="col-md-4">
                                        <img src="{{ url('public/storage/'.$image->main_image) }}" class="img-responsive fullWidth" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                @include('_aside')
            </div>
        </div>
    </div>
</div>
@endsection