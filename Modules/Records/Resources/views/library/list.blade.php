@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/nprogress/nprogress.css?v=20190827') }}"/>
<style type="text/css">

    #nprogress .bar {
        background: red !important;
        position: absolute;
    }

    #nprogress .peg {
        box-shadow: 0 0 0px #ffffff, 0 0 0px #ffffff !important;
    }

    #nprogress .spinner-icon {
        border-top-color: red !important;
        border-left-color: red !important;
    }

</style>

<div id="app">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Archivos en Biblioteca</h1>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4" @click="loadRecords('image')" style="cursor: pointer!important;">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Imagenes</div>
                                <div class="h6 mb-0 font-weight-bold">Total: @{{ image.total }}</div>
                                <div class="h6 mb-0 font-weight-bold">Peso: @{{ image.size }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-image fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4" @click="loadRecords('video')" style="cursor: pointer!important;">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Video</div>
                                <div class="h6 mb-0 font-weight-bold">Total: @{{ video.total }}</div>
                                <div class="h6 mb-0 font-weight-bold">Peso: @{{ video.size }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-video fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4" @click="loadRecords('audio')" style="cursor: pointer!important;">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Audio</div>
                                <div class="h6 mb-0 font-weight-bold">Total: @{{ audio.total }}</div>
                                <div class="h6 mb-0 font-weight-bold">Peso: @{{ audio.size }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-audio fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4" @click="loadRecords('office')" style="cursor: pointer!important;">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Office</div>
                                <div class="h6 mb-0 font-weight-bold">Total: @{{ office.total }}</div>
                                <div class="h6 mb-0 font-weight-bold">Peso: @{{ office.size }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-archive fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow mb-4" v-if="data.length === 0">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary text-center">No hay archivos
                            disponibles.</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4" v-if="data.length > 0">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Archivos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4" v-if="val.remove === false" v-for="(val,item) in data">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div v-if="val.type === 'image'">
                                    <img :src="val.url" style="max-width: 100%!important;">
                                </div>
                                <div v-if="val.type === 'video'">
                                    <video :src="val.url" controls style="max-width: 100%!important;"></video>
                                </div>
                                <div v-if="val.type === 'audio'">
                                    <audio :src="val.url" controls style="max-width: 100%!important;"></audio>
                                </div>
                                <div v-if="val.type === 'office'">
                                    <iframe v-if="val.typeView === true" :src="val.urlTemp" frameborder="0"
                                            style="width: 100%!important;height: 300px!important;"></iframe>
                                    <div v-if="val.typeView === false"
                                         style="width: 100% !important;height: 184px !important;text-align: -webkit-center;">
                                        <h4 style="margin-top: 120px;">No hay vista previa. . .</h4>
                                    </div>

                                </div>
                                <hr class="sidebar-divider">
                                <strong>Tipo: </strong>@{{ val.type | textFilter }} @{{ val.typeExtension }}<br>
                                <strong>Tamaño: </strong>@{{ val.size }}<br>
                                <div v-if="val.type === 'image'"><strong>Dimension: </strong>@{{ val.dimension }}</div>

                                <div class="text-left">
                                    <strong>Url: </strong>@{{ val.url | shortText }}&quot;
                                    <button type="button" class="btn btn-success" @click="copyText(val.url)"><i
                                                class="fas fa-copy"></i></button>
                                </div>
                                <br>
                                <div class="justify-content-right text-right">
                                    <a href="#" class="btn btn-danger btn-block" @click="deleteArchive(val,item)"><i
                                                class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@include('layouts.footscript')

<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('/js/axios.js?v=20190827') }}"></script>

<script src="{{ asset('assets/nprogress/nprogress.js?v=20190827') }}"></script>
<script type="text/javascript">
    $(function () {
        loadProgressBar()
    })
</script>

<script>

    var app = new Vue({
        el: '#app',
        data() {
            return {
                image: [],
                video: [],
                audio: [],
                office: [],
                data: [],
                statusPetition: false
            }
        },
        mounted() {
            this.loadLibrary()
        },
        methods: {
            loadLibrary() {
                RoutePost_BACK('{{route('library.archive.list.all')}}', {}).then(
                    response => {
                        if (response.data.code === 200) {
                            this.image = response.data.data.image;
                            this.video = response.data.data.video;
                            this.audio = response.data.data.audio;
                            this.office = response.data.data.office;
                            this.statusPetition = true
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            loadRecords(value) {
                if (this.statusPetition) {
                    this.statusPetition = false
                    let from = {
                        item: value
                    }
                    RoutePost_BACK('{{route('library.archive.load.item')}}', from).then(
                        response => {
                            if (response.data.code === 200) {
                                this.data = response.data.data
                                this.statusPetition = true
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                }

            },
            deleteArchive(value, item) {
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
                            id: value.id
                        }
                        RoutePost_BACK('{{route('library.archive.item.delete')}}', form).then(
                            response => {
                                if (response.data.code === 200) {
                                    this.loadLibrary()
                                    this.data.splice(item, 1)
                                    toastrPersonalized.toastr('', response.data.message, 'success');
                                    // Swal.fire(
                                    //     'Listo',
                                    //     response.data.message,
                                    //     'success'
                                    // ).then((result) => {
                                    // });

                                }
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }
                })
            },
            copyText(v) {
                var $temp = $("<input>")
                $("body").append($temp);
                $temp.val(v).select();
                document.execCommand("copy", true);
                $temp.remove();
                toastrPersonalized.toastr('Enlace copiado', v, 'success');
            }
        },
        filters: {
            textFilter: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            },
            shortText: function (value) {
                if (!value) return ''
                return value.substr(0, 20) + ". . ."
            }
        },
        computed: {},
    })
</script>
