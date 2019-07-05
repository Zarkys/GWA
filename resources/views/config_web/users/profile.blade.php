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
    <h1 class="h3 mb-0 text-gray-800">Actualizar Perfil del usuario: {{Auth::User()->name}}</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Nuevos datos del usuario</h6>
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
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="inputName" v-model="name_user" aria-describedby="nameHelp" placeholder="Nombre del Usuario">
                      </div>
                      <button v-on:click="updateName" type="button" class="btn btn-primary">Actualizar Nombre</button>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Contrasena Antigua</label>
                                   <input type="text" class="form-control" id="inputName" v-model="old_password" aria-describedby="nameHelp" placeholder="">
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Contrasena nueva</label>
                                   <input type="text" class="form-control" id="inputName" v-model="new_password" aria-describedby="nameHelp" placeholder="">
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Repita nueva contrasena</label>
                                   <input type="text" class="form-control" id="inputName" v-model="new_password2" aria-describedby="nameHelp" placeholder="">
                            </div>
                            <br>
                            <button v-on:click="updatePassword" type="button" class="btn btn-primary">Actualizar Contraseña</button>
                    </div>
                   

                </div>
              
              
              
               
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
                name_user:'',
                old_password:'',
                new_password:'',
                new_password2:'',
                attribute:{},
                attribute:'',
                attributes: []
            }
        },
        mounted() {
           var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('user/get_user/', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.name_user = response.data.data.name; 
                          
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
            updateName() {
                Swal.fire({
                    title: 'Estas seguro de actualizar el nombre del usuario?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                    }).then((result) => {
                    if (result.value) {
                        let form = {
                                name: this.name_user,                                
                            }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('user/update_name', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
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
            updatePassword() {
                Swal.fire({
                    title: 'Estas seguro de actualizar el nombre del usuario?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                    }).then((result) => {
                    if (result.value) {
                        let form = {
                                old_password: this.old_password,   
                                new_password: this.new_password, 
                                confirm_password: this.new_password2,                               
                            }
                         
         
                            updateElement('user/update_password', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
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

        },
        computed: {

        },
    })
</script>