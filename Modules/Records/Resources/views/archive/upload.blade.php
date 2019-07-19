@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div id="app">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-primary">Subir Archivo</h6>
                    </div>
                </div>

            </div>

            <div class="container">
                <br/>
                <h3 align="center">How to Upload a File using Dropzone.js with PHP</h3>
                <br/>
                <form action="{{route('records.archive.store')}}" class="dropzone" id="dropzoneFrom">

                </form>

                <br/>
                <br/>
                <div align="center">
                    <button type="button" class="btn btn-primary" id="submit-all">Guardar</button>
                </div>
                <br/>
                <br/>
                <br/>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')
@include('layouts.footscript')

<link href="{{ asset('assets/dropzone/dropzone.css?v='.time()) }}" rel="stylesheet">
<script src="{{asset('assets/dropzone/dropzone.js?v='.time())}}"></script>

<script>
    $(function () {
        Dropzone.options.dropzoneFrom = {
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFilezise: 5,
            init: function () {
                var submitBtn = document.querySelector('#submit-all');
                myDropzone = this;

                submitBtn.addEventListener("click", function () {
                    myDropzone.processQueue();
                });
                let tmp = '';
                this.on("complete", function (file) {
                    if (file.status === 'success') {
                        setTimeout(function () {
                            myDropzone.removeFile(file)
                        }, 3000)
                    }
                    if (file.status === 'error') {
                        toastrPersonalized.toastr('', 'Intente de nuevo', 'error');
                    }
                    clearTimeout(tmp)
                    tmp = setTimeout(function () {
                        myDropzone.processQueue();
                        console.log('hola')
                    }, 1000)

                });

                this.on("success", function () {
                        myDropzone.processQueue.bind(myDropzone)
                    }
                );
            }
        };
    })
</script>


{{--@include('layouts.header')--}}
{{--@include('layouts.sidebar')--}}
{{--@include('layouts.navbar')--}}

{{--<div id="app">--}}

{{--<div class="container-fluid">--}}
{{--<div class="card shadow mb-4">--}}
{{--<div class="card-header py-3">--}}
{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<h6 class="m-0 font-weight-bold text-primary">Subir Archivo</h6>--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}
{{--<div class="card-body">--}}
{{--<form action="{{route('records.archive.store')}}" class="dropzone" id="dropzone">--}}

{{--<div class="dz-message">--}}
{{--Arrastre sus Archivos aqui.--}}
{{--</div>--}}
{{--<div class="dropzone-previews"></div>--}}

{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}

{{--@include('layouts.footer')--}}
{{--@include('layouts.footscript')--}}

{{--<script src="{{ asset('/js/vue.js') }}"></script>--}}
{{--<script src="{{ asset('/js/axios.min.js') }}"></script>--}}
{{--<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>--}}
{{--<script src="{{ asset('/js/axios.js?v='.time()) }}"></script>--}}

{{--<script src="{{ asset('assets/vue-validate/vee-validate.js')}}"></script>--}}


{{--<link href="{{ asset('assets/dropzone/dropzone.css?v='.time()) }}" rel="stylesheet">--}}
{{--<script src="{{asset('assets/dropzone/dropzone.js?v='.time())}}"></script>--}}
{{--<style>--}}
{{--.dropzone .dz-preview .dz-progress .dz-upload {--}}
{{--display: block;--}}
{{--height: 100%;--}}
{{--width: 0;--}}
{{--background: #4169e1 !important;--}}
{{--}--}}
{{--</style>--}}
{{--<script>--}}
{{--Vue.use(VeeValidate);--}}

{{--var app = new Vue({--}}
{{--el: '#app',--}}
{{--data() {--}}
{{--return {--}}
{{--name: '',--}}
{{--}--}}
{{--},--}}
{{--mounted() {--}}
{{--},--}}
{{--methods: {--}}
{{--saveRow() {--}}
{{--this.$validator.validateAll().then((result) => {--}}
{{--if (result) {--}}
{{--RoutePost_BACK('{{route('records.archive.store')}}', {}).then(--}}
{{--response => {--}}

{{--console.log(response)--}}
{{--})--}}
{{--.catch((error) => {--}}
{{--console.log(error)--}}
{{--});--}}

{{--}--}}
{{--})--}}
{{--}--}}
{{--},--}}
{{--computed: {},--}}
{{--})--}}
{{--</script>--}}