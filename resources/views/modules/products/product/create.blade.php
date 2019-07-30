@include('layouts.header')
<!-- Custom styles for this page -->

@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        color: #fff;
        text-decoration: none;
    }

    /*--choice modal1--*/

    .openbtn {
        margin-top: 80px;
    }

    .modal-header {
        padding: 15px;
        border-bottom: none;
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-body.choice-modal {
        position: relative;
        padding: 0px;

    }

    .row.inner-scroll {
        height: 445px;
        overflow: auto;
    }

    .gallery-card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
        height: 132px;
        margin-bottom: 14px;
    }

    .gallery-card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        /*padding: 1.25rem;*/
    }

    .gallery-card img {
        height: 130px;
        width: 100%;
    }

    label {
        margin-bottom: 0 !important;
    }

    /*--checkbox--*/

    .block-check {
        display: block;
        position: relative;


        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .block-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        right: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
        cursor: pointer;
    }

    /* On mouse-over, add a grey background color */
    .block-check:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .block-check input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .block-check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .block-check .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }


    /*--checkbox css end--*/
</style>
<div id="app">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Agregar Producto</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('product.list') }}" class="btn btn-warning btn-icon-split">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input v-model="name" v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('name') }" type="text"
                                       name="name" id="name"
                                       placeholder="Nombre del producto">
                                <i v-show="errors.has('name')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('name')"
                                      class="help is-danger">@{{ errors.first('name') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Producto</label>
                                <v-select :options="types" label="name" v-model="type"
                                          @input="defaultSelection"></v-select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Categoría de Producto</label>
                                <v-select :options="categories" label="name"
                                          v-model="category" @input="defaultSelection"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Moneda</label>
                                <v-select :options="currencies" label="iso_name"
                                          v-model="currency" @input="defaultSelection"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Precio</label>
                                <input class="form-control" v-model.lazy="priceTemp" v-money="moneyConfig"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Descuento</label>
                                <input class="form-control" v-model.lazy="percentageTemp" v-money="wholeConfig"
                                       @input="defaultSelection"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mostrar precio</label>
                                <v-select :options="showArray" label="name"
                                          v-model="showPrice" @input="defaultSelection"></v-select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea v-model="description" v-validate="'required'" class="form-control"
                                          :class="{'input': true, 'is-danger': errors.has('description') }" type="text"
                                          name="description" id="description"
                                          placeholder="Descripcion de la categoría"></textarea>
                                <i v-show="errors.has('description')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('description')"
                                      class="help is-danger">@{{ errors.first('description') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seleccionar Imagen</label>
                                <br>
                                <a class="btn btn-success btn-icon-split" v-on:click="consultImg"
                                   data-toggle="modal" data-target="#myModal">
                                    <span class="icon text-white-50">
                                      <i class="fas fa-file-image"></i>
                                    </span>
                                </a>
                                <br>
                                <div v-if="this.imageSelect.length === 1">
                                    Has seleccionado @{{this.imageSelect.length}} imagen.
                                </div>
                                <div v-if="this.imageSelect.length > 1">
                                    Has seleccionado @{{this.imageSelect.length}} imagenes en total.
                                </div>

                            </div>
                        </div>
                    </div>
                    <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Selecciona tus imagenes</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body choice-modal">
                    <div class="container-fluid">
                        <div class="row inner-scroll">
                            <div class="col-md-2" v-for="(val,item) in images">
                                <div class="gallery-card">
                                    <div class="gallery-card-body">
                                        <label class="block-check">
                                            <img :src="val.url"
                                                 class="img-responsive"/>
                                            <input type="checkbox" v-model="imageSelect" :value="val.id">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
                </div>
            </div>

        </div>
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

<script src="{{ asset('assets/vue-validate/vee-validate.js')}}"></script>

<script src="{{ asset('assets/money/v-money.min.js') }}"></script>

<script>
    Vue.component('v-select', VueSelect.VueSelect)

    Vue.use(VeeValidate);

    var app = new Vue({
        el: '#app',
        data() {
            return {
                types: [],
                type: null,
                categories: [],
                images: [],
                imageSelect: [],
                showArray: [
                    {
                        name: 'Si',
                        value: 1
                    },
                    {
                        name: 'No',
                        value: 0
                    }
                ],
                category: null,
                currencies: [],
                currency: null,
                message: '',
                name: '',
                description: '',
                products: {},
                typeproduct: '',
                typeproducts: [],
                categoryforproduct: '',
                categoriesforproducts: [],
                price_product: '',
                price_discount_product: '',
                showPrice: null,
                moneyConfig: {
                    decimal: '.',
                    thousands: '',
                    prefix: '',
                    suffix: '',
                    precision: 2,
                    masked: true,
                },
                wholeConfig: {
                    decimal: '.',
                    thousands: '',
                    prefix: '',
                    suffix: ' %',
                    precision: 1,
                    masked: true,
                    limit: 2
                },
                priceTemp: '0.00',
                price: 0,
                percentageTemp: '0.0',
                percentage: 0,
            }
        },
        mounted() {
            this.listResource()
        },
        methods: {
            listResource() {
                RouteGet_BACK('{{route('product.resources.active')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.categories = response.data.categories;
                            this.category = this.categories[0]

                            this.types = response.data.types;
                            this.type = this.types[0]

                            this.currencies = response.data.currencies;
                            this.currency = this.currencies[0]

                            if (this.categories.length === 0) {
                                Swal.fire(
                                    'Alerta',
                                    'Necesita registrar al menos una Categoria',
                                    'warning'
                                ).then((result) => {
                                    window.location.href = '{{route('product.category.create')}}';
                                });
                            }
                            if (this.types.length === 0) {
                                Swal.fire(
                                    'Alerta',
                                    'Necesita registrar al menos un tipo de producto',
                                    'warning'
                                ).then((result) => {
                                    window.location.href = '{{route('product.type.create')}}';
                                });
                            }

                            if (this.showPrice === null) {
                                this.showPrice = this.showArray[0]
                            }


                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            saveRow() {

                this.price = parseFloat(this.priceTemp)
                this.percentage = 0.0
                if (this.percentageTemp !== "0.0 %") {
                    let valorTemp = this.percentageTemp.split(' %');
                    let valor = parseFloat(valorTemp[0])

                    if (!isNaN(valor)) {
                        if (valor >= 99) {
                            this.percentageTemp = "99.9 %"
                            this.percentage = 99.9
                        } else {
                            this.percentage = valor
                        }
                    }

                }
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Swal.fire({
                            title: 'Estas seguro?',
                            text: "",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Guardar'
                        }).then((result) => {
                            if (result.value) {
                                let form = {
                                    name: this.name,
                                    description: this.description,

                                    id_type: this.type.id,
                                    id_category: this.category.id,

                                    price: this.price,
                                    percentage: this.percentage,
                                    show_price: this.showPrice.value

                                }

                                RoutePost_BACK('{{route('product.store')}}', form).then(
                                    response => {
                                        if (response.data.code === 200) {

                                            Swal.fire(
                                                'Listo',
                                                response.data.message,
                                                'success'
                                            ).then((result) => {
                                                window.location.href = '{{route('product.list')}}';
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
                    }
                });
            },
            defaultSelection() {
                if (this.currency === null) {
                    this.currency = this.currencies[0]
                }
                if (this.type === null) {
                    this.type = this.types[0]
                }
                if (this.category === null) {
                    this.category = this.categories[0]
                }
                if (this.show_price_product === null) {
                    this.show_price_product = this.showArray[0]
                }

                if (this.percentageTemp !== "0.0 %") {
                    let valorTemp = this.percentageTemp.split(' %');
                    let valor = parseFloat(valorTemp[0])

                    if (!isNaN(valor)) {
                        if (valor >= 99) {
                            this.percentageTemp = "99.9 %"
                            this.percentage = 99.9
                            return false
                        } else {
                            this.percentage = valor
                            return false
                        }

                    }

                }

            },
            consultImg() {
                RouteGet_BACK('{{route('product.consult.gallery')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.images = response.data.images;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }

        },
        computed: {},
    })
</script>