@include('layouts.header')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- End of Topbar -->
<div id="app">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    </div>



    <p class="mb-4">En esta lista puedes visualizar todos los productos que existen actualmente </p>
   
       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Productos</h6>
                </div>
                <div class="col-md-4">
                <a href="products/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nuevo Producto</span>
                  </a>
                </div>
            </div>
                
                
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="product in products">
                    <div class="row">
                    <div class="col-md-6">
                    @{{product.name}}
                    </div>
                    <div class="col-md-4">
                    @{{product.type_product.name}}
                    </div>
                    <div class="col-md-2">
                    <a href="#" class="btn btn-primary btn-circle">
                    <i class="fas fa-edit"></i>
                    </a>
                    </div>
                    </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>
   
    <!-- /.container-fluid -->



</div>
</div>
<!-- End of Main Content -->
@include('layouts.footer')
@include('layouts.footscript')

<!-- Additional Scripts -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('/js/axios.js') }}"></script>
<!-- Custom page Script -->
<script>
    var app = new Vue({
        el: '#app',
        data() {
            return {
                message: '',
                products: {},
            }
        },
        mounted() {
            loadElements('product', '').then(
                    response => {
                        if (response.data.code !== 500) {

                            console.log(response.data.data)
                            this.products = response.data.data;
                            console.log(this.products);

                        } else {
                            console.log(response.data);
                        }
                    })
                .catch(error => {
                    console.log(error);
                })



        },
        methods: {
            back() {

            },
            editSubmit() {

            },
            cleanform() {

            }

        },
        computed: {

        },
    })
</script>