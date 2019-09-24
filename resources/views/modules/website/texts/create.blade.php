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
                        <h6 class="m-0 font-weight-bold text-primary">Agregar Texto</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route( 'website.text.list')}}" class="btn btn-warning btn-icon-split">
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
                                <label>Valor Español</label>
                                <textarea rows="10" cols="50" type="text" v-model="value_es" id="value_es" name="value_es"
                                       v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('value_es') }"
                                       placeholder="Valor en Español">
                                        </textarea>
                                <i v-show="errors.has('value_es')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('value_es')"
                                      class="help is-danger">@{{ errors.first('value_es') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sección</label>
                                <v-select :options="sectionArray" label="title" v-model="section"
                                          @input="defaultSelect"></v-select>
                            </div>
                             <div v-for="config in config_module">
                             <div v-if="config.name_module === 'Traductor'" class="form-group">
                            <div v-if="config.status === 1" class="form-group">
                                <label>Valor Ingles</label>
                                <textarea rows="10" cols="50" type="text" v-model="value_en" id="value_en" name="value_en"
                                       v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('value_en') }"
                                       placeholder="Valor en Ingles">
                                </textarea>
                                <i v-show="errors.has('value_en')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('value_en')"
                                      class="help is-danger">@{{ errors.first('value_en') }}</span>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                value_es: '',
                value_en: '',
                section: null,
                sectionArray: [],
            }
        },
        mounted() {
             loadOneElement('configmodule', '').then(
                    response => {
                        if (response.data.code !== 500) {
                            this.config_module = response.data.data;
                        }
                     else {
                            console.log(response.data);
                        }  
                         
                    })
                .catch(error => {
                    console.log(error);
                });
            RouteGet_BACK('{{route('website.component.list')}}', {}).then(
                response => {
                    if (response.data.code !== 500) {
                        this.sectionArray = response.data.arraySection;
                        if (this.sectionArray.length === 0) {
                            Swal.fire(
                                'Alerta',
                                'Necesita registrar al menos una Sección',
                                'warning'
                            ).then((result) => {
                                window.location.href = '{{route('website.section.create')}}';
                            });
                        }

                        this.section = this.sectionArray[0]
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
                                        value_es: this.value_es,
                                        value_en: this.value_en,
                                        id_section: this.section.id,
                                    }

                                    RoutePost_BACK('{{route('website.text.store')}}', form).then(
                                        response => {
                                            if (response.data.code !== 500) {
                                                Swal.fire(
                                                    'Listo',
                                                    response.data.message,
                                                    'success'
                                                ).then((result) => {
                                                    window.location.href = '{{route( 'website.text.list')}}';
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
                if (this.section === null) {
                    this.section = this.sectionArray[0]
                }
            }
        },
        computed: {},
    })
</script>