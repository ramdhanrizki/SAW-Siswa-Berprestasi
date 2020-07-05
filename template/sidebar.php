<!--sidebar Begins-->
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <img class="admin-brand-logo" src="assets/img/logo.png" width="40" alt="atmos Logo">
        <span class="admin-brand-content"><a href="index.html">SMA YADIKA 3</a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <!-- Menu List Begins-->
        <ul class="menu">
            <!--list item begins-->
            <li class="menu-item <?=@$_GET['p']=='dashboard' || !$_GET['p']?'active':''?>">
                <a href="index.php?p=dashboard" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Dashboard
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi mdi-desktop-mac-dashboard"></i>
                    </span>
                </a>
            </li>

            <li class="menu-item <?=@$_GET['p']=='siswa'?'active':''?>">
                <a href="index.php?p=siswa" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Data Siswa
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-file-document-box-outline"></i>
                    </span>
                </a>
            </li>

            <li class="menu-item <?=@$_GET['p']=='ranking'?'active':''?>">
                <a href="index.php?p=ranking" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Perangkingan
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-chart-bar"></i>
                    </span>
                </a>
            </li>
            <!--list item ends-->
        </ul>
        <!-- Menu List Ends-->
    </div>

</aside>
<!--sidebar Ends-->