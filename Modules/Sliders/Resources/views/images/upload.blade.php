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
                <h3 align="center">Puedes subir todas tus imagenes y encontrarlos en la lista de sliders.</h3>
                <br/>
                <form action="{{route('sliders.image.store')}}" class="dropzone" id="dropzone">

                </form>
                <br/>
                <br/>
                {{--<div align="center">--}}
                {{--<button type="button" class="btn btn-primary" id="submit-all">Guardar</button>--}}
                {{--</div>--}}
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
<script src="{{asset('assets/dropzone/dropzone.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        Dropzone.options.dropzone = {
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFilesize: 1,
            acceptedFiles: '.bmp,.cgm,.jpeg,.png,.webp,.gif',
            dictDefaultMessage: 'Selecciona o Arrastra tus Imagenes aqui.',
            dictRemoveFile: 'Eliminar',
            dictCancelUpload: '',
            init: function () {
                var submitBtn = document.querySelector('#submit-all');
                myDropzone = this;

                submitBtn.addEventListener("click", function () {
                    myDropzone.processQueue();
                });

                // let tmp = '';
                this.on("complete", function (file) {
                    if (file.status === 'success') {
                        setTimeout(function () {
                            myDropzone.removeFile(file)
                        }, 2000)
                        setTimeout(function () {
                            myDropzone.processQueue();
                        }, 1000)
                    }
                    if (file.status === 'error') {
                        toastrPersonalized.toastr('', 'Intente de nuevo', 'error');
                    }
                    // clearTimeout(tmp)
                    // tmp = setTimeout(function () {
                    //     myDropzone.processQueue();
                    // }, 1000)

                });

                // this.on("success", function () {
                //         myDropzone.processQueue.bind(myDropzone)
                //     }
                // );

                // this.on('removedfile', function (e) {
                //         console.log(e)
                //     return false
                // });

            },
            // addRemoveLinks:true,
        };
    })
</script>
