@extends('blog::landing.app')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <h1>{{ $post->name }}</h1>
                    <input value="{{$post->id}}" id="id_post" type="hidden">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Catergoría
                            <a href="{{ route('web.blog.category', $post->category->slug) }}">
                                {{ $post->category->name }}
                            </a>
                        </div>

                        <div class="panel-body">

                            {!! $post->content !!}
                            <hr>

                            Etiquetas
                            @foreach($post->tags as $tag)
                                <a href="{{ route('web.blog.tag', $tag->slug) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{--{{dd($post)}}--}}
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"
                                       class="collapsed" aria-expanded="false">
                                        Comentarios
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" aria-expanded="false"
                                 style="height: 0px;">
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nombre</th>
                                            <th>Comentario</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($post->comments as $item => $value)
                                            <tr>
                                                <td style="width: 15%">:D</td>
                                                <td style="width: 35%">{{$value->name}}</td>
                                                <td style="width: 50%">{{$value->comment}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class=""
                                       aria-expanded="true">
                                        Deja tu comentario.
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form @submit.prevent="saveRow">
                                        <div class="col-md-4">
                                            <div class="panel-group">
                                                <label>Nombre</label>
                                                <input v-model="name" v-validate="'required'" class="form-control"
                                                       :class="{'input': true, 'is-danger': errors.has('name') }"
                                                       type="text"
                                                       name="name" id="name"
                                                       placeholder="Nombre Completo">
                                                <i v-show="errors.has('name')"
                                                   class="fa fa-exclamation-triangle redAlert"></i>
                                                <span v-show="errors.has('name')"
                                                      class="help is-danger redAlert">@{{ errors.first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel-group">
                                                <label>Correo Electronico</label>
                                                <input v-model="email" v-validate="'required|email'"
                                                       class="form-control"
                                                       :class="{'input': true, 'is-danger': errors.has('email') }"
                                                       type="text"
                                                       name="email" id="email"
                                                       placeholder="Jose@google.com">
                                                <i v-show="errors.has('email')"
                                                   class="fa fa-exclamation-triangle redAlert"></i>
                                                <span v-show="errors.has('email')"
                                                      class="help is-danger redAlert">@{{ errors.first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel-group">
                                                <label>Valoracion</label>
                                                <select class="form-control" v-model="selectVal">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mensaje</label>
                                                <textarea v-model="comment" v-validate="'required'"
                                                          class="form-control"
                                                          :class="{'input': true, 'is-danger': errors.has('comment') }"

                                                          name="comment" id="comment" rows="5"
                                                          placeholder="Hola esto es una descripcion. . ."></textarea>
                                                <i v-show="errors.has('comment')"
                                                   class="fa fa-exclamation-triangle redAlert"></i>
                                                <span v-show="errors.has('comment')"
                                                      class="help is-danger redAlert">@{{ errors.first('comment') }}</span>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                </div>
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

@endsection
@section('scripts')
    <style>
        .redAlert {
            color: red;
            background-color: white;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://thdoan.github.io/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="https://thdoan.github.io/bootstrap-select/js/bootstrap-select.js"></script>

    <link href="{{ asset('assets/toastr/toastr.scss')}}" rel="stylesheet">
    <script src="{{ asset('assets/toastr/toastr.js')}}"></script>
    <script src="{{ asset('assets/toastr/toastrPersonalized.js')}}"></script>

    <script src="{{ asset('/js/vue.js') }}"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>

    <script src="{{ asset('/js/axios.js?v='.time()) }}"></script>

    <script src="{{ asset('assets/vue-validate/vee-validate.js')}}"></script>

    <script>
        Vue.use(VeeValidate);

        var app = new Vue({
            el: '#app',
            data() {
                return {
                    id_post: '',
                    name: '',
                    email: '',
                    comment: '',
                    selectVal: 1,
                }
            },
            methods: {
                saveRow() {
                    this.id_post = $('#id_post').val()
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let form = {
                                id_post: this.id_post,
                                name: this.name,
                                email: this.email,
                                comment: this.comment,
                                selectVal: this.selectVal,
                            }
                            RoutePost_BACK('{{route('web.save.comment')}}', form).then(
                                response => {
                                    if (response.data.code === 200) {
                                        toastrPersonalized.toastr('', response.data.message, 'success');
                                    }

                                    this.name = this.email = this.comment = '';

                                    this.$validator.reset()

                                })
                                .catch((error) => {
                                    toastrPersonalized.toastr('', error.message, 'warning');
                                });

                        }


                    });

                },

            },
            computed: {},
        })
    </script>
@endsection