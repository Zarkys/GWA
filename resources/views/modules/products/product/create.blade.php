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
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-labeled btn-success" data-toggle="modal"
                                    data-target="#myModalAttr">
                                <span class="uicon btn-label"><i class="fas fa-check"></i></span>
                                Agrege atributos
                            </button>
                            <div class="row">
                                <div class="col-md-5" v-for="val in attrSelect"
                                     style="margin-right: 1%;margin-top: 1%;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;">
                                    <strong>@{{ val.name }}: </strong> @{{ val.value }}<br>
                                    {{--<span class="fa fa-times-circle btn-warning text-center btn-block"--}}
                                    {{-- style="margin-bottom: 3%!important;"></span>--}}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" v-if="this.images.length > 0">
                                <button type="button" class="btn btn-labeled btn-success" data-toggle="modal"
                                        data-target="#myModal">
                                    <span class="uicon btn-label"><i class="fas fa-file-image"></i></span>
                                    Seleccionar Imagen
                                </button>
                                <br>
                                <div v-if="this.imageSelect.length === 1">
                                    Imagen @{{this.imageSelect.length}}
                                </div>
                                <div v-if="this.imageSelect.length > 1">
                                    Imagenes @{{this.imageSelect.length}}
                                </div>
                                <div class="row">
                                    <div class="col-md-4" v-for="(val,item) in imageSelect"
                                         style="background-color: rgb(245, 245, 245);border: 1px solid rgb(204, 204, 204);border-radius: 4px;margin-bottom: 1%;margin-top: 1%;">
                                        <img :src="val" class="img-responsive" style="height: 100px;width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-if="this.images.length === 0">
                                <label>No hay imagenes para seleccionar</label>
                            </div>
                        </div>
                    </div>
                    <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">

            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Selecciona tus imagenes</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row inner-scroll">
                            <div class="col-md-2" v-for="(val,item) in images">
                                <div class="gallery-card">
                                    <div class="gallery-card-body">
                                        <label class="block-check">
                                            <img :src="val.url"
                                                 class="img-responsive"/>
                                            <input type="checkbox" v-model="imageSelect" :value="val.url">
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

    <div class="modal fade" id="myModalAttr">
        <div class="modal-dialog modal-lg">

            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Crear o Selecciona atributes publicos</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input v-model="name_attr" class="form-control"
                                           type="text"
                                           name="name_attr" id="name_attr" ref="name_attr"
                                           placeholder="Nombre del atributo">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input v-model="value_attr" class="form-control"
                                           type="text"
                                           name="value_attr" id="value_attr" ref="value_attr"
                                           placeholder="Valor del atributo">
                                </div>
                            </div>
                            {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>Publico</label>--}}
                            {{--<div class="custom-control custom-checkbox">--}}
                            {{--<input type="checkbox" class="custom-control-input" id="defaultUnchecked"--}}
                            {{--v-model="checked_attr" name="check-button">--}}
                            {{--<label class="custom-control-label" for="defaultUnchecked"></label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Añadir</label>
                                    <br>
                                    <button type="button" v-on:click="saveAttr" class="btn btn-success btn-circle">
                                        <span class="fa fa-plus-circle"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>

                        </div>
                        <div class="row text-center justify-center" v-if="showErrors">
                            <div class="col md-6"><i class="fa fa-exclamation-triangle"></i>
                                <span class="help is-danger">Existen campos requeridos.</span></div>
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3" v-for="(val,item) in attrs">
                            <div class="form-group">
                                <strong>@{{ val.name }}: </strong> @{{ val.value }}<br>
                                {{--<label>Publico: @{{ val.show_attr ? 'SI': 'NO'}}</label>--}}
                                {{--<br>--}}
                                <input type="checkbox" v-model="attrSelect" :value="val">
                                Agregar
                                <br>
                                <span class="fa fa-times-circle btn-danger text-center btn-block"
                                      @click="removeItem(item)"></span>
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

<script src="{{ asset('/js/vue-select.js') }}"></script>
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
                showErrors: false,
                categories: [],
                images: [],
                imageSelect: [],
                attrSelect: [],
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
                attrs: [],
                saveAttrs: [],
                // attr:{
                id_attr: null,
                checked_attr: true,
                name_attr: '',
                value_attr: '',
                // }

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
                            this.attrs = response.data.attributeProduct;
                            this.images = response.data.images;
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
                            if (this.images.length === 0) {

                                Swal.fire(
                                    'Atencion',
                                    'No posees ninguna imagen en tu galeria',
                                    'warning'
                                ).then((result) => {

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
                                    id_currency: this.currency.iso,

                                    price: this.price,
                                    percentage: this.percentage,
                                    show_price: this.showPrice.value,
                                    images: this.imageSelect,

                                    attrs: this.attrSelect,

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
            saveAttr() {
                if (this.name_attr === '' && this.value_attr === '') {
                    this.showErrors = true;
                } else {

                    let form = {
                        show_attr: true,
                        name: this.name_attr,
                        value: this.value_attr,
                    }

                    this.name_attr = ''
                    this.value_attr = ''
                    this.showErrors = false;

                    RoutePost_BACK('{{route('attribute.store')}}', form).then(
                        response => {
                            if (response.data.code === 200) {
                                toastrPersonalized.toastr('', response.data.message, 'success');
                                this.attrs.push(response.data.data)


                            } else {
                                toastrPersonalized.toastr('', 'Existen campos requeridos.', 'warning');
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }


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
            removeItem(item) {
                Swal.fire({
                    title: 'Eliminar de dase de datos.',
                    text: 'Esta seguro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {

                        let form = {
                            id: this.attrs[item].id,
                        }
                        RoutePost_BACK('{{route('attribute.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {

                                    let id = this.attrs[item].id
                                    let name = this.attrs[item].name
                                    toastrPersonalized.toastr('', 'Has borrado el atributo "' + name + '"', 'info');
                                    this.attrs.splice(item, 1)

                                    let arrayTemp = this.attrSelect

                                    for (i in arrayTemp) {
                                        let tmp = arrayTemp[i]
                                        if (tmp.id === id) {
                                            this.attrSelect.splice(i, 1)
                                        }

                                    }

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

        },
        computed: {},
    })
</script>