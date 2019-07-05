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
        <h1 class="h3 mb-0 text-gray-800">Textos del Website</h1>
    </div>



    <p class="mb-4">En esta lista puedes visualizar todas los textos del sitio web que existen actualmente </p>
   
       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Textos</h6>
                </div>
                <div class="col-md-4">
                      
                <a href="texts/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nuevo Texto</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
                    <div class="row">
                            <div class="col-md-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filtrar por Seccion</h6>
                           
                            </div>
                            <div class="col-md-3">
                                   <v-select :options="sections" label="title" v-model="section" @@input="onChange"></v-select>
                            </div>
                            <div class="col-md-3">
                                    
                           
                            </div>
                        </div>
                        <br>
                    <ul class="list-group">
                            <li class="list-group-item">
                            <div class="row">
                            <div class="col-md-2">
                            <strong>Nombre</strong>
                            </div>
                            <div class="col-md-3">
                                    <strong>Espanol</strong>
                                    </div>
                                    <div class="col-md-3">
                                           <strong>Ingles</strong>
                                            </div>
                            <div class="col-md-2">
                              <strong>Seccion</strong>
                            </div>
                            <div class="col-md-2">
                          
                            </div>
                            </div>
                            </li>
        
                        </ul>
                <ul class="list-group">
                    <li class="list-group-item" v-for="text in texts">
                    <div class="row">
                    <div class="col-md-2">
                    @{{text.name}}
                    </div>
                    <div class="col-md-3" style="font-size:12px">
                            @{{text.value_es}}
                            </div>
                            <div class="col-md-3" style="font-size:12px">
                                    @{{text.value_en}}
                                    </div>
                    <div class="col-md-2">
                        @{{text.section.title}}
                    </div>
                    <div class="col-md-2">
                    <a href="#" v-on:click="updateRow(text.id)" class="btn btn-primary btn-circle">
                    <i class="fas fa-edit"></i>
                    </a>

                    <a v-if="text.active === 1" href="#" v-on:click="checkRow(text.id)" class="btn btn-success btn-circle">
                    <i class="fas fa-check"></i>
                    </a>
                    <a v-if="text.active === 0" href="#" v-on:click="checkRow(text.id)" class="btn btn-warning btn-circle">
                    <i class="fas fa-times"></i>
                    </a>
                    @if(Auth::user()->rol===2)
                    <a href="#" v-on:click="trashRow(text.id)" class="btn btn-danger btn-circle">
                    <i class="fas fa-trash"></i>
                    </a>
                    @endif
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
                texts: {},
                sections:[],
                section:''
            }
        },
        mounted() {
            loadElements('section', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.sections = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });

            loadElements('text', '').then(
                    response => {
                        if (response.data.code !== 500) {

                            
                            this.texts = response.data.data;
                         

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })



        },
        methods: {
            onChange () {                
                loadElements('text/filterbysection/'+this.section.id, '').then(
                    response => {
                        if (response.data.code !== 500) {

                            
                            this.texts = response.data.data;
                         

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })
                },
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
                      
                       

                            trashElement('text/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetexts = response.data.data; 
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
                      
                       

                        changueElement('text/change/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetexts = response.data.data; 
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
                window.location.href = 'texts/update/'+idelement;
            },
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>