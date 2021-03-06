@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Imágenes de Sliders</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('sliders.image.create')}}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                            <span class="text">Registrar</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Nombre</th>
                        <th>Imágen</th>
                        <th style="text-align: -webkit-center">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(image,item) in images">
                        <td width="30%">@{{image.title}}</td>
                        <td width="20%">@{{image.name}}</td>
                        <td width="30%">
                            <img v-bind:src="image.url" v-if="image.url" style='max-width:150px;'>
                            <p v-if="!image.url">No tiene imagene</p>
                        </td>

                        <td width="20%" style="text-align: -webkit-center">
                            <a v-if="image.status == 1" href="#" v-on:click="changeActive(image)"
                               class="btn btn-success btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="image.status == 0" href="#" v-on:click="changeActive(image)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultImage(image.id)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteImage(image,item)" style="margin-top: 2%!important;"
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
                images: {},
            }
        },
        mounted() {
            this.listImages()
        },
        methods: {
            listImages() {

                RoutePost_BACK('{{route('sliders.image.list.all')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.images = response.data.data;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })


            },

            changeActive(image) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la Imagen por Sección.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: image.id
                        }
                        RoutePost_BACK('{{route('sliders.image.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    image.status = response.data.status_post;
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
            deleteImage(value, item) {
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
                            id: value.id
                        }
                        RoutePost_BACK('{{route('sliders.image.item.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listImages()
                                    this.images.splice(item, 1)
                                    toastrPersonalized.toastr('', response.data.message, 'success');
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }
                })
            },
            consultImage(id) {
                window.location.href = 'edit/' + id;
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
</script>                                                                                                         
