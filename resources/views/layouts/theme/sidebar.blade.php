<!--    SIDEBAR     -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="compactSidebar">
        <ul class="menu-categories">
            @can('Ventas_Index')
            <li class="">
                <a href="{{ url('pos')}}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M0 32C0 14.3 14.3 0 32 0H160c17.7 0 32 14.3 32 32V416c0 53-43 96-96 96s-96-43-96-96V32zM223.6 425.9c.3-3.3 .4-6.6 .4-9.9V154l75.4-75.4c12.5-12.5 32.8-12.5 45.3 0l90.5 90.5c12.5 12.5 12.5 32.8 0 45.3L223.6 425.9zM182.8 512l192-192H480c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32H182.8zM128 64H64v64h64V64zM64 192v64h64V192H64zM96 440c13.3 0 24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24z" />
                            </svg>--}}
                            <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                        </div>
                        <span>VENTA</span>
                    </div>
                </a>
            </li>
            @endcan
            <li class="mt-2">
                @can('Report_Index')
                <a href="#homeSubmenuStock" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="text-center">
                        <i class="fa fa-boxes fa-3x text-muted" aria-hidden="true"></i>
                        <div class=" text-center">
                            <span class="text-white">GESTION STOKS</span>
                        </div>
                    </div>
                </a>
                @endcan
                <ul class="collapse list-unstyled text-white text-lg mt-2" id="homeSubmenuStock">
                    @can('Category_Index')
                    <li class="">
                        <a class="text-white" href="{{url('categories')}}">CATEGORIAS</a>
                        <i class="fa fa-tags fa-1x text-muted" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Product_Index')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{url('products')}}">PRODUCTOS</a>
                        <i class="fa fa-shopping-basket fa-1x text-muted" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Denominaciones_Index')
                    <li class="mt-2">
                        <a class="text-white" href="{{url('coins')}}">MONEDAS</a>
                        <i class="far fa-money-bill-alt fa-1x text-muted pl-3" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="mt-5">
                @can('Report_Index')
                <a href="#homeSubmenuReport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="text-center">
                        <i class="fas fa-file-medical-alt fa-3x text-muted" aria-hidden="true"></i>
                        <div class=" text-center">
                            <span class="text-white">REPORTERIA</span>
                        </div>
                    </div>
                </a>
                @endcan
                <ul class="collapse list-unstyled text-white text-lg" id="homeSubmenuReport">
                    @can('Cashout_Index')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('cashout') }}">CIERRE CAJA</a>
                        <i class="fas fa-cash-register fa-1x text-muted  pl-2" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Report_Index')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('reports') }}">VENTAS</a>
                        <i class="fas fa-file-contract fa-1x text-muted pl-5" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('graficas') }}">ESTADISTICA</a>
                        <i class="fas fa-chart-bar fa-1x text-muted pl-2" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="mt-5">
                @role('Admin')
                <a href="#homeSubmenuUser" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="text-center">
                        <i class="fa fa-users fa-3x text-muted" aria-hidden="true"></i>
                        <div class=" text-center">
                            <span class="text-white">GESTION USUARIOS</span>
                        </div>
                    </div>
                </a>
                @endcan
                <ul class="collapse list-unstyled text-white text-lg" id="homeSubmenuUser">
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('roles') }}">ROLES</a>
                        <i class="fa fa-street-view fa-1x text-muted  pl-5" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('permisos') }}">PERMISOS</a>
                        <i class="fa fa-unlock-alt fa-1x text-muted pl-4" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('asignar') }}">ASIGNAR</a>
                        <i class="fa fa-check-square fa-1x text-muted pl-4" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('users') }}">USUARIOS</a>
                        <i class="fa fa-user fa-1x text-muted pl-3" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </nav>
</div>