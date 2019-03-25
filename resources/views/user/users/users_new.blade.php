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
        <h1 class="h3 mb-0 text-gray-800">Agregar un Usuario</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Agregar Usuario</h6>
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
                    <input type="text" class="form-control" id="inputName" v-model="name_type" aria-describedby="nameHelp" placeholder="Nombre de usuario">
                     </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" v-model="email_type" aria-describedby="nameHelp" placeholder="Email de usuario">
                                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Rol</label>
                        <v-select :options="roles" label="name" v-model="rol"></v-select>
                    </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" class="form-control" id="inputPassword" v-model="password_type" aria-describedby="nameHelp" placeholder="Password">
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
                message: '',
                name_type:'',
                email_type:'',
                password_type:'',
                posts: {},
                rol:'',
                roles: []
            }
        },
        mounted() {            

             loadElements('rol', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.roles = response.data.data; 
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
                                name: this.name_type,
                                email: this.email_type,
                                password: this.password_type,
                                rol: this.rol.id
                            }

                            saveElement('user', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.attributes = response.data.data; 
                                           Swal.fire(
                                                'Elemento Guardado',
                                                'La información se almaceno correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/goadmin/users';
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