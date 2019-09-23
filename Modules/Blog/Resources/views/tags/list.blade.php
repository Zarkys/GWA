@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de las Etiquetas</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('blog.tag.create')}}" class="btn btn-primary btn-icon-split">
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
                        <th>Slug</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="tag in tags">
                        <td width="20%">@{{tag.name}}</td>
                        <td width="35%">@{{tag.description | shortText}}</td>
                        <td width="25%">@{{tag.slug}}</td>
                        <td width="20%" style="text-align: -webkit-center!important;margin-top: -1%">
                            <a v-if="tag.active === 1" href="#" v-on:click="changeActive(tag)"
                               class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="tag.active === 0" href="#" v-on:click="changeActive(tag)"
                               class="btn btn-warning btn-block btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                            <br>
                            <a href="#" v-on:click="consultTag(tag.id)" style="margin-top: -20%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteTag(tag)" style="margin-top: -20%!important;"
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

<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                tags: {},
            }
        },
        mounted() {
            this.listTags()
        },
        methods: {
            listTags(){
                RouteGet_BACK('{{route('blog.tag.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.tags = response.data.data;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeActive(tag) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la Etiqueta.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: tag.id
                        }
                        RoutePost_BACK('{{route('blog.tag.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    tag.active = response.data.active;
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
            deleteTag(tag) {
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
                            id: tag.id
                        }
                        RoutePost_BACK('{{route('blog.tag.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listTags()
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
            consultTag(id) {
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