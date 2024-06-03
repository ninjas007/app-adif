<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ config('app.app_name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">{{ config('app.short_app_name') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'adif' ? 'active' : '' }}">
                <a href="{{ url('/adif') }}"
                    class="nav-link"><i class="fas fa-file"></i><span>Adif</span></a>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'profile' ? 'active' : '' }}">
                <a href="{{ url('profile') }}"
                    class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'award' ? 'active' : '' }}">
                <a href="{{ url('award') }}"
                    class="nav-link"><i class="fas fa-certificate"></i><span>Award</span></a>
                </ul>
            </li>
        </ul>
    </aside>
</div>
