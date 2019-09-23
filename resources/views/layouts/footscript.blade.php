{{--<script src="{{ asset('/vendors/jquery/jquery.min.js') }}"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>--}}
{{--<script src="{{ asset('/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>--}}
{{--<script src="{{ asset('/vendors/jquery-easing/jquery.easing.min.js') }}"></script>--}}
{{--<script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>--}}

{{--<script src="{{ asset('assets/toastr/toastr.js')}}"></script>--}}
{{--<script src="{{ asset('assets/toastr/toastrPersonalized.js')}}"></script>--}}

{{--<script src="https://unpkg.com/vue-select@3.0.0"></script>--}}
{{--<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">--}}


{{--</body>--}}
{{--</html>--}}

<script src="{{ asset('/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendors/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('assets/toastr/toastr.js')}}"></script>
<script src="{{ asset('assets/toastr/toastrPersonalized.js')}}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>

<script type="text/javascript">
    $(function () {

    })

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    })

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
</script>

</body>
</html>