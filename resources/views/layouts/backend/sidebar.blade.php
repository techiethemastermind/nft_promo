<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <a href="#" class="sidebar-brand ">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid" />
                </span>
            </a>

            <!-- Sidebar Head -->
            <div class="sidebar-heading">Ethereum</div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Ethereum -->
                <li class="sidebar-menu-item {{ Request::is('ethereum/wallet') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('ethereum.wallet') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">spa</span>
                        <span class="sidebar-menu-text">Ethereum Wallet</span>
                    </a>
                </li>
            </ul>

            <!-- Setting Header -->
            <div class="sidebar-heading">Setting</div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ Request::is('price') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('price') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">attach_money</span>
                        <span class="sidebar-menu-text">Prices</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- // END drawer -->

@push('after-scripts')
<script>
    $(document).ready(function(){

        // Make parent menu active
        var active_menus = $('li.sidebar-menu-item.active');
        $.each(active_menus, function(idx, item){
            $(this).closest('ul.sidebar-submenu').parent().addClass('active open');
        });
    });
</script>
@endpush