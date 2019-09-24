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
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Entradas</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route( 'blog.post.create')}}" class="btn btn-primary btn-icon-split">
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
                        <th>Titulo</th>
                        {{--<th>Autor</th>--}}
                        <th>Categoria</th>
                        <th>Etiquetas</th>
                        <th>Comentarios</th>
                        <th>Publicado</th>
                        <th style="text-align: -webkit-center!important;">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="post in posts" class="text-left">
                        <td width="20%">@{{post.title}}</td>
                        {{--<td width="15%">@{{post.user.name}}</td>--}}
                        <td width="15%">@{{post.category.name}}</td>
                        <td width="20%"><span v-for="val in post.tags"><strong>@{{ val.name }}</strong>@{{ post.tags.length > 1?',':'' }}</span>
                        <td width="5%">@{{post.comments.length }}</span>
                        </td>
                        <td width="20%">@{{post.publication_date}}</td>
                        <td width="25%" style="text-align: -webkit-center!important;">
                            <a v-if="post.status_post === 1" href="#" v-on:click="changeStatus(post)"
                               class="btn btn-success btn-circle" style="margin-top: 2%!important;">
                                {{--Publicado--}} <i class="fas fa-check"></i>
                            </a>
                            <a v-if="post.status_post === 0" href="#" v-on:click="changeStatus(post)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                {{--Borrador--}} <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultPost(post)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deletePost(post)" style="margin-top: 2%!important;"
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
                posts: [],
            }
        },
        mounted() {
            this.listPost()
        },
        methods: {
            listPost() {
                RouteGet_BACK('{{route('blog.post.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.posts = response.data.data;

                        } else {
                            console.log(response.data);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeStatus(post) {
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
                            id: post.id
                        }
                        RoutePost_BACK('{{route('blog.post.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    post.status_post = response.data.status_post;
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
            deletePost(post) {
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
                            id: post.id
                        }
                        RoutePost_BACK('{{route('blog.post.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listPost()
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
            consultPost(post) {
                window.location.href = 'edit/' + post.id;
            },
        },
        computed: {},
    })
</script>