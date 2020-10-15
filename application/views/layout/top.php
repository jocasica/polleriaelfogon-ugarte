<!DOCTYPE html>
<html dir="ltr" lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>panel/assets/images/favicon.png">
    <title>Pollería el Fogon</title>
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>panel/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>panel/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Start of  Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=5d000902-f89e-4047-aaa8-484bf10ae0be"> </script>
    <!-- End of  Zendesk Widget script -->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="menu">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url() ?>images/solo-logo.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url() ?>images/solo-logo.png" alt="homepage" class="light-logo" />

                        </b>

                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text" style="">
                            <!-- dark Logo text -->
                            <img src="<?= base_url() ?>images/solo-texto.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="<?= base_url() ?>images/solo-texto.png" class="light-logo" alt="homepage" />

                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url() ?>panel/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)" hidden><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Cerrar Sesión</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic"><img src="<?= base_url('') ?>panel/assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium"><?php echo($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name) ?></h5>
                                        <span class="op-5 user-email"><?php echo($this->ion_auth->user()->row()->email) ?></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd" hidden>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                        
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <!--li class="p-15 m-t-10"><a href="javascript:void(0)" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-plus-square"></i> <span class="hide-menu m-l-5">Create New</span> </a></li-->
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('venta') ?>" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">VENTAS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('reportes') ?>" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">REPORTES</span></a></li>
                        <?php if ($this->ion_auth->in_group(1)){?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('compra') ?>" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">COMPRAS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('item') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">ITEMS</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('producto/menu') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">PRODUCTOS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('insumo') ?>" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">INSUMOS</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('auth') ?>" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">USUARIOS</span></a></li>
                        
                        <li class="text-center p-40 upgrade-btn">
                        <?php }?>
                        </li>
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <!-- Tomar desde page-wraper-->