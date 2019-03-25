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
        <h1 class="h3 mb-0 text-gray-800">Actualizar Textos</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Actualizar texto</h6>
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
                                        <input type="text" class="form-control" id="inputName" v-model="name_text"
                                            aria-describedby="nameHelp" placeholder="Nombre del texto">
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleFormControlSelect1">Seccion</label>
                                            <v-select :options="sections" label="title" v-model="section"></v-select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Valor en Español</label>
                                                <input type="text" class="form-control" id="inputName" v-model="value_es"
                                                    aria-describedby="nameHelp" placeholder="Indica el valor">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Valor en Inglés</label>
                                                    <input type="text" class="form-control" id="inputName" v-model="value_en"
                                                        aria-describedby="nameHelp" placeholder="Indica el valor">
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
                name_text:'',
                value_en:'',
                value_es:'',
                section:'',
                sections:[],
                text:{},
                text:'',
                texts: []
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

           var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('text/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.text = response.data.data; 
                            this.name_text = this.text.name;
                            this.value_en = this.text.value_en;
                            this.value_es = this.text.value_es;
                            this.section = this.text.section;
                           
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
                            name: this.name_text,
                            value_es:this.value_es,
                            value_en:this.value_en,
                            id_section:this.section.id                         

                        }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('text/'+idurl, form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.texts = response.data.data; 
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