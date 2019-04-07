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
        <h1 class="h3 mb-0 text-gray-800">Actualizar Estatus del comentario</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Cambio en el estado del estatus</h6>
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
                    <label for="exampleInputEmail1">Comentario</label>
                    <input type="text" class="form-control" id="inputName" v-model="coment" aria-describedby="nameHelp" placeholder="Comentario" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Post</label>
                                <v-select :options="posts" label="title" v-model="post" disabled></v-select>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleFormControlSelect1">Estado</label>
                            <select v-model="status">
                                <option value=0>Pendiente de revisión</option>
                                <option value=1>Aprobar</option>
                                <option value=2>Marcar como spam</option>
                                <option value=3>Mover a papelera</option>
                            </select>
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
                coment: '',
                status:'',
                coments:{},
                post:'',
                posts: []
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
           var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('coment/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.comment = response.data.data; 
                            this.coment = this.comment.coment;
                            this.post = this.comment.post;
                            this.status = this.comment.status_coment;
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
                                status_coment: this.status
                            }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('coment/'+idurl, form).then(
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