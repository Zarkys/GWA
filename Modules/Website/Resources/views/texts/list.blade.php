@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Textos</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route( 'website.text.create')}}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                            <span class="text">Crear</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-left">
                        <th>Nombre</th>
                        <th>Español</th>
                        <th>Ingles</th>
                        <th>Sección</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="text in texts" class="text-left">
                        <td width="30%">@{{text.name}}</td>
                        <td width="20%">@{{text.value_es}}</td>
                        <td width="20%">@{{text.value_en}}</td>
                        <td width="20%">@{{text.section.title}}</td>
                        <td width="15%" style="text-align: -webkit-center!important;margin-top: -1%">
                            <a v-if="text.active === 1" href="#" v-on:click="changeStatus(text)"
                               class="btn btn-success btn-block btn-sm"><i class="fas fa-check"></i>
                            </a>
                            <a v-if="text.active === 0" href="#" v-on:click="changeStatus(text)"
                               class="btn btn-warning btn-block btn-sm"><i class="fas fa-times"></i>
                            </a>
                            <br>
                            <a href="#" v-on:click="consultText(text)" style="margin-top: -20%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteText(text)" style="margin-top: -20%!important;"
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
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                texts: [],
            }
        },
        mounted() {
            this.listText()
        },
        methods: {
            listText() {
                RouteGet_BACK('{{route('website.text.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.texts = response.data.data;

                        } else {
                            console.log(response.data);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeStatus(text) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la entrada.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: text.id
                        }
                        RoutePost_BACK('{{route('website.text.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    text.active = response.data.active;
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
            deleteText(text) {
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
                            id: text.id
                        }
                        RoutePost_BACK('{{route('website.text.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listText()
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
            consultText(text) {
                window.location.href = 'edit/' + text.id;
            },
        },
        computed: {},
    })
</script>