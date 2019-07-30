@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Tipos de Productos</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('product.type.create')}}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                            <span class="text">Crear</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="type in types">
                        <td width="20%">@{{type.name}}</td>
                        <td width="40%">@{{ type.description | shortText }}</td>
                        <td width="15%" style="text-align: -webkit-center!important;margin-top: -1%">
                            <a v-if="type.active === 1" href="#" v-on:click="changeActive(type)"
                               class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="type.active === 0" href="#" v-on:click="changeActive(type)"
                               class="btn btn-warning btn-block btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                            <br>
                            <a href="#" v-on:click="consultTp(type.id)" style="margin-top: -20%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteTp(type)" style="margin-top: -20%!important;"
                               class="btn btn-danger btn-circle">
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

<!-- Additional Scripts -->
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('/js/axios.js?v='.time()) }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                types: [],
            }
        },
        mounted() {
            this.listTypes()
        },
        methods: {
            listTypes(){
                RouteGet_BACK('{{route('product.type.list.all')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.types = response.data.data;

                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeActive(val) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus del tipo de producto.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: val.id
                        }
                        RoutePost_BACK('{{route('product.type.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    val.active = response.data.active;
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
            deleteTp(val) {
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
                            id: val.id
                        }
                        RoutePost_BACK('{{route('product.type.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listTypes()
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
            consultTp(id) {
                window.location.href = 'edit/' + id;
            }
        },
        filters: {
            shortText: function (value) {
                if (!value) return ''
                return value.substr(0, 75)+" . . ."
            }
        },
        computed: {},
    })
</script>