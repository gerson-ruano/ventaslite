<div class="container d-print-none">
    <div class="header">
        <!-- Contenido del menú en la parte superior -->
        <ul class="menu-categories">
            @can('Ventas_Index')
            <li class="menu-item">
                <a href="{{ url('pos') }}">
                    <span>VENTA</span>
                </a>
            </li>
            @endcan
            @can('Report_Index')
            <li class="mt-0">
                <a href="#homeSubmenuStock2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="text-dark">GESTION STOKS</span>
                </a>
                @endcan
                <ul class="collapse list-unstyled text-dark text-lg mt-2" id="homeSubmenuStock2">
                    @can('Category_Index')
                    <li class="">
                        <a class="text-dark" href="{{url('categories')}}">CATEGORIAS</a>
                        <i class="fa fa-tags fa-1x text-muted" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Product_Index')
                    <li class="mt-2">
                        <a class="text-dark text-left" href="{{url('products')}}">PRODUCTOS</a>
                        <i class="fa fa-shopping-basket fa-1x text-muted" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Denominaciones_Index')
                    <li class="mt-2">
                        <a class="text-dark" href="{{url('coins')}}">MONEDAS</a>
                        <i class="far fa-money-bill-alt fa-1x text-muted pl-3" aria-hidden="true"
                            style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
            {{--@role('Admin')--}}
            <li class="mt-0">
                <a href="#homeSubmenuReport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="text-dark">REPORTERIA</span>
                </a>
                {{--@endcan--}}
                <ul class="collapse list-unstyled text-white text-lg" id="homeSubmenuReport">
                    @can('Cashout_Index')
                    <li class="mt-2">
                        <a class="text-left" href="{{ url('cashout') }}">CIERRE CAJA</a>
                        <i class="fas fa-cash-register fa-1x text-muted  pl-2" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @can('Report_Index')
                    <li class="mt-2">
                        <a class="text-left" href="{{ url('reports') }}">VENTAS</a>
                        <i class="fas fa-file-contract fa-1x text-muted pl-4" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    <li class="mt-2">
                        <a class="text-left" href="{{ url('graficas') }}">ESTADISTICA</a>
                        <i class="fas fa-chart-bar fa-1x text-muted pl-2" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
            @role('Admin')
            <li class="mt-0">
                <a href="#homeSubmenuUser2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="text-dark">GESTION USUARIOS</span>
                </a>
                <ul class="collapse list-unstyled text-white text-lg" id="homeSubmenuUser2">
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-dark text-left" href="{{ url('roles') }}">ROLES</a>
                        <i class="fa fa-street-view fa-1x text-muted  pl-5" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-dark text-left" href="{{ url('permisos') }}">PERMISOS</a>
                        <i class="fa fa-unlock-alt fa-1x text-muted pl-4" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-dark text-left" href="{{ url('asignar') }}">ASIGNAR</a>
                        <i class="fa fa-check-square fa-1x text-muted pl-4" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                    @role('Admin')
                    <li class="mt-2">
                        <a class="text-dark text-left" href="{{ url('users') }}">USUARIOS</a>
                        <i class="fa fa-user fa-1x text-muted pl-3" aria-hidden="true" style="vertical-align: middle;"></i>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>
