@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Comentarios</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="comment in comments">
                        <td width="10%">@{{ comment.name}}</td>
                        <td width="20%">@{{ comment.email}}</td>
                        <td width="40%">@{{ comment.comment | shortText}}</td>
                        <td width="20%">@{{ comment.publication_date }}</td>
                        <td width="10%" style="text-align: -webkit-center!important;margin-top: -1%">
                            <a href="#" v-on:click="changeStatus(comment,true)"
                               class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="#" v-on:click="changeStatus(comment,false)"
                               class="btn btn-danger btn-block btn-sm">
                                <i class="fas fa-times"></i>
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
                comments: {},
            }
        },
        mounted() {
            this.listComments()
        },
        methods: {
            listComments() {
                RouteGet_BACK('{{route('blog.comment.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.comments = response.data.data;

                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            changeStatus(comment, status) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus del comentario.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: comment.id,
                            status: status
                        }
                        RoutePost_BACK('{{route('blog.comment.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listComments()
                                    Swal.fire(
                                        'Listo',
                                        response.data.message,
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

            }

        },
        filters: {
            shortText: function (value) {
                if (!value) return ''
                return value.substr(0, 120) + " . . ."
            }
        },
        computed: {},
    })
</script>