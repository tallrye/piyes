@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="jumbotron">
                    <h1>Welcome!</h1>
                    <p>This is a dummy website which is only built for demo purposes. This site's main goal is to demonstrate basic features of Piyes CMS.</p>
                    <p>Please remember, all changes you'll perform in Piyes CMS will be reflected here. Go ahead and create an article, add some gallery images, sort articles, submit the contact form on the right sidebar...</p>
                    <p>
                        Login credentials are: <br>
                        <strong>email:</strong> s_uzuncavdar@hotmail.com <br>
                        <strong>pass:</strong> dummydum
                        <br><br>
                        <a href="{{ route('login') }}" class="btn btn-primary fullWidth"><i class="fa fa-sign-in"></i> Login Now</a>
                    </p>
                </div>
                <section class="articles">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>All Articles <small>( {{ $articles->count() }} )</small></h3>
                            <hr>
                        </div>
                        @foreach($articles as $article)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 singleArticle">
                            <a href="{{ route('detail', ['url' => $article->url]) }}">
                                @if($article->main_image)
                                <img src="{{ url('storage/'.$article->main_image) }}" class="img-responsive fullWidth" alt="">
                                @else
                                <img src="{{ url('piyes/img/default.png') }}" class="img-responsive fullWidth" alt="">
                                @endif
                                <div class="brief clearfix">
                                    <h4>{{ $article->title }}</h4>
                                    <div class="tags">
                                        @foreach($article->tags as $tag)
                                        <span><i class="fa fa-tag"> {{ $tag->name }}</i></span>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <p>{{ $article->caption }}</p>
                                    <span class="date"><i class="fa fa-calendar"></i> {{ $article->created_at->format('d.m.Y') }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
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