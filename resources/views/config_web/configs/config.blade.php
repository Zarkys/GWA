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
            <h1 class="h3 mb-0 text-gray-800">Actualizar Configuraciones de la Web</h1>
        </div>



        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary">Caracteristicas del Producto</h6>
                        <p>Indica los valores que deseas mostrar del producto</p>
                    </div>

                </div>


            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">


                            <ul class="list-group">
                                <li class="list-group-item" v-for="config in config_web">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @{{config.name_config}}
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputName" v-model="config.value"
                                                    aria-describedby="nameHelp" placeholder="Nombre del Producto">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button v-on:click="updateConfigWeb(config)" type="button" class="btn btn-primary">Actualizar</button>
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{ asset('/js/axios.js') }}"></script>
<script src="https://unpkg.com/vue-select@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Custom page Script -->
<script>
    Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                name_product: '',
                product: {},
                attributetypes: [],
                attributetype: {},
                config_web:{},
                typeproduct: '',
                typeproducts: []
            }
        },
        mounted() {
          
            loadOneElement('configweb', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            this.config_web = response.data.data;
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
            updateConfigWeb(config) {
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
                       
               

                        updateElement('configweb/'+config.id, config).then(
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

            }

        },
        computed: {

        },
    })
</script>