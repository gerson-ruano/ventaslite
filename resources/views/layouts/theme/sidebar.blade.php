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
            @can('Cashout_Index')
            <li class="">
                <a href="{{ url('cashout')}}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-216c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm72 24c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm120-56c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm120-56c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24z" />
                            </svg>--}}
                            <i class="fas fa-cash-register fa-3x text-muted"></i>
                        </div>
                        <span>CIERRE DE CAJA</span>
                    </div>
                </a>
            </li>
            @endcan
            @can('Report_Index')
            <li class="">
                <a href="{{ url('reports') }}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path
                                    d="M64 0C28.7 0 0 28.7 0 64V288H112c6.1 0 11.6 3.4 14.3 8.8L144 332.2l49.7-99.4c2.7-5.4 8.2-8.8 14.3-8.8s11.6 3.4 14.3 8.8L249.9 288H320c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-6.1 0-11.6-3.4-14.3-8.8L208 275.8l-49.7 99.4c-2.7 5.4-8.3 8.8-14.3 8.8s-11.6-3.4-14.3-8.8L102.1 320H0V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0z" />
                            </svg>--}}
                            <i class="fas fa-file-medical-alt fa-3x text-muted"></i>
                        </div>
                        <span>REPORTES</span>
                    </div>
                </a>
            </li>
            @endcan
            <li class="mt-2">
                <a href="#homeSubmenuStock" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="text-center">
                        <i class="fa fa-boxes fa-3x text-muted" aria-hidden="true"></i>
                        <div class=" text-center">
                            <span class="text-white">GESTION DE STOKS</span>
                        </div>
                    </div>
                </a>
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
                        <i class="fa fa-shopping-basket fa-1x text-muted" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Denominaciones_Index')
                    <li class="mt-2">
                        <a class="text-white" href="{{url('coins')}}">MONEDAS</a>
                        <i class="far fa-money-bill-alt fa-1x text-muted pl-3" aria-hidden="true" style="vertical-align: middle;"></i>
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
                            <span class="text-white">GESTION DE USUARIOS</span>
                        </div>
                    </div>
                </a>
                @endcan
                <ul class="collapse list-unstyled text-white text-lg" id="homeSubmenuUser">
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('roles') }}">ROLES</a>
                        <i class="fa fa-street-view fa-1x text-muted  pl-5" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('permisos') }}">PERMISOS</a>
                        <i class="fa fa-unlock-alt fa-1x text-muted pl-4" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('asignar') }}">ASIGNAR</a>
                        <i class="fa fa-check-square fa-1x text-muted pl-4" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-white text-left" href="{{ url('users') }}">USUARIOS</a>
                        <i class="fa fa-user fa-1x text-muted pl-3" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </nav>
</div>




