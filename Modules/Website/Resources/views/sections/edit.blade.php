@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Actualizando la Sección</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('website.section.list')}}" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                            <span class="text">Volver</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form @submit.prevent="updateRow">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título</label>
                                <input v-model="title" v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('title') }" type="text"
                                       name="title" id="title" placeholder="Título de Sección">
                                <i v-show="errors.has('title')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('title')"
                                      class="help is-danger">@{{ errors.first('title') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input v-model="description" v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('description') }" type="text"
                                       name="description" id="description" placeholder="Descripción de la seccion">
                                <i v-show="errors.has('description')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('description')"
                                      class="help is-danger">@{{ errors.first('description') }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>

</div>

@include('layouts.footer')
@include('layouts.footscript')

<script>
    Vue.use(VeeValidate);

    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                title: '',
                description: '',
            }
        },
        mounted() {
            var pageURL = window.location.href;
            this.id = pageURL.substr(pageURL.lastIndexOf('/') + 1);

            var form = {
                'id': this.id
            }
            RoutePost_BACK('{{route('website.section.consult')}}', form).then(
                response => {
                    if (response.data.code !== 500) {
                        this.title = response.data.data.title;
                        this.description = response.data.data.description;
                    } else {
                        console.log(response.data);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            updateRow() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Swal.fire({
                            title: 'Estas seguro?',
                            text: '',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Guardar'
                        }).then((result) => {
                            if (result.value) {
                                let form = {
                                    id: this.id,
                                    title: this.title,
                                    description: this.description,
                                }
                                RoutePost_BACK('{{route('website.section.update')}}', form).then(
                                    response => {
                                        if (response.data.code === 200) {
                                            toastrPersonalized.toastr('', response.data.message, 'success');
                                            Swal.fire(
                                                'Listo',
                                                response.data.message,
                                                'success'
                                            ).then((result) => {
                                                window.location.href = '{{route('website.section.list')}}';
                                            });

                                        } else {
                                            $.each(response.data.data, function (i, v) {
                                                toastrPersonalized.toastr('', v[0], 'warning');
                                            })
                                        }
                                    })
                                    .catch((error) => {
                                        toastrPersonalized.toastr('', error.message, 'warning');
                                    });

                            }
                        })
                    }

                });

            },

        },
        computed: {},
    })
</script>
