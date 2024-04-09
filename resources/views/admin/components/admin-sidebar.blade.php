<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Master</li>
                <li>
                    <a href="{{ route('admin.category.index') }}" class="waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="menu-title">Pustaka</li>
                <li>
                    <a href="{{ route('admin.money.index') }}" class="waves-effect">
                        <i class="bx bx-money"></i>
                        <span>Money</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>