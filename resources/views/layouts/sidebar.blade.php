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
        <a class="nav-link" href="{{url('goadmin/home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    @if(Auth::user()->rol===2)
        <div class="sidebar-heading">
            Zona de Blog
        </div>
        <li class="nav-item">
            <a class="nav-link  @yield('blog_menu')" href="#" data-toggle="collapse" data-target="#collapseBlog"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Blog</span>
            </a>
            <div id="collapseBlog" class="collapse @yield('blog_submenu')" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('blog.post.list')}}">Entrada</a>
                    @if(Auth::user()->rol===2)
                        <a class="collapse-item" href="{{route('blog.category.list')}}">Categoría</a>
                        <a class="collapse-item" href="{{route('blog.tag.list')}}">Etiqueta</a>
                        <a class="collapse-item" href="{{route('blog.comment.list')}}">Comentarios</a>
                    @endif
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Zona de Medios
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedios"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-film"></i>
                <span>Medios</span>
            </a>
            <div id="collapseMedios" class="collapse" aria-labelledby="headingPages"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if(Auth::user()->rol===2)
{{--                        <a class="collapse-item" href="{{url('goadmin/library')}}">Biblioteca</a>--}}
{{--                        <a class="collapse-item" href="{{url('goadmin/archive')}}">Agregar archivo</a>--}}
                        <a class="collapse-item" href="{{route('library.archive.list')}}">Biblioteca</a>
                        <a class="collapse-item" href="{{route('records.archive.create')}}">Agregar archivo</a>
{{--                        <a class="collapse-item" href="{{url('goadmin/archive_folder')}}">Archivos en Carpeta</a>--}}
                    @endif
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Zona Catálogo
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatalog"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Catálogo</span>
            </a>
            <div id="collapseCatalog" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{route('product.list')}}">Producto</a>
                    <a class="collapse-item" href="{{route('product.category.list')}}">Categoría</a>
                    <a class="collapse-item" href="{{route('product.type.list')}}">Tipo</a>
                    <a class="collapse-item" href="{{route('product.currency.list')}}">Monedas</a>

                    {{--<a class="collapse-item" href="{{url('goadmin/products')}}">Productos</a>--}}
                    {{--@if(Auth::user()->rol===2)--}}
                    {{--<a class="collapse-item" href="{{url('goadmin/typeproducts')}}">Tipos de Producto</a>--}}
                    {{--<a class="collapse-item" href="{{url('goadmin/attributes')}}">Atributos</a>--}}
                    {{--<a class="collapse-item" href="{{url('goadmin/categoriesforproducts')}}">Categoría de--}}
                    {{--Producto</a>--}}
                    {{--@endif--}}
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
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
    @endif
<!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Zona de Website
    </div>
    @if(Auth::user()->rol===2)
        <li class="nav-item">
            <a class="nav-link" href="{{route('website.section.list')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Secciones</span></a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{route('website.text.list')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Textos</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('goadmin/contacts')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Contactos</span></a>
    </li>
   <!-- @if(Auth::user()->rol===2)
        <li class="nav-item">
            <a class="nav-link" href="{{url('goadmin/config')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Configuracion</span></a>
        </li>
    @endif-->


<!-- Divider -->

    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Pages Collapse Menu -->
    @if(Auth::user()->rol===2)
        <div class="sidebar-heading">
            Configuraciones
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{url('goadmin/config')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Configuracion</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('goadmin/config_module')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Modulos</span></a>
        </li>
@endif
<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Pages Collapse Menu -->
    @if(Auth::user()->rol===2)
        <div class="sidebar-heading">
            Sistema
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-user"></i>
                <span>Usuario</span>
            </a>
            <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">


                    <a class="collapse-item" href="{{url('goadmin/users')}}">Usuario</a>

                </div>
            </div>
        </li>
@endif


<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">