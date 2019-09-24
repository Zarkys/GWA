@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Imágenes por Sección</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('website.image.create')}}" class="btn btn-primary btn-icon-split">
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
                        <th>Sección</th>
                        <th>Imágen</th>
                        <th style="text-align: -webkit-center">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="image in images">
                        <td width="50%">@{{image.section.title}}</td>
                         <td><img v-bind:src="image.image" style='max-width:150px;'></td>
                         {{--<td><img v-bind:src="'../../../upload/records/image/'+image.image" style='max-width:150px;'></td> --}}
                        <td width="20%" style="text-align: -webkit-center">
                            <a v-if="image.active === 1" href="#" v-on:click="changeActive(image)"
                               class="btn btn-success btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="image.active === 0" href="#" v-on:click="changeActive(image)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultImage(image.id)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteImage(image)" style="margin-top: 2%!important;"
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
               // images: '',
                //image: '',
            }
        },
        mounted() {
            this.listImages()
        },
        methods: {
            listImages(){
                RouteGet_BACK('{{route('website.image.listAll')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            
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
                        RoutePost_BACK('{{route('website.image.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    image.active = response.data.active;
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
            deleteImage(image) {
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
                            id: image.id
                        }
                        RoutePost_BACK('{{route('website.image.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listImages()
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
            consultImage(id) {
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