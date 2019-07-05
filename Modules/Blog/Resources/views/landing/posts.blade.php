@extends('blog::landing.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        	<h1>Lista de Entradas</h1>

        	@foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-heading">{{ $post->title }}</div>

                <div class="panel-body">
                    {!! $post->content !!}
                    <a href="{{ route('web.blog.post', $post->slug) }}" class="pull-right">Leer más</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
