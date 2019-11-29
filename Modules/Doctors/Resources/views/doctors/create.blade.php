@include('layouts.header')
<!-- Custom styles for this page -->

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
                        <h6 class="m-0 font-weight-bold text-primary">Agregar Doctor</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route( 'doctors.doctor.list')}}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                    </span>
                            <span class="text">Volver</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="saveRow" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" v-model="name" id="name" name="name"
                                       v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('name') }"
                                       placeholder="Nombre de la variable">
                                <i v-show="errors.has('name')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('name')"
                                      class="help is-danger">@{{ errors.first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Consultorio</label>
                                <textarea rows="10" cols="50" type="text" v-model="consulting_room" id="consulting_room" name="consulting_room"
                                       {{--v-validate="'required'" --}}class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('consulting_room') }"
                                       placeholder="Consultorio">
                                        </textarea>
                                <i v-show="errors.has('consulting_room')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('cosulting_room')"
                                      class="help is-danger">@{{ errors.first('consulting_room') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Especialidad</label>
                                <v-select :options="specialtyArray" label="name" v-model="specialty"
                                          @input="defaultSelect"></v-select>
                            </div>
                            <div  class="form-group">
                                <label>Teléfono</label>
                                <input type="text" v-model="phone" id="phone" name="phone"
                                       {{--v-validate="'required'"--}} class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('phone') }"
                                       placeholder="Teléfono">
                                <i v-show="errors.has('phone')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('phone')"
                                      class="help is-danger">@{{ errors.first('phone') }}</span>
                            </div>
                        </div>
                    </div>
<div class="text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<script src="https://unpkg.com/vue-select@latest"></script>

<!-- START DATEPICKER -->
<link href="https://cdn.jsdelivr.net/npm/flatpickr@4/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-flatpickr-component@8"></script>
<script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>


<link href="https://cdn.quilljs.com/1.3.4/quill.core.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.4/quill.bubble.css" rel="stylesheet">

<script>
    Vue.use(VeeValidate)
    Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        components: {
        },
        data() {
            return {
                name: '',
                consulting_room: null,
                phone: null,
                specialty: null,
                specialtyArray: []
            }
        },
        mounted() {
           RouteGet_BACK('{{route('doctors.component.list')}}', {}).then(
                response => {
                    if (response.data.code !== 500) {
                        this.specialtyArray = response.data.arraySpecialty;
                        console.log(this.specialtyArray);
                        if (this.specialtyArray.length === 0) {
                            Swal.fire(
                                'Alerta',
                                'Necesita registrar al menos una Especialidad',
                                'warning'
                            ).then((result) => {
                                window.location.href = '{{route('doctors.specialty.create')}}';
                            });
                        }

                        this.specialty = this.specialtyArray[0]
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            saveRow() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Swal.fire({
                                title: 'Estas seguro de guardar el elemento?',
                                text: "Debes estar seguro antes de continuar",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Guardar'
                            }).then((result) => {
                                if (result.value) {
                                    let form = {
                                        name: this.name,
                                        consulting_room: this.consulting_room,
                                        phone: this.phone,
                                        id_specialty: this.specialty.id,
                                    }

                                    RoutePost_BACK('{{route('doctors.doctor.store')}}', form).then(
                                        response => {
                                            if (response.data.code !== 500) {
                                                Swal.fire(
                                                    'Listo',
                                                    response.data.message,
                                                    'success'
                                                ).then((result) => {
                                                    window.location.href = '{{route( 'doctors.doctor.list')}}';
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

                    }
                })

            },
            defaultSelect() {
                if (this.specialty === null) {
                    this.specialty = this.specialtyArray[0]
                }
            }
        },
        computed: {},
    })
</script>
