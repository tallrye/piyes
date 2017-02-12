<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="{{ route('piyes.search') }}">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="keyword" id="top-search" autocomplete="off">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Piyes | Content Management System</span>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    
                    <i class="fa fa-envelope"></i>  
                    @if(unreadMailCount() and auth()->user()->settings->showNotifications)
                        <span class="label label-warning">{{ unreadMailCount() }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    @foreach(latestMails() as $unreadMailLink)
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="{{ route('piyes.inbox.detail', ['mail' => $unreadMailLink->id]) }}" class="pull-left iconLink">
                                <i class="{{ ($unreadMailLink->isRead) ? 'fa fa-envelope-open' : 'fa fa-envelope text-warning' }}"></i>
                            </a>
                            <div class="media-body">
                            <a href="{{ route('piyes.inbox.detail', ['mail' => $unreadMailLink->id]) }}" class="unredMailLink">
                                <strong>From: </strong> {{ $unreadMailLink->from }} <br>
                                <strong>Subject: </strong> {{ $unreadMailLink->subject }} <br>
                                <small class="text-muted">{{ $unreadMailLink->created_at->format('d/m/Y @ h:i') }}</small>
                            </a>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    @endforeach
                    <li>
                        <div class="text-center link-block">
                            <a href="{{ route('piyes.inbox.index') }}">
                                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            <li>
                <a class="right-sidebar-toggle">
                    <i class="fa fa-gears"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>