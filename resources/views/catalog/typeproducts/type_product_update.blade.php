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
        <h1 class="h3 mb-0 text-gray-800">Actualizar Producto</h1>
    </div>      

       
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Nuevos datos del Producto</h6>
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
                    <input type="text" class="form-control" id="inputName" v-model="name_type" aria-describedby="nameHelp" placeholder="Nombre del Producto">
                      </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion</label>
                                    <input type="text" class="form-control" id="inputName" v-model="description_type" aria-describedby="nameHelp" placeholder="Nombre del Producto">
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
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Atributos a este Tipo de Producto</h6>
                    <p>Un tipo de producto por ejemplo "Vehiculo", posee distintos atributos por ejemplo "Tipo de Motor"</p>
                    </div>
                  
                </div>
                    
                    
                </div>
                <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                        <label for="exampleFormControlSelect1">Atributo</label>
                                        <v-select :options="attributes" label="name" v-model="attribute"></v-select>
                                    </div>
                        </div>
                        <div class="col-md-6">
                                <ul class="list-group">
                                        <li class="list-group-item" v-for="attributetype in attributetypes">
                                        <div class="row">
                                        <div class="col-md-7">
                                        @{{attributetype.attribute.name}}
                                        </div>
                                        <div class="col-md-2">
                                      
                                        </div>
                                        <div class="col-md-3" >                                 
                                            
                                                <a v-if="attributetype.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo" href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-success btn-circle">
                                                        <i class="fas fa-check"></i>
                                                        </a>
                                                        <a v-if="attributetype.active === 0" data-placement="top" title="Cambiar Estatus a Activo" href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-warning btn-circle">
                                                        <i class="fas fa-times"></i>
                                                        </a>
                                        <a href="#" v-on:click="trashRow(typeproduct.id)" data-placement="top" title="Eliminar" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                        </a>
                                        </div>
                                        </div>
                                        </li>
                    
                                    </ul>
                        </div>
                       
    
                    </div>
                  
                  
                  
                    <button v-on:click="addRow" type="button" class="btn btn-primary">Agregar Item</button>
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
                name_type:'',
                description_type:'',
                attribute:null,
                attributes:[],
                attributetypes:[],
                typeproduct:{},
                typeproduct:'',
                typeproducts: []
            }
        },
        mounted() {
           var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('typeproduct/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.typeproduct = response.data.data; 
                            this.name_type = this.typeproduct.name;
                            this.description_type = this.typeproduct.description;
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });
                loadElements('attribute', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.attributes = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });

                loadElements('typeproductattribute/filterby/id_type_product/'+idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.attributetypes = response.data.data; 
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
                                name: this.name_type,
                                description: this.description_type
                            }
                            var pageURL = window.location.href;
                            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
         
                            updateElement('typeproduct/'+idurl, form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typeproducts = response.data.data; 
                                           Swal.fire(
                                                'Elemento Actualizado',
                                                'La información se actualizo correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/typeproducts';
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
                var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
           
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
                                id_attribute: this.attribute.id,
                                id_type_product: idurl
                            }

                            saveElement('typeproductattribute', form).then(
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
                      
                       

                        changueElement('typeproductattribute/change/'+idelement, '').then(
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
                      
                       

                            trashElement('typeproductattribute/'+idelement, '').then(
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