@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        color: #fff;
        text-decoration: none;
    }

    /*--choice modal1--*/

    .openbtn {
        margin-top: 80px;
    }

    .modal-body.choice-modal {
        position: relative;
        padding: 0px;

    }

    .row.inner-scroll {
        height: 445px;
        overflow: auto;
    }

    .gallery-card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
        height: 132px;
        margin-bottom: 14px;
    }

    .gallery-card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        /*padding: 1.25rem;*/
    }

    .gallery-card img {
        height: 130px;
        width: 100%;
    }

    label {
        margin-bottom: 0 !important;
    }

    /*--checkbox--*/

    .block-check {
        display: block;
        position: relative;


        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .block-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        right: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
        cursor: pointer;
    }

    /* On mouse-over, add a grey background color */
    .block-check:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .block-check input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .block-check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .block-check .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }


    /*--checkbox css end--*/
</style>
<div id="app">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-10">
                        <h6 class="m-0 font-weight-bold text-primary">Agregar Imagenes por sección</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('website.image.list') }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                    </span>
                            <span class="text">Volver</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sección</label>
                                <v-select :options="sections" label="title" v-model="section"
                                          @input="defaultSelection">
                                </v-select>
                                <div style="width: 95%;text-align: -webkit-left;margin: 2%;color: black;font-size: medium;">
                                    <strong>Descripción: </strong>@{{ this.section.description === '' ?'- - -':this.section.description }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Variable</label>
                                <input type="text" class="form-control" v-model="nameVar">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <div class="form-group" v-if="this.images.length > 0">
                                <button type="button" class="btn btn-labeled btn-success" data-toggle="modal"
                                        data-target="#myModal">
                                    <span class="uicon btn-label"><i class="fas fa-file-image"></i></span>
                                    Seleccionar Imagen
                                </button>
                                <br>
                                <div v-if="this.imageSelect.length === 1">
                                    Imagen @{{this.imageSelect.length}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12" v-for="(val,item) in imageSelect"
                                         style="background-color: rgb(245, 245, 245);border: 1px solid rgb(204, 204, 204);border-radius: 4px;margin-bottom: 1%;margin-top: 1%;">
                                        <img :src="images[val].url" class="img-responsive"
                                             style="height: 250px;width: 250px;margin-left: 11%;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-if="this.images.length === 0">
                                <label>No hay imagenes para seleccionar</label>
                            </div>
                        </div>
                    </div>
                    <button v-on:click="saveRow" type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">

            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Selecciona tus imagenes</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row inner-scroll">
                            <div class="col-md-4" v-for="(val,item) in images">
                                <div class="gallery-card">
                                    <div class="gallery-card-body">
                                        <label class="block-check">
                                            <img :src="val.url"
                                                 class="img-responsive"/>
                                            <input type="checkbox" v-model="imageSelect" :value="item"
                                                   @click="oneImg(item)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<script src="{{ asset('/js/vue-select.js') }}"></script>

<script>
    Vue.component('v-select', VueSelect.VueSelect)
    Vue.use(VeeValidate);

    var app = new Vue({
        el: '#app',
        data() {
            return {
                types: [],
                type: null,
                showErrors: false,
                images: [],
                imageSelect: [],
                nameVar: '',
                message: '',
                section: '',
                descriptionSection: 'asdas d',
                sections: [],
                imageSelectFinal: [],

            }
        },
        mounted() {
            this.listResource()
        },
        methods: {
            listResource() {
                RouteGet_BACK('{{route('website.image.resources.active')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.images = response.data.images;
                            this.sections = response.data.sections;
                            this.section = this.sections[0]


                            if (this.sections.length === 0) {
                                Swal.fire(
                                    'Alerta',
                                    'Necesita registrar al menos una Sección',
                                    'warning'
                                ).then((result) => {
                                    window.location.href = '{{route('website.section.create')}}';
                                });
                            }
                            if (this.images.length === 0) {

                                Swal.fire(
                                    'Atencion',
                                    'No posees ninguna imagen en tu galeria',
                                    'warning'
                                ).then((result) => {

                                });
                            }

                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            oneImg(item) {
                this.imageSelect = []
                this.imageSelect = [item]

            },
            saveRow() {

                this.imageSelectFinal = []
                for (i in this.imageSelect) {
                    let position = this.imageSelect[i]
                    this.imageSelectFinal.push(this.images[position].id)
                }

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Swal.fire({
                            title: 'Estas seguro?',
                            text: "",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Guardar'
                        }).then((result) => {
                            if (result.value) {
                                let form = {
                                    id_section: this.section.id,
                                    name: this.nameVar,
                                    image: this.imageSelectFinal[0],

                                }

                                RoutePost_BACK('{{route('website.image.store')}}', form).then(
                                    response => {
                                        if (response.data.code === 200) {

                                            Swal.fire(
                                                'Listo',
                                                response.data.message,
                                                'success'
                                            ).then((result) => {
                                                window.location.href = '{{route('website.image.list')}}';
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
                });
            },
            defaultSelection() {
                if (this.section === null) {
                    this.section = this.sections[0]
                }

            }

        },
        computed: {},
    })
</script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
