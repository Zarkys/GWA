@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Crear Tipo de Producto</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('product.type.list')}}" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                            <span class="text">Volver</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form @submit.prevent="saveRow">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input v-model="name" v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('name') }" type="text"
                                       name="name" id="name" placeholder="Nombre del tipo de producto">
                                <i v-show="errors.has('name')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('name')"
                                      class="help is-danger">@{{ errors.first('name') }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input v-model="description" v-validate="'required'" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('description') }" type="text"
                                       name="description" id="description" placeholder="Descripcion del tipo de producto">
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
                name: '',
                description: '',
                posts: {},
                parentcategory: '',
                parentscategories: []
            }
        },
        methods: {
            saveRow() {
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
                                    name: this.name,
                                    description: this.description,
                                }
                                RoutePost_BACK('{{route('product.type.store')}}', form).then(
                                    response => {
                                        if (response.data.code === 200) {
                                            toastrPersonalized.toastr('', response.data.message, 'success');
                                            Swal.fire(
                                                'Listo',
                                                response.data.message,
                                                'success'
                                            ).then((result) => {

                                                window.location.href = '{{route('product.type.list')}}';
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