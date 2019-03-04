   
   
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/goadmin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GWA</div>
       
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Zona de Blog
      </div>
      <li class="nav-item">
        <a class="nav-link" href="posts">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Entradas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Páginas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comments">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Comentarios</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
     
      </li>     

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Zona Catálogo
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatalog" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Catálogo</span>
        </a>
        <div id="collapseCatalog" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
          <a class="collapse-item" href="{{url('goadmin/products')}}">Productos</a>
            <a class="collapse-item" href="{{url('goadmin/typeproducts')}}">Tipos de Producto</a>
            <a class="collapse-item" href="{{url('goadmin/attributes')}}">Atributos</a>
           
          </div>
        </div>
      </li> 

      <div class="sidebar-heading">
        Zona de Websiite
      </div>
      <li class="nav-item">
          <a class="nav-link" href="{{url('goadmin/sections')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Secciones</span></a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('goadmin/texts')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Textos</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{url('goadmin/contacts')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Contactos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('goadmin/config')}}">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Configuracion</span></a>
          </li>

    

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

        <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar --> 