<div class="ibox float-e-margins">
    <div class="ibox-content mailbox-content">
        <div class="file-manager">
            <a class="btn btn-block btn-primary compose-mail" href="{{ route('piyes.inbox.compose') }}">Compose Mail</a>
            <div class="space-25"></div>
            <h5>Folders</h5>
            <ul class="folder-list m-b-md" style="padding: 0">
                <li>
                    <a href="{{ route('piyes.inbox.index') }}"> 
                        <i class="fa fa-inbox "></i> Inbox 
                        @if(unreadMailCount())
                        <span class="label label-warning pull-right">
                            {{ unreadMailCount() }}
                        </span> 
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('piyes.inbox.sent') }}"> 
                        <i class="fa fa-envelope-o"></i> Sent Mail
                    </a>
                </li>
                <li>
                    <a href="{{ route('piyes.inbox.important') }}"> 
                        <i class="fa fa-certificate"></i> Important
                    </a>
                </li>
                <li>
                    <a href="{{ route('piyes.inbox.drafts') }}"> 
                        <i class="fa fa-file-text-o"></i> Drafts 
                        @if(draftMailCount())
                        <span class="label label-danger pull-right">
                            {{ draftMailCount() }}
                        </span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('piyes.inbox.trash') }}"> 
                        <i class="fa fa-trash-o"></i> Trash
                    </a>
                </li>
            </ul>

            <h5 class="tag-title">Labels</h5>
            <ul class="tag-list" style="padding: 0">
                @foreach(inboxLabels() as $inboxLabel)
                    <li><a href=""><i class="fa fa-tag"></i> {{ $inboxLabel->title }}</a></li>
                    @foreach($inboxLabel->categories as $inboxCategory)
                    <li><a href=""><i class="fa fa-tag"></i> {{ $inboxCategory->title }}</a></li>
                    @endforeach
                @endforeach
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>