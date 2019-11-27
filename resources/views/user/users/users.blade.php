@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
                    </div>
                    {{--<div class="col-md-2">--}}
                    {{--<a href="{{route('product.category.create')}}" class="btn btn-primary btn-icon-split">--}}
                    {{--<span class="icon text-white-50"><i class="fas fa-plus"></i></span>--}}
                    {{--<span class="text">Crear</span>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th style="text-align: -webkit-center!important;">Administrar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,item) in users">
                        <td width="25%">@{{user.name}} @{{user.last_name}}</td>
                        <td width="30%">@{{ user.email }}</td>
                        <td width="25%"> @{{user.rol.name}}</td>
                        <td width="20%" style="text-align: -webkit-center!important;">
                            <a v-if="user.active === 1" href="#" v-on:click="changeActive(user)"
                               class="btn btn-success btn-circle">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="user.active === 0" href="#" v-on:click="changeActive(user)"
                               class="btn btn-warning btn-circle">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="trashRow(user.id,item)" class="btn btn-danger btn-circle">
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
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                users: {},
            }
        },
        mounted() {
            RouteGet_BACK('{{route('api.user')}}', {}).then(
                response => {
                    if (response.data.code === 200) {
                        this.users = response.data.data;

                    }
                })
                .catch(error => {
                    console.log(error);
                })

        },
        methods: {
            trashRow(id, item) {
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

                        let form = {
                            id: id
                        }
                        RoutePost_BACK('{{route('api.user.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {

                                    this.users.splice(item, 1);

                                    Swal.fire(
                                        'Elemento Eliminado',
                                        'Elemento eliminado correctamente',
                                        'success'
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
            changeActive(val) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus del usuario.',
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
                        RoutePost_BACK('{{route('api.user.change.active')}}', form).then(
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
            checkRow(idelement) {
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


                        inactiveElement('user/change/inactive/' + idelement, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    // this.typeattributes = response.data.data;
                                    Swal.fire(
                                        'Estatus Cambiado',
                                        'Estatus modificado correctamente',
                                        'success'
                                    ).then((result) => {
                                        window.location.href = 'users';
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
            activeRow(idelement) {
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


                        inactiveElement('user/change/active/' + idelement, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    // this.typeattributes = response.data.data;
                                    Swal.fire(
                                        'Estatus Cambiado',
                                        'Estatus modificado correctamente',
                                        'success'
                                    ).then((result) => {
                                        window.location.href = 'users';
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
        }
    })
</script>
