@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary">Cambiar
                            contraseña</h6>
                    </div>
                </div>


            </div>
            <div class="card-body">
                <form @submit.prevent="updatePassword">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password Current</label>
                                <input type="password" class="form-control" name="old_password"
                                       :class="{'input': true, 'is-danger': errors.has('old_password') }"
                                       v-model="old_password" v-validate="'required|min:6'"
                                       placeholder="* * * * * * * *">
                                <i v-show="errors.has('old_password')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('old_password')" class="help is-danger">@{{ errors.first('old_password') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group-append">

                                    <input v-model="password" v-validate="'required|min:6'" class="form-control"
                                           :class="{'input': true, 'is-danger': errors.has('password') }" type="password"
                                           name="password" placeholder="* * * * * *" id="password" ref="password">
                                    <button class="btn btn-primary btn-ms" type="button" id="showPassword"
                                            click="mostrarPassword()"><span
                                                class="fa fa-eye-slash icon iconPassword"></span></button>

                                </div>
                                <i v-show="errors.has('password')" class="fa fa-exclamation-triangle"></i>
                                <span v-show="errors.has('password')"
                                      class="help is-danger">@{{ errors.first('password') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control"
                                       :class="{'input': true, 'is-danger': errors.has('password_confirmation') }"
                                       v-model="password_confirmation" v-validate="'required|confirmed:password'"
                                       name="password_confirmation" placeholder="* * * * * * * *">
                                <i v-show="errors.has('password_confirmation')" class="fas fa-exclamation-triangle"></i>
                                <span v-show="errors.has('password_confirmation')" class="help is-danger">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 offset-sm-8">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

    </div>

</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<script type="text/javascript">
    $(function () {
        $(document).on('click', '#showPassword', function () {
            var change = document.getElementById("password");
            if (change.type == "password") {
                change.type = "text";
                $('.iconPassword').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                change.type = "password";
                $('.iconPassword').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        });
    })

</script>

<script>

    var app = new Vue({
        el: '#app',
        data() {
            return {
                old_password: '',
                password: '',
                password_confirmation: '',
            }
        },
        mounted() {
        },
        methods: {
            updatePassword() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Swal.fire({
                            title: 'Estas seguro?',
                            text: '',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Actualizar'
                        }).then((result) => {
                            if (result.value) {
                                let form = {
                                    old_password: this.old_password,
                                    password: this.password,
                                }
                                RoutePost_BACK('{{route('profile.update.password')}}', form).then(
                                    response => {
                                        if (response.data.code !== 500) {
                                            Swal.fire(
                                                'Listo',
                                                response.data.message,
                                                'success'
                                            ).then((result) => {
                                                window.location.href = '{{route('auth.logout')}}';
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

        },
        computed: {},
    })
</script>
