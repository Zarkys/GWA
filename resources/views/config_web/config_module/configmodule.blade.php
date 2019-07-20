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
            <h1 class="h3 mb-0 text-gray-800">Actualizar Configuraciones de modulos para la Web</h1>
        </div>



        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary">Configuraciones de Modulos de GWA</h6>
                        <p>Indica los valores que deseas modificar</p>
                    </div>

                </div>


            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">


                            <ul class="list-group">
                                <li class="list-group-item" v-for="config in config_module">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>@{{config.name_module}}</h4>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <div class="form-group">
                                <v-select :options="statusArray" label="name" v-model="status"></v-select>
                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button v-on:click="updateConfigModule(config)" type="button" class="btn btn-primary">Actualizar</button>
                                           <!--   <a v-if="attributetype.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo"
                                                href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-success btn-circle">
                                                <i class="fas fa-check"></i>
                                            </a>
                                           <a v-if="attributetype.active === 0" data-placement="top" title="Cambiar Estatus a Activo"
                                                href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-warning btn-circle">
                                                <i class="fas fa-times"></i>
                                            </a>
                                           <a href="#" v-on:click="trashRow(typeproduct.id)" data-placement="top"
                                                title="Eliminar" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a> -->
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-6">

                        </div>


                    </div>



                    
                </form>
            </div>
        </div>

    </div>

</div>

<!-- /.container-fluid -->



<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<!-- Additional Scripts -->
 <script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>

<script src="{{ asset('/js/axios.js') }}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<!--<script src="https://unpkg.com/vue-select@latest"></script>-->
<script src="{{ asset('/js/vue-select.js') }}"></script>
<!-- Custom page Script -->
<script>
    Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                config_module:{},
                status: {'id': 0, 'name': 'Desactivado'},
                statusArray: [],
            }
        },
        mounted() {
          
            loadOneElement('configmodule', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            this.config_module = response.data.data;
                        }
                     else {
                            console.log(response.data);
                        }  
                         
                    })
                .catch(error => {
                    console.log(error);
                });

              RouteGet_BACK('componentmodule/list', {}).then(
                response => {
                    if (response.data.code !== 500) {
                        this.statusArray = response.data.arrayStatus;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
               var form = {
                'id': 1
            }
               

            loadOneElement('configmodule/2', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            this.status = response.data.data.status;
                            console.log(this.status);
                        }
                     else {
                            console.log(response.data);
                        }  
                         
                    })
                .catch(error => {
                    console.log(error);
                });


        },
        methods: {
            back() {

            },
            updateConfigModule(config) {
                Swal.fire({
                    title: 'Estas seguro de actualizar las configuraciones de la Web?',
                    text: "Este cambio puede afectar el buen funcionamiento del website, sea cuidadoso",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                }).then((result) => {
                    if (result.value) {
                       let form = {
                                status: this.status.id
                            }
               

                        updateElement('configmodule/'+config.id, form).then(
                                response => {
                                    if (response.data.code !== 500) {
                                         
                                        Swal.fire(
                                            'Elemento Actualizado',
                                            'La información se actualizo correctamente',
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
            updateRow() {
                Swal.fire({
                    title: 'Estas seguro de actualizar el elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            name: this.name_product,
                            id_type_product: this.typeproduct.id
                        }
                        var pageURL = window.location.href;
                        var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);

                        updateElement('product/' + idurl, form).then(
                                response => {
                                    if (response.data.code !== 500) {
                                        // this.typeproducts = response.data.data; 
                                        Swal.fire(
                                            'Elemento Actualizado',
                                            'La información se actualizo correctamente',
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
            cleanform() {

            },
            defaultSelect() {
                if (this.status === null) {
                    this.status = {'id': 0, 'name': 'Desactivado'}
                }
            }

        },
        computed: {

        },
    })
</script>