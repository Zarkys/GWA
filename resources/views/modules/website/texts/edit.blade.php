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
                        <h6 class="m-0 font-weight-bold text-primary">Agregar Entrada</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route( 'blog.post.list')}}" class="btn btn-warning btn-icon-split">
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
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" v-model="title" id="title" name="title"
                                       v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('title') }"
                                       placeholder="Titulo de la entrada">
                                <i v-show="errors.has('title')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('title')"
                                      class="help is-danger">@{{ errors.first('title') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Enlace Permanente</label>
                                <input type="text" id="slug" name="slug" v-validate="'required'"
                                       class="form-control" placeholder="titulo-de-la-entrada"
                                       :class="{'input': true, 'is-danger': errors.has('slug') }">
                                <i v-show="errors.has('slug')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('slug')"
                                      class="help is-danger">@{{ errors.first('slug') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="quillEditor">Contenido</label>
                                <quill-editor v-model="content" id="content" name="content" v-validate="'required'"
                                              ref="quillEditor"
                                              :options="editorOption"
                                              :class="{'input': true, 'is-danger': errors.has('content') }">
                                </quill-editor>
                                <i v-show="errors.has('content')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('content')"
                                      class="help is-content" style="color: red;">@{{ errors.first('content') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Categoria</label>
                                <v-select :options="categoryArray" label="name" v-model="category"
                                          @input="defaultSelect"></v-select>
                            </div>
                            <div class="form-group">
                                <label>Estado</label>
                                <v-select :options="statusArray" label="name" v-model="status"
                                          @input="defaultSelect"></v-select>
                            </div>
                            <div class="form-group">
                                <label>Fecha de publicación</label>
                                <flat-pickr :config="configs.dateTimePicker"
                                            id="datetime-input"
                                            class="form-control"
                                            v-model="datepublication"
                                            placeholder="Fecha de publicación">
                                </flat-pickr>
                            </div>

                            <div class="form-group">
                                <label>Selecccione sus etiquetas</label><br>
                                <i v-show="validaTag" class="fa fa-exclamation-triangle"></i>
                                <span v-show="validaTag" class="help is-content"
                                      style="color: red;">Marque una Etiqueta</span><br v-show="validaTag">

                                <div class="form-check form-check-inline" v-for="v in tagArray">
                                    <input class="form-check-input" type="checkbox" v-model="tagSelect" :id="v.id"
                                           :value="v.id" @change="defaultSelect">
                                    <label class="form-check-label" :for="v.id">@{{ v.name }}</label>
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

<!-- Additional Scripts -->
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/axios.js') }}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
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

{{--TODO NEW SCRIPT--}}
<script src="{{ asset('assets/vue-validate/vee-validate.js')}}"></script>
<script src="{{ asset('assets/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#title, #slug").stringToSlug({
            callback: function (text) {
                $('#slug').val(text);
            }
        });
    });
</script>

<script>
    Vue.use(VeeValidate)
    Vue.use(VueQuillEditor)
    Vue.component('flat-pickr', VueFlatpickr);
    Vue.component('v-select', VueSelect.VueSelect)

    var app = new Vue({
        el: '#app',
        components: {
            LocalQuillEditor: VueQuillEditor.quillEditor
        },
        data() {
            return {
                validaTag: false,
                title: '',
                slug: '',
                content: '',
                status: {'id': 0, 'name': 'Borrador'},
                category: null,
                categoryArray: [],
                statusArray: [],
                tagArray: [],
                tagSelect: [],
                datepublication: new Date(),

                message: '',
                title_type: '',
                permanent_link_type: '',
                content_type: '',
                visibility: '',

                editorOption: {
                    theme: 'snow'
                },
                configs: {
                    dateTimePicker: {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i:s',
                        defaultDate: new Date(),
                        altInput: true,
                        altFormat: "F j, Y - H:i"
                    }
                }
            }
        },
        mounted() {
            RouteGet_BACK('{{route('blog.component.list')}}', {}).then(
                response => {
                    if (response.data.code !== 500) {
                        this.statusArray = response.data.arrayStatus;
                        this.categoryArray = response.data.arrayCategory;
                        this.tagArray = response.data.arrayTag;
                        if (this.categoryArray.length === 0) {
                            Swal.fire(
                                'Alerta',
                                'Necesita registrar al menos una Categoria',
                                'warning'
                            ).then((result) => {
                                window.location.href = '{{route('blog.category.create')}}';
                            });
                        }
                        if (this.tagArray.length === 0) {
                            Swal.fire(
                                'Alerta',
                                'Necesita registrar al menos una Etiqueta',
                                'warning'
                            ).then((result) => {
                                window.location.href = '{{route('blog.tag.create')}}';
                            });
                        }

                        this.category = this.categoryArray[0]
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            saveRow() {
                if (this.tagSelect.length === 0) {
                    this.validaTag = true
                }
                this.slug = $('#slug').val()
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if (this.tagSelect.length > 0) {
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
                                        title: this.title,
                                        slug: this.slug,
                                        content: this.content,
                                        id_category: this.category.id,
                                        status_post: this.status.id,
                                        publication_date: this.datepublication,
                                        tags: this.tagSelect
                                    }

                                    RoutePost_BACK('{{route('blog.post.store')}}', form).then(
                                        response => {
                                            if (response.data.code !== 500) {
                                                Swal.fire(
                                                    'Listo',
                                                    response.data.message,
                                                    'success'
                                                ).then((result) => {
                                                    window.location.href = '{{route( 'blog.post.list')}}';
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
                        } else {
                            this.validaTag = true
                        }

                    }
                })

            },
            defaultSelect() {
                if (this.status === null) {
                    this.status = {'id': 0, 'name': 'Borrador'}
                }
                if (this.category === null) {
                    this.category = this.categoryArray[0]
                }
                if (this.tagSelect.length === 0) {
                    this.validaTag = true
                } else {
                    this.validaTag = false
                }
            }
        },
        computed: {},
    })
</script>