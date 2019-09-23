<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GWA - Acceso</title>

    <link href="{{ asset('/vendors/fontawesome-free/css/all.min.css?v='.time()) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/sb-admin-2.min.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('assets/toastr/toastr.scss')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<div id="app">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img v-bind:src="imagelogo.value" style='width:100%;padding:10%'>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido a la administracion del
                                            Website</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('auth.login.post')}}">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Ingresa correo electrónico">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   class="form-control form-control-user" id="exampleInputPassword"
                                                   placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="customCheck" class="custom-control-input"
                                                       id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Acceder
                                        </button>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <a href='/' class="btn btn-primary btn-user btn-block">
                                                    Volver al Sitio
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script src="{{ asset('website_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<script src="{{ asset('assets/toastr/toastr.js')}}"></script>
<script src="{{ asset('assets/toastr/toastrPersonalized.js')}}"></script>

@include('layouts.toastr')

<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                texts: {},
                counters: {},
                imagelogo: {
                    value: 'img/loginimg.jpeg'
                },
            }
        },
        mounted() {
            loadElements('configweb/imagelogo', '').then(
                response => {
                    if (response.data.code !== 500) {

                        if (response.data.data.value != null) {
                            console.log('SHOWING');
                            console.log(response.data.data.value);
                            this.imagelogo = response.data.data;
                        }


                    } else {
                        console.log(response.data);
                    }
                })
                .catch(error => {
                    console.log(error);
                })


        },

    })
</script>

</body>
</html>
