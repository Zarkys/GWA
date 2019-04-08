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
        <h1 class="h3 mb-0 text-gray-800">Agregar un Nuevo producto</h1>
    </div>      

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Agregar Producto</h6>
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
                    <input type="text" class="form-control" id="inputName" v-model="name_product" aria-describedby="nameHelp" placeholder="Nombre del Producto">
                    <small id="emailHelp" class="form-text text-muted">Sera el nombre mostrado en el titulo del producto</small>
                </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea  rows="4" cols="50" type="text" class="form-control" id="inputDescription" v-model="description_product" aria-describedby="nameHelp" placeholder="Agregar descripcion del producto"></textarea>
                     </div>
                     </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de Producto</label>
                        <v-select :options="typeproducts" label="name" v-model="typeproduct"></v-select>
                    </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoría de Producto</label>
                        <v-select :options="categoriesforproducts" label="name" v-model="categoryforproduct"></v-select>
                    </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="text" class="form-control" id="inputPrice" v-model="price_product" aria-describedby="nameHelp" placeholder="Precio del Producto">
                    <small id="emailHelp" class="form-text text-muted">Sera el precio principal del producto</small>
                </div>
                    </div>
                     <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Precio de Descuento</label>
                    <input type="text" class="form-control" id="inputPriceDiscount" v-model="price_discount_product" aria-describedby="nameHelp" placeholder="Precio  de descuento del Producto">
                    <small id="emailHelp" class="form-text text-muted">Sera el precio con descuento del producto</small>
                </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                            <label for="exampleFormControlSelect1">Mostrar precio :</label>
                            <select v-model="show_price_product">
                                <option value=1>Si</option>
                                <option value=2>No</option>
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
                message: '',
                name_product:'',
                description_product:'',
                products: {},
                typeproduct:'',
                typeproducts: [],
                categoryforproduct:'',
                categoriesforproducts: [],
                price_product:'',
                price_discount_product:'',
                show_price_product:''
            }
        },
        mounted() {
               

                loadElements('typeproduct', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.typeproducts = response.data.data; 
                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });

                loadElements('categoryforproduct', '').then(
                    response => {
                        if (response.data.code !== 500) {                          
                            this.categoriesforproducts = response.data.data; 
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
                                name: this.name_product,
                                description: this.description_product,
                                id_type_product: this.typeproduct.id,
                                id_category_for_product: this.categoryforproduct.id,
                                price: this.price_product,
                                price_discount: this.price_discount_product,
                                show_price: this.show_price_product

                            }

                            saveElement('product', form).then(
                                    response => {
                                        if (response.data.code !== 500) {                          
                                           // this.typeproducts = response.data.data; 
                                           Swal.fire(
                                                'Elemento Guardado',
                                                'La información se almaceno correctamente',
                                                'success'
                                                ).then((result) => {
                                                    window.location.href = '/goadmin/products';
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