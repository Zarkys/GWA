@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de las Especialidad</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('doctors.specialty.create')}}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                            <span class="text">Crear</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="m-0 font-weight-bold text-primary">Filtrar por Nombre</h6>

                    </div>
                    <div class="col-md-3">
                        <!--  <v-select :options="sections" label="title" v-model="section" @@input="onChange"></v-select>-->
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputName" v-model="filtername_type"
                                   aria-describedby="nameHelp" placeholder="Nombre de la Especialidad Médica">
                        </div>

                    </div>
                    <div class="col-md-3">

                        <a href="#" v-on:click="filter()" class="btn btn-primary btn-circle">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
                <br>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="text-align: -webkit-center!important;">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="specialty in specialties">
                        <td width="35%">@{{specialty.name}}</td>
                        <td width="35%">@{{specialty.description | shortText}}</td>
                        <td width="30%" style="text-align: -webkit-center!important;">
                            <a v-if="specialty.active == 1" href="#" v-on:click="changeActive(specialty)"
                               class="btn btn-success btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="specialty.active == 0" href="#" v-on:click="changeActive(specailty)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultSpecialty(specialty.id)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteSpecialty(specialty)" style="margin-top: 2%!important;"
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
                filtername_type: '',
                specialties: {},
            }
        },
        mounted() {
            this.listSpecialties()
        },
        methods: {
            listSpecialties() {
                RouteGet_BACK('{{route('doctors.specialty.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.specialties = response.data.data;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            filter() {
                Swal.fire({
                    title: 'Estas seguro de buscar por este nombre?',
                    text: "Debes estar seguro antes de continuar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Buscar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            name: this.filtername_type,
                        }

                        loadElements('../../doctors/specialty/findbyunique/name/' + this.filtername_type, '').then(
                            response => {
                                if (response.data.code !== 500) {


                                    this.specialties = response.data.data;


                                } else {
                                    console.log(response.data);
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })

                    }
                })
            },
            changeActive(specialty) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus de la Especialidad.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: specialty.id
                        }
                        RoutePost_BACK('{{route('doctors.specialty.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    specialty.active = response.data.active;
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
            deleteSpecialty(specialty) {
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
                            id: specialty.id
                        }
                        RoutePost_BACK('{{route('doctors.specialty.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listSpecialties()
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
            consultSpecialty(id) {
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
</script>
