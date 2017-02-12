@extends('layouts.piyes')

@section('title') <title>Piyes | Inbox</title> @endsection

@section('styles')
    <link href="{{ url('public/piyes/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            @include('piyes.includes.inbox-menu')
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="{{ route('piyes.inbox.reply', ['mail' => $mail->id]) }}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                    <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i> </a>
                    <form style="display:inline" method="POST" action="{{ route('piyes.inbox.move-to-trash', ['mail' => $mail->id]) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                        </button>
                    </form>
                </div>
                <div class="mail-tools tooltip-demo m-t-md">
                    <h3>
                        {{ $mail->subject }}
                    </h3>
                    <h5>
                        <span class="pull-right font-normal">{{ $mail->created_at->format('d.m.y @ h:i') }}</span>
                        <span class="font-normal">From: </span>{{ $mail->from }} <br>
                        <span class="font-normal">To: </span>{{ $mail->to }}
                    </h5>
                </div>
            </div>
            <div class="mail-box">


                <div class="mail-body">
                    {!! $mail->body !!}
                </div>
                @if($mail->attachments->count())
                <div class="mail-attachment">
                    <p>
                        <span><i class="fa fa-paperclip"></i> 2 attachments - </span>
                        <a href="#">Download all</a>
                        |
                        <a href="#">View all images</a>
                    </p>
                    <div class="attachment">
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="icon">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-name">
                                        Document_2014.doc
                                        <br/>
                                        <small>Added: Jan 11, 2014</small>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="image" class="img-responsive" src="img/p1.jpg">
                                    </div>
                                    <div class="file-name">
                                        Italy street.jpg
                                        <br/>
                                        <small>Added: Jan 6, 2014</small>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="image" class="img-responsive" src="img/p2.jpg">
                                    </div>
                                    <div class="file-name">
                                        My feel.png
                                        <br/>
                                        <small>Added: Jan 7, 2014</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endif
                
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ url('public/piyes/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection