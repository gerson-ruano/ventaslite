<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row">
            <li class="nav-item theme-logo">
                <a href="home">
                    <img src="assets/img/ventaslite_logo.png" class="navbar-logo" alt="logo"><b
                        style="font-size: 30px: color:#3B3F5C">{{ config('app.name') }}</b>
                </a>
            </li>
        </ul>

        {{--<a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                <line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line>
                <line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line>
            </svg>
        </a>--}}

        <livewire:search>
            
            
            <span>{{ now()->formatLocalized('%A, %d de %B de %Y,') }}</span>
            <span class="ml-2">
                {{ now()->format('H:i') }}
            </span>
            <ul class="navbar-item flex-row navbar-dropdown">



                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{--<img src="assets/img/ventaslite_logo.png" alt="admin-profile" class="img-fluid">--}}

                        @if(auth()->check() && auth()->user()->image)
                        <img src="{{ asset('storage/users/' . auth()->user()->image) }}" class="img-fluid mr-2"
                            alt="avatar">
                        @else
                        <img src="assets/img/invitado.png" class="img-fluid mr-2" alt="avatar">
                        {{--<i class="fas fa-user text-dark"></i>--}}
                        @endif

                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp"
                        aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                {{--<img src="assets/img/ventas2.png" class="img-fluid mr-2" alt="avatar">--}}
                                @if(auth()->check() && auth()->user()->image)
                                <img src="{{ asset('storage/users/' . auth()->user()->image) }}" class="img-fluid mr-2"
                                    alt="avatar">
                                @else
                                <img src="assets/img/invitado.png" class="img-fluid mr-2" alt="avatar">
                                @endif
                                <div class="media-body">
                                    <h5>Mi Perfil</h5>
                                    @if(auth()->check())
                                    <span>{{ auth()->user()->name }}</span>
                                    @else
                                    <span>Invitado</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            @if(auth()->check())
                            <a href="">
                                <i class="fas fa-user-shield"></i><span> {{ auth()->user()->profile }}</span>
                            </a>
                            <a href="home">
                                <!--svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg-->
                                <i class="fas fa-home"></i> Home
                                {{--<span>{{ auth()->user()->name }}</span>--}}
                                @else
                                <a href="register">
                                    <!--svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg-->
                                    <i class="fas fa-user-slash"></i> Registrarse
                                </a>
                                <a href="login">
                                    <!--svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg-->
                                    <i class="fas fa-arrow-alt-circle-left"></i> Login
                                    @endif
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Log Out</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
    </header>

</div>
<!--  END NAVBAR  -->