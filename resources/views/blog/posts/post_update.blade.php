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
        <h1 class="h3 mb-0 text-gray-800">Modificar una Entrada</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Modificar Entrada</h6>
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
                    <div class="col-md-8">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="inputName" v-model="title_type" aria-describedby="nameHelp" placeholder="Introduce el titulo aqui">
                     </div>
                     <div class="form-group">
                    <label for="exampleInputEmail1">Enlace Permanente</label>
                    <input type="text" class="form-control" id="inputName" v-model="permanent_link_type" aria-describedby="nameHelp" placeholder="Introduce el link permanente">
                     </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Contenido</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="content_type" aria-describedby="nameHelp" placeholder="Agregar el contenido"></textarea>
                     </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Estado</label>
                            <select v-model="status">
                                <option value=1>Borrador</option>
                                <option value=2>Pendiente de revisión</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Visibilidad</label>
                            <select v-model="visibility">
                                <option value=1>Público</option>
                                <option value=2>Privado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Publicación</label>
                            <vuejs-datepicker v-model="datepublication" name="fecha"></vuejs-datepicker>
                        </div>
                        
                    </div>
                    </div>
              
              
              
                <button v-on:click="updateRow" type="button" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">Etiquetas</h6>
                            <p>Agrega las etiquetas relacionadas a esta entrada</p>
                        </div>
                    </div>
                </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Etiquetas</label>
                                <v-select :options="tags" label="name" v-model="tag"></v-select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                            <li class="list-group-item" v-for="posttag in poststags">
                            <div class="row">
                                <div class="col-md-7">
                                    @{{posttag.tag.name}}
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3" >    
                                <a v-if="posttag.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo" href="#" v-on:click="checkRow(posttag.id)" class="btn btn-success btn-circle">
                                <i class="fas fa-check"></i>
                                </a>
                                <a v-if="posttag.active === 0" data-placement="top" title="Cambiar Estatus a Activo" href="#" v-on:click="checkRow(posttag.id)" class="btn btn-warning btn-circle">
                                <i class="fas fa-times"></i>
                                </a>
                                <a href="#" v-on:click="trashRow(post.id)" data-placement="top" title="Eliminar" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                                </a>
                                </div>
                            </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <button v-on:click="addRow" type="button" class="btn btn-primary">Agregar Etiqueta</button>
                </form>
            </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">Categoría</h6>
                            <p>Agrega las categorias relacionadas a esta entrada</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Categoría</label>
                                    <v-select :options="categories" label="name" v-model="category"></v-select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                <li class="list-group-item" v-for="postcategory in postscategories">
                                <div class="row">
                                    <div class="col-md-7">
                                    @{{postcategory.category.name}}
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3" >
                                    <a v-if="postcategory.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo" href="#" v-on:click="checkRow(postcategory.id)" class="btn btn-success btn-circle">
                                    <i class="fas fa-check"></i>
                                    </a>
                                    <a v-if="postcategory.active === 0" data-placement="top" title="Cambiar Estatus a Activo" href="#" v-on:click="checkRow(postcategory.id)" class="btn btn-warning btn-circle">
                                    <i class="fas fa-times"></i>
                                    </a>
                                    <a href="#" v-on:click="trashRow(post.id)" data-placement="top" title="Eliminar" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                    </div>
                                </div>
                                </li>
                                </ul>
                            </div>
                        </div>
                        <button v-on:click="addRow" type="button" class="btn btn-primary">Agregar Categoría</button>
                    </form>
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
<script src="https://unpkg.com/vuejs-datepicker"></script>

<!-- Custom page Script -->
<script>
Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        components: {
        vuejsDatepicker
    },
        data() {
            return {
                message: '',
                title_type:'',
                permanent_link_type:'',
                content_type:'',
                visibility:'',
                status:'',
                datepublication:'',
                tag:null,
                tags:[],
                poststags:[],
                category:null,
                categories:[],
                postscategories:[],
                post:{},
                post:'',
                posts: []
            }
        },
        mounted() { 
            var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('post/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.post = response.data.data; 
                            this.title_type = this.post.title;
                            this.permanent_link_type = this.post.permanent_link;
                            this.content_type = this.post.content;
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });
        loadElements('tag', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.tags = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });
                loadElements('category', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.categories = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });

                loadElements('posttag/filterby/id_post/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.tagsposts = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });
                loadElements('postcategory/filterby/id_post/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.postscategories = response.data.data; 
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
                                title: this.title_type,
                                permanent_link: this.permanent_link_type,
                                content: this.content_type,
                            }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('post/'+idurl, form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typeproducts = response.data.data; 
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
            addRow() {
               // var pageURL = window.location.href;
            //var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            var idurl = 3;
           
                Swal.fire({
                    title: 'Estas seguro de agregar este elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Agregar'
                    }).then((result) => {
                    if (result.value) {
                        let form = {
                                id_tag: this.tag.id,
                                id_post: idurl
                            }

                            saveElement('posttag', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typeproducts = response.data.data; 
                                           Swal.fire(
                                                'Elemento Agregado',
                                                'La información se almaceno correctamente',
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
                      
                       

                        changueElement('posttag/change/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetypeproducts = response.data.data; 
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
                      
                       

                            trashElement('posttag/'+idelement, '').then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typetypeproducts = response.data.data; 
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
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>