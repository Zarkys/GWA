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

        <!-- DataTales Example -->
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
                                <input type="text" class="form-control" id="inputName" v-model="name_product"
                                    aria-describedby="nameHelp" placeholder="Nombre del Producto">
                                <small id="emailHelp" class="form-text text-muted">Sera el nombre mostrado en el titulo
                                    del producto</small>
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



                    <button v-on:click="updateRow" type="button" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary">Caracteristicas del Producto</h6>
                        <p>Indica los valores que deseas mostrar del producto</p>
                    </div>

                </div>


            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">


                            <ul class="list-group">
                                <li class="list-group-item" v-for="attributetype in attributetypes">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @{{attributetype.attribute.name}}
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputName" v-model="attributetype.value"
                                                    aria-describedby="nameHelp" placeholder="Nombre del Producto">

                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                           <!--   <a v-if="attributetype.active === 1" data-placement="top" title="Cambiar Estatus a Inactivo"
                                                href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-success btn-circle">
                                                <i class="fas fa-check"></i>
                                            </a>
                                           <a v-if="attributetype.active === 0" data-placement="top" title="Cambiar Estatus a Activo"
                                                href="#" v-on:click="checkRow(attributetype.id)" class="btn btn-warning btn-circle">
                                                <i class="fas fa-times"></i>
                                            </a>
                                           <a href="#" v-on:click="trashRow(typeproduct.id)" data-placement="top"
                                                title="Eliminar" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a> -->
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-6">

                        </div>


                    </div>



                    <button v-on:click="updateAttributes" type="button" class="btn btn-primary">Actualizar Caracteristicas</button>
                </form>
            </div>
        </div>

    </div>

</div>

<!-- /.container-fluid -->



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
                name_product: '',
                description_product: '',
                product: {},
                attributetypes: [],
                attributetype: {},
                typeproduct: '',
                typeproducts: [],
                categoryforproduct:'',
                categoriesforproducts: [],
                price_product:'',
                price_discount_product:'',
                show_price_product:''
            }
        },
        mounted() {
            var pageURL = window.location.href;
            var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);
            console.log(idurl);
            loadOneElement('product/' + idurl, '').then(
                    response => {
                        if (response.data.code !== 500) {
                            this.product = response.data.data;
                            this.name_product = this.product.name;
                            this.description_product = this.product.description;
                            this.typeproduct = this.product.type_product;
                            this.categoryforproduct = this.product.category_for_product;
                            this.price_product = this.product.price;
                            this.price_discount_product = this.product.price_discount;
                            this.show_price_product = this.product.show_price;

                            loadElements('productattribute/getattributes/' + idurl, '').then(
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

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                });

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
            updateAttributes() {
                Swal.fire({
                    title: 'Estas seguro de actualizar los atributos del producto?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                }).then((result) => {
                    if (result.value) {
                       

                        console.log(this.attributetypes.length);
                        var newArray = []
                        this.attributetypes.forEach(function(entry) {
                            var newObject ={
                                id: entry.id,
                                id_attribute:entry.id_attribute,
                                id_product_attribute:entry.id_product_attribute,
                                id_type_product:entry.id_type_product,
                                value:entry.value
                            }
                            newArray.push(newObject);
                        });
                        console.log(newArray);

                        
                        var pageURL = window.location.href;
                        var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);

                        updateElement('productattribute/updateAttributes/' + idurl, newArray).then(
                                response => {
                                    if (response.data.code !== 500) {
                                        // this.typeproducts = response.data.data; 
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
                            name: this.name_product,
                            description: this.description_product,
                            id_type_product: this.typeproduct.id,
                            id_category_for_product: this.categoryforproduct.id,
                            price: this.price_product,
                            price_discount: this.price_discount_product,
                            show_price: this.show_price_product

                        }
                        var pageURL = window.location.href;
                        var idurl = pageURL.substr(pageURL.lastIndexOf('/') + 1);

                        updateElement('product/' + idurl, form).then(
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
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>