@if(session()->has('status'))
    @if (session()->get('status') === 'OK')
        @if(is_array(session()->get('message')))
            @foreach(session()->get('message') as $item)
                <script>
                    $(function () {
                        toastrPersonalized.toastr('{!! session()->get('title') !!}', '{!! $item !!}', 'success');
                    });
                </script>
            @endforeach
        @else
            <script>
                $(function () {
                    toastrPersonalized.toastr('{!! session()->get('title') !!}', '{!! session()->get('message') !!}', 'success');
                });
            </script>
        @endif

        {{session()->remove('status')}}

    @endif

    @if (session()->get('status') === 'FAILED')
        @if(is_array(session()->get('message')))
            @foreach(session()->get('message') as $item)
                <script>
                    $(function () {
                        toastrPersonalized.toastr('{!! session()->get('title') !!}', '{!! $item !!}', 'error');
                    });
                </script>
            @endforeach
        @else
            <script>
                $(function () {
                    toastrPersonalized.toastr('{!! session()->get('title') !!}', '{!! session()->get('message') !!}', 'error');
                });
            </script>
        @endif

        {{session()->remove('status')}}

    @endif
@endif

