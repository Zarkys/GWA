@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Categorías</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('blog.category.create')}}" class="btn btn-primary btn-icon-split">
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
                        <th style="text-align: -webkit-center">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories">
                        <td width="20%">@{{category.name}}</td>
                        <td width="35%">@{{ category.description | shortText }}</td>
                        <td width="25%">@{{category.slug}}</td>
                        <td width="20%" style="text-align: -webkit-center!important;">
                            <a v-if="category.active === 1" href="#" v-on:click="changeActive(category)"
                               class="btn btn-success btn-circle"  style="margin-top: 2%!important;">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="category.active === 0" href="#" v-on:click="changeActive(category)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultCategory(category.id)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteCategory(category)" style="margin-top: 2%!important;"
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
                categories: {},
            }
        },
        mounted() {
            this.listCategories()
        },
        methods: {
            listCategories(){
                RouteGet_BACK('{{route('blog.category.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.categories = response.data.data;

                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeActive(category) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la categoria.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: category.id
                        }
                        RoutePost_BACK('{{route('blog.category.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    category.active = response.data.active;
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
            deleteCategory(category) {
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
                            id: category.id
                        }
                        RoutePost_BACK('{{route('blog.category.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listCategories()
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
            consultCategory(id) {
                window.location.href = 'edit/' + id;
            }

        },
        filters: {
            shortText: function (value) {
                if (!value) {
                    return ''
                } else {
                    if (value.length > 90) {
                        return value.substr(0, 90) + " . . ."
                    } else {
                        return value
                    }

                }

            }
        },
        computed: {},
    })
</script>
