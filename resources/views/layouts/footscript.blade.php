<script src="{{ asset('/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendors/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('assets/toastr/toastr.js')}}"></script>
<script src="{{ asset('assets/toastr/toastrPersonalized.js')}}"></script>

<script src="{{ asset('assets/vue-validate/vee-validate.js')}}"></script>

<script src="{{ asset('/js/sweetalert2@8.js') }}"></script>

<script >
    Vue.use(VeeValidate);
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
