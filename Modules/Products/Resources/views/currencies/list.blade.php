@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Monedas para los Productos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Simbolo</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="currency in currencies">
                        <td width="30%">@{{currency.name}} (@{{currency.iso}})</td>
                        <td width="30%">@{{ currency.symbol }}</td>
                        <td width="10%" style="text-align: -webkit-center!important;margin-top: -1%">
                            <a v-if="currency.active === 1" href="#" v-on:click="changeActive(currency)"
                               class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="currency.active === 0" href="#" v-on:click="changeActive(currency)"
                               class="btn btn-warning btn-block btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                            {{--<br>--}}
                            {{--<a href="#" v-on:click="consultCategory(category.id)" style="margin-top: -20%!important;"--}}
                            {{--class="btn btn-primary btn-circle">--}}
                            {{--<i class="fa fa-edit"></i>--}}
                            {{--</a>--}}
                            <a href="#" v-on:click="deleteCategory(currency)"
                               class="btn btn-danger  btn-block btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@include('layouts.footscript')

<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('/js/axios.js?v='.time()) }}"></script>

<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                currencies: {},
            }
        },
        mounted() {
            this.listCurrency()
        },
        methods: {
            listCurrency() {
                RouteGet_BACK('{{route('product.currency.list.all')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.currencies = response.data.data;

                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeActive(currency) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la moneda.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: currency.iso
                        }
                        console.log(form)
                        RoutePost_BACK('{{route('product.currency.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    currency.active = response.data.active;
                                    Swal.fire(
                                        'Listo',
                                        response.data.message,
                                        'success'
                                    ).then((result) => {
                                    });

                                } else {
                                    Swal.fire(
                                        'Alerta',
                                        response.data.message,
                                        'warning'
                                    ).then((result) => {
                                    });
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }
                })

            },
            deleteCategory(currency) {
                Swal.fire({
                    title: 'Estas seguro de eliminarlo?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: currency.iso
                        }
                        RoutePost_BACK('{{route('product.currency.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listCurrency()
                                    Swal.fire(
                                        'Listo',
                                        response.data.message,
                                        'success'
                                    ).then((result) => {
                                    });

                                } else {
                                    Swal.fire(
                                        'Alerta',
                                        response.data.message,
                                        'warning'
                                    ).then((result) => {
                                    });
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }
                })
            }
        },
        filters: {
            shortText: function (value) {
                if (!value) return ''
                return value.substr(0, 75) + " . . ."
            }
        },
        computed: {},
    })
</script>