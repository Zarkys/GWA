@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Doctores</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('doctors.doctor.create')}}" class="btn btn-primary btn-icon-split">
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
                            <input type="text" class="form-control" v-model="filterfor" aria-describedby="nameHelp"
                                   placeholder="Nombre del Doctor">
                        </div>

                    </div>
                    <div class="col-md-3">

                        <a href="#" v-on:click="filterforname()" class="btn btn-primary btn-circle">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
                <br>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Consultorio</th>
                        <th>Teléfono</th>
                        <th>Especialidad</th>
                        <th style="text-align: -webkit-center!important;">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="doctor in doctors">
                        <td width="20%">@{{doctor.name}}</td>
                        <td width="20%">@{{doctor.consulting_room | shortText}}</td>
                        <td width="20%">@{{doctor.phone}}</td>
                        <td width="20%">@{{doctor.specialty.name}}</td>
                        <td width="20%" style="text-align: -webkit-center!important;">
                            <a v-if="doctor.active == 1" href="#" v-on:click="changeActive(doctor)"
                               class="btn btn-success btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-check"></i>
                            </a>
                            <a v-if="doctor.active == 0" href="#" v-on:click="changeActive(doctor)"
                               class="btn btn-warning btn-circle" style="margin-top: 2%!important;">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="#" v-on:click="consultDoctor(doctor.id)" style="margin-top: 2%!important;"
                               class="btn btn-primary btn-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" v-on:click="deleteDoctor(doctor)" style="margin-top: 2%!important;"
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
                filterfor: '',
                doctors: {},
            }
        },
        mounted() {
            this.listDoctors()
        },
        methods: {
            listDoctors() {
                RouteGet_BACK('{{route('doctors.doctor.list.all')}}', {}).then(
                    response => {
                        if (response.data.code !== 500) {
                            this.doctors = response.data.data;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            filterforname() {
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
                        loadElements('../../doctors/doctor/findbyunique/name/' + this.filterfor, '').then(
                            response => {
                                if (response.data.code !== 500) {
                                    console.log('primer console.log')
                                    console.log(response.data.data)
                                    this.doctors = response.data.data;
                                    console.log('segundo console.log')
                                    console.log(this.doctors);

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
            changeActive(doctor) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'Se cambiara el estatus del Doctor.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cambiar'
                }).then((result) => {
                    if (result.value) {
                        let form = {
                            id: doctor.id
                        }
                        RoutePost_BACK('{{route('doctors.doctor.change.status')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    doctor.active = response.data.active;
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
            deleteDoctor(doctor) {
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
                            id: doctor.id
                        }
                        RoutePost_BACK('{{route('doctors.doctor.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.listDoctors()
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
            consultDoctor(id) {
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
