@extends('layouts.piyes')

@section('title') <title>Piyes | Compose New Mail</title> @endsection

@section('styles')
    <link href="{{ url('piyes/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="wrapper wrapper-content" id="app">
    <div class="row">
        <div class="col-lg-3">
            @include('piyes.includes.inbox-menu')
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <form style="display: none !important;" id="draftForm" method="POST" action="{{ route('piyes.inbox.update', ['mail' => $mail->id]) }}">
                        {{ csrf_field() }}
                        <input type="email" class="form-control" name="to" v-model="to" value="{{ $mail->to }}" required>
                        <input type="email" class="form-control" name="from" v-model="from" value="{{ $mail->from }}" required>
                        <input type="text" class="form-control" name="subject" v-model="subject" value="{{ $mail->subject }}" required>
                        <textarea name="body" id="draftBody" cols="30" rows="10" required></textarea>
                    </form>
                    <a id="saveDraftBtn" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-save"></i> Save</a>
                    <a href="{{ route('piyes.inbox.drafts') }}" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard Changes</a>
                </div>
                <h2>
                    Edit Draft
                </h2>
            </div>
            <div class="mail-box">
                <form class="form-horizontal" id="composerForm" method="POST" action="{{ route('piyes.inbox.send') }}">
                    {{ csrf_field() }}
                    <div class="mail-body">
                        <div class="form-group noMarginTop"><label class="col-sm-2 control-label">From:</label>
                            <div class="col-sm-10"><input type="email" class="form-control" name="from" value="{{ $mail->from }}" v-model="from" required></div>
                        </div>
                        <div class="form-group noMarginTop"><label class="col-sm-2 control-label">To:</label>
                            <div class="col-sm-10"><input type="email" class="form-control" name="to" v-model="to" required value="{{ $mail->to }}"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="subject" v-model="subject" required value="{{ $mail->subject }}"></div>
                        </div>
                    </div>
                    <div class="mail-text h-200">
                        <textarea name="body" id="composeBody" cols="30" rows="10" class="summernote" required>{{ $mail->body }}</textarea>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-envelope"></i> Send</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <!-- iCheck -->
    <script src="{{ url('piyes/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                from: "{{ $mail->from }}",
                to: "{{ $mail->to }}",
                subject: "{{ $mail->subject }}",
                body: ""
            }
        });
        $(document).ready(function(){
            $('.summernote').summernote({height: 400});

            $(document).delegate('#saveDraftBtn', 'click', function(e){
                e.preventDefault();
                var $form = $('#draftForm');
                $('#draftBody').val($('#composeBody').val());
                if($form.find('textarea').val() == ""){
                    toastr.error('Mail body can not be null');
                }else{
                    $form.submit();
                }
            });
        });
    </script>
@endsection