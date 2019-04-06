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
        <h1 class="h3 mb-0 text-gray-800">Agregar un comentario</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Agregar un comentario</h6>
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
                        <label for="exampleFormControlSelect1">Post</label>
                        <v-select :options="posts" label="title" v-model="post"></v-select>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Comentario ha responder</label>
                        <v-select :options="comentsposts" label="coment" v-model="comentpost"></v-select>
                        <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                             <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="comentanswer" aria-describedby="nameHelp" placeholder="Comentario ha responder"></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Comentario</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputLegend" v-model="coment" aria-describedby="nameHelp" placeholder="Agregar un comentario"></textarea>
                     </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="exampleFormControlSelect1">Publicación</label>
                            <vuejs-datepicker v-model="datepublication" name="fecha"></vuejs-datepicker>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="exampleFormControlSelect1">Estatus</label>
                            <select v-model="status">
                                <option value=1>Borrador</option>
                                <option value=2>Pendiente de revisión</option>
                            </select>
                        </div>
                    </div>
                   

                </div>
              
              
              
                <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
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
                coment:'',
                comments: {},
                post:'',
                posts: [],
                comentpost:'',
                comentsposts: []
            }
        },
        mounted() {  

         loadElements('post', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.posts = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                }); 
         loadElements('coment/filterby/id_post/'+1, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.comentsposts = response.data.data; 
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
            saveRow() {
                Swal.fire({
                    title: 'Estas seguro de guardar el elemento?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Guardar'
                    }).then((result) => {
                    if (result.value) {
                        let form = {
                                id_post: this.post.id,
                                id_answer_to: this.comentpost.id,
                                coment: this.coment,
                                status_coment: this.status.id
                            }

                            saveElement('category', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
                                           Swal.fire(
                                                'Elemento Guardado',
                                                'La información se almaceno correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/goadmin/categories';
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