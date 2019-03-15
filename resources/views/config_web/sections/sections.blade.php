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
        <h1 class="h3 mb-0 text-gray-800">Secciones</h1>
    </div>



    <p class="mb-4">En esta lista puedes visualizar todas las secciones del sitio web que existen actualmente </p>
   
       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Secciones</h6>
                </div>
                <div class="col-md-4">
                <a href="sections/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nueva Seccion</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="section in sections">
                    <div class="row">
                    <div class="col-md-6">
                    @{{section.title}}
                    </div>
                    <div class="col-md-4">
                   
                    </div>
                    <div class="col-md-2">
                    <a href="#" v-on:click="updateRow(section.id)" class="btn btn-primary btn-circle">
                    <i class="fas fa-edit"></i>
                    </a>

                    <a v-if="section.active === 1" href="#" v-on:click="checkRow(section.id)" class="btn btn-success btn-circle">
                    <i class="fas fa-check"></i>
                    </a>
                    <a v-if="section.active === 0" href="#" v-on:click="checkRow(section.id)" class="btn btn-warning btn-circle">
                    <i class="fas fa-times"></i>
                    </a>
                    <a href="#" v-on:click="trashRow(section.id)" class="btn btn-danger btn-circle">
                    <i class="fas fa-trash"></i>
                    </a>
                    </div>
                    </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>
   
    <!-- /.container-fluid -->



</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<!-- Additional Scripts -->
 <script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                sections: {},
            }
        },
        mounted() {
            loadElements('section', '').then(
                    response => {
                        if (response.data.code !== 500) {

                            console.log(response.data.data)
                            this.sections = response.data.data;
                            console.log(this.sections);

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })



        },
        methods: {
            back() {

            },
            editSubmit() {

            },
            trashRow(idelement){
                console.log(idelement);
                Swal.fire({
                    title: 'Estas seguro de eliminar el elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                    }).then((result) => {
                    if (result.value) {
                      
                       

                            trashElement('section/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typesections = response.data.data; 
                                           Swal.fire(
                                                'Elemento Eliminado',
                                                'Elemento eliminado correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.reload();
                                                });
                                               
                                            
                                        } else {
                                            console.log(response.data);
                                        }
                                    })
                                .catch(error => {
                                    console.log(error);
                                });

                    }
                    })
            },
            checkRow(idelement){
                console.log(idelement);
                Swal.fire({
                    title: 'Estas seguro de cambiar el estatus del elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                    }).then((result) => {
                    if (result.value) {
                      
                       

                        changueElement('section/change/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typesections = response.data.data; 
                                           Swal.fire(
                                                'Estatus Cambiado',
                                                'Estatus modificado correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.reload();
                                                });
                                               
                                            
                                        } else {
                                            console.log(response.data);
                                        }
                                    })
                                .catch(error => {
                                    console.log(error);
                                });

                    }
                    })
            },
            updateRow(idelement)
            {
                window.location.href = 'sections/update/'+idelement;
            },
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>