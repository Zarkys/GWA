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
        <h1 class="h3 mb-0 text-gray-800">Tipos de Producto</h1>
    </div>



    <p class="mb-4">En esta lista puedes visualizar todos los tipos de productos que existen actualmente </p>
   
       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Tipos Productos</h6>
                </div>
                <div class="col-md-4">
                <a href="/goadmin/typeproducts/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nuevo Tipo de Producto</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
             <ul class="list-group">
                            <li class="list-group-item">
                            <div class="row">
                            <div class="col-md-6">
                             <strong>Nombre</strong>
                            </div>
                            <div class="col-md-4">
                             <strong>Descripción</strong>
                            </div>
                            <div class="col-md-2">
                          
                            </div>
                            </div>
                            </li>
        
                        </ul>
                <ul class="list-group">
                    <li class="list-group-item" v-for="typeproduct in typeproducts">
                    <div class="row">
                    <div class="col-md-6">
                    @{{typeproduct.name}}
                    </div>
                    <div class="col-md-4">
                    @{{typeproduct.description}}
                    </div>
                    <div class="col-md-2" >
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Actualizar" v-on:click="updateRow(typeproduct.id)" class="btn btn-primary btn-circle">
                    <i class="fas fa-edit"></i>
                    </a>

                    <a v-if="typeproduct.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo" href="#" v-on:click="checkRow(typeproduct.id)" class="btn btn-success btn-circle">
                    <i class="fas fa-check"></i>
                    </a>
                    <a v-if="typeproduct.active === 0" data-placement="top" title="Cambiar Estatus a Activo" href="#" v-on:click="checkRow(typeproduct.id)" class="btn btn-warning btn-circle">
                    <i class="fas fa-times"></i>
                    </a>
                    <a href="#" v-on:click="trashRow(typeproduct.id)" data-placement="top" title="Eliminar" class="btn btn-danger btn-circle">
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
                typeproducts: {},
            }
        },
        mounted() {
            loadElements('typeproduct', '').then(
                    response => {
                        if (response.data.code !== 500) {

                            console.log(response.data.data)
                            this.typeproducts = response.data.data;
                            console.log(this.typeproducts);

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
                      
                       

                            trashElement('typeproduct/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetypeproducts = response.data.data; 
                                           Swal.fire(
                                                'Elemento Eliminado',
                                                'Elemento eliminado correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = 'typeproducts';
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
                      
                       

                        changueElement('typeproduct/change/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetypeproducts = response.data.data; 
                                           Swal.fire(
                                                'Estatus Cambiado',
                                                'Estatus modificado correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = 'typeproducts';
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
                window.location.href = '/goadmin/typeproducts/update/'+idelement;
            },
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>