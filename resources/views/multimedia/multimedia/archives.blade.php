@include('layouts.header')
<!-- Custom styles for this page -->


@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Archivos</h1>
        </div>


        <p class="mb-4">En esta lista puedes visualizar todos los archivos que existen actualmente </p>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Archivos</h6>
                    </div>
                    <div class="col-md-4">
                        <a href="archive/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                            <span class="text">Nuevo archivo</span>
                        </a>
                    </div>
                </div>


            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Nombre</strong>
                            </div>
                            <div class="col-md-3">
                                <strong>Tipo</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Fecha de creación</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Título</strong>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                    </li>

                </ul>
                <ul class="list-group">
                    <li class="list-group-item" v-for="archive in archives">
                        <div class="row">
                            <div class="col-md-3">
                                @{{archive.name}}
                            </div>
                            <div class="col-md-3">
                                @{{archive.type}}
                            </div>
                            <div class="col-md-2">
                                @{{archive.creation_date}}
                            </div>
                            <div class="col-md-2">
                                @{{archive.title}}
                            </div>
                            <div class="col-md-2">
                                <a href="#" v-on:click="updateRow(archive.id)" class="btn btn-primary btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a v-if="archive.active === 1" href="#" v-on:click="checkRow(archive.id)"
                                   class="btn btn-success btn-circle">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a v-if="archive.active === 0" href="#" v-on:click="activeRow(archive.id)"
                                   class="btn btn-warning btn-circle">
                                    <i class="fas fa-times"></i>
                                </a>
                                <a href="#" v-on:click="trashRow(archive.id)" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>

    <!-- /.container-fluid -->


</div>
</div>
<!-- End of Main Content -->
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
                archives: {},
            }
        },
        mounted() {
            loadElements('archive', '').then(
                response => {
                    if (response.data.code !== 500) {

                        console.log(response.data.data)
                        this.archives = response.data.data;
                        console.log(this.archives);

                    } else {
                        console.log(response.data);
                    }
                })
                .catch(error => {
                    console.log(error);
                })


        },
        methods: {
            back() {

            },
            editSubmit() {

            },
            trashRow(idelement) {
                console.log(idelement);
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


                        trashElement('archive/change/delete/' + idelement, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    // this.typeattributes = response.data.data;
                                    Swal.fire(
                                        'Elemento Eliminado',
                                        'Elemento eliminado correctamente',
                                        'success'
                                    ).then((result) => {
                                        window.location.href = 'library';
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


                        inactiveElement('archive/change/inactive/' + idelement, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    // this.typeattributes = response.data.data;
                                    Swal.fire(
                                        'Estatus Cambiado',
                                        'Estatus modificado correctamente',
                                        'success'
                                    ).then((result) => {
                                        window.location.href = 'library';
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


                        activeElement('archive/change/active/' + idelement, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    // this.typeattributes = response.data.data;
                                    Swal.fire(
                                        'Estatus Cambiado',
                                        'Estatus modificado correctamente',
                                        'success'
                                    ).then((result) => {
                                        window.location.href = 'library';
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
            updateRow(idelement) {
                window.location.href = 'archive/update/' + idelement;
            },
            cleanform() {

            }

        },
        computed: {},
    })
</script>