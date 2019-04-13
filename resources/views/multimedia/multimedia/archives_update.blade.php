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
        <h1 class="h3 mb-0 text-gray-800">Actualizar Archivo</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Nuevos datos de archivo</h6>
                </div>
                <div class="col-md-4">
                <a href="{{ url()->previous() }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Volver</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de archivo</label>
                    <input type="text" class="form-control" id="inputName" v-model="name_type" aria-describedby="nameHelp" placeholder="Nombre del archivo" disabled>
                     </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo de archivo</label>
                                    <input type="text" class="form-control" id="inputTypeArchive" v-model="typearchive_type" aria-describedby="nameHelp" placeholder="Tipo de archivo" disabled>
                                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Fecha de creación</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="creationdate_type" aria-describedby="nameHelp" placeholder="Fecha de creación" disabled>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Tamaño del archivo</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="creationdate_type" aria-describedby="nameHelp" placeholder="Tamaño del archivo" disabled>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Dimensiones</label>
                    <input type="text" class="form-control" id="inputCreationDate" v-model="dimension_type" aria-describedby="nameHelp" placeholder="Dimension del archivo" disabled>
                     </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" class="form-control" id="inputUrl" v-model="url_type" aria-describedby="nameHelp" placeholder="Url">
                     </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="inputTitle" v-model="title_type" aria-describedby="nameHelp" placeholder="Título del archivo">
                     </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Texto alternativo</label>
                    <input type="text" class="form-control" id="inputAlternativeText" v-model="alternativetext_type" aria-describedby="nameHelp" placeholder="Texto alternativo">
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Leyenda</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="legend_type" aria-describedby="nameHelp" placeholder="Leyenda del archivo"></textarea>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputDescription" v-model="description_type" aria-describedby="nameHelp" placeholder="Descripción del archivo"></textarea>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Subido por : </label>
                    <input type="text" class="form-control" id="inputUser" v-model="user_type" aria-describedby="nameHelp" placeholder="Usuario" disabled>
                     </div>
                    </div>
                   

                </div>
              
              
              
                <button v-on:click="updateRow" type="button" class="btn btn-primary">Actualizar</button>
                </form>
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

<script src="{{ asset('/js/axios.js') }}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="https://unpkg.com/vue-select@latest"></script>

<!-- Custom page Script -->
<script>
Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                name_type:'',
                typearchive_type:'',
                creationdate_type:'',
                size_type:'',
                dimension_type:'',
                url_type:'',
                title_type:'',
                legend_type:'',
                alternativetext_type:'',
                description_type:'',
                user_type:'',
                archive:{},
                archive:'',
                archives: []
            }
        },
        mounted() {

           var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('archive/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.archive = response.data.data; 
                            this.name_type = this.archive.name;
                            this.typearchive_type = this.archive.type;
                            this.creationdate_type = this.archive.creation_date;
                            this.size_type = this.archive.size;
                            this.dimension_type = this.archive.dimension;
                            this.url_type = this.archive.url;
                             this.title_type = this.archive.name;
                            this.tipearchive_type = this.archive.title;
                            this.legend_type = this.archive.legend;
                            this.alternativetext_type = this.archive.alternative_text;
                            this.description_type = this.archive.description;
                            this.user_type = this.archive.user;
                        } else {
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
                               /* name: this.name_type,
                                type_archive: this.typearchive_type,
                                creation_date: this.creationdate_type,
                                size: this.size_type,
                                dimension: this.dimension_type,*/
                                url: this.url_type,
                                title: this.title_type,
                                legend: this.legend_type,
                                alternative_text: this.alternativetext_type,
                                description: this.description_type,
                               // user: this.user_type,
                            }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('archive/'+idurl, form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
                                           Swal.fire(
                                                'Elemento Actualizado',
                                                'La información se actualizo correctamente',
                                                'success'
                                                ).then((result) => {
                                                   window.history.back();
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