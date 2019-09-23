@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Ordenes Atendidas</h6>
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
                            <a href="#" v-on:click="viewOrder(order)"
                               class="btn btn-success btn-circle">
                                <i class="fa fa-check"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" v-if="order.id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Orden Atendida</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-8">
                                <h5>
                                    <strong>Nombre:</strong>@{{ order.user.name }}
                                    <br>
                                    <strong>Correo:</strong>@{{ order.user.email }}
                                    <br><strong>N° </strong>@{{ order.number_order }}
                                    <br>
                                    <p style="font-size: initial!important;">@{{ dateFormat(order.created_at) }}</p>
                                </h5>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr style="text-align: -webkit-center">
                                <th scope="col">Code</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Administrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(value,item) in order.details" style="text-align: -webkit-center">
                                <td>@{{ value.code }}</td>
                                <td>@{{ value.product.name }}</td>
                                <td v-html="priceText(value)"></td>
                                <td>
                                    {{--Cantidad: @{{value.cant_product }}<br>--}}
                                    Total: @{{ totalCant(value) }} <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <h3 style="text-align: end">Total: @{{ totalFinal(order.details) }}</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
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
                RoutePost_BACK('{{route('order.list.all.status')}}', {status: 2}).then(
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
                $("#myModal").modal("hide");
                // $('#myModal').hide()
            },
            viewOrder(order) {
                this.order = order
                $("#myModal").modal("show");
                $("#myModal").show();
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
            totalCant: function (value) {
                console.log(value)
                return value.product.price_final+ ' ' + value.symbol;
            },
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
        },
        computed: {},
    })
</script>