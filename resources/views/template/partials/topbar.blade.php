<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('admin') }}">[<strong>anbiotek</strong>] STORAGE</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">settings</i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name}}</li>
                        {{-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">lock</i>Change Password</a></li>
                        <li role="seperator" class="divider"></li> --}}
                        <li><a href="#"><i class="material-icons">people</i>Ubah Profil</a></li>
                        <li><a href="#"><i class="material-icons">lock</i>Ubah Password</a></li>
                        <li><a href="{{route('logout')}}"><i class="material-icons">input</i>Keluar</a></li>
                        <li class="footer">
                            <a href="javascript:void(0);">Batal</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
