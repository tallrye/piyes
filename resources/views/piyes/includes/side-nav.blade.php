<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        <img alt="image" class="img-circle img-responsive" width="48" 
                            src="{{ (auth()->user()->settings->profile_photo) ? url('public/storage/profile-photos/'.auth()->user()->settings->profile_photo) :  url('public/piyes/img/avatar.png') }}" 
                        />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ auth()->user()->name }}</strong>
                     </span> <span class="text-muted text-xs block">{{ auth()->user()->roles[0]->name }} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('piyes.change-profile-photo.index') }}">Change Profile Photo</a></li>
                        <li><a href="{{ route('piyes.tasks.index') }}">Tasks</a></li>
                        <li><a href="{{ route('piyes.inbox.index') }}">Inbox</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    P
                </div>
            </li>
            <li class="{{ (strpos($currentRouteName, 'home') !== false) ? 'active' : '' }}">
                <a href="{{ route('piyes.home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @can('view_user_management')
            <li class="{{ (strpos($currentRouteName, 'user-management') !== false) ? 'active' : '' }}">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">User Management</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('manage_roles')
                    <li class="{{ (strpos($currentRouteName, 'user-management.roles') !== false) ? 'active' : '' }}">
                        <a href="{{ route('piyes.user-management.roles.index') }}">Roles</a>
                    </li>
                    @endcan
                    @can('manage_permissions')
                    <li class="{{ (strpos($currentRouteName, 'user-management.permissions') !== false) ? 'active' : '' }}">
                        <a href="{{ route('piyes.user-management.permissions.index') }}">Permissions</a>
                    </li>
                    @endcan
                    @can('manage_users')
                    <li class="{{ (strpos($currentRouteName, 'user-management.users') !== false) ? 'active' : '' }}">
                        <a href="{{ route('piyes.user-management.users.index') }}">Users</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('manage_forms')
            <li class="{{ (strpos($currentRouteName, 'forms') !== false) ? 'active' : '' }}">
                <a href="{{ route('piyes.forms.index') }}"><i class="fa fa-list-alt"></i> <span class="nav-label">Forms </span></a>
            </li>
            @endcan
            @can('manage_inbox')
            <li>
                <a href="{{ route('piyes.inbox.index') }}">
                    <i class="fa fa-envelope"></i> <span class="nav-label">Inbox </span>
                    @if(unreadMailCount() and auth()->user()->settings->showNotifications)
                    <span class="label label-warning pull-right">{{ unreadMailCount() }}</span>
                    @endif
                </a>
            </li>
            @endcan
            <li>
                <a href="{{ route('piyes.tags.index') }}">
                    <i class="fa fa-tags"></i> <span class="nav-label">Tags </span>
                </a>
            </li>
            <li>
                <a href="{{ route('piyes.articles.index') }}">
                    <i class="fa fa-edit"></i> <span class="nav-label">Articles </span>
                </a>
            </li>
        </ul>
    </div>
</nav>