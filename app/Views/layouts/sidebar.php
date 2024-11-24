<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= route_to('/') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-wifi"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Megavision <sup>S</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= (uri_string() == '' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= route_to('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>

    <!-- Nav Item - Employee -->
    <li class="nav-item <?= (uri_string() == 'employee' ? 'active' : '') ?>">
        <a class=" nav-link" href="<?= route_to('employee') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Employee</span></a>
    </li>

    <!-- Nav Item - Item -->
    <li class="nav-item <?= (uri_string() == 'item' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= route_to('item') ?>">
            <i class="fas fa-fw fa-box"></i>
            <span>Item</span></a>
    </li>

    <!-- Nav Item - Sales -->
    <li class="nav-item <?= (uri_string() == 'sales' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= route_to('sales') ?>">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Sales</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ADDON
    </div>

    <!-- Nav Item - API -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAPI"
            aria-expanded="true" aria-controls="collapseAPI">
            <i class="fas fa-fw fa-paper-plane"></i>
            <span>APIs</span></a>
        </a>
        <div id="collapseAPI" class="collapse" aria-labelledby="headingAPI" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item genereteAPIKeys" href="#">Generate New Key</a>
                <a class="collapse-item seeAPIKeys" href="#">See Current Key</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>