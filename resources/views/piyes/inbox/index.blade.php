@extends('layouts.piyes')

@section('title') <title>Piyes | Inbox</title> @endsection

@section('styles')
@endsection

@section('content')

<div class="wrapper wrapper-content" id="app">
        <div class="row">
            <div class="col-lg-3">
                @include('piyes.includes.inbox-menu')
            </div>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <form method="GET" action="{{ route('piyes.inbox.search') }}" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="subject" placeholder="Search email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
                    {{ $inboxName }}
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        {!! $mails->render() !!}

                        <!-- <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button> -->
                    </div>
                    <a onclick="location.reload();" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</a>
                    @unless(isset($trashFolder))
                    <form style="display:inline" method="POST" action="{{ route('piyes.inbox.mark-as-read') }}">
                        {{ csrf_field() }}
                        <select v-model="selectedMails" style="display: none;" name="selected_mails[]" multiple required>
                            <option v-for="selectedMail in selectedMails" :value="selectedMail"></option>
                        </select>
                        <button type="submit" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                        </button>
                    </form>
                    <form style="display:inline" method="POST" action="{{ route('piyes.inbox.mark-as-important') }}">
                        {{ csrf_field() }}
                        <select v-model="selectedMails" style="display: none;" name="selected_mails[]" multiple required>
                            <option v-for="selectedMail in selectedMails" :value="selectedMail"></option>
                        </select>
                        <button type="submit" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> 
                        </button>
                    </form>
                    <form style="display:inline" method="POST" action="{{ route('piyes.inbox.mark-as-trash') }}">
                        {{ csrf_field() }}
                        <select v-model="selectedMails" style="display: none;" name="selected_mails[]" multiple required>
                            <option v-for="selectedMail in selectedMails" :value="selectedMail"></option>
                        </select>
                        <button type="submit" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                    </form>
                    @endunless
                </div>
            </div>
                <div class="mail-box">
                    @if($mails->isEmpty())
                        <div class="col-md-12">Nothing to show.</div>
                    @endif
                    <table class="table table-hover table-mail">
                        <tbody>
                            @foreach($mails as $mail)
                            <tr class="{{ ($mail->isRead) ? 'read' : 'unread' }}">
                                <td class="check-mail">
                                    <input type="checkbox" v-model="selectedMails" value="{{ $mail->id }}">
                                </td>
                                <td class="mail-ontact">
                                    <a href="{{ route(($mail->isDraft) ? 'piyes.inbox.edit' : 'piyes.inbox.detail', ['mail' => $mail->id]) }}">
                                        
                                        {{ $mail->from }}
                                        @if($mail->isDraft)
                                        <small><em>(draft)</em></small>
                                        @endif
                                    </a> 
                                </td>
                                <td>
                                    @if($mail->isImportant)
                                    <span class="label label-warning pull-right"><i class="fa fa-exclamation"></i></span>
                                    @endif
                                </td>
                                <td class="mail-subject"><a href="{{ route(($mail->isDraft) ? 'piyes.inbox.edit' : 'piyes.inbox.detail', ['mail' => $mail->id]) }}">{{ ($mail->subject) ?: '(empty)' }}</a></td>
                                <td>
                                    @if($mail->form)
                                    <span class="label label-default"><i class="fa fa-tag"></i> {{ $mail->form->title }}</span>
                                    @endif
                                </td>
                                <td class="">@if($mail->attachments->count())<i class="fa fa-paperclip"></i>@endif</td>
                                <td class="text-right mail-date">{{ $mail->created_at->format('d/m/Y @ h:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        @endsection

@section('scripts')
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                selectedMails: [],
            }
        });
    </script>
@endsection