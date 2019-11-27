@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Ordenes pendiente</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Detalles</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(order,item) in orders">
                        <td width="10%">@{{ order.number_order}}</td>
                        <td width="20%">@{{ order.user.name }}</td>
                        <td width="25%">@{{ order.user.email }}</td>
                        <td width="15%">@{{ cantTemp(order) }}</td>
                        <td width="20%">@{{ totalTemp(order) }}</td>
                        <td width="35%" style="padding: 0%;padding-top: 1%;padding-bottom: 1%;">
                            <a href="#" v-on:click="viewOrder(order,item)"
                               class="btn btn-success btn-circle">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" v-on:click="cancelOrder(item,orders)"
                               class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" v-if="order.id">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalles de la Orden Pendiente</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>
                                        <strong>Nombre: </strong>@{{ order.user.name }}
                                        <br>
                                        <strong>Correo: </strong>@{{ order.user.email }}
                                        <br><strong>N° </strong>@{{ order.number_order }}
                                        <br>
                                        <p style="font-size: initial!important;">@{{ dateFormat(order.created_at) }}</p>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>
                                        <strong v-if="order.dni">Dni: </strong>@{{ order.dni }}
                                        <br>
                                        <strong v-if="order.address">Direccion: </strong>@{{ order.address }}
                                        <br>
                                        <strong v-if="order.type">Type: </strong>@{{ order.type }}

                                    </h5>
                                </div>

                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr style="text-align: -webkit-center">
                                <th scope="col">Code</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(value,item) in order.details" style="text-align: -webkit-center">
                                <td>@{{ value.code }}</td>
                                <td>@{{ value.product.name }}</td>
                                <td v-html="priceText(value)"></td>
                                <td>
                                    {{--<div style="text-align: center;background-color: #c1c1c1;font-size: larger;">--}}
                                    {{--<i class="fa fa-minus" @click="adminCant(false,value)"></i>--}}
                                    {{--@}}--}}
                                    {{--value.cant_product }}--}}
                                    {{--<i class="fa fa-plus" @click="adminCant(true,value)"></i>--}}
                                    {{--</div>--}}
                                    {{--Total: @{{ totalCant(value) }} <br>--}}
                                    <strong>Cancelar <i class="fa fa-times"
                                                        @click="removeProduct(order,item,value.id)"></i></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <h3 style="text-align: end">Total: @{{ totalFinal(order.details) }}</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="attendedOrder()">
                            Atender
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModal()">
                            Cerrar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@include('layouts.footscript')

<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                orders: {},
                order: {},
                itemOrder: '',
                tmCant: ''
            }
        },
        mounted() {
            this.listProducts()
        },
        methods: {
            dateFormat(date, format = 'DD/MM/YYYY  h:m a') {
                return moment(date).format(format);
            },
            listProducts() {
                RoutePost_BACK('{{route('order.list.all.status')}}', {status: 1}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.orders = response.data.data;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            closeModal() {
                let myModal = document.querySelector('#myModal')
                myModal.classList.remove('show');
                let body = document.querySelector('body')
                let divModalShadow = document.querySelector('.modal-backdrop')
                divModalShadow.classList.remove('show');
                divModalShadow.style.position = 'initial'


                $("#myModal").modal("hide");
                $("#myModal").hide();
            },
            viewOrder(order, item) {
                this.order = order
                this.itemOrder = item
                $("#myModal").modal("show");
            },
            cancelOrder(item, orders) {
                swalWithBootstrapButtons.fire({
                    title: 'Esta Seguro?',
                    text: 'Se eliminara la orden pendiente',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {

                        RoutePost_BACK('{{route('order.cancel')}}', {id: orders[item].id}).then(
                            response => {
                                if (response.data.code === 200) {
                                    orders.splice(item, 1)

                                    Toast.fire({
                                        type: 'info',
                                        title: 'Orden Eliminada'
                                    })

                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })


                    }
                })
            },
            priceText: function (details) {
                let product = details.product
                let symbol = ' ' + details.symbol
                if (product.price) {
                    let priceTmp = product.price_final
                    let discountTmp = product.price_discount === null ? '' : '<br> Descuento: ' + product.price_discount + '%<br>Costo final: ' + priceTmp + symbol
                    return 'Costo: ' + product.price + symbol + discountTmp
                } else {
                    return 'Gratis. . .'
                }

            },
            {{--adminCant: function (status, value) {--}}
                    {{--let cant = value.cant_product;--}}
                    {{--let sendChange = false--}}
                    {{--if (status) {--}}
                    {{--if (cant < 10) {--}}
                    {{--sendChange = true--}}
                    {{--value.cant_product = cant + 1--}}
                    {{--}--}}

                    {{--} else {--}}
                    {{--if (cant > 1) {--}}
                    {{--sendChange = true--}}
                    {{--value.cant_product = cant - 1--}}
                    {{--}--}}
                    {{--}--}}

                    {{--if (sendChange) {--}}
                    {{--clearTimeout(this.tmCant);--}}
                    {{--this.tmCant = setTimeout(function () {--}}
                    {{--let form = {--}}
                    {{--'id': value.id,--}}
                    {{--'cant': value.cant_product,--}}
                    {{--}--}}
                    {{--RoutePost_BACK('{{route('order.cant.details')}}', form).then(--}}
                    {{--response => {--}}
                    {{--if (response.data.code === 200) {--}}
                    {{--Toast.fire({--}}
                    {{--type: 'success',--}}
                    {{--title: 'Actualizado'--}}
                    {{--})--}}

                    {{--}--}}
                    {{--})--}}
                    {{--.catch(error => {--}}
                    {{--console.log(error);--}}
                    {{--})--}}

                    {{--}, 1500);--}}
                    {{--}--}}

                    {{--},--}}
                    {{--totalCant: function (value) {--}}
                    {{--return (value.products.price_final * value.cant_product).toFixed(2) + ' ' + value.products.currency_symbol;--}}
                    {{--},--}}
            cantTemp: function (order) {
                total = 0
                arrayPetitions = order.details
                for (i in arrayPetitions) {
                    total = total + 1
                }
                return total
            },
            totalTemp: function (order) {
                total = 0
                symbol = order.symbol
                arrayPetitions = order.details
                for (i in arrayPetitions) {
                    total = total + arrayPetitions[i].amount
                }
                return total.toFixed(2) + ' ' + symbol
            },
            totalFinal: function (details) {
                total = 0
                symbol = details[0].symbol
                arrayPetitions = details
                for (i in arrayPetitions) {
                    // symbol = arrayPetitions[i].products.currency_symbol
                    total = total + arrayPetitions[i].amount
                }
                return total.toFixed(2) + ' ' + symbol
            },
            removeProduct: function (order, item, id) {
                if (order.details.length === 1) {

                    swalWithBootstrapButtons.fire({
                        title: 'Atencion!',
                        text: 'Actualmente solo tiene un producto, ¿Desea cancelar la orden completa?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            RoutePost_BACK('{{route('order.cancel')}}', {id: this.orders[this.itemOrder].id}).then(
                                response => {
                                    if (response.data.code === 200) {
                                        this.orders.splice(this.itemOrder, 1)

                                        Toast.fire({
                                            type: 'info',
                                            title: 'Orden Eliminada'
                                        })

                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                })

                        }
                    })
                } else {

                    swalWithBootstrapButtons.fire({
                        title: 'Esta Seguro?',
                        text: 'Se eliminara el producto de la orden.',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            RoutePost_BACK('{{route('order.cancel.details')}}', {id: id}).then(
                                response => {
                                    if (response.data.code === 200) {

                                        order.details.splice(item, 1);

                                        Toast.fire({
                                            type: 'info',
                                            title: 'Producto Eliminado'
                                        })

                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                })


                        }
                    })
                }


            },
            attendedOrder: function () {

                swalWithBootstrapButtons.fire({
                    title: 'Esta Seguro?',
                    text: 'La orden será procesada',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Procesar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let id = this.orders[this.itemOrder].id
                        RoutePost_BACK('{{route('order.attended')}}', {id: id}).then(
                            response => {
                                if (response.data.code === 200) {

                                    this.orders.splice(this.itemOrder, 1)
                                    $("#myModal").modal("hide");
                                    Toast.fire({
                                        type: 'success',
                                        title: 'Orden Atendida'
                                    })

                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })

                    }
                })
            }
        },
        computed: {},
    })
</script>