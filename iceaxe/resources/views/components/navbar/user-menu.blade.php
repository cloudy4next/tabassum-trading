@php
    $userName = Auth::user()->user_name;
    $memberSince = Auth::user()->created_at;
    $image = Auth::user()->userImage();
@endphp
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{ $image ? 'data:image/png;base64,' . $image : asset('img/blx100x100.png') }}"
             class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">{{$userName}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-warning">
            <img src="{{ $image ? 'data:image/png;base64,' . $image : asset('img/blx100x100.png') }}" class="img-circle" alt="User Image">

            <p class="text-white">
                {{$userName}}
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="{{ route('user_info.change') }}" class="btn btn-default btn-flat">Profile</a>
            <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
        </li>
    </ul>
</li>
