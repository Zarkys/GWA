@include('layouts.header')
<!-- Custom styles for this page -->


@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Acerca de GWA</h1>
    </div>


    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                    <p class="mb-4">GWA es un administrador web creado para que usted pueda administrar su sitio web de la manera más sencilla posible.</p>
   
                    <h2 class="h3 mb-0 text-gray-800">Usted tiene instalado la versión 1.0</h2>
                    <br>
                    <p class="mb-4">Progresivamente vamos añadiendo nuevas funciones a GWA para que la administración de web sea más completa,
                        recomendamos que semestralmente solicite al equipo de desarrollo la incorporación de actualizaciones en su sitio web,
                        esta buena práctica le asegura que su sitio web se mantenga actualizado y mucho más seguro. </p>
                        <br>
                        <p> La implementación de actualizaciones puede mejorar el perfomance de su sitio web y puede acarrear costos adicionales</p>
                    </div>
                    <div class="col-md-4">
                            <img class="d-block w-100" src="{{ asset('img/guruvslogo.jpg')}}" alt="Third slide">
                    </div>
                </div>
                      
            </div>
    </div>
  

    </div>
   
    <!-- /.container-fluid -->



</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

